<?php
//if angemeldet
if(!isset($_SESSION['login']) || !$_SESSION['login']){
    header("Location: anmelden.php", true, 302);
    exit();
}