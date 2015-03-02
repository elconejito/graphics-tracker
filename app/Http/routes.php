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

Route::get('home', [
	'as' => 'home',
	'uses' => 'HomeController@index'
]);

Route::get('modal/{model}/{id}', 'ModalController@show');

Route::get('jobs/{id}', 'JobsController@show')
		->where('id', '[0-9]+');
Route::get('jobs/{timeframe?}/{user?}', 'JobsController@index');
Route::resource('jobs', 'JobsController');

Route::get('projects/{id}/{timeframe?}/{user?}', 'ProjectsController@show');
Route::resource('projects', 'ProjectsController');

Route::get('reports/{timeframe?}/{user?}', 'ReportsController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);