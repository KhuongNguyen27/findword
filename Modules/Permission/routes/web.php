<?php

use Illuminate\Support\Facades\Route;
// use Modules\Permission\app\Http\Controllers\PermissionController;
use Modules\Permission\app\Http\Controllers\GroupController;
use Modules\Permission\app\Http\Controllers\UserController;

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
    'middleware' => ['auth','auth.admin']
], function () {
Route::resource('groups', GroupController::class)->names('groups');
Route::resource('users', UserController::class)->names('users');
Route::post('groups/{id}/updateRoles', [GroupController::class, 'updateRoles'])->name('groups.updateRoles');

});


