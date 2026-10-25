<?php
class tool{
    public static function emBereinigen($email){
        return strtolower(trim($email));
    }
    public static function emTesten($email){
        if (!empty(filter_var(tool::emBereinigen($email), FILTER_VALIDATE_EMAIL))) {
            return true;
        }
    return false;
    }


}