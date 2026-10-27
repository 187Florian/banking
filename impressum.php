<?php
session_start();
require_once 'lang.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?= $lngImpressumTitle[$_SESSION['lang']] ?></title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body class="container2">
        <h1><?= $lngImpressumH1[$_SESSION['lang']] ?></h1>
        <h2><?= $lngImpressumH2[$_SESSION['lang']] ?></h2>
        <p>
        <?= $lngImpressumText[$_SESSION['lang']] ?>

        </p>
        <p class="link"><a href="index.php"><?= $lngZurueckHauptseite[$_SESSION['lang']] ?></a></p>
    </body>
</html>