<?php

class UrlController extends BaseController {

	protected static function get_random_url(){

    	$number = DB::table('urls')->count();
    	if($number > 0){
			$random = mt_rand(1,$number);
			$randomurl = Url::find($random);
			return $randomurl;
		}
    }

	public function getIndex(){
		
        $randomurl = static::get_random_url();
		return View::make('index')->with("randomurl", $randomurl);
    }

    public function postIndex(){

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
    }

    public function getLink($shortened){

        // find query in database
        $row = Url::where('shortened', '=', $shortened)->first();
        // if not found, redirect to home page
        if(is_null($row)){ return Redirect::to('/'); }
        // get url and redirect
        return Redirect::to($row->url);
    }
}