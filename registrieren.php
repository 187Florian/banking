<?php
session_start();
//already logt in
require_once 'check_not_loged_in.php';
require_once 'user.php';
if($_SERVER['REQUEST_METHOD']==='POST'&& isset($_POST['regesNewUser'])){
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    //em test 
    if(!empty($email)&&!empty($password) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        //new user
        if(user::newUser($email,$password)){
            $_SESSION['login'] = true;
            $_SESSION['email'] = $email;
            header("Location: dashboard.php", true, 302);
            exit();
        }
        else{
            $error = "Error!";
        }
    }
    else{
        $error = "Please provide valid info!";
    }
}
$error = $error ?? "";
?>
<!DOCTYPE html>


<html>
    <head>
        <meta charset="utf-8">
        <title>Registrieren</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body class="container2">
        <h1>Konto erstellen</h1>
        <form action="registrieren.php" method="post">
            
        <input type="text" name="email" placeholder="Gültige E-Mail">

        <input type="password" name="password" placeholder="Sicheres Passwort">

        <button type="submit" name="regesNewUser">Registrieren</button>
        </form>
        <?php echo $error;?>
        <footer>
        <p class="link"><a href="anmelden.php">Sie besitzen schon ein Konto?</a></p>
        
        <p class="link"><a href="index.html">Zurück zur Hauptseite</a></p>
        </footer>
       
    </body>
</html>