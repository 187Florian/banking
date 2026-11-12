<?php
require_once 'db_con.php';
class Logger{
    /*
        //Log typen
        - Transaction log  sqlite = 'transaction' (Log for history of transfers for the useres)
        - Private Log       (General log for devs)

        //user action types
        -login
        -logout
        -sent/recievd money
        -chaged job (fired/applied)


        Backend priave log is not developed yet!!!!!!
    */
    
    private $db;
    private $logging;
    function __construct(){
        $this->db= Db_con::getDb();
        $this->logging = false;
    }
    public function logTransaction($amount,$empfaenger,$user){
    $para =[
        
        
        ':transfer_type' => "Transfer Log",
        ':amount' => $amount,
        ':absender' => $user->getEmail(),
        ":empfaenger" => $empfaenger,
    ];
    //Wichtig! typ des logs = transaction
    $this->sendLog("transaction",$para);
    }

    public function userAction($user,$type,$newValue) {
    }
    //logic





    private function sendLog(String $log_type,array $para){
        try{


        if(!$this->logging&&!$this->db->inTransaction()){
        $this->db->beginTransaction();
        $this->logging = true;
        }

        
        // log tranascion
        if($log_type =='transaction'){
        $log_payload = $this->db->prepare("
        INSERT INTO transaction_log (amount, empfaenger, absender, type_of_transfer) 
        VALUES (:amount, :empfaenger, :absender, :transfer_type);
        ");
        }

        //andere fälle comming soon

        //data loadiong
        if(isset($log_payload)){
        $log_payload->execute($para);
        }
    }
    catch(PDOException $e) {

        echo "Datenbank Fehler: " . $e->getMessage();
        if ($this->db->inTransaction()) {
            $this->db->rollBack();
        }
    } 
    }
    //
    public function save_log(){
            if($this->logging){
                $this->db->commit();
                $this->logging = false;
            }
    }


}