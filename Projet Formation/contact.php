
<!DOCTYPE html>
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">

    <title>Edutech</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-stand-blog.css">
    <link rel="stylesheet" href="assets/css/owl.css">
<!--

TemplateMo 551 Stand Blog

https://templatemo.com/tm-551-stand-blog

-->
  </head>

  <body id="contact">

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="index.php"><h2>Edutech<em>.</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="index.php">Accueil
                  <span class="sr-only"></span>
                </a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" href="formation.php">Formations</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.php">Nous Contacter</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="heading-page header-text">
      <section class="page-heading">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="text-content">
                <h4></h4>
                <h2></h2>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    
    <!-- Banner Ends Here -->
  

    <section class="contact-us">
      <div class="container">
        <div class="row">
        
          <div class="col-lg-12">
            <div class="down-contact">
              <div class="row">
                <div class="col-lg-8">
                  <div class="sidebar-item contact-form">
                    <div class="sidebar-heading">
                      <h2 id="message">Contacter Nous</h2>
                    </div>
                    <div class="content">
                      <form id="contact" action="" method="post">
                        <div class="row">
                          <div class="col-md-6 col-sm-12">
                            <fieldset>
                              <input name="nom" type="text" id="nom" placeholder="Votre Nom" required="">
                            </fieldset>
                          </div><br>
                          <div class="col-md-6 col-sm-12">
                          <fieldset>
                              <input name="prenom" type="text" id="prenom" placeholder="Votre Prénom" required="">
                            </fieldset><br>
                            </div><br>
                          <div class="col-md-6 col-sm-12">
                            <fieldset>
                              <input name="email" type="text" id="email" placeholder="Votre Adresse Mail" required="">
                            </fieldset><br>
                          </div>
                          <div class="col-md-6 col-sm-12">
                            <fieldset>
                              <input name="tel" rows="6" id="tel" placeholder="Votre Numéro de Téléphone" required="">
                            </fieldset><br>
                          </div><br><br>
                          <div class="col-md-6 col-sm-12">
                          <select name='formation'>
                          <?php 
                            session_start(); 
                            if (isset($_GET['formation_id']) && isset($_GET['formation_nom'])) {
                            $_SESSION['formation_id'] = $_GET['formation_id'];
                            $_SESSION['formation_nom'] = $_GET['formation_nom'];
                            }
                          ?>
                          <?php
                            if (isset($_SESSION['formation_id']) && isset($_SESSION['formation_nom'])) {
                               echo '<option value="' . $_SESSION['formation_id'] . '" selected>' . $_SESSION['formation_nom'] . '</option>';
                          } else {
                            include('connexion.php');
                            $resultat = $cnn->prepare("SELECT * FROM FORMATION");
                            $resultat->execute();

                            while ($ligne = $resultat->fetch()) {
                           echo '<option value="' . $ligne['IdFormation'] . '">' . $ligne['NomFormation'] . '</option>';
                          }
                           }
                            ?>
                          <div class="col-md-6 col-sm-12">
                          <input type="checkbox" name="consentement" id="consentement" />
                          <label id="consentement" for="consentement">J'accepte d'envoyer mes données</label>
                          </div>
                          <div class="col-lg-12">
                          </select><br><br><br>
                            <fieldset>
                              <button type="submit" id="form-submit" class="main-button">Envoyer</button>
                            </fieldset>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <?php

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Connexion à la base de données
                    include('connexion.php');
                
                    // Récupérer les données du formulaire
                    $nom = $_POST['nom'] ?? '';
                    $prenom = $_POST['prenom'] ?? '';
                    $email = $_POST['email'] ?? '';
                    $tel = $_POST['tel'] ?? '';
                    $formation = $_POST['formation'] ?? '';
                
                    // Vérification des champs obligatoires
                    if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($tel) && !empty($formation)) {
                        try {
                            // Préparation de la requête SQL
                            $stmt = $cnn->prepare("
                                INSERT INTO Client (Nom, Prénom, Téléphone, `Adresse Mail`, Formation)
                                VALUES (:nom, :prenom, :tel, :email, :formation)
                            ");
                
                            // Liaison des paramètres
                            $stmt->bindParam(':nom', $nom);
                            $stmt->bindParam(':prenom', $prenom);
                            $stmt->bindParam(':tel', $tel);
                            $stmt->bindParam(':email', $email);
                            $stmt->bindParam(':formation', $formation);
                
                            // Exécution de la requête
                            if ($stmt->execute()) {
                                //echo "Vos informations ont été enregistrées avec succès.";
                            } else {
                                //echo "Une erreur s'est produite lors de l'enregistrement. Veuillez réessayer.";
                            }
                        } catch (PDOException $e) {
                            //echo "Erreur : " . $e->getMessage();
                        }
                    } else {
                        //echo "Tous les champs obligatoires doivent être remplis.";
                    }
                }
                ?>
                

                <div class="col-lg-4">
                  <div class="sidebar-item contact-information">
                    <div class="sidebar-heading">
                      <h2 id="contact">Contact</h2>
                    </div>
                    <div class="content">
                      <ul>
                        <li>                          
                          <h5>Numéro de téléphone</h5>
                          <span> 06 30 14 43 51</span>
                        </li>
                        <li>
                         <h5>Adresse Mail</h5> 
                         <span>edutech@gmail.com</span>
                        </li>
                        <li>
                          <h5>Adresse</h5>
                          <span>3 Place Mathias, 
                          	<br>71100 Chalon-sur-Saône</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-lg-12">
            <div id="map">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2731.866428433335!2d4.861208099999999!3d46.787236299999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f31b6426616967%3A0x9e9f0dca7bb86c53!2sLyc%C3%A9e%20Mathias!5e0!3m2!1sfr!2sfr!4v1734688255036!5m2!1sfr!2sfr" width="1000" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>" width="100%" height="450px" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
          </div>
          
        </div>
      </div>
    </section>

    
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
          </div>
          <div class="col-lg-12">
            <div class="copyright-text">
              <p><a rel="nofollow" href="https://templatemo.com" target="_parent"></a></p>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/accordions.js"></script>

    <script language = "text/Javascript"> 
      cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
      function clearField(t){                   //declaring the array outside of the
      if(! cleared[t.id]){                      // function makes it static and global
          cleared[t.id] = 1;  // you could use true and false, but that's more typing
          t.value='';         // with more chance of typos
          t.style.color='#fff';
          }
      }
    </script>
123
  </body>
</html>