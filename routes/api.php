<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware(['cors','passport-auth'])->group(function () {
    // Route::post('/login',  [\Laravel\Passport\Http\Controllers\AccessTokenController::class, 'issueToken'])->name('guest.login');
    Route::post('login', 'App\Http\Controllers\Auth\ApiAuthController@login')->name('guest.login');
    Route::get('login', 'App\Http\Controllers\Auth\ApiAuthController@login')->name('guest.login-get');
});

Route::middleware(['auth:api','cors'])->group(function () {

    Route::post('/logout/{user}', 'App\Http\Controllers\Auth\ApiAuthController@logout')->name('logout.api');
    Route::get('/users', 'App\Http\Controllers\UserController@index')->name('user.index');
    Route::get('/users/{user}', 'App\Http\Controllers\UserController@show')->name('user.show');
    Route::post('/users/update/{user}', 'App\Http\Controllers\UserController@update')->name('user.update');
    Route::post('/register', 'App\Http\Controllers\UserController@store')->name('user.store');
    Route::post('/delete/{user}', 'App\Http\Controllers\UserController@destroy')->name('user.destroy');
});
