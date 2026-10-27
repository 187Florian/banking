<?php
session_start();
require_once "lang.php";


?>
<!DOCTYPE html>
<html lang="de">
    <head>
       <title>Banking</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
    </head>
        <body>
        
<div class="container">
        <div class="geld">
        <img src="img/$blue.png" alt="50">
        </div>
<div class="inhalt">
        <div class="ansprache">
        <h2><?= $lngwelcometext1[$_SESSION['lang']] ?></h2>
        <h2><?= $lngwelcometext2[$_SESSION['lang']] ?></h2>
        </div>

            <div class="weiterleitungen">
            <a  href="anmelden.php"><?= $lnglogin[$_SESSION['lang']] ?></a>
            </div>
            
            <div class="weiterleitungen">
                    <a href="registrieren.php"><?= $lngnewaccount[$_SESSION['lang']] ?></a>
            </div>
</div>
</div>
<footer>
            <div class="link"><a  href="impressum.php"><span><?= $lngLegalDisclosure[$_SESSION['lang']] ?></span></a></div>
            <div class="link"><a href="explain.php"><span><?=  $lngwhoweare[$_SESSION['lang']] ?></span></a></div>
</footer>
        </body>


</html>