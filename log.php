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
        -changed salary



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
    public function privateLog($userEm,$activity,$value){
        $para =[
            'activity' => $activity,
            'value' => $value,
            "user" => $userEm,
        ];
        $this->sendLog("private_log",$para);
    }
    public function errorLog($userEm,$activity,$value){
        $para =[
            'activity' => $activity,
            'value' => $value,
            "user" => $userEm,
        ];
        $this->sendLog("error_log",$para);
    }


    private function sendLog(String $log_type,array $para){
        

    
        //private log user acctivity
        if($log_type =="private_log"){
            $logEntry = "[". date('Y-m-d H:i:s') . "]" . " User: " . $para['user'] . "; Activity: " . $para['activity'] . "; Value: " . $para['value']. ";" . PHP_EOL ;
            file_put_contents('logs/activity.log', $logEntry, FILE_APPEND | LOCK_EX);
        }
        //private log errors
        if($log_type =="error_log"){
            $logEntry = "[". date('Y-m-d H:i:s') . "]" . " User: " . $para['user'] . "; Activity: " . $para['activity'] . "; Value: " . $para['value']. ";" . PHP_EOL ;
            file_put_contents('logs/error.log', $logEntry, FILE_APPEND | LOCK_EX);
        }


        /*
            DB VERBINDUNG LOGS

        */
        try{
        if(!$this->logging&&!$this->db->inTransaction()&& $log_type =="transaction"){
            $this->db->beginTransaction();
            $this->logging = true;
            }
        // log tranascion
        if($log_type =='transaction'){
        $log_payload = $this->db->prepare("
        INSERT INTO transaction_log (amount, empfaenger, absender, type_of_transfer) 
        VALUES (:amount, :empfaenger, :absender, :transfer_type);
        ");
        

        //andere fälle comming soon

        //data loadiong
        if(isset($log_payload)){
        $log_payload->execute($para);
        }
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