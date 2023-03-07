<?php

namespace tweets_pre\Helper;

class Utility {
    public static function redirect($url) {
        header("Location: " . $url);
        exit();
    }
    
    public static function sanitize($string) {
        return filter_var($string, FILTER_SANITIZE_STRING);
    }
    
    public static function getParam($name, $default = null) {
        return isset($_GET[$name]) ? self::sanitize($_GET[$name]) : $default;
    }
    
    public static function postParam($name, $default = null) {
        return isset($_POST[$name]) ? self::sanitize($_POST[$name]) : $default;
    }
}

?>