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
    if(Auth::check()){
      return view('welcome',[
          'user_id'=>Auth::user()->id,
          'email'=>Auth::user()->email,
          'token'=>Auth::user()->loginTokens()->first()->token
      ]);
    }else
    return view('welcome');
});

Route::get('auth/token/{token}', 'Auth\AuthController@authenticate');
Route::get('logout', 'Auth\AuthController@logout');
Route::get('/home', 'HomeController@index');
