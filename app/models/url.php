<?php


class Url extends Eloquent {
	protected $fillable = array('url', 'shortened');
	public $timestamps = false;

	public static $rules = array( 'url' => 'required|url' );
}