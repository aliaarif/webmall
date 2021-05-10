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
    // add the product to cart
    public function add(Request $request)
    {
        $product = Product::find($request->pid);

        if($product){
            \Cart::session(session()->getId() ?? Auth::id())->add(array(
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'attributes' => [
                    'cover_img' => $product->cover_img
                ],
                'associatedModel' => $product
            ));
            $cartItems = \Cart::session(session()->getId() ?? Auth::id())->getTotalQuantity() ?? 0;
            return back()->with(['cartItems' => $cartItems]);
        }
    }



    // update the product to cart
    public function update(Request $request)
    {
        $qty = $request->action == 'plus' ? 1 : -1;
        $product = Product::find($request->pid);
        if($product)
        {
            if($request->qty == 1 && $qty == -1){
                \Cart::session(session()->getId() ?? Auth::id())->remove($request->pid);
            }else{
                \Cart::session(session()->getId() ?? Auth::id())->update($request->pid,['quantity' => $qty]);
            }
            return redirect()->route('cart.index');
        }
    }


    public function remove(Request $request)
    {
        // remove the product from cart
        \Cart::session(session()->getId() ?? Auth::id())->remove($request->pid);
        return redirect()->route('cart.index');
    }


    public function cart()
    {

        $user = Auth::check() ? User::where('id', Auth::id())->with('roles')->first() : false;
        $meta = [
            'title' => env('APP_NAME', 'Application') . ' | Home',
            'description' => 'This is dummy description for the Application from dynamic'
        ];
        

        // view the cart items
        $items = \Cart::session(session()->getId() ?? Auth::id())->getContent();
        

        $cartItemsArr = [];
        foreach($items as $row) {array_push($cartItemsArr, $row);}
        sort($cartItemsArr);
        $cartTotalQuantity = \Cart::session(session()->getId() ?? Auth::id())->getTotalQuantity() ?? 0;

        $data = [
            'meta' => $meta,
            'products' => Product::take(20)->get(),
            'auth' => $user,
            'cartItems' => $cartItemsArr,
            'cartTotalQuantity' => $cartTotalQuantity

        ];


        return Inertia::render('Cart/Index', $data);
    }    


}
