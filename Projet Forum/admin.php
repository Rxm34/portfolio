<?php include('en-tête.php');
      include('connexion.php');
      session_start();
      if (isset($_SESSION['Type']) && ($_SESSION['Type']==0) )
      {
      ?> 


<div class="container">
  <div class="row">
     
        <fieldset><legend>Administration - Gestion des utilisateurs</fieldset>
        <br><br>
        <?php
        $resultat = $cnn->prepare("SELECT * FROM membre order by NomMemb, PrenomMemb");
        $resultat->execute();
        // Affichage des lignes. Une ligne contient un enregistrement
        echo '<fieldset class="admin">
                <table style="color:white; width:600px; margin-left:auto;margin-right:auto;">
                   <tr>  <td> Nom de l\'utilisateur</td><td>Administration</td>  </tr>';
        while($ligne = $resultat->fetch()) {
          echo '<tr><td>'.$ligne['NomMemb'].' '.$ligne['PrenomMemb'].'</td><td>';

          if ($ligne['TypeMemb']==0) echo '<img src="img/Administrateur.png" width="100"> ';
          else echo '<a href="ModifDroit.php?id='.$ligne['IdMemb'].'&droit=0"><img src="img/GrisAdministrateur.png" width="100"></a> ';
          if ($ligne['TypeMemb']==1) echo '<img src="img/Moderateur.png" width="100"> ';
          else echo '<a href="ModifDroit.php?id='.$ligne['IdMemb'].'&droit=1"><img src="img/GrisModerateur.png" width="100"></a> ';
          if ($ligne['TypeMemb']==2) echo '<img src="img/Utilisateur.png" width="100"> ';
          else echo '<a href="ModifDroit.php?id='.$ligne['IdMemb'].'&droit=2"><img src="img/GrisUtilisateur.png" width="100"></a> ';
          echo '<a onclick="return confirm(\'Voulez-vous supprimer ce membre ?\');" href="Supp.php?id='.$ligne['IdMemb'].'"><img src="img/supprimer.png" width="40" height="40"></a>';
          echo '</td></tr>';
        }
        echo '</table></fieldset>'
      ?>
      <br><br>
      <a href="index.php"><button type="button" class="retour">Retourner à l'accueil</button></a>
      <br><br><br>
      <a href="ajouter_rubrique.php"><img src="img/Ajouter.png" width="150"></a>
      <br>
      <?php
        $resultat2 = $cnn->prepare("SELECT * FROM rubrique order by NomRub");
        $resultat2->execute();
        // Affichage des lignes. Une ligne contient un enregistrement
        echo '<fieldset class="admin">
                <table style="color:white; width:600px; margin-left:auto;margin-right:auto;">
                   <tr>  <td> Nom de la rubrique</td><td>Administration</td>  </tr><br>';
        while($ligne2 = $resultat2->fetch()) {
          echo '<tr><td>'.$ligne2['NomRub'].'</td><td>';
          echo '<a href="modifier_rubrique.php?id='.$ligne2['IdRub'].'"><img src="img/modifier.png" width="40"></a>';
          echo '<a onclick="return confirm(\'Voulez-vous supprimer cette rubrique ?\');" href="Supp.php?rub='.$ligne2['IdRub'].'"><img src="img/supprimer.png" width="40" height="40"></a>';
          echo '</td></tr>';
        }
        echo '</table></fieldset>'
      ?>
      <br><br>
    </div>
  </div>


 <?php include('pied-de-page.php');
 
      }
      else
        header('Location: index.php');
      ?>


 
