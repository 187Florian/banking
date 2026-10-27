<?php
session_start();
require_once 'login.php';
require_once 'tool.php';
require_once 'lang.php';
//already logt in
require_once 'check_not_loged_in.php';

//header dashboard und überprüfer
if ($_SERVER['REQUEST_METHOD']== "POST" && isset($_POST['anmelden'])){
    $login = new login();
    $ergebnis = $login->sql_logintest($_POST['email'],$_POST['password']);
        if(!is_String($ergebnis)){
            $_SESSION['login'] = true;
            $_SESSION['email'] = tool::emBereinigen($_POST['email']);
            header("Location: dashboard.php", true, 302);
            exit();
        }
        else{
            $error = $ergebnis;
        }
    }
    $error = $error ?? "";

?>
<!DOCTYPE html>

<html>

<head>
        <meta charset="utf-8">
        <title><?= $lngAnmeldenTitle[$_SESSION['lang']] ?></title>
        <link rel="stylesheet" href="style.css">
    </head>
    
    <body class="container2">
        <h1><?= $lngAnmeldenH1[$_SESSION['lang']] ?></h1>
            <form action="anmelden.php" method="post">
                <input type="text" name="email" placeholder="<?= $lngAnmeldenPlaceholderEmail[$_SESSION['lang']] ?>" required>
                <input type="password" name="password" placeholder="<?= $lngAnmeldenPlaceholderPassword[$_SESSION['lang']] ?>" required>
                <button type="submit" name="anmelden"><?= $lngAnmeldenButton[$_SESSION['lang']] ?></button>
                <br>
                <?php echo $error;?>
            </form>
        <footer>
            <p class="link"><a href="registrieren.php"><?= $lngAnmeldenFooterNoAccount[$_SESSION['lang']] ?></a></p>
            <p class="link"><a href="index.php"><?= $lngZurueckHauptseite[$_SESSION['lang']] ?></a></p>
        </footer>
    </body>
</html>