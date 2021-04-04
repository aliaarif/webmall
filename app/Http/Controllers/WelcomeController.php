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
        $user = Auth::check() ? User::where('id', Auth::id())->with('roles')->first() : false;
        $meta = [
            'title' => env('APP_NAME', 'Application') . ' | Home',
            'description' => 'This is dummy description for the Application from dynamic'
        ];

        $data = [
            'meta' => $meta,
            'products' => Product::take(20)->get(),
            'auth' => $user
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

        $data = [
            'meta' => $meta,
            'products' => Product::take(20)->get(),
            'auth' => $user,
            'product' => $product
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

        $data = [
            'meta' => $meta,
            'auth' => $user,
            'products' => Product::all(),
        ];

        return Inertia::render('Dashboard', $data);
    }





    public function businessSchoolApplicationFee()
    {

        $user = Auth::check() ? User::where('id', Auth::id())->with('roles')->first() : false;
        $meta = [
            'title' => 'Business School Application Fee | ' . env('APP_NAME', 'Application'),
            'description' => 'This is dummy description for the Application from dynamic'
        ];

        $data = [
            'meta' => $meta,
            'auth' => $user,
            'products' => Product::all(),
            'tab' => Session::get('tab') ?? 'Login Panel'
        ];

        return Inertia::render('BusinessSchoolApplicationFee', $data);
    }

    public function libraryPayments(Request $request)
    {
        $module = 'charges';
        $user = Auth::check() ? User::where('id', Auth::id())->with('roles')
            ->when($module, function ($q) use ($module) {
                return $q->with($module);
            })
            ->first()
            : false;

        $meta = [
            'title' => 'Library Payments | ' . env('APP_NAME', 'Application'),
            'description' => 'This is dummy description for the Application from dynamic'
        ];

        $data = [
            'meta' => $meta,
            'auth' => $user,
            'tab' => Session::get('tab') ?? 'Login Panel',
            'sessions' => $request->session()->all(),
            'responseStatus' => Session::get('status') ?? false
        ];

        return Inertia::render('LibraryPayments', $data);
    }
}
