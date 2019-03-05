<?php

namespace App\Classes;

class Auth
{
    public static function check($value){
        return \App\Classes\Session::has($value);
    }
    public static function user($value){
        return \App\Classes\Session::get($value);
    }
} 
?>