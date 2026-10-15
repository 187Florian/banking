<?php
session_start();
//already logt in
if(isset($_SESSION['login']) && $_SESSION['login']){
    header("Location: dashboard.php", true, 302);
    exit();
}
?>


<!DOCTYPE html>


<html>
    <head>
        <meta charset="utf-8">
        <title>Registrieren</title>
        <link rel="stylesheet" href="">
    </head>
    <body>
        <h1>Konto erstellen</h1>
        <form action="registrieren.php" method="post">
            
        <input type="text" name="email" placeholder="Gültige E-Mail">

        <input type="password" name="password" placeholder="Passwort mit Mindestens 8 Zeichen">

        <button type="submit" name="regesNewUser">Registrieren</button>
        </form>


        
       
    </body>
</html>