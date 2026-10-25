<?php
session_start();
require_once 'logout.php';
require_once 'user.php';
//check if logt in
require_once 'check_auth.php';

//abmelden knopf
if(isset($_POST['abmelden'])){
    $sessionStop = new logout();
    $sessionStop->abmelden();
}

$nutzer = new user($_SESSION['email']);

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Dashbaord</title>
        <link rel="stylesheet" href="">
    </head>
    <body>
        <h1>
            Dashboard
        </h1>

        <form method="post">
            <button name="abmelden">Abmelden</button>
        </form>



        <div>   
                <p>Willkommen</p>   
                <p>Dein Kontostand beträgt: <?php  echo $nutzer->getGeld() . '€';?>!</p>
                <a href="transfer.php">Überweisungen</a>
        </div>
        
    
    </body>
</html>