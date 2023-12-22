<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\app\Http\Controllers\AuthController;

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
    'prefix' => 'auth'
], function () {
    Route::get('login',[AuthController::class,'login'])->name('auth.login');
    Route::post('postLogin',[AuthController::class,'postLogin'])->name('auth.postLogin');
    Route::get('logout',[AuthController::class,'logout'])->name('auth.logout');

    // Register
    Route::get('register',[AuthController::class,'register'])->name('auth.register');
    Route::post('postRegister',[AuthController::class,'postRegister'])->name('auth.postRegister');

    // Forgot password
    Route::get('/forgot',[AuthController::class,'forgot'])->name('auth.forgot');
    Route::post('/postForgot',[AuthController::class,'postForgot'])->name('auth.postForgot');
    Route::get('/resetPassword/{token}',[AuthController::class,'getReset'])->name('auth.getReset');
    Route::post('/resetPassword/{token}',[AuthController::class,'postReset'])->name('auth.postReset');
});


