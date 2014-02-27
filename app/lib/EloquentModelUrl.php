<?php namespace lib;

use lib\UrlModelInterface;
use Url;
use Validator;

class EloquentModelUrl implements UrlModelInterface {
	public function getTopSites() {
		return Url::where('count', '>', 0)
					->take(5)
					->orderBy('count', 'desc')
					->get();
	}

	public function getCount() {
		return Url::all()
					->count();
	}

	public function findUrl($random) {
		return Url::find($random);
	}

	public function getWhere($url) {
		return Url::where('url', '=', $url)
					->first();
	}

	public function create($array) {
		return Url::create($array);
	}

	public static function make_short_url(){

		do{
			$short = base_convert(rand(10000,99999), 10, 36);
		}while(Url::where('shortened', '=', $short)->first());

		return $short;
	}

	public static function validate($input){
		$v = Validator::make($input ,Url::$rules);
		if($v->fails()){ return $v; }
		else { return true; }
	}
}