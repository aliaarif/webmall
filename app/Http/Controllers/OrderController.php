<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;
use App\Models\Role;
use App\Models\User;
use Session;
use Auth;

class OrderController extends Controller
{
    
    
    
    
    public function myOrders()
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
        
        $data = [
            'meta' => $meta,
            'auth' => $user,
            'cartItems' => $cartItems
        ];
        
        return Inertia::render('Orders/Myorders', $data);
    }  
    
    
    
}
