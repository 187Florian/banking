<?php
session_start();

if(isset($_SESSION['login']) && $_SESSION['login']){
    header("Location: dashboard.php", true, 302);
    exit();
}

require_once 'login.php';
?>
<!DOCTYPE html>

<html>

<head>
        <meta charset="utf-8">
        <title></title>
    
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



                //echo(password_hash("hallo",PASSWORD_DEFAULT));
                    if ($_SERVER['REQUEST_METHOD']== "POST" && isset($_POST['anmelden'])){
                    echo htmlspecialchars($_POST['email']);
                    echo htmlspecialchars($_POST['password']);
                    $login = new logintest();
                    //$login->sql_newUser('florian@outlook.com',password_hash("hallo",PASSWORD_DEFAULT));
                    //$login->sql_newUser($_POST['email'],password_hash($_POST['password'], PASSWORD_DEFAULT));
                        if($login->sql_logintest($_POST['email'],$_POST['password'])){
                        
                            $_SESSION['login'] = true;
                            header("Location: dashboard.php", true, 302);
                            exit();
                            }
                    } 
        ?>
                    <footer>
                        <a href="index.html">Zurück zur Hauptseite</a>
                    </footer>
    </body>
</html>