<?php

use Illuminate\Support\Facades\Route;
use Modules\Job\app\Http\Controllers\JobController;

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

// Route::group([], function () {
//     Route::resource('job', JobController::class)->names('job');
// });


Route::group([
    'prefix'=>'jobs',
    'as'=>'website.',
],function () {
    Route::get('/', [JobController::class,'index'])->name('home');
    Route::get('/vietnam', [JobController::class,'index'])->name('homewcountry');
    Route::get('/{slug}', [JobController::class, 'show'])->name('jobs.show');
    Route::get('/aplication/{id}', [JobController::class,'aplication'])->name('jobs.aplication');
    // Route::get('/showjob/{id}', [JobController::class,'show'])->name('jobs.show');
});