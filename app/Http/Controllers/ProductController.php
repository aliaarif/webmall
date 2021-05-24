<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;

use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\UserDetail;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\CommonTraits;

use Session;
use Config;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;


class ProductController extends Controller
{
    
    
    public function products(){
        $products = Product::with('categories:id,name')->get();
        
        return $products;
    }
}