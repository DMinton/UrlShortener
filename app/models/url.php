<?php


class Url extends Eloquent {
	protected $fillable = array('url', 'shortened');
	public $timestamps = false;

	public static $rules = array( 'url' => 'required|url' );

	public static function validate($input){
		$v = Validator::make($input ,self::$rules);
		if($v->fails()){ return $v; }
		else { return true; }
	}

	public function getTopSites() {
		return $this::where('count', '>', 0)
					->take(5)
					->orderBy('count', 'desc')
					->get();
	}

	public function getCount() {
		return DB::table('urls')
					->count();
	}

	public function findUrl($random) {
		return Url::find($random);
	}

	public function getWhere($url) {
		return Url::where('url', '=', $url)->first();
	}

	public static function make_short_url(){

		do{
			$short = base_convert(rand(10000,99999), 10, 36);
		}while(self::where('shortened', '=', $short)->first());

		return $short;
	}
}