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

    <form action="transfer.php" method="post">
        <input type="email" name="mail" placeholder="Empfänger Email">
        <input type="number" min="1" name="menge" placeholder="Menge">
        <button name="ueberweisen">Überweisen</button>
    </form>
    <?php
        if($_SERVER['REQUEST_METHOD']== "POST" && isset($_POST['ueberweisen'])){
            $menge = (int)$_POST['menge']; 
            if($user->testForUser($_POST['mail'])&& $user->getGeld() >= $menge){
                $user->changeGeld(-$menge);
                $empfänger = new user($_POST['mail']);
                $empfänger->changeGeld($menge);
                echo "überweisung erfolgreich!";
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