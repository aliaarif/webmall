<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Country;
use App\Models\Address;
use Razorpay\Api\Api;
use Exception;
use Session;
use Inertia\Inertia;
use App\Models\Role;
use App\Models\User;
use Auth;

class PaymentController extends Controller
{
  
  
  
  public function checkout()
  {
    
    $user = Auth::check() ? User::where('id', Auth::id())->with('roles')->first() : false;
    $meta = [
      'title' => env('APP_NAME', 'Application') . ' | Home',
      'description' => 'This is dummy description for the Application from dynamic'
    ];
    
    // view the cart items
    $items = \Cart::session(session()->getId() ?? Auth::id())->getContent();
    
    $cartItems = [];
    foreach($items as $row) {array_push($cartItems, $row);}
    sort($cartItems);
    $cartTotalQuantity = \Cart::session(session()->getId() ?? Auth::id())->getTotalQuantity() ?? 0;
    $countries = Country::with('states:id,name')->get();
    $addresses = Address::where('user_id', Auth::id())->get();
    
    //dd($addresses);
    
    //dd($countries);
    $data = [
      'meta' => $meta,
      'auth' => $user,
      'cartItems' => $cartItems,
      'cartTotalQuantity' => $cartTotalQuantity,
      'countries' => $countries,
      'addresses' => $addresses
    ];
    return Inertia::render('Checkout/Index', $data);
  }
  
  
  
  public function makePayment(Request $request)
  {
    // $input = $request->all();
    // $api = new Api(env('RAZORPAY_KEY', 'rzp_test_HbTgIQNLrQUvHu'), env('RAZORPAY_SECRET', 'b6N61bUE4V2EDr9PwPzkol0r'));
    // $order = $api->order->create(array(
      //   'receipt' => '123',
      //   'amount' => 100,
      //   'currency' => 'INR'
      //   )
      //   Session::put('success', 'Payment successful');
      
      $user =  User::where('id', Auth::id())->with(['roles', 'addresses', 'cards'])->first();
      
      dd($user);
      // $items = \Cart::session(session()->getId() ?? Auth::id())->getContent();
      // $cartItems = [];
      // foreach($items as $row) {array_push($cartItems, $row);}
      // sort($cartItems);
      // $data = [
        //     'auth' => $user,
        //     'cartItems' => $cartItems
        // ];
        
        
        
        //After Successfull Payment
        
        //Store Order data into orders table
        
        //Store Order data into order_items table
        
        return redirect()->route('myorders');
      }
      
      
      
      
      
    }
    