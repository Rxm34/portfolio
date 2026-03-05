<?php include('en-tête.php'); ?>
<section class="Rubrique"><br>
<h1 id="inscription"> Modifier une rubrique </h1><br><br>
<form name="Rubrique" action="#" method="post">
    <?php
    include('connexion.php');
    
    if (isset($_GET['id'])) {
        $ligne = $cnn->prepare("SELECT * FROM rubrique WHERE IdRub = :IdRub");
        $ligne->bindParam(':IdRub', $_GET['id']);
        $ligne->execute();
        $resultat = $ligne->fetch();
    }

    $resultat2 = $cnn->prepare("SELECT * FROM categorie");
    $resultat2->execute();
    echo '<label for="cat" class="Rubrique">Modifiez la catégorie</label><br>
          <select  name="cat" class="categorieSelect">';
    while($ligne = $resultat2->fetch()) {
        echo '<option value="'.$ligne['IdCat'].'">'.$ligne['NomCat'].'</option>';
    }
    echo '</select>';
    ?>
    <br><br>
    <label for="NomRub" class="Rubrique">Modifiez le titre de la rubrique</label><br>
    <textarea type="text" name="NomRub" id="NomRub" required><?php echo $resultat['NomRub']; ?></textarea><br><br><br>
    <label class="Contenu" for="DescRub">Modifiez la description de la rubrique</label><br>
    <textarea name="DescRub" id="DescRub" required><?php echo $resultat['DescRub']; ?></textarea><br><br>
    <input type="submit" class="menu2" value="Valider"><br><br><br><br>
    <a href="javascript:history.back()"><button type="button" class="retourCharte">Retour</button></a><br><br><br>
    <a href="index.php"><button type="button" class="retour">Retourner à l'accueil</button></a>
    <?php  
    if (isset($_POST['NomRub']) && isset($_POST['DescRub'])) {

        $NomRub = $_POST['NomRub'];
        $DescRub = $_POST['DescRub'];
        $Cat = $_POST['cat'];
                        
        $stmt = $cnn->prepare("UPDATE rubrique SET NomRub=:NomRub, DescRub=:DescRub, IdCat=:IdCat WHERE IdRub = :IdRub");
        $stmt->bindParam(':NomRub', $NomRub);
        $stmt->bindParam(':DescRub', $DescRub);
        $stmt->bindParam(':IdCat', $Cat);
        $stmt->bindParam(':IdRub', $_GET['id']);
        $stmt->execute();
        header('Location: admin.php');
    }
    ?>
</form>
</section><br><br><br>
