<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Modules\Staff\app\Http\Controllers\AuthController;
use Modules\Transaction\app\Http\Controllers\TransactionController;
use Modules\Transaction\app\Http\Controllers\Admin\TransactionController as TransactionsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([
	'middleware' => ['auth.employee'],
	'as' => 'employee.'
], function () {
    //Job
	Route::get('/transaction', [TransactionController::class,'index'])->name('transaction.index');
	Route::get('/transaction/create', [TransactionController::class,'create'])->name('transaction.create');
	Route::post('/transaction/store', [TransactionController::class,'store'])->name('transaction.store');
	Route::get('/transaction/edit/{id}', [TransactionController::class,'edit'])->name('transaction.edit');
	Route::get('/transaction/{id}', [TransactionController::class,'show'])->name('transaction.show');
	Route::post('/transaction/{id}', [TransactionController::class,'update'])->name('transaction.update');
	Route::get('/transaction/delete/{id}', [TransactionController::class,'destroy'])->name('transaction.destroy');
});
Route::group([
	'middleware' => ['auth.employee'],
	'as' => 'admin.',
	'prefix' => 'admin'
], function () {
	Route::get('transactions',[TransactionsController::class,'index'])->name('transactions.index');
	Route::get('transactions/create',[TransactionsController::class,'create'])->name('transactions.create');
	Route::post('transactions/store',[TransactionsController::class,'store'])->name('transactions.store');
	Route::get('/transactions/edit/{id}', [TransactionsController::class,'edit'])->name('transactions.edit');
	Route::get('/transactions/{id}', [TransactionsController::class,'show'])->name('transactions.show');
	Route::post('/transactions/{id}', [TransactionsController::class,'update'])->name('transactions.update');
	Route::get('/transactions/delete/{id}', [TransactionsController::class,'destroy'])->name('transactions.destroy');
});

 
// Route login Facebook
Route::get('/login/facebook', [AuthController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('/login/facebook/callback', [AuthController::class, 'handleFacebookCallback']);

// Route login Google
Route::get('/login/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/callback', [AuthController::class ,'handleGoogleCallback']);

