<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;
use App\Models\Role;
use App\Models\User;
use Session;
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
        
        $data = [
            'meta' => $meta,
            'auth' => $user,
            'cartItems' => $cartItems,
            'cartTotalQuantity' => $cartTotalQuantity
        ];

        return Inertia::render('Checkout/Index', $data);
    }  
    
    
    
    public function processCheckout()
    {
        $user = Auth::check() ? User::where('id', Auth::id())->with('roles')->first() : false;   
        $items = \Cart::session(session()->getId() ?? Auth::id())->getContent();
        $cartItems = [];
        foreach($items as $row) {array_push($cartItems, $row);}
        sort($cartItems);
        $data = [
            'auth' => $user,
            'cartItems' => $cartItems
        ];

        //After Successfull Payment

        //Store Order data into orders table
        
        //Store Order data into order_items table

        return redirect()->route('myorders');
    }  


    


}
