<!DOCTYPE html>
<html>

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
  
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

  <body id="accueil">

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
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Accueil
                  <span class="sr-only">(current)</span>
                </a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" href="formation.php">Formations</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.php">Nous contacter</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <!-- Page Content -->
    <!-- Banner Starts Here -->

    <section class="blog-posts">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="all-blog-posts">
              <div class="row">
                <div class="col-lg-12">
                  <div class="blog-post">
                    <div class="blog-thumb">
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php 
      include('connexion.php');
      $resultat = $cnn->prepare("SELECT * FROM THEME");
      $resultat->execute();
      // Affichage des lignes. Une ligne contient un enregistrement
      while($ligne = $resultat->fetch()) {
    ?>           

    <section class="blog-posts">
    <h2>Bienvenue chez EduTech</h2><br><br>
    <?php echo '<p>EduTech est une entreprise spécialisée dans les formations informatiques.</p>';
          echo '<p>Que vous soyez débutant ou professionnel, nos parcours sont conçus pour </p>';
          echo '<p>tous les niveaux.</p><br><br>';
          echo '<h3> Veuillez choisir le thème de votre prochaine formation.</h3>'?>
    <div class="main-banner header-text">
      <div class="container-fluid">
        <div class="owl-banner owl-carousel">
        
          
 <?php 
      include('connexion.php');
      $resultat = $cnn->prepare("SELECT * FROM THEME");
      $resultat->execute();
      // Affichage des lignes. Une ligne contient un enregistrement
      while($ligne = $resultat->fetch()) {
    ?>           
        <a href="formation.php?id=<?php echo $ligne['IdTheme']; ?>"><div class="item">
            <img src="assets/images/<?php echo $ligne['logotheme']; ?>" alt="" >
            <div class="item-content">
              <div class="main-content">
                <div class="meta-category">
                    <?php echo '<span>'.$ligne['NomTheme'].'</span>'; ?> 
                </div>
              </div>
            </div>
          </div>
        </a>
       

  <?php
      }
     ?>
     <?php
      }
     ?>
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