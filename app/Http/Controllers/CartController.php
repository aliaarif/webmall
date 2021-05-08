<?php

namespace App\Http\Controllers;

use App\Models\Product;
//use App\Models\Cart;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Auth;
use App\Models\Role;
use App\Models\User;
use Session;

class CartController extends Controller
{
    
    public function add(Request $request)
    {
        $product = Product::find($request->productId);

        if($product){

            // add the product to cart
            \Cart::session(Auth::id() ?? session()->getId())->add(array(
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'attributes' => [
                    'cover_img' => $product->cover_img
                ],
                'associatedModel' => $product
            ));
            $cartItems = \Cart::session(Auth::id() ?? session()->getId())->getTotalQuantity() ?? 0;
            return back()->with(['cartItems' => $cartItems]);

        }
    }




    public function update(Request $request)
    {
        //dd($request->all());
        $product = Product::find($request->pid);
        if($product){
            if($request->qty == 0){
            // remove the product from cart
            \Cart::session(Auth::id() ?? session()->getId())->remove($request->pid);
            //dd(\Cart::session(Auth::id() ?? session()->getId())->getContent());
            return redirect()->route('basket.index');
            }else{
                //dd($request->qty);
                // update the item on cart
                \Cart::session(Auth::id() ?? session()->getId())
                    ->update($request->pid,
                        [
                            'quantity' => $request->qty
                        ]
                    );
                //dd(\Cart::session(Auth::id() ?? session()->getId())->getContent());
                return redirect()->route('basket.index');
            }
        }
    }

    public function remove(Request $request)
    {
        // remove the product from cart
        \Cart::session(Auth::id() ?? session()->getId())->remove($request->productId);
        return redirect()->route('basket.index');
    }


    public function cart()
    {

        $user = Auth::check() ? User::where('id', Auth::id())->with('roles')->first() : false;
        $meta = [
            'title' => env('APP_NAME', 'Application') . ' | Home',
            'description' => 'This is dummy description for the Application from dynamic'
        ];

        // view the cart items
        $items = \Cart::session(Auth::id() ?? session()->getId())->getContent();

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


    public function basket()
    {

        $user = Auth::check() ? User::where('id', Auth::id())->with('roles')->first() : false;
        $meta = [
            'title' => env('APP_NAME', 'Application') . ' | Home',
            'description' => 'This is dummy description for the Application from dynamic'
        ];

        // view the cart items
        $items = \Cart::session(Auth::id() ?? session()->getId())->getContent();

        $cartItems = [];
        foreach($items as $row) {array_push($cartItems, $row);}

        //return $cartItems;

        

        $data = [
            'meta' => $meta,
            'products' => Product::take(20)->get(),
            'auth' => $user,
            'cartItems' => $cartItems
        ];

        return Inertia::render('Basket/Index', $data);
    }    


}
