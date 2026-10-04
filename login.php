<?php

class logintest {




    public function loginPruefen($em,$pw){
        //test 1 - not empty
        if (!empty($em)&&!empty($pw)) {
            echo "not empty";
            //testen ob email
            if (filter_var(trim($em), FILTER_VALIDATE_EMAIL)){
                echo "valid mali";
                //email sql test
                    
                //password get
                $db_pw = password_hash("hallo", PASSWORD_DEFAULT);
                //passwort test
                if(password_verify($pw,$db_pw)){
                    // login 
                    
                    echo " \br  ! pw right !";
                    return true;
                }
            }
            

        }
        
    }
    public function sql_newUser($em,$pwH){
        $db1 = new SQLite3('user.db');
            if($db1){
                echo "con established";
                $db1->exec("INSERT INTO user (email,pwHash) VALUES ('$em','$pwH')");
            }
            else{
                echo "no con";
            }
    }





    public function sql_logintest($em,$pw){
        try {
        $db2 = new PDO('sqlite:user.db');
            $pwHashObjekt = $db2->prepare("SELECT pwHash FROM USER WHERE email = :em");
            $pwHashObjekt->execute([':em' => $em]);
            $pwHash = $pwHashObjekt->fetch(PDO::FETCH_ASSOC);
            if($pwHash){
                if(password_verify($pw,$pwHash['pwHash'])){
                    echo " Loged in!";
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
    return false;
    }
}
?>