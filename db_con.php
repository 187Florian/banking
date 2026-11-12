<?php
class Db_con{
private static ?PDO $db = null;

public static function getDb() {
try{
if(self::$db==null){
    self::$db = new PDO('sqlite:user.db');
    self::$db->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
    );
}

return self::$db;
}

catch(PDOException $e) {
    echo "Datenbank Fehler: " . $e->getMessage();
}
   
}

}
