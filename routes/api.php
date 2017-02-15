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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('/login','Auth\AuthController@postLogin');
Route::resource('design', 'DesignController', ['only' => ['index']]);
Route::resource('color', 'ColorController', ['only' => ['index']]);

Route::get('profile', 'ProfileController@show')->middleware('tokencheck');
Route::put('profile', 'ProfileController@update')->middleware('tokencheck');
Route::post('sendmsg','AboutController@sendmsg');
