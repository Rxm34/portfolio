<?php
      include('connexion.php');
      $resultat = $cnn->prepare("UPDATE membre SET TypeMemb=:Type WHERE IdMemb=:Memb");
      $resultat->bindParam(':Type',$_GET['droit'], PDO::PARAM_INT);
      $resultat->bindParam(':Memb',$_GET['id'], PDO::PARAM_STR);
        $resultat->execute();
      
      header('Location: admin.php');
      
      
      
      
      
      
?>