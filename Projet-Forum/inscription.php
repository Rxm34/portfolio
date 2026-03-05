<?php include('en-tête.php');?>
            <section class="inscription"><br>
            <h1 id="inscription"> Inscription </h1><br><br>
            <form name="inscription" action="#" method="post">
            <label for="nom">Saisissez votre adresse mail </label>
                <input type="email" name="mail"  required/><br>
                <label for="nom">Saisissez votre nom </label>
                <input type="text" name="nom" id="votre nom" required/><br>
                <label for="prenom">Saisissez votre prénom</label>
                <input type="text" name="prenom" id="prenom" required/><br>
                <label for="motdepasse">Saisissez un mot de passe</label>
                <input type="password" name="motdepasse" id="motdepasse" required/><br><br>
               
                <input type="submit" id="Inscription" value="Valider"><br>
                <br><a href="charte.php"><button type="button" class="retourCharte">(Charte d'utilisation)</button></a>
                <?php 
                    session_start(); 
                        if (isset($_POST['nom'])) {
                         
                       
                            include('connexion.php');
                            $mail = $_POST['mail'];
                            $nom = $_POST['nom'];
                            $prenom = $_POST['prenom'];
                            $mdp = $_POST['motdepasse'];

                            $hash = password_hash($mdp, PASSWORD_DEFAULT);
                           
                            $stmt = $cnn->prepare("INSERT INTO membre (IdMemb,NomMemb, PrenomMemb, MdpMemb)
                                                    VALUES (:mail, :nom, :prenom, :mdp)");
                             $stmt->bindParam(':mail', $mail);
                            $stmt->bindParam(':nom', $nom);
                            $stmt->bindParam(':prenom', $prenom);
                            $stmt->bindParam(':mdp', $hash);
                            $stmt->execute();
 
                            $_SESSION['Mail'] = $mail;
                            $_SESSION['Nom'] = $nom;
                            $_SESSION['Prenom'] = $prenom;
                            $_SESSION['Type'] = 2;
                        }
        
                    ?>
                    
            </form>
            <br>
            </section><br><br><br>
            <a href="index.php"><button type="button" class="retour">Retourner à l'accueil</button></a> <br><br><br>

