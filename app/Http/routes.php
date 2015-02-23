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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::get('modal/{model}/{id}', 'ModalController@show');

Route::resource('jobs', 'JobsController');

Route::get('projects/{id}/{user?}/{timeframe?}', 'ProjectsController@show');
Route::resource('projects', 'ProjectsController');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);