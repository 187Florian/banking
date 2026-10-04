<?php
class logout{
    public function abmelden(){
        //var reset    
        $_SESSION = array();
        if (ini_get("session.use_cookies")){
            // del everythinkg
            $chokie = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $chokie["path"], $chokie["domain"],
            $chokie["secure"], $chokie["httponly"]);

        }
        
        session_destroy();
        header("Location: anmelden.php", true, 302);
        exit();
    }  
}
?>