<?php
require_once 'tool.php';

class user{

private $em;
private $db;

function __construct($pEm){
$this->db= new PDO('sqlite:user.db');
$this->em=tool::emBereinigen($pEm);
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
        $tempUser = new user(tool::emBereinigen($em));
        //test if already an user with this email
        if(!$tempUser->testForUser($tempUser->getEmail())&&filter_var($tempUser->getEmail(), FILTER_VALIDATE_EMAIL)){
        $createNewUserSQL = $tempUser->db->prepare(
        "INSERT INTO user (email,pwHash,geld)
        VALUES (:email,:pwHash,:geld);");
        $createNewUserSQL->execute([':email'=>$tempUser->getEmail(),':pwHash'=>password_hash($pw,PASSWORD_DEFAULT),':geld'=>10]);
        return true;
        }
        
        return false;
        }
    catch(PDOException $e){
        echo "Datenbank Fehler: " . $e->getMessage();
        return false;
    }

}
public function getGeld(){
    if($this->testForUser(tool::emBereinigen($this->em))){
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
}
public function getEmail(){
    return $this->em;
}

public function ueberweisung($amount, $empfänger){
    try{//rollback funtion mit begint transk.
        $this->db->beginTransaction();

        //absender
        $geldChange = $this->db->prepare("UPDATE user
        SET geld = geld - :pAmount
        WHERE email = :pem
        AND geld >= :pAmount;
        ");
        $geldChange->execute([':pAmount' => $amount,':pem'=> $this->em]);

        //empfänger
        if($geldChange->rowCount()==1){
            $empängerGeld = $this->db->prepare(
            "UPDATE user
            SET geld = geld + :pAmountEmpfänger
            WHERE email = :empfängerEm"
            );
            $empängerGeld->execute([':pAmountEmpfänger' => $amount,':empfängerEm'=> $empfänger]);
            if($empängerGeld->rowCount() !== 1) {
                $this->db->rollBack();
                return false;
            }    
        }
        else{
            $this->db->rollBack(); 
            return false;
        }
        //änmderung permanent schreiben
        $this->db->commit();
        return true;
    }
    catch(PDOException $e) {
        // fals mitten in der transaktion:
        if ($this->db->inTransaction()) {
            $this->db->rollBack();
        }
    


        echo "Datenbank Fehler: " . $e->getMessage();
        
    }
    return false;
}
}
