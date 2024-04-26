<?php

use Illuminate\Support\Facades\Route;
use Modules\AdminUser\app\Http\Controllers\AdminAuthController;
use Modules\AdminUser\app\Http\Controllers\AdminUserController;

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

Route::group(
    [
        'prefix' => 'admin',
    ],
    function () {
        Route::group([
            'prefix' => 'adminuser',
        ], function () {
            Route::get('login', [AdminAuthController::class, 'login'])->name('login');
            Route::post('postLogin', [AdminAuthController::class, 'postLogin'])->name('adminuser.postLogin');
            Route::get('logout', [AdminAuthController::class, 'logout'])->name('adminuser.logout');

            Route::get('register', [AdminAuthController::class, 'register'])->name('adminuser.register');
            Route::post('postRegister', [AdminAuthController::class, 'postRegister'])->name('adminuser.postRegister');

            Route::get('forgotPass', [AdminAuthController::class, 'forgotPass'])->name('adminuser.forgotPass');
            Route::post('postForgotPass', [AdminAuthController::class, 'postForgotPass'])->name('adminuser.postForgotPass');

            Route::get('resetPass', [AdminAuthController::class, 'resetPass'])->name('adminuser.resetPass');
            Route::post('postResetPass', [AdminAuthController::class, 'postResetPass'])->name('adminuser.postResetPass');
        });

        Route::group(['middleware' => ['auth','auth.admin']], function () {
            Route::get('adminuser/{id}/cvs/{type}', [AdminUserController::class, 'showCVs'])->name('adminuser.showCVs');
            Route::get('adminuser/{id}/cv/{type}', [AdminUserController::class, 'showCV'])->name('adminuser.showCV');
            Route::resource('adminuser', AdminUserController::class)->names('adminuser');
        });
    }
);
