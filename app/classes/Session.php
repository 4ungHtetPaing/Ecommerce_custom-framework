<?php 

namespace App\Classes;


class Session{
    public static function set($key,$value){
        if(self::has($key)){
            self::remove($key);
        }
        $_SESSION[$key] = $value;
    }
    public static function has($key){
        return isset($_SESSION[$key]) ? true : false;
    }
    public static function get($key){
        if(self::has($key))
            return $_SESSION[$key];
    }
    public static function remove($key){
        if(self::has($key)){
            unset($_SESSION[$key]);
        }
    }
    public static function replace($key,$value){
        if(self::has($key))
        {
            self::remove($key);
        }
        self::set($key,$value);
    }
    public static function flash($key,$value=""){
        if(!empty($value)){
            self::replace($key,$value);
        }else{
            if (strpos(self::get($key), 'Error') == true) {
                echo '<div class = "alert alert-danger alert-dismissible fade show" role = "alert">
                    <button type = "button" class = "close" data-dismiss="alert" aria-label = "Close">
                      <span aria-hidden = "true"> & times; </span>
                    </button ><strong>'. self::get($key) .' </strong ></div>';
            }else{
                echo '<div class = "alert alert-success alert-dismissible fade show" role ="alert">
                    <button type = "button" class = "close" data-dismiss ="alert" aria-label = "Close">
                      <span aria-hidden = "true"> & times; </span>
                    </button ><strong>' . self::get($key) . '</strong ></div>';
            }          
            self::remove($key);
        }
    }
}


?>