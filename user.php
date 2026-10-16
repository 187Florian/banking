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
    //SELECT EXISTS(SELECT 1 FROM user WHERE email = :em LIMIT 1);
}
catch(PDOException $e) {
    echo "Datenbank Fehler: " . $e->getMessage();
}
}
public static function newUser($em,$pw){
    try{
        $tempUser = new user($em);
        $createNewUserSQL = $tempUser->db->prepare(
        "INSERT INTO user (email,pwHash,geld)
        VALUES (:email,:pwHash,:geld);");
        $createNewUserSQL->execute([':email'=>$em,':pwHash'=>password_hash($pw,PASSWORD_DEFAULT),':geld'=>10]);
    }
    catch(PDOException $e){
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


public function changeGeld($amount){
    try{
        echo "geld wird um " . $amount . " geändert";
        $newAmount = $this->getGeld() + $amount;
        $geldChange = $this->db->prepare("UPDATE user
        SET geld = :pAmount
        WHERE email = :pem;");
        $geldChange->execute([':pAmount' => $newAmount,'pem'=> $this->em]);
    }
    catch(PDOException $e) {
        echo "Datenbank Fehler: " . $e->getMessage();
    }
    
}
}
