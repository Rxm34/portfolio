<?php include('en-tête.php');?>

<?php 
  session_start();
  include('connexion.php');
  include('Date.php');

  $resultat = $cnn->prepare("SELECT * FROM rubrique WHERE IdRub=:id" );
  $resultat->bindParam(':id', $_GET['IdRub'], PDO::PARAM_INT);
  $resultat->execute();
  $ligne = $resultat->fetch();
?> 

<div class="parallax-content baner-content" id="home">
  <div class="container">
    <div class="text-content">
      <?php
        echo '<fieldset><legend>'.$ligne['NomRub'];
        if (isset($_SESSION['Nom'])) {
          echo '<a href="ajouter_article.php?IdRub='.$_GET['IdRub'].'"><button type="button" class="menu" style="font-size:14px; margin-right:10px; margin-top:4px;">Ajouter un article</button></a>';
        }
        echo '</legend></fieldset>';
      ?>
    </div>

    <?php 
    $resultat2 = $cnn->prepare("SELECT * FROM article WHERE IdRub=:id");
    $resultat2->bindParam(':id', $ligne['IdRub'], PDO::PARAM_INT);
    $resultat2->execute();

    while($ligne2 = $resultat2->fetch()) {
    ?> 
      <div class="AffCatRub">
        <img id="rubrique" src="../img/logo.jpg" alt="">

        <?php echo '<div class="AffCatRubDesc"><h1><a href="article.php?IdArt=' .$ligne2['IdArt']. '">' .$ligne2['TitreArt']. '</a></h1></div>' ;?>

        <?php 
          $resultat3 = $cnn->prepare("SELECT COUNT(IdRep) AS NbRep FROM reponse WHERE IdArt = :id");
          $resultat3->bindParam(':id', $ligne2['IdArt'], PDO::PARAM_INT);
          $resultat3->execute();
          $ligne3 = $resultat3->fetch();
          $nba = 1 + $ligne3['NbRep']; 

          echo '<p class="messages">' .$nba. '<br>' . ($nba > 1 ? 'Messages' : 'Message') . '</p>' ;

          $resultat4 = $cnn->prepare("SELECT * FROM article INNER JOIN membre ON article.IdMemb=membre.IdMemb WHERE IdArt=:id");
          $resultat4->bindParam(':id', $ligne2['IdArt'], PDO::PARAM_INT);
          $resultat4->execute();
          $ligne4 = $resultat4->fetch();

          $lettre = strtoupper(substr($ligne4['NomMemb'], 0, 1));
          if ($ligne4['TypeMemb'] == 2) $type = "prenomUtilisateur";
          else if ($ligne4['TypeMemb'] == 1) $type = "prenomModerateur";
          else if ($ligne4['TypeMemb'] == 0) $type = "prenomAdministrateur";

          echo '<p class="date"><span class="'.$type.'avatar">'.$lettre.'</span>Par <span id="'.$type.'">' . $ligne4['NomMemb'] . '</span><br>' . temps_ecoule($ligne4['DateArt']) . '</p>';?>
      </div>
    <?php 
    }
    ?>
  </div>
</div>

<?php include('pied-de-page.php'); ?>
