<?php
require_once 'tool.php';
require_once 'db_con.php';
require_once 'log.php';
class user{

private $em;
private $db;
private $logger;
private $type;
function __construct($pEm){
$this->db= Db_con::getDb();
$this->em=Tool::emBereinigen($pEm);
$this->logger = new Logger();
}

public function changePassword($newPasword){
try{
    $pwChange = $this->db->prepare("
    UPDATE user SET pwHash = :newPw WHERE email = :pem;
    ");
    $pwChange->execute([':newPw' => password_hash($newPasword,PASSWORD_DEFAULT),':pem'=> $this->em]);
    if($pwChange->rowCount()==1){
        
        $this->logger->privateLog($this->em,"Changed PW", "NONE");
        return true;
    }
    return false;
}
catch(PDOException $e) {
        echo "Datenbank Fehler: " . $e->getMessage();
        $this->logger->errorLog($this->em, "Datenbank Fehler: User; Function: changePassword" ,$e->getMessage());
        return false;
}
}

public function testForUser($em): bool{
try{
    $testForUser = $this->db->prepare("SELECT EXISTS(SELECT 1 FROM user WHERE email = :em);");
    $testForUser->execute([':em'=>$em]);
    $result = (bool) $testForUser->fetchColumn();
    return $result;
}
catch(PDOException $e) {
    echo "Datenbank Fehler: " . $e->getMessage();
    $this->logger->errorLog($this->em, "Datenbank Fehler: User; Function:  testForUser" ,$e->getMessage());
    return false;

}
}
public static function newUser($em,$pw){
    try{
        $tempUser = new user(Tool::emBereinigen($em));
        //test if already an user with this email
        if(!$tempUser->testForUser($tempUser->getEmail())&&Tool::emTesten($em)){
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
public function getGeld(): int{
    if($this->testForUser(Tool::emBereinigen($this->em))){
    try{
        $geldSQLpayload = $this->db->prepare(
            "SELECT geld
            FROM user
            WHERE email = :em;");
        $geldSQLpayload->execute([':em' => $this->em]);
        $resultGeld = $geldSQLpayload->fetch(PDO::FETCH_ASSOC);
        return (int) $resultGeld['geld'];
    }
    catch(PDOException $e){
        echo "Datenbank Fehler: " . $e->getMessage();
        $this->logger->errorLog($this->em, "Datenbank Fehler: User; Function:  getGeld" ,$e->getMessage());
        return 0;
    }
}
return 0;
}
public function getEmail(){
    return $this->em;
}

public function ueberweisung(int $amount, String $empfaenger){
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
            $empaengerGeld = $this->db->prepare(
            "UPDATE user
            SET geld = geld + :pAmountEmpfaenger
            WHERE email = :empfaengerEm"
            );
            $empaengerGeld->execute([':pAmountEmpfaenger' => $amount,':empfaengerEm'=> $empfaenger]);
            if($empaengerGeld->rowCount() !== 1) {
                $this->db->rollBack();
                $this->logger->errorLog($this->em, "Function: Transaktion" ,"Fehler beim Geld drauf tuen (STEP 2) -User does not exist?");
                return false;
            }    
        }
        else{
            $this->db->rollBack(); 
            //Fehler error log
            $this->logger->errorLog($this->em, "Function: Transaktion" ,"Fehler beim Geld abziehen (STEP 1) -User does not exist?");
            return false;
            
        }
        //wenn alles geklappt hat, log wird geschrieben!
        $this->logger->logTransaction($amount,$empfaenger,$this);
         // speichern allem (GELD + log)
        //änmderung permanent schreiben
        if($this->db->inTransaction()){
            $this->db->commit();
            return true;
        }


        //Fehler error log
        $this->logger->errorLog($this->em, "Function: Transaktion" ,"General Error");
        return false;
    }
    catch(PDOException $e) {
        // fals mitten in der transaktion:
        if ($this->db->inTransaction()) {
            $this->db->rollBack();
        }
        //Fehler error log
        $this->logger->errorLog($this->em, "Datenbank Fehler: Function: Transaktion" ,$e->getMessage());
    }

    return false;
}
public function getType(string $em): String {
    //db zugriff um sehen welcher type ein account ist
    return "user";
}
protected function getDb():PDO|null  {
    try{
    return $this->db;
    }
    catch(PDOException $e){
        echo "Datenbank Fehler: " . $e->getMessage();
        $this->logger->errorLog($this->em, "Datenbank Fehler: DB Pull" ,$e->getMessage());
        return null;
    }
}
}