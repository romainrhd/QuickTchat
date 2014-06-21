<?php
    require_once('config.php');
    $dsn = 'mysql:host='.DB_ADDRESS.';dbname='.DB_NAME;
    $username = DB_USER;
    $password = DB_PASSWORD;
    $connexion = new PDO($dsn, $username, $password);
    $connexion->exec("set names utf8");
?>