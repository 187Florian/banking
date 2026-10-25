<?php
if(isset($_SESSION['login']) && $_SESSION['login']){
    header("Location: dashboard.php", true, 302);
    exit();
}