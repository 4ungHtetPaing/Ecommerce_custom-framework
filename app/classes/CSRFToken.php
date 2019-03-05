<?php

namespace App\Classes;

class CSRFToken
{
    public static function _token()
    {
        if (!Session::has("token")) 
        { 
           return Session::set("token", base64_encode(openssl_random_pseudo_bytes(32)));
            // return Session::get("token");
        } else {
            return Session::get("token");
        }
    }
    public static function checkToken($token)
    {
        return Session::get("token") == $token ? true : false;
    }
}
