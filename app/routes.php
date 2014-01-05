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



Route::post('/', function()
{
	$url = Input::get('url');

	// URL validation
	$validation = Url::validate(array('url' => $url ));
	
	if($validation !== true){
		return Redirect::to('/')->withErrors($validation->messages());
	}

	// Checks if url is in table
	$record = Url::where('url', '=', $url)->first();
	
	if($record){
		return View::make('result')->with('shortened', $record->shortened);
	}

	// adds url to table and creates shortened url
	$newurl = Url::make_short_url();
	$save = Url::create(array(
		'url' => $url,
		'shortened' => $newurl
	));

	// return results
	if($save){
		return View::make('result')->with('shortened', $save->shortened);
	}
});

Route::get('{url}', function($shortened){
	
	// find query in database
	$row = Url::where('shortened', '=', $shortened)->first();
	// if not found, redirect to home page
	if(is_null($row)){ return Redirect::to('/'); }
	// get url and redirect
	return Redirect::to($row->url);
});