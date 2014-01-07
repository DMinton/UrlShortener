<?php

class UrlController extends BaseController {

    protected static function get_top_sites(){
        $topcount = Url::where('count', '>', 0)->take(5)->orderBy('count', 'desc')->get();
        //dd($topcount);
        return $topcount;
    }

	protected static function get_random_url(){

    	$number = DB::table('urls')->count();
    	if($number > 0){
			$random = mt_rand(1,$number);
			$randomurl = Url::find($random);
			return $randomurl;
		}
    }

	public function getIndex(){
		
        $randomurl = self::get_random_url();
        $topcount = self::get_top_sites();
        $data = array("randomurl" => $randomurl, "topcount" => $topcount);
        return View::make('index')->with($data);
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
            return View::make('result')->with('shortened', $record);
        }

        // adds url to table and creates shortened url
        $newurl = Url::make_short_url();
        $save = Url::create(array(
            'url' => $url,
            'shortened' => $newurl
        ));
        $save->count = 0;
        // return results
        if($save){
            return View::make('result')->with('shortened', $save);
        }
    }

    public function getLink($shortened){

        // find query in database, increment, redirect if not found
        $row = Url::where('shortened', '=', $shortened)->first();
        if(isset($row)){
            $row->increment('count');
        }
        else{ return Redirect::to('/'); }
        // get url and redirect
        return Redirect::to($row->url);
    }
}