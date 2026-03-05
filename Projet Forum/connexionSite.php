<?php 
session_start();
include('en-tête.php');
?>
<section class="inscription"><br>
<h1 id="inscription"> Connexion </h1><br><br>

<form name="connexion" action="#" method="post">
    <label for="mail">Saisissez votre adresse mail </label>
    <input type="email" name="mail" required/><br>

    <label for="motdepasse">Saisissez votre mot de passe</label>
    <input type="password" name="motdepasse" id="motdepasse" required/><br><br>

    <input type="submit" id="Connexion" value="Valider"><br>

    <?php 
    if (isset($_POST['mail']) && isset($_POST['motdepasse'])) {
        include('connexion.php'); 
        
        $mail2 = $_POST['mail'];
        $mdp2 = $_POST['motdepasse'];

        $stmt = $cnn->prepare("SELECT * FROM membre WHERE IdMemb = :mail");
        $stmt->bindParam(':mail', $mail2);
        $stmt->execute();
        $ligne = $stmt->fetch();

        if ($ligne && password_verify($mdp2, $ligne['MdpMemb'])) {
            $_SESSION['Id'] = $ligne['IdMemb'];  
            $_SESSION['Type'] = $ligne['TypeMemb']; 
            $_SESSION['Nom'] = $ligne['NomMemb'];         
            header('Location: index.php');
            exit;
        } else {
            echo '<p style="color:red;">Adresse mail ou mot de passe incorrect.</p>';
        }
    }
    ?>      
</form>

<br>
</section><br><br><br>
<a href="index.php"><button type="button" class="retour">Retourner à l\'accueil</button></a> <br><br><br>
