<?php include('en-tête.php'); 
      include('connexion.php');
      include('Date.php');
    
      if (isset($_POST['ContenuRep'])) {

        $ContenuRep = $_POST['ContenuRep'];
                       
        $stmt = $cnn->prepare("INSERT INTO reponse (IdMemb,IdArt,ContenuRep) VALUES (:IdMemb, :IdArt, :ContenuRep)");
        $stmt->bindParam(':IdMemb', $_SESSION['Id']);
        $stmt->bindParam(':IdArt',  $_GET['IdArt']);
        $stmt->bindParam(':ContenuRep',  $ContenuRep);
        $stmt->execute();
       }
      $resultat4 = $cnn->prepare("SELECT * FROM article INNER JOIN membre ON article.IdMemb=membre.IdMemb  WHERE IdArt=:id ");
      $resultat4->bindParam(':id',$_GET['IdArt'], PDO::PARAM_INT);
      $resultat4->execute();
      $ligne4 = $resultat4->fetch();
    ?> 
    <div class="parallax-content baner-content" id="home">
        <div class="container">
            <div class="text-content">
                <?php echo '<fieldset><legend>'.$ligne4['TitreArt']. '</legend></fieldest>';?>
            </div>
      <?php $lettre=strtoupper(substr($ligne4['NomMemb'],0,1));
      
      $date=date_create($ligne4['DateArt']);
      if($ligne4['TypeMemb']==2) $type="prenomUtilisateur";
      else if($ligne4['TypeMemb']==1) $type="prenomModerateur";
      else if($ligne4['TypeMemb']==0) $type="prenomAdministrateur";
      
        echo '
              <div class="AffCatRub">
                <img id="rubrique" src="../img/logo.jpg"alt="">
                <div class="AffCatRubDesc2"><p>'.$ligne4['ContenuArt'].'</p></div>
                <p class="date"><span class="'.$type.'avatar">'.$lettre.'</span>Par <span id="'.$type.'">' . $ligne4['NomMemb'] . '</span><br>' . temps_ecoule($ligne4['DateArt']) . '</p>';
                if (isset($_SESSION['Type']) && ($_SESSION['Type']!=2) )
                echo '<a onclick="return confirm(\'Voulez-vous supprimer cet article ?\');" href="Supp.php?art='.$ligne4['IdArt'].'"><img class="poubelle" src="img/supprimer.png" width="40" height="40"></a>';
              echo '</div>' ;
      ?>
   
        <?php 

     
      $resultat5 = $cnn->prepare("SELECT * FROM article INNER JOIN reponse ON article.IdArt=reponse.IdArt INNER JOIN membre ON reponse.IdMemb=membre.IdMemb  WHERE article.IdArt=:id ORDER BY DateRep DESC");
      $resultat5->bindParam(':id',$ligne4['IdArt'], PDO::PARAM_INT);
      $resultat5->execute();
      
      while ($ligne5 = $resultat5->fetch()){

        echo '<div class="AffCatRub">
        <img id="rubrique" src="../img/logo.jpg"alt="">';
        
          if($ligne5['TypeMemb']==2) $type="prenomUtilisateur";
          else if($ligne5['TypeMemb']==1) $type="prenomModerateur";
          else if($ligne5['TypeMemb']==0) $type="prenomAdministrateur";
              $date=date_create($ligne5['DateRep']);
              $lettre=strtoupper(substr($ligne5['NomMemb'],0,1));
          echo ' <div class="AffCatRubDesc2"><p>'.$ligne5['ContenuRep'].'</p></div><p class="date"><span class="'.$type.'avatar">'.$lettre.'</span>Par <span id="'.$type.'">' .$ligne5['NomMemb']. '</span><br>' . temps_ecoule($ligne5['DateRep']) . '</p>';
          if (isset($_SESSION['Type']) && ($_SESSION['Type']!=2) )
            echo '<a onclick="return confirm(\'Voulez-vous supprimer cette réponse ?\');" href="Supp.php?rep='.$ligne5['IdRep'].'"><img class="poubelle" src="img/supprimer.png" width="40" height="40"></a>';
        echo '</div><br><br>';
    }
      ?>
    
    <div class="AffCatRub">
    <?php
       if (isset($_SESSION['Nom'])) {
          echo '<form name="Reponse" action="#" method="post">
          <textarea name="ContenuRep" class="ContenuRep" required></textarea>
          <br><br>
          <input type="submit" class="menu2" value="Répondre"></form>'; 
          
        }
    ?>
    </div>
    <br><br>
    </div>
    </div><br><br>
   
      <?php include('pied-de-page.php');?>
