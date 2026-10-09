<?php
class user{

private $em;
private $db;

function __construct($pEm){
$this->db= new PDO('sqlite:user.db');
$this->em=$pEm;
}

static function user($em,$pwClear){
}


public function testForUser($em){

try{
}
catch(PDOException $e) {
    echo "Datenbank Fehler: " . $e->getMessage();
}

    
}
public function getGeld(){
    try{
        $geldSQLpayload = $this->db->prepare(
            "SELECT geld
            FROM user
            WHERE email = :em;");
        $geldSQLpayload->execute([':em' => $this->em]);
        $resultGeld = $geldSQLpayload->fetch(PDO::FETCH_ASSOC);
        return $resultGeld['geld'];
    }
    catch(PDOException $e) {
        echo "Datenbank Fehler: " . $e->getMessage();
    }
}


public function chanceGeld($amount){

    try{

    }
    catch(PDOException $e) {
        echo "Datenbank Fehler: " . $e->getMessage();
    }
    
}
}
?>