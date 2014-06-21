<?php
    $dsn = 'mysql:host=localhost;dbname=tchat';
    $username = 'root';
    $password = '';
    $connexion = new PDO($dsn, $username, $password);
    $connexion->exec("set names utf8");
?>