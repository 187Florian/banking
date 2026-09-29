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
}
?>