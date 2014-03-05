<?php

use lib\EloquentModelUrl;

class UrlController extends BaseController {

    public function __construct(EloquentModelUrl $url) {
        $this->url = $url;
    }

    protected function get_top_sites(){
        $topcount = $this->url->getTopSites();
        return $topcount;
    }

    protected function get_random_url(){

    	$number = $this->url->getCount();
    	if($number > 0){
         $random = mt_rand(1,$number);
         $randomurl = $this->url->findRandomUrl($random);
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
        $validation = $this->url->validate(array('url' => $url ));

        if($validation !== true){
            return Redirect::to('/')->withErrors($validation->messages());
        }

            // Checks if url is in table
        $record = $this->url->getByUrl($url);
        
        if($record){
            return View::make('result')->with('shortened', $record);
        }

            // adds url to table and creates shortened url
        $newurl = $this->url->make_short_url();
        $save = $this->url->create(array(
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
        $row = $this->url->getByUrl($shortened);

        if(isset($row)){
            $row->increment('count');
        }
        else{ return Redirect::to('/'); }
            // get url and redirect
        return Redirect::to($row->url);
    }
}