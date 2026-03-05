<?php
    $host   = $_ENV['DB_HOST'];
    $bdd    = $_ENV['DB_NAME'];
    $user   = $_ENV['DB_USER'];
    $passwd = $_ENV['DB_PASS'];
    try {
        $cnn = new PDO("mysql:host=$host;dbname=$bdd;charset=utf8", $user, $passwd , array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch(PDOException $e) {
        echo 'Erreur : '.$e->getMessage();
    }
?>