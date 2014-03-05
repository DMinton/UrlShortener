<?php namespace lib;

interface UrlModelInterface {
	public function getTopSites();
	public function getCount();
	public function findRandomUrl($random);
	public function getByUrl($url);
	public function create($array);
	public static function make_short_url();
	public static function validate($input);
}