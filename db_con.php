<?php
class Db_con{
private function __construct()
{
    throw new \Exception('Not implemented THIS FUNCTION IS STATIC');
}
private static ?PDO $db = null;

public static function getDb() {
try{
if(self::$db==null){
    self::$db = new PDO('sqlite:user.db');
    self::$db->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
    );
    self::$db->setAttribute(PDO::ATTR_TIMEOUT, 5);
}

return self::$db;
}

catch(PDOException $e) {
    echo "Datenbank Fehler: " . $e->getMessage();
}
   
}

}
