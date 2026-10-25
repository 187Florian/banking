<?php
require_once 'tool.php';
class login {
    public function sql_logintest($em,$pw){
        try {
        $db2 = new PDO('sqlite:user.db');
            $pwHashObjekt = $db2->prepare("SELECT pwHash FROM USER WHERE email = :em");
            $pwHashObjekt->execute([':em' => tool::emBereinigen($em)]);
            $pwHash = $pwHashObjekt->fetch(PDO::FETCH_ASSOC);
            if($pwHash){
                if(password_verify($pw,$pwHash['pwHash'])){
                    return true;
                }
                    else{
                        echo " Wrong PW!";
                }
            }
                else{
                    echo "Wrong Email!";
                }
        }
        catch(PDOException $e) {
            echo "Datenbank Fehler: " . $e->getMessage();
        }
    sleep(1);
    return false;
    }
}
