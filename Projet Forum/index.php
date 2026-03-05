<?php include('en-tête.php');?>
    <?php 
      include('connexion.php');
      include('Date.php');
    
      $resultat = $cnn->prepare("SELECT * FROM categorie" );
      $resultat->execute();
      // Affichage des lignes. Une ligne contient un enregistrement
      while($ligne = $resultat->fetch()) {
    ?> 
    <div class="parallax-content baner-content" id="home">
        <div class="container">
            <div class="text-content">
                <?php echo '<fieldset><legend>'.$ligne['NomCat']. '</legend></fieldest>';?>
            </div>
    <?php 
   
    $resultat2 = $cnn->prepare("SELECT * FROM rubrique WHERE IdCat=:id");
    $resultat2->bindParam(':id',$ligne['IdCat'], PDO::PARAM_INT);
  
    $resultat2->execute();
    // Affichage des lignes. Une ligne contient un enregistrement
    while($ligne2 = $resultat2->fetch()) {
    ?> 
    <div class="AffCatRub">
        <img id="accueil" src="../img/logo.jpg"alt="">
        <?php echo '<div class="AffCatRubDesc"><h1><a href="rubrique.php?IdRub=' .$ligne2['IdRub']. '">' .$ligne2['NomRub']. '</h1></a>' ;?>
        <?php echo '<p style="text-align:justify;">' .$ligne2['DescRub']. '</p></div>' ;?>
    <?php 
      $resultat3 = $cnn->prepare("SELECT COUNT(IdArt) AS NbArt FROM article WHERE IdRub = :id");
      $resultat3->bindParam(':id',$ligne2['IdRub'], PDO::PARAM_INT);
      $resultat3->execute();
      $ligne3 = $resultat3->fetch();
      $nba=$ligne3['NbArt'];
      $resultat3 = $cnn->prepare("SELECT COUNT(IdRep) AS NbRep FROM article INNER JOIN reponse ON article.IdArt=reponse.IdArt WHERE IdRub = :id");
      $resultat3->bindParam(':id',$ligne2['IdRub'], PDO::PARAM_INT);
      $resultat3->execute();
      $ligne3 = $resultat3->fetch();
      $nba+=$ligne3['NbRep'];
      if($nba>1)
        echo '<p class="messages">' .$nba. '<br>Messages</p>' ;
      else
        echo '<p class="messages">' .$nba. '<br>Message</p>' ;
     
      $resultat4 = $cnn->prepare("SELECT * FROM article INNER JOIN membre ON article.IdMemb=membre.IdMemb  WHERE IdRub=:id ORDER BY DateArt DESC");
      $resultat4->bindParam(':id',$ligne2['IdRub'], PDO::PARAM_INT);
      $resultat4->execute();
      // Affichage des lignes. Une ligne contient un enregistrement
      $ligne4 = $resultat4->fetch();
      $resultat5 = $cnn->prepare("SELECT * FROM article INNER JOIN reponse ON article.IdArt=reponse.IdArt INNER JOIN membre ON article.IdMemb=membre.IdMemb  WHERE IdRub=:id ORDER BY DateRep DESC");
      $resultat5->bindParam(':id',$ligne2['IdRub'], PDO::PARAM_INT);
      $resultat5->execute();
      // Affichage des lignes. Une ligne contient un enregistrement
      $ligne5 = $resultat5->fetch();
      if (isset($ligne4['DateArt'])){ 
        if($ligne4['DateArt']>$ligne5['DateRep']){
          $lettre=strtoupper(substr($ligne4['NomMemb'],0,1));
          if($ligne4['TypeMemb']==2) $type="prenomUtilisateur";
          else if($ligne4['TypeMemb']==1) $type="prenomModerateur";
          else if($ligne4['TypeMemb']==0) $type="prenomAdministrateur";
              $date=date_create($ligne4['DateArt']);
              echo '<p class="date">' .$ligne4['TitreArt']. '<br><span class="'.$type.'avatar">'.$lettre.'</span>Par <span id="'.$type.'">' . $ligne4['NomMemb'] . '</span><br>' . temps_ecoule($ligne4['DateArt']) . '</p>' ;
        
        }
        else if(isset($ligne5['DateRep'])){
          if($ligne5['TypeMemb']==2) $type="prenomUtilisateur";
          else if($ligne5['TypeMemb']==1) $type="prenomModerateur";
          else if($ligne5['TypeMemb']==0) $type="prenomAdministrateur";
              $date=date_create($ligne5['DateRep']);
              $lettre=strtoupper(substr($ligne5['NomMemb'],0,1));
              echo '<p class="date">' .$ligne5['TitreArt']. '<br><span class="'.$type.'avatar">'.$lettre.'</span>Par <span id="'.$type.'">' . $ligne5['NomMemb'] . '</span><br>' . temps_ecoule($ligne5['DateRep']) . '</p>' ;
            }
        else
        echo '<p class="date"></p>' ;
      }
      else 
       echo '<p class="date"></p>' ;
      ?>
    </div>
    <?php 
      }
      ?>
       </div>
    </div>
    <?php 
      }
      ?>
      <?php include('pied-de-page.php');?>