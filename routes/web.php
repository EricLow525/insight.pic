<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// sample API
Route::get('/api/rooms',function(){
    return \App\Room::all();
});

Route::post('/api/login', function(){
    return 0;
});

/*
Route::post('/api/login','Auth\AuthController@postLogin');
Route::get('auth/token/{token}', 'Auth\AuthController@authenticate');

Route::get('dashboard', function () {
    return 'Welcome, ' . Auth::user()->name;
})->middleware('auth');
*/
