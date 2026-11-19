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
    $dbPath = __DIR__ . '/../db/user.db';
    self::$db = new PDO('sqlite:'.  $dbPath);
    self::$db->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
    );
    self::$db->exec('PRAGMA foreign_keys = ON;');
    self::$db->setAttribute(PDO::ATTR_TIMEOUT, 5);
}
return self::$db;
}

catch(PDOException $e) {
    echo "Datenbank Fehler: " . $e->getMessage();
}
   
}

}
