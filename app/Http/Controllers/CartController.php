<?php

namespace App\Http\Controllers;

use App\Models\Product;
//use App\Models\Cart;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Auth;
use App\Models\Role;
use App\Models\User;

class CartController extends Controller
{
    
    public function add(Request $request)
    {
        $product = Product::find($request->productId);

        if($product){

            // add the product to cart
            \Cart::session(Auth::id())->add(array(
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'attributes' => array(),
                'associatedModel' => $product
            ));

            return redirect()->route('cart.index');

        }
    }


    public function index()
    {

        $user = Auth::check() ? User::where('id', Auth::id())->with('roles')->first() : false;
        $meta = [
            'title' => env('APP_NAME', 'Application') . ' | Home',
            'description' => 'This is dummy description for the Application from dynamic'
        ];

        // view the cart items
        $items = \Cart::session(Auth::id())->getContent();

        $cartItems = [];
        foreach($items as $row) {array_push($cartItems, $row);}

        //return $cartItems;

        

        $data = [
            'meta' => $meta,
            'products' => Product::take(20)->get(),
            'auth' => $user,
            'cartItems' => $cartItems
        ];

        return Inertia::render('Cart/Index', $data);
    }    


}
