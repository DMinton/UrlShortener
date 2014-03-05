<?php namespace Library\Interfaces;

interface UrlModelInterface {
	public function makeShortUrl();
	public function getTopSites();
	public function getCount();
	public function redirect($url);
	public function findRandomUrl($random);
	public function getByUrl($url);
	public function createUrl($url);
	public static function validate($input);
}