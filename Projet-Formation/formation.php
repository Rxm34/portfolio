<!DOCTYPE html>

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">

    <title>EduTech</title>

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

  <body id="formation">

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
          <a class="navbar-brand" href="index.php"><h2>EduTech<em>.</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="index.php">Accueil
                  <span class="sr-only">(current)</span>
                </a>
              </li> 
              <li class="nav-item active">
                <a class="nav-link" href="formation.php">Formations</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.php">Nous contacter</a>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <!-- Page Content -->
    <!-- Banner Starts Here -->
    
<br>

    
    <!-- Banner Ends Here -->

    
    <section class="about-us multicolonnes">
  <?php 
  include('connexion.php');
  if (isset($_GET['id'])) {
    $resultat = $cnn->prepare("SELECT * FROM FORMATION WHERE IdTheme=:id");
    $resultat->bindParam(':id',$_GET['id'], PDO::PARAM_STR);
  } else {
    $resultat = $cnn->prepare("SELECT * FROM FORMATION");
  }

  $resultat->execute();
  // Affichage des lignes. Une ligne contient un enregistrement
  while($ligne = $resultat->fetch()) {
  ?>

    <div class="unecolonne">
        <img src="assets/images/<?php echo $ligne['LogoFormation']; ?>" alt="" >
        <?php 
        echo '<h6>' .$ligne['Niveau'].'</h6>';
        echo '<h5 class="h7">' .$ligne['Descriptif'].'</h5>'; 
        echo '<h4 class="titre">' .$ligne['NomFormation'].'</h4>';
        // Redirection vers la page contact avec l'id et le nom de la formation
        echo '<a href="contact.php?formation_id='.$ligne['IdFormation'].'&formation_nom='.$ligne['NomFormation'].'"><button id="choix" type="button" class="choisir-btn">Choisir</button></a>';
        if (!empty($ligne['Plaquette Formation'])) { ?>
          <a href="assets/pdf/<?php echo $ligne['Plaquette Formation']; ?>" class="btn btn-primary" download>Télécharger le PDF</a>
          <?php }?>
    </div>
  <?php
  }
  ?> 
</section>


    
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
          </div>
          <div class="col-lg-12">
            <div class="copyright-text">
              
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

  </body>
</html>