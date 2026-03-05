<?php
    $host = 'localhost';
    $bdd = 'Forum';
    $user = 'root';
    $passwd = 'Remy@Alan123';
    try {
        $cnn = new PDO("mysql:host=$host;dbname=$bdd;charset=utf8", $user, $passwd , array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        //echo 'Connexion réussie';
    }
    catch(PDOException $e) {
        echo 'Erreur : '.$e->getMessage();
    }
?>