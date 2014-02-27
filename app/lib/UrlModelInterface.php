<?php namespace lib;

interface UrlModelInterface {
	public function getTopSites();
	public function getCount();
	public function findUrl($random);
	public function getWhere($url);
	public function create($array);
	public static function make_short_url();
	public static function validate($input);
}