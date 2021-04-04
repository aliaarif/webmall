<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/products' , [ProductController::class,'products'])->name('list.products');

Route::post('/purchase' , [AuthController::class,'purchase'])->name('product.purchase');


Route::post('/auth/token', [ApiController::class, 'generateToken']);

// Route::post('/auth/token', function(){
//     session(['aaa' => 111]);
//         dd(session()->get('aaa'));
// });

Route::middleware(['CheckApiToken'])->group(function() {
Route::post('/deposits/applicant' , [ApiController::class,'ApplicantDeposits_Login']);
Route::get('/deposits/{applicant_id}' , [ApiController::class,'ApplicantDeposits_Deposits']);
Route::post('/deposits/{applicant_id}' , [ApiController::class,'DepositsTransaction_Details']);

Route::post('/application-fees/applicant' , [ApiController::class,'ApplicationFees_Login']);
Route::get('/application-fees/{applicant_id}' , [ApiController::class,'ApplicationFees_Deposits']);
Route::post('/application-fees/{applicant_id}' , [ApiController::class,'ApplicationFeesTransaction_Details']);

Route::get('/business-school-study-tours/{student_id}' , [ApiController::class,'GetBusinessSchoolStudyTours']);

Route::get('/get-library-payments/{username}' , [ApiController::class,'GetLibraryPayments']);

Route::post('/direct-debits/user', [ApiController::class,'directDebitAuth']);
Route::post('/direct-debits/validate-account', [ApiController::class,'directDebitValidate']);
Route::post('/direct-debits/{user}', [ApiController::class,'directDebitSave']);

Route::get('/print/{user}/credit', [ApiController::class,'printCreditBalance']);
Route::post('/print/{user}/credit', [ApiController::class,'printCreditSave']);
Route::get('/print/{userid}/transactions', [ApiController::class,'printCreditTransactions']);

Route::post('/transactions/{userid}', [ApiController::class, 'updateTransaction']);

Route::get('/user/{userid}', [ApiController::class,'getUser']);

});
