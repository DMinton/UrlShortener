<?php namespace Library\Helpers;

class Helpers {

    public static function getSiteDataAsArray($url) {

        $returnData = array();
        $calls = array(
                'getTopSites',
                'getRandomUrl'
            );

        forEach($calls as $function) {
            $returnData[$function] = self::$function($url);
        }

        return $returnData;
    }

	public static function getTopSites($url){
        $topcount = $url->getTopSites();
        return $topcount;
    }

    public static function getRandomUrl($url){
        $number = $url->getCount();

        if($number > 0) {
            $random = mt_rand(1,$number);
            $randomurl = $url->findRandomUrl($random);
            return $randomurl;
        }
    }

}