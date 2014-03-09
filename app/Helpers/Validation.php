<?php namespace Helpers;

use Validator;

class Validation {

    public static function validate($input, $rules){
        $data = array('url' => $input );
        $v = Validator::make($data, $rules);
        if($v->fails()){ return $v; }
        else { return true; }
    }
}