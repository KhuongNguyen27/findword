<?php

use Illuminate\Support\Facades\Route;
use Modules\Transaction\app\Http\Controllers\TransactionController;

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
	Route::get('/transaction/show/{id}', [TransactionController::class,'show'])->name('transaction.show');
	Route::post('/transaction/update/{id}', [TransactionController::class,'update'])->name('transaction.update');
	Route::get('/transaction/delete/{id}', [TransactionController::class,'destroy'])->name('transaction.destroy');
});
Route::group([
	'middleware' => ['auth.employee'],
	'as' => 'admin.',
	'prefix' => 'admin'
], function () {
	Route::get('transactions',[TransactionController::class,'transactions'])->name('transactions');
});