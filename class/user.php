<?php
require_once 'tool.php';
require_once 'db_con.php';
require_once 'log.php';
class User{

private $em;
protected readonly int $id;
private $db;
protected readonly Logger $logger;
protected readonly String $type;
function __construct(int $pId){
$this->db= Db_con::getDb();
$this->logger = new Logger();
$this->id = $pId;
}

/*
    id: 1...* User/ ministry / business
    id: -1 temp test id
    id 0 admin pobably
*/

public function changePassword($newPasword){
try{
    $pwChange = $this->db->prepare("
    UPDATE user SET pwHash = :newPw WHERE id = :pid;
    ");
    $pwChange->execute([':newPw' => password_hash($newPasword,PASSWORD_DEFAULT),':pid'=> $this->id]);
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

public function testForUser($id): bool{
try{
    $testForUser = $this->db->prepare("SELECT EXISTS(SELECT 1 FROM user WHERE id = :id);");
    $testForUser->execute([':id'=>$id]);
    $result = (bool) $testForUser->fetchColumn();
    return $result;
}
catch(PDOException $e) {
    echo "Datenbank Fehler: " . $e->getMessage();
    $this->logger->errorLog($this->em, "Datenbank Fehler: User; Function:  testForUser" ,$e->getMessage());
    return false;

}
}
public static function newUser(String $name,String $pw,String $userType): bool{
    $Templogger= new Logger();
    try{
        $tempUser = new user(Tool::emBereinigen(-1));
        
        //test if already an user with this email
        $bereinigterName = $name; 
        //!!!! Fehlend noch test valider name!  
        $nameOk= true;
        
        $testAnfrageName = $tempUser->db->prepare("SELECT EXISTS(SELECT 1 FROM user WHERE name = :pName);");
        $testAnfrageName->execute(['pName'=>$bereinigterName]);
        $result = (bool) $testAnfrageName->fetchColumn();


        if(!$result&&$nameOk){  
        $createNewUserSQL = $tempUser->db->prepare(
        "INSERT INTO user ('name','pwHash','type')
        VALUES (:pname,:pwHash,:pType);");
        $createNewUserSQL->execute([':pname'=>$bereinigterName,':pwHash'=>password_hash($pw,PASSWORD_DEFAULT),'pType'=>$userType]);
        $Templogger->privateLog($bereinigterName,"new Account","Account Type" . $userType);
        return true;
        }
        
        return false;
        }
    catch(PDOException $e){
        echo "Datenbank Fehler: " . $e->getMessage();
        $Templogger->errorLog("noUser, wird gerade erstellt!", "Datenbank Fehler: User; Function:  newUser" ,$e->getMessage());
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
public final function getType(int $pid ): String {
    try{
$dbRequest = $this->db->prepare("SELECT type FROM user WHERE id=:pId;");
$dbRequest->execute([':pId'=>$pid]);
$resultType = $dbRequest->fetch(PDO::FETCH_ASSOC);

return (String) $resultType['type'];
    }catch(PDOException $e){
        echo "Datenbank Fehler: " . $e->getMessage();
        $this->logger->errorLog($this->em, "Datenbank Fehler: User; Function:  getType" ,$e->getMessage());
        return 0;
    }
}
public function getName() : String {
    //muss noch sql anfrage
    return "name";
}
public function getId(): int {
    return $this->id;
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