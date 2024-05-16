<?php
    Route::group([
        'prefix' => 'auth'
    ], function () {
        Route::get('login',[Modules\Employee\app\Http\Controllers\auth\AuthController::class,'login'])->name('employee.auth.login');
        Route::post('postLogin',[Modules\Employee\app\Http\Controllers\auth\AuthController::class,'postLogin'])->name('employee.auth.postLogin');
        // Register
        Route::get('register',[Modules\Employee\app\Http\Controllers\auth\AuthController::class,'register'])->name('employee.auth.register');
        Route::post('postRegister',[Modules\Employee\app\Http\Controllers\auth\AuthController::class,'postRegister'])->name('employee.auth.postRegister');
       
        // Route::get('verification',[Modules\Employee\app\Http\Controllers\auth\AuthController::class,'verification'])->name('employee.auth.verification');

    });