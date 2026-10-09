<?php
session_start();
//look if its is 
if(!isset($_SESSION['login']) || !$_SESSION['login']){
    header("Location: anmelden.php", true, 302);
    exit();
}
require_once 'logout.php';
require_once 'user.php';
$nutzer = new user($_SESSION['email']);
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="">
    </head>
    <body>
        <h1>
            Dashboard
        </h1>

        <form method="post">
            <button name="abmelden">Abmelden</button>
        </form>

        <div>   <p>Willkommen</p>   
                <p>Dein Kontostand beträgt: <?php  echo $nutzer->getGeld() . '€';?>!</p>
    
        </div>
        <?php 
        if(isset($_POST['abmelden'])){
            $sessionStop = new logout();
            $sessionStop->abmelden();
           
        }
        ?>

    </body>
</html>