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
          'email'=>Auth::user()->email,
          'token'=>Auth::user()->loginTokens()->first()->token
      ]);
    }else
    return view('welcome');
});

// sample API
Route::get('/api/rooms',function(){
    return \App\Room::all();
});
Route::post('/api/login','Auth\AuthController@postLogin');
//Auth::routes();

Route::get('auth/token/{token}', 'Auth\AuthController@authenticate');

Route::get('logout', 'Auth\AuthController@logout');
/*
Route::get('dashboard', function () {

    return view('welcome',[
        'email'=>Auth::user()->email,
        'token'=>Auth::user()->loginTokens()->first()->token
    ]);
})->middleware('auth');
*/
Route::get('/home', 'HomeController@index');
