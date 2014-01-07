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

		do{
			$short = base_convert(rand(10000,99999), 10, 36);
		}while(self::where('shortened', '=', $short)->first());

		return $short;
	}
}