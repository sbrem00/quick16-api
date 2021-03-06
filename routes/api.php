<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => 'auth:api'], function(){
    Route::get('creations', 'CreationController@index');
    Route::get('creations/{creation}', 'CreationController@show');
    Route::post('creations', 'CreationController@store');
    Route::put('creations/{creation}', 'CreationController@update');
    Route::delete('creations/{creation}', 'CreationController@delete');
});

//User register, login and logout
Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

