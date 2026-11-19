<?php
class Tool{
    private function __construct()
    {
        throw new \Exception('Not implemented THIS FUNCTION IS STATIC');
    }
    public static function emBereinigen($email): String{
        return strtolower(trim($email));
    }
    public static function emTesten($email): bool{
        if (!empty(filter_var(Tool::emBereinigen($email), FILTER_VALIDATE_EMAIL))) {
            return true;
        }
    return false;
    }


}