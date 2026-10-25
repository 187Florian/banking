<?php
session_start();
require_once 'logout.php';
require_once 'user.php';
require_once 'check_auth.php';
require_once 'tool.php';

//header

    //abmelden
if(isset($_POST['abmelden'])){
        $sessionStop = new logout();
        $sessionStop->abmelden();
}

//objekte
$user = new User(tool::emBereinigen($_SESSION['email']));

if($_SERVER['REQUEST_METHOD']== "POST" && isset($_POST['ueberweisen']) && isset($_POST['menge'])&& isset($_POST['mail'])){
    $menge = (int)$_POST['menge']; 
    $postEmail = tool::emBereinigen($_POST['mail']);
    if(tool::emTesten($postEmail) && $user->testForUser($postEmail)&& $menge>0){
        //test if selbstüberweisung
        if($user->getEmail()!=$postEmail){


        if($user->ueberweisung($menge,$postEmail)){

            header("Location: transfer.php", true, 302);
            exit();
        }
        else{
            echo "Error!";
        }


        
        }
        else{
            echo "You can not transfer yourself money!";
        }
    }
    else{
        echo "error! ";
    }
    

}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <title>Überweisung</title>
    </head>
    <body>
        <h2>Überwesungen</h2>

        

        <h3>Sie können <?php 
        $avMoney = $user->getGeld();
        if($avMoney<0){
            $avMoney = 0;
        }
        echo $avMoney;
        ?>€ überweisen</h3>

    <form action="transfer.php" method="post">
        <input type="email" name="mail" placeholder="Empfänger Email">
        <input type="number" min="1" name="menge" placeholder="Menge">
        <button name="ueberweisen">Überweisen</button>
    </form>
    
    
    
        <footer>
            <p><a href="dashboard.php">Zurück zum Dashbaord</a></p>
        </footer>

        <form method="post">
            <button name="abmelden">Abmelden</button>
        </form>
    </body>
</html>