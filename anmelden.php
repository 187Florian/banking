<?php
session_start();
require_once 'login.php';
//already logt in
if(isset($_SESSION['login']) && $_SESSION['login']){
    header("Location: dashboard.php", true, 302);
    exit();
}
//header dashboard und überprüfer
if ($_SERVER['REQUEST_METHOD']== "POST" && isset($_POST['anmelden'])){
    $login = new login();
        if($login->sql_logintest($_POST['email'],$_POST['password'])){
            $_SESSION['login'] = true;
            $_SESSION['email'] = $_POST['email'];
            header("Location: dashboard.php", true, 302);
            exit();
        }
    }
?>
<!DOCTYPE html>

<html>

<head>
        <meta charset="utf-8">
        <title>Anmelden</title>
    
    </head>
    
    <body>
        <h3>

            Melden sie sich bitte an

        </h3>
        <div class="login">
            <form action="anmelden.php" method="post">

                <input type="text" name="email" placeholder="E-Mail">

                <input type="password" name="password" placeholder="Passwort">

                <button type="submit" name="anmelden">Anmelden</button>
            </form>
        </div>

        <?php
                    
        ?>
                    <footer>
                        <a href="index.html">Zurück zur Hauptseite</a>
                    </footer>
    </body>
</html>