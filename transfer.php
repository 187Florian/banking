<?php
session_start();
require_once 'logout.php';
require_once 'user.php';
require_once 'check_auth.php';
require_once 'tool.php';
require_once 'lang.php';
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
            $error = "Error!";
        }
        }
        else{
            $error = "You can not transfer yourself money!";
        }
    }
    else{
        $error = "error! ";
    }
    

}
$error = $error ?? "";
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <title><?= $lngTransferTitle[$_SESSION['lang']] ?></title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body class="container2">
        <h1><?= $lngTransferH1[$_SESSION['lang']] ?></h1>

        

        <h3><?= $lngTransferAvailable1[$_SESSION['lang']] ?> <?php 
        $avMoney = $user->getGeld();
        if($avMoney<0){
            $avMoney = 0;
        }
        echo $avMoney;
        ?><?= $lngTransferAvailable2[$_SESSION['lang']] ?></h3>

    <form action="transfer.php" method="post">
        <input type="email" name="mail" placeholder="<?= $lngTransferPlaceholderMail[$_SESSION['lang']] ?>">
        <input type="number" min="1" name="menge" placeholder="<?= $lngTransferPlaceholderMenge[$_SESSION['lang']] ?>">
        <button name="ueberweisen"><?= $lngTransferButton[$_SESSION['lang']] ?></button>
    </form>
    <br>
    <p><?php echo $error;?></p>
    
    
    
        <footer>
            <p class="link"><a href="dashboard.php"><?= $lngTransferFooterDashboard[$_SESSION['lang']] ?></a></p>
        </footer>

        <form method="post">
            <button name="abmelden" class="abmelden"><?= $lngDashboardAbmelden[$_SESSION['lang']] ?></button>
        </form>
    </body>
</html>