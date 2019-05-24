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

Route::middleware('api')->namespace('Auth')->prefix('auth')->group(function (){
	Route::post('login', 'AuthController@login');
	Route::post('logout', 'AuthController@logout');
	Route::post('refresh', 'AuthController@refresh');
	Route::post('me', 'AuthController@me');
});

Route::get('movies','MoviesController@index');

Route::get('movies/{movie}','MoviesController@show');

Route::get('moviesAdded','MoviesController@showAdded');

Route::get('moviesCategory/{movie}','MoviesController@showByCategory');

Route::post('movies','MoviesController@store');

Route::put('movies/{movie}','MoviesController@update');

Route::delete('movies/{movie}','MoviesController@delete');
