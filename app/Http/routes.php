<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'WelcomeController@index');

//Route::get('home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function()
{
    Route::get('/', 'HomeController@index');
});

Route::get('/search','SearchsController@results');
Route::resource('likes','LikesController',['only' => ['store', 'destroy']]);

Route::get('{username}/followers', 'UsersController@followers');
Route::get('{username}/following', 'UsersController@following');
Route::get('/', 'UsersController@index');
Route::get('/home', 'HomeController@index');
Route::post('/tweet', 'TweetsController@store');
Route::post('/retweet', 'TweetsController@retweet');
Route::post('/reply', 'TweetsController@reply');
Route::post('/follow/{username}', 'FollowersController@store');
Route::get('/{username}', 'UsersController@show');


//Route::get('/{something}', 'HomeController@unknown');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
