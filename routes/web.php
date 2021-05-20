<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\LibraryPaymentsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CronJobController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\DropdownController;



use Symfony\Component\HttpFoundation\Session\Session as HttpFoundationSessionSession;


use Laravel\Socialite\Facades\Socialite;
use Inertia\Inertia;


Route::get('dependent-dropdown', [DropdownController::class, 'index']);
Route::post('api/fetch-states', [DropdownController::class, 'fetchState']);
Route::post('api/fetch-cities', [DropdownController::class, 'fetchCity']);


Route::get('/cart', [CartController::class, 'cart'])->name('cart.index')->middleware('web');
Route::post('/add-to-cart', [CartController::class, 'add'])->name('cart.add')->middleware('web');
Route::post('/update-cart', [CartController::class, 'update'])->name('cart.update')->middleware('web');
Route::post('/remove-from-cart', [CartController::class, 'remove'])->name('cart.remove')->middleware('web');

Route::get('/{slug}' , [WelcomeController::class,'details'])->where('slug', '!=', 'login')->name('details');

Route::get('/address' , [AddressController::class,'address'])->name('address');

Route::get('/' , [WelcomeController::class,'welcome'])->name('welcome');
Route::get('dashboard' , [WelcomeController::class,'dashboard'])->name('dashboard')->middleware('auth');

Route::get('/login' , [AuthController::class,'loginForm'])->name('loginForm');
Route::post('/login' , [AuthController::class,'login'])->name('login');

Route::post('/logout' , [AuthController::class,'logout'])->name('logout');

Route::prefix('sign-in')->group(function(){
    Route::get('{social_provider}' , [AuthController::class,'redirectToProvider'])->name('redirectToProvider');
    Route::get('{social_provider}/callback' , [AuthController::class,'handleProviderCallback'])->name('handleProviderCallback');
});


Route::middleware('auth')->group(function(){
    Route::get('/checkout', [PaymentController::class, 'checkout']);
    
    Route::post('/checkout', [PaymentController::class, 'processCheckout']);
    
    Route::get('/my-orders', [OrderController       ::class, 'myOrders'])->name('myorders');
});
