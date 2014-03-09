<?php

use Models\Interfaces\UrlModelInterface as UrlModel;
use Helpers\Helpers as Helpers;
use Helpers\Validation as Validator;

class UrlController extends BaseController {

    public function __construct(UrlModel $url) {
        $this->url = $url;
    }

    public function getIndex(){

        $data = Helpers::getSiteDataAsArray($this->url);
        return View::make('index')->with($data);
    }

    public function postIndex(){

        $url = Input::get('url');

            // URL validation
        $validation = Validator::validate($url, $this->url->getRules());

        if($validation !== true){
            return Redirect::to('/')->withErrors($validation->messages());
        }

            // Checks if url is in table
            // if not in table, ceates new url
        $newUrl = $this->url->getByUrl($url);

        if(is_null($newUrl)){
            $newUrl = $this->url->createUrl($url);
        }
        return View::make('result')->with('shortened', $newUrl);
    }

    public function getLink($input){
            // find query in database
        $url = $this->url->getByShortened($input);
        
            // not found, redirect home
        if( ! isset($url)){
            return Redirect::to('/');
        }
            // increment and redirect
        $url->increment('count');
        return Redirect::to($url->url);
    }
}