<?php

use Illuminate\Support\Facades\Route;
use Modules\Employee\app\Http\Controllers\EmployeeController;
use Modules\Employee\app\Http\Controllers\AuthController;
use Modules\Employee\app\Http\Controllers\ProfileController;
use Modules\Employee\app\Http\Controllers\JobController;
use Modules\Employee\app\Http\Controllers\HomeEmployeeController;
use Modules\Employee\app\Http\Controllers\JobapplicationController;
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
	'prefix' => 'employee',
	'middleware' => ['auth.employee'],
	'as' => 'employee.'
], function () {



	// profile
	Route::get('/', [ProfileController::class, 'dashboard'])->name('home');
	Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
	Route::post('/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile/changepassword', [ProfileController::class, 'editpassword'])->name('profile.editpassword');
	Route::post('/change-password/{id}', [ProfileController::class, 'changePassword'])->name('profile.changePassword');
	Route::post('/delete-image', [ProfileController::class, 'deleteImage'])->name('image.delete');


	//Job
	Route::group(['middleware' => 'badword.filter'], function () {
		Route::get('/jobs', [JobController::class, 'index'])->name('job.index');
		Route::get('/job/create', [JobController::class, 'create'])->name('job.create');
		Route::post('/job/store', [JobController::class, 'store'])->name('job.store');
		Route::get('/job/edit/{id}', [JobController::class, 'edit'])->name('job.edit');
		Route::get('/job/show/{id}', [JobController::class, 'show'])->name('job.show');
		Route::post('/job/update/{id}', [JobController::class, 'update'])->name('job.update');
		Route::delete('/job/delete/{id}', [JobController::class, 'destroy'])->name('job.delete');
		Route::get('/job/{id}/applied-jobs', [JobController::class, 'showjobcv'])->name('job.showjobcv');
	});

	// CV apply
	Route::get('/applied-jobs', [JobapplicationController::class, 'index'])->name('cv.index');
	Route::get('/applied-jobs/{id}', [JobapplicationController::class, 'show'])->name('cv.show');
	Route::put('/cv/update/{id}', [JobapplicationController::class, 'update'])->name('cv.update');
	Route::delete('/cv/delete/{id}', [JobapplicationController::class, 'destroy'])->name('cvs.delete');
	Route::get('/applied-jobs/{id}/send-email', [JobapplicationController::class, 'sendEmail'])->name('cv.sendemail');
});

Route::post('/applied-jobs/store', [JobapplicationController::class, 'store'])->name('cv.store');
// list employ website
Route::get('/employees', [EmployeeController::class, 'index'])->name('employee.index');
Route::get('/employees/{id}', [EmployeeController::class, 'show'])->name('employee.show');

Route::group([
	'prefix' => 'employee',
	'as' => 'employee.'
], function () {
	Route::get('login', [AuthController::class, 'login'])->name('login');
	Route::post('postLogin', [AuthController::class, 'postLogin'])->name('postLogin');
	// Register
	Route::get('register', [AuthController::class, 'register'])->name('register');
	Route::post('postRegister', [AuthController::class, 'postRegister'])->name('postRegister');
	Route::get('logout', [AuthController::class, 'logout'])->name('logout');
	
	Route::get('/verification/{email}',[AuthController::class,'verification'])->name('verification');
    Route::post('/confirm', [AuthController::class, 'confirm'])->name('confirm');
	Route::post('resend', [AuthController::class, 'resend'])->name('resend');

});

