<?php namespace Models\Interfaces;

interface UrlModelInterface {
	public function makeShortUrl();
	public function getTopSites();
	public function getCount();
	public function findRandomUrl($random);
	public function getByUrl($url);
	public function createUrl($url);
}