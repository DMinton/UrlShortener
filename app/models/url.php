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

	public static function make_short_url(){

		$short = base_convert(rand(10000,99999), 10, 36);

		if(static::where('shortened', '=', $short)->first()){
			return static::make_short_url();
		}

		return $short;
	}
}