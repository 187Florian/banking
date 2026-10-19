<?php
session_start();
require_once 'logout.php';
require_once 'user.php';

//header
    //look if logt in
if(!isset($_SESSION['login']) || !$_SESSION['login']){
    header("Location: anmelden.php", true, 302);
    exit();
}
    //abmelden
if(isset($_POST['abmelden'])){
        $sessionStop = new logout();
        $sessionStop->abmelden();
}

//objekte
$user = new User($_SESSION['email']);
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
    <a href="dashboard.php">Zurück</a>
    
    <?php
        if($_SERVER['REQUEST_METHOD']== "POST" && isset($_POST['ueberweisen'])){
            $menge = (int)$_POST['menge']; 
            if($user->testForUser($_POST['mail'])&& $user->getGeld() >= $menge && $menge>0){
                //test if selbstüberweisung
                echo $user->getEmail();
                if($user->getEmail()!=strtolower(trim($_POST['mail']))){
                $user->changeGeld(-$menge);
                $empfänger = new user($_POST['mail']);
                $empfänger->changeGeld($menge);
                echo "überweisung erfolgreich!";
                }
                else{
                    echo "You can not transfer yourself money!";
                }
            }
            else{
                echo "Zu wenig Geld auf dem Konto oder falsches Empfänger Konto!";
            }

        }
    ?>


        <form method="post">
            <button name="abmelden">Abmelden</button>
        </form>
    </body>
</html>