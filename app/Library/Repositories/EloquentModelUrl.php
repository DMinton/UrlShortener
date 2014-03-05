<?php namespace Library\Repositories;

use Library\Interfaces\UrlModelInterface;
use Library\Helpers\Helpers;
use Url, Validator, Redirect;

class EloquentModelUrl implements UrlModelInterface {

	public function makeShortUrl(){

		do{
			$short = base_convert(rand(10000,99999), 10, 36);
		}while(Url::where('shortened', '=', $short)->first());

		return $short;
	}

	public function getTopSites() {
		return Url::where('count', '>', 0)
					->take(5)
					->orderBy('count', 'desc')
					->get();
	}

	public function redirect($url) {
		$url->increment('count');
		return Redirect::to($url->url);
	}

	public function getCount() {
		return Url::all()
					->count();
	}

	public function findRandomUrl($random) {
		return Url::find($random);
	}

	public function getByUrl($url) {
		return Url::where('url', '=', $url)
					->first();
	}

	public function getByShortened($shortened) {
		return Url::where('shortened', '=', $shortened)
					->first();
	}

	public function createUrl($url) {
		$newurl = $this->makeShortUrl();

		$data = array(
            	'url' 		=> $url,
            	'shortened' => $newurl,
            	'count' 	=> 0
            );

		return Url::create($data);
	}

	public static function validate($input){
		$data = array('url' => $input );
		$v = Validator::make($data ,Url::$rules);
		if($v->fails()){ return $v; }
		else { return true; }
	}
}