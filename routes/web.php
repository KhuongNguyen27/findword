<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ToolController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::get('/', function () {
//     return view('website/employer/index');
// })->name('home');
// Route::get('/', function () {
//     return view('website.dashboards.index');
// })->name('home');

Route::get('/', [HomeController::class,'index'])->name('home');

Route::get('/viec-lam-trong-nuoc/{job_type?}', [JobController::class,'vnjobs'])->name('jobs.vnjobs');

Route::get('/viec-lam-ngoai-nuoc/{job_type?}', [JobController::class,'nnjobs'])->name('jobs.nnjobs');

Route::get('/cong-ty', [EmployeeController::class,'index'])->name('employees.index');

Route::get('/nganh-nghe/{slug}', [CareerController::class,'show'])->name('careers.show');
Route::get('/bai-viet/{slug}', [PostController::class,'show'])->name('posts.show');
Route::get('/trang/{slug}', [PageController::class,'show'])->name('pages.show');
Route::get('/importVNW', [ToolController::class,'importVNW']);


Route::prefix('themes')->group(function () {
    
    // Route::get('/employer', function () {
    //     return view('website/employer/index');
    // })->name('employer.index');

    Route::get('/contacts', function () {
        return view('website/contacts/index');
    })->name('contacts.index');

    Route::get('/aplications', function () {
        return view('website/aplications/index');
    })->name('aplications.index');

    // Route::get('/prices', function () {
    //     return view('website/prices/index');
    // })->name('prices.index');

    Route::get('/', function () {
        return view('website/dashboards/index');
    })->name('dashboards.index');

    Route::get('/post-job', function () {
        return view('website/dashboards/postjob/index');
    })->name('postjob.index');

    Route::get('/manage-job', function () {
        return view('website/dashboards/managejob/index');
    })->name('managejob.index');

    Route::get('/aplicants', function () {
        return view('website/dashboards/aplicants/index');
    })->name('aplicants.index');

    Route::get('/Shortlisteds', function () {
        return view('website/dashboards/Shortlisteds/index');
    })->name('Shortlisteds.index');

    Route::get('/pakages', function () {
        return view('website/dashboards/pakages/index');
    })->name('pakages.index');

    Route::get('/messages', function () {
        return view('website/dashboards/messages/index');
    })->name('messages.index');

    Route::get('/cv-manager', function () {
        return view('website/dashboards/cv-manager/index');
    })->name('cv-manager.index');

    Route::get('/resume-alerts', function () {
        return view('website/dashboards/resume-alerts/index');
    })->name('resume-alerts.index');

    Route::get('/change-password', function () {
        return view('website/dashboards/change-password/index');
    })->name('change-password.index');

    Route::get('/profile', function () {
        return view('website/dashboards/profile/index');
    })->name('profile.index');
});