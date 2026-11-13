<?php
require_once 'db_con.php';
date_default_timezone_set('Europe/Berlin');
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

    //logic
    public function privateLog($user,$activity,$value){
        $para =[
            'activity' => $activity,
            'value' => $value,
            "user" => $user,
        ];
        $this->sendLog("private_log",$para);
    }



    private function sendLog(String $log_type,array $para){
        try{

    

        if(!$this->logging&&!$this->db->inTransaction()&& $log_type !="private_log"){
        $this->db->beginTransaction();
        $this->logging = true;
        }

        if($log_type =="private_log"){
            $logEntry = "[". date('Y-m-d H:i:s') . "]" . " User: " . $para['user'] . "; Activity: " . $para['activity'] . "; Value: " . $para['value']. ";" . PHP_EOL ;
            file_put_contents('logs/activity.log', $logEntry, FILE_APPEND | LOCK_EX);
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