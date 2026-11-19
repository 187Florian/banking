<?php
require_once 'tool.php';
require_once 'db_con.php';
class Login {
    private $db;
    public function __construct()
    {
        $this->db =$db = Db_con::getDb();
    }
    public function sql_logintest($name,$pw){
        try {


            $pwHashObjekt = $this->db->prepare("SELECT pwHash FROM USER WHERE name = :username");
            $pwHashObjekt->execute([':username' => Tool::emBereinigen($name)]);
            $pwHash = $pwHashObjekt->fetch(PDO::FETCH_ASSOC);
            if($pwHash){
                if(password_verify($pw,$pwHash['pwHash'])){
                    return true;
                }
                    else{
                        $error = " Wrong PW!";
                }
            }
                else{
                    $error = "Wrong name";
                }
        }
        catch(PDOException $e) {
            $error = "Datenbank Fehler: " . $e->getMessage();
        }
    sleep(1);
    return $error;
    }

   
}
