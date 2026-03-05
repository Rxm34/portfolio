<?php include('en-tête.php');?>
<section class="Article"><br>
<h1 id="inscription"> Article </h1><br><br>
<form name="Article" action="#" method="post">
    <label for="TitreArt">Saisissez le titre de votre article </label>
    <input type="text" name="TitreArt" id="TitreArt"  required/><br>
    <label class="Contenu" for="ContenuArt">Saisissez le contenu de votre article</label>
    <textarea name="ContenuArt" id="ContenuArt" required></textarea><br><br>
    <input type="submit" id="Valider" value="Valider"><br><br><br><br>
    <a href="javascript:history.back()"><button type="button" class="retourCharte">Retour</button></a><br><br><br>
    <a href="index.php"><button type="button" class="retour">Retourner à l'accueil</button></a>            
    <?php  
        if (isset($_POST['TitreArt']) && isset($_POST['ContenuArt'])) {
            include('connexion.php');

            $TitreArt = $_POST['TitreArt'];
            $ContenuArt = $_POST['ContenuArt'];
                           
            $stmt = $cnn->prepare("INSERT INTO article (TitreArt,ContenuArt,IdMemb,IdRub) VALUES (:TitreArt, :ContenuArt, :IdMemb, :IdRub)");
            $stmt->bindParam(':TitreArt', $TitreArt);
            $stmt->bindParam(':ContenuArt', $ContenuArt);
            $stmt->bindParam(':IdMemb',  $_SESSION['Id']);
            $stmt->bindParam(':IdRub',  $_GET['IdRub']);
            $stmt->execute();
            header('Location: rubrique.php?IdRub='.$_GET['IdRub']);
        }
    ?>
</form>
</section><br><br><br>       
            