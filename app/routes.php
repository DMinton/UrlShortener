<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'UrlController@getIndex');
Route::post('/', 'UrlController@postIndex');
Route::get('{any}', 'UrlController@getLink');

App::bind(
	'Library\Interfaces\UrlModelInterface',
	'Library\Repositories\EloquentModelUrl'
);