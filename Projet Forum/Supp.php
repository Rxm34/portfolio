<?php
  include('connexion.php');
  
  if (isset($_GET['id'])) {
    $resultat = $cnn->prepare("DELETE FROM membre WHERE IdMemb=:Memb");
    $resultat->bindParam(':Memb',$_GET['id'], PDO::PARAM_STR);
    $resultat->execute();
  }
  else 
    if (isset($_GET['rub'])) {
      $resultat = $cnn->prepare("DELETE FROM rubrique WHERE IdRub=:IdRub");
      $resultat->bindParam(':IdRub',$_GET['rub'], PDO::PARAM_INT);
      $resultat->execute();
    }
  else 
    if (isset($_GET['art'])) {
      $resultat = $cnn->prepare("DELETE FROM article WHERE IdArt=:IdArt");
      $resultat->bindParam(':IdArt',$_GET['art'], PDO::PARAM_INT);
      $resultat->execute();
    }
  else 
    if (isset($_GET['rep'])) {
      $resultat = $cnn->prepare("DELETE FROM reponse WHERE IdRep=:IdRep");
      $resultat->bindParam(':IdRep',$_GET['rep'], PDO::PARAM_INT);
      $resultat->execute();
    }
  header('Location: index.php'); 
?> 