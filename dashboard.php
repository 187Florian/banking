<?php
session_start();
require_once 'logout.php';
require_once 'user.php';
require_once 'lang.php';
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
        <title><?= $lngDashboardTitle[$_SESSION['lang']] ?></title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body class="container2">
        <h1>
        <?= $lngDashboardH1[$_SESSION['lang']] ?>
        </h1>
        
        
        <form method="post">
            <button name="abmelden" class="abmelden"><?= $lngDashboardAbmelden[$_SESSION['lang']] ?></button>
        </form>
        <div class="wilkommenstext">   
                <p><?= $lngDashboardWillkommen[$_SESSION['lang']] ?></p>   
                <p><?= $lngDashboardKontostand[$_SESSION['lang']] ?>  <?php  echo $nutzer->getGeld() . '€';?>!</p>
                <?php echo $error;?>
        </div>
    <footer>
        <div class="link"><a href="transfer.php"><?= $lngDashboardUeberweisungen[$_SESSION['lang']] ?></a></div></footer>
    </body>
</html>