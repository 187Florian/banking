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

                <input type="text", name="email", placeholder="E-Mail">

                <input type="password", name="password", placeholder="Passwort">

                <button type="submit" name="anmelden">Anmelden</button>
            </form>




        </div>

        <?php
           require_once 'logintest.php';
                    if ($_SERVER['REQUEST_METHOD']== "POST" && isset($_POST['anmelden'])){
                    echo htmlspecialchars($_POST['email']);
                    echo htmlspecialchars($_POST['password']);
                    $logintester = new logintest();
                        if($logintester->loginPruefen(htmlspecialchars($_POST['email']),htmlspecialchars($_POST['password']))){
                            echo "login colpelte!!";
                        }
                    }



        ?>
    





                    <footer>
                        <a href="index.html">Zurück zur Hauptseite</a>
                    </footer>
    </body>
</html>