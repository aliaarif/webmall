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

use Symfony\Component\HttpFoundation\Session\Session as HttpFoundationSessionSession;


use Laravel\Socialite\Facades\Socialite;
use Inertia\Inertia;

Route::get('/basket', [CartController::class, 'basket'])->name('basket.index')->middleware('web');
Route::get('/cart', [CartController::class, 'cart'])->name('cart.index')->middleware('web');
Route::post('/add-to-cart', [CartController::class, 'add'])->name('cart.add')->middleware('web');
Route::post('/update-cart', [CartController::class, 'update'])->name('cart.update')->middleware('web');
Route::post('/remove-from-cart', [CartController::class, 'remove'])->name('cart.remove')->middleware('web');

Route::get('/{slug}' , [WelcomeController::class,'details'])->where('slug', '!=', 'login')->name('details');

Route::get('/' , [WelcomeController::class,'welcome'])->name('welcome');
Route::get('dashboard' , [WelcomeController::class,'dashboard'])->name('dashboard')->middleware('auth');

Route::get('/login' , [AuthController::class,'loginForm'])->name('loginForm');
Route::post('/login' , [AuthController::class,'login'])->name('login');

Route::post('/logout' , [AuthController::class,'logout'])->name('logout');

//Route::get('/auth/{social_provider}/login' , [AuthController::class,'socialSignInForm'])->name('socialSignInForm');
//Route::post('/auth/{social_provider}/login' , [AuthController::class,'socialSignIn'])->name('socialSignIn');

Route::prefix('sign-in')->group(function(){
    Route::get('{social_provider}' , [AuthController::class,'redirectToProvider'])->name('redirectToProvider');
    Route::get('{social_provider}/callback' , [AuthController::class,'handleProviderCallback'])->name('handleProviderCallback');
});



// Route::middleware([])->group(function(){
// foreach(Config::get('modules', 'default') as $module){
//     Route::get($module['route'] , [WelcomeController::class, $module['getMethod']])->name($module['getMethod']);
// }
// });

// Start Library Payments Routes
//Route::get('/library-payments', [LibraryPaymentsController::class, 'lpLogin'])->name('lp.login');
// Route::middleware(['CheckLPSession'])->group(function() {
//     Route::get('/library-payments/steps-to-process', [LibraryPaymentsController::class, 'lpSteps'])->name('lp.steps');
//     Route::post('/library-payments/confirm-application', [LibraryPaymentsController::class, 'confirmApi'])->name('lp.confirmApi');
//     Route::post('/library-payments/suite-details', [LibraryPaymentsController::class, 'suiteItemsDetail'])->name('lp.suiteItemsDetail');
// });
Route::post('/library-payments/verify', [LibraryPaymentsController::class, 'lpValidateLogin'])->name('lp.validateLogin');

// Route::post('/library-payments/order', [LibraryPaymentsController::class, 'lpOrder'])->name('lp.order');
// Route::get('/library-payments/thank-you', [LibraryPaymentsController::class, 'lpThankYou'])->name('lp.ThankYou');

// Ends Library Payments Routes


Route::post('/payment_failure', [OrderController::class, 'updateFailurePayment']);
Route::get('/payment_confirmation', [OrderController::class, 'updateSuccessPayment'])->name('payment_confirmation');
//Route::post('/events-durham-login-verify', [EventsDurhamController::class, 'validateEventsDurhamLogin']);
// payment gateway routes
Route::get('/continue-to-payment', function () {
    return view('checkout');
});
Route::get('/checkout', [PaymentController::class, 'processPaymentRequest']);
Route::get('/api-test', [PaymentController::class, 'testMiddlewareAPI']);
Route::post('/process-payment-response', [PaymentController::class, 'processResponse']);

