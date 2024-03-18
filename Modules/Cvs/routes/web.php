<?php

use Illuminate\Support\Facades\Route;
use Modules\Cvs\app\Http\Controllers\Admin\CvsController as AdminCvs;
use Modules\Cvs\app\Http\Controllers\Website\CvsController as WebsiteCvs;

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
    Route::get('/cvs', [AdminCvs::class,'index'])->name('cvs.index');
	Route::get('/cvs/create', [AdminCvs::class,'create'])->name('cvs.create');
	Route::post('/cvs/store', [AdminCvs::class,'store'])->name('cvs.store');
	Route::get('/cvs/edit/{id}', [AdminCvs::class,'edit'])->name('cvs.edit');
	Route::get('/cvs/{id}', [AdminCvs::class,'show'])->name('cvs.show');
	Route::post('/cvs/{id}', [AdminCvs::class,'update'])->name('cvs.update');
	Route::get('/cvs/delete/{id}', [AdminCvs::class,'destroy'])->name('cvs.destroy');
});
Route::get('/cvs', [WebsiteCvs::class,'index'])->name('cvs.index');
Route::get('/cvs/create', [WebsiteCvs::class,'create'])->name('cvs.create');
Route::post('/cvs/store', [WebsiteCvs::class,'store'])->name('cvs.store');
Route::get('/cvs/edit/{id}', [WebsiteCvs::class,'edit'])->name('cvs.edit');
Route::get('/cvs/{id}', [WebsiteCvs::class,'show'])->name('cvs.show');
Route::post('/cvs/{id}', [WebsiteCvs::class,'update'])->name('cvs.update');
Route::get('/cvs/delete/{id}', [WebsiteCvs::class,'destroy'])->name('cvs.destroy');