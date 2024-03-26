<?php

use Illuminate\Support\Facades\Route;
use Modules\Account\app\Http\Controllers\Website\AccountController;

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
    'prefix' => 'website',
    'as' => 'website.'
], function () {
    Route::resource('account', AccountController::class)->names('account');
});