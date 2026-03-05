<?php session_start(); ?>
<!DOCTYPE html>
<html id="Accueil">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<!--
Tinker CSS Template
https://templatemo.com/tm-506-tinker
-->
        <title>SIOConnect</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
        
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/fontAwesome.css">
        <link rel="stylesheet" href="css/hero-slider.css">
        <link rel="stylesheet" href="css/owl-carousel.css">
        <link rel="stylesheet" href="css/templatemo-style.css">
        <link rel="stylesheet" href="css/lightbox.css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>

<body id="accueil">
    <div class="header">
        <div class="container2">
            <nav class="navbar navbar-inverse" role="navigation">
                <div class="navbar-header">
                    <button type="button" id="nav-toggle" class="navbar-toggle" >
                        <span class="sr-only"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    
                    <img src="img/logoMathias2.png" alt="" id="Mathias">
                    <a href="index.php" class="MonLogo"><em>SIO</em>Connect</a>
                    
                </div>
                <!--/.navbar-header-->
                <div id="main-nav" class="collapse navbar-collapse">
                    <?php
                    if (isset($_SESSION['Nom'])) { 
                        if ($_SESSION['Type'] == 0) {
                            echo '<a href="admin.php"><button type="button" class="menu">Administration</button></a>';
                        } 
                        echo '<a href="deconnexionSite.php"><button type="button" class="menu">Déconnexion ('.$_SESSION['Nom'].')</button></a>';
                    } else {
                        echo ' <a href="inscription.php"><button type="button" class="menu">Inscription</button></a>';
                        echo ' <a href="connexionSite.php"><button type="button" class="menu">Connexion</button></a>';
                    }
                    ?>

                  
                   
                </div>
                <!--/.navbar-collapse-->
            </nav>
            <!--/.navbar-->
        </div>
        <!--/.container-->
    </div>
    <!--/.header-->

