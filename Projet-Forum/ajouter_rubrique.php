<?php include('en-tête.php');?>
<section class="Rubrique"><br>
<h1 id="inscription"> Ajouter une rubrique </h1><br><br>
<form name="Rubrique" action="#" method="post">
    <?php include('connexion.php');
          $resultat = $cnn->prepare("SELECT * FROM categorie");
          $resultat->execute();
          echo '<label for="cat" class="Rubrique">Sélectionnez la catégorie </label><br>
                <select  name="cat" class="categorieSelect">';
          while($ligne = $resultat ->fetch()) {
            echo '<option value="'.$ligne['IdCat'].'">'.$ligne['NomCat'].'</option>';
          }
          echo '</select>';
    ?>
    <br><br>
    <label for="NomRub" class="Rubrique">Saisissez le titre de votre rubrique </label><br>
    <textarea type="text" name="NomRub" id="NomRub"  required></textarea><br><br><br>
    <label class="Contenu" for="DescRub">Saisissez la description de votre rubrique</label><br>
    <textarea name="DescRub" id="DescRub" required></textarea><br><br>
    <input type="submit" class="menu2" value="Valider"><br><br><br><br>
    <a href="javascript:history.back()"><button type="button" class="retourCharte">Retour</button></a><br><br><br>
    <a href="index.php"><button type="button" class="retour">Retourner à l'accueil</button></a>
    <?php  
        if (isset($_POST['NomRub']) && isset($_POST['DescRub'])) {

            $NomRub = $_POST['NomRub'];
            $DescRub = $_POST['DescRub'];
            $Cat = $_POST['cat'];
                           
            $stmt = $cnn->prepare("INSERT INTO rubrique (NomRub,DescRub,IdCat) VALUES (:NomRub, :DescRub, :IdCat)");
            $stmt->bindParam(':NomRub', $NomRub);
            $stmt->bindParam(':DescRub', $DescRub);
            $stmt->bindParam(':IdCat', $Cat);
            $stmt->execute();
            header('Location: admin.php');
           
        }
    ?>
</form>
</section><br><br><br>