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
if(!isset($error)){
    $error = "";
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Dashbaord</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body class="container2">
        <h1>
            Dashboard
        </h1>
        <div>
        
        <form method="post">
            <button name="abmelden" class="abmelden">Abmelden</button>
        </form>
        <div class="wilkommenstext">   
                <p>Willkommen</p>   
                <p>Dein Kontostand beträgt: <?php  echo $nutzer->getGeld() . '€';?>!</p>
                <?php echo $error;?>
</div>
        </div>
    <footer>
        <div class="link"><a href="transfer.php">Überweisungen</a></div></footer>
    </body>
</html>