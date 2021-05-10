<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LibraryPayment;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\CommonTraits;
use App\Models\Order;
use App\Models\OrderItems;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Mail\LibraryPaymentMail;
use App\Models\Role;
use App\Models\User;
use Mail;
use Session;
use Config;
use App\Models\Product;
use Inertia\Inertia;
use Auth;

class WelcomeController extends Controller
{

    use CommonTraits;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $moduleRoute = [];
        //  foreach(Product::all() as $module){
        //     $data = [
        //         'products' => Product::all(),
        //         'page_title' => env('APP_NAME', 'Application').' | Home'
        //         ];

        //     return Inertia::render($module['getMethod'], $data);
        // }
    }

    public function welcome()
    {

        /**
        * clear cart
        *
        * @return void
        */
        // \Cart::clear();
        // \Cart::session(session()->getId() ?? Auth::id())->clear();

        $user = Auth::check() ? User::where('id', Auth::id())->with('roles')->first() : false;
        $meta = [
            'title' => env('APP_NAME', 'Application') . ' | Home',
            'description' => 'This is dummy description for the Application from dynamic'
        ];
        $cartTotalQuantity = \Cart::session(session()->getId() ?? Auth::id())->getTotalQuantity() ?? 0;
        

        $data = [
            'meta' => $meta,
            'products' => Product::take(20)->get(),
            'auth' => $user,
            'cartItems' => $cartTotalQuantity
        ];

        return Inertia::render('Welcome', $data);
    }

    public function details($slug)
    {

        $user = Auth::check() ? User::where('id', Auth::id())->with('roles')->first() : false;
        $meta = [
            'title' => env('APP_NAME', 'Application') . ' | Home',
            'description' => 'This is dummy description for the Application from dynamic'
        ];
        $product = Product::where('slug', $slug)->first();
        $cartItems = \Cart::session(session()->getId() ?? Auth::id())->getTotalQuantity() ?? 0;
        

        $data = [
            'meta' => $meta,
            'products' => Product::take(20)->get(),
            'auth' => $user,
            'product' => $product,
            'cartItems' => $cartItems
            
        ];

        return Inertia::render('Details', $data);
    }

    public function dashboard()
    {

        $user = Auth::check() ? User::where('id', Auth::id())->with('roles')->first() : false;
        $meta = [
            'title' => env('APP_NAME', 'Application') . ' | Dashboard',
            'description' => 'This is dummy description for the Application dashboard'
        ];
        $cartItems = \Cart::session(session()->getId() ?? Auth::id())->getTotalQuantity() ?? 0;

        $data = [
            'meta' => $meta,
            'auth' => $user,
            'products' => Product::all(),
            'cartItems' => $cartItems
        ];

        return Inertia::render('Dashboard', $data);
    }

}
