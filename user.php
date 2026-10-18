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
    $testForUser = $this->db->prepare("SELECT EXISTS(SELECT 1 FROM user WHERE email = :em);");
    $testForUser->execute([':em'=>$em]);
    $result = (bool) $testForUser->fetchColumn();
    return $result;
}
catch(PDOException $e) {
    echo "Datenbank Fehler: " . $e->getMessage();
}
}
public static function newUser($em,$pw){
    try{
        $tempUser = new user(strtolower(trim($em)));
        //test if already an user with this email
        if(!$tempUser->testForUser($tempUser->getEmail())&&filter_var($tempUser->getEmail(), FILTER_VALIDATE_EMAIL)){
        $createNewUserSQL = $tempUser->db->prepare(
        "INSERT INTO user (email,pwHash,geld)
        VALUES (:email,:pwHash,:geld);");
        $createNewUserSQL->execute([':email'=>$tempUser->getEmail(),':pwHash'=>password_hash($pw,PASSWORD_DEFAULT),':geld'=>10]);
        return true;
        }
        echo "There is already a user with this em! or this is not an em";
        return false;
        }
    catch(PDOException $e){
        echo "Datenbank Fehler: " . $e->getMessage();
        return false;
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
public function getEmail(){
    return $this->em;
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
