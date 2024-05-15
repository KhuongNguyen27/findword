<?php
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [Modules\Employee\app\Http\Controllers\profile\ProfilesController::class,'index'])->name('employee.profile.index');
        Route::post('/update/{id}', [Modules\Employee\app\Http\Controllers\profile\ProfilesController::class,'update'])->name('employee.profile.update');
    });                       
    
