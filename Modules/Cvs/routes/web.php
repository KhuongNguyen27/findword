<?php

use Illuminate\Support\Facades\Route;
use Modules\Cvs\app\Http\Controllers\CvsController;

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
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth.employee']
], function () {
    Route::get('/cvs', [CvsController::class,'index'])->name('cvs.index');
	Route::get('/cvs/create', [CvsController::class,'create'])->name('cvs.create');
	Route::post('/cvs/store', [CvsController::class,'store'])->name('cvs.store');
	Route::get('/cvs/edit/{id}', [CvsController::class,'edit'])->name('cvs.edit');
	Route::get('/cvs/{id}', [CvsController::class,'show'])->name('cvs.show');
	Route::post('/cvs/{id}', [CvsController::class,'update'])->name('cvs.update');
	Route::get('/cvs/delete/{id}', [CvsController::class,'destroy'])->name('cvs.destroy');
});