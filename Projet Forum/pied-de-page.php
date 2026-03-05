<footer>
<?php include('connexion.php');?>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="logo">
                       <fieldset class="statistique">
                        <legend>STATISTIQUES DES FORUMS</legend>

                            <?php
                            $resultat6 = $cnn->prepare("SELECT COUNT(IdArt) AS TotalArt FROM article");
                            $resultat6->execute();
                            $ligne6 = $resultat6->fetch();
                            $resultat7 = $cnn->prepare("SELECT COUNT(IdArt) AS TotArt FROM article");
                            $resultat7->execute();
                            $ligne7 = $resultat7->fetch();
                            $nbtot=$ligne7['TotArt'];
                            $resultat7 = $cnn->prepare("SELECT COUNT(IdRep) AS TotRep FROM article INNER JOIN reponse ON article.IdArt=reponse.IdArt");
                            $resultat7->execute();
                            $ligne7 = $resultat7->fetch();
                            $nbtot+=$ligne7['TotRep'];
                            echo '<p> <span id="nbarticle">' .$ligne6['TotalArt']. '</span><span id="nbtot">' .$nbtot. '</span><br><span id="totalarticle">Total des articles</span><span id="totalmessages">Total des messages </span></p>';
                            ?>
                       </fieldset>
                       <fieldset class="statistique">
                        <legend>STATISTIQUES DES MEMBRES</legend>
                            <?php
                            $resultat8 = $cnn->prepare("SELECT COUNT(IdMemb) AS totalMemb FROM membre");
                            $resultat8->execute();
                            $ligne8 = $resultat8->fetch();
                            $resultat9 = $cnn->prepare("SELECT * FROM membre ORDER BY DateIns DESC");
                            $resultat9->execute();
                            $ligne9 = $resultat9->fetch();
                            $date=date_create($ligne9['DateIns']);
                            $lettre=strtoupper(substr($ligne9['NomMemb'],0,1));
                            if($ligne9['TypeMemb']==2) $type="prenomUtilisateur";
                            else if($ligne9['TypeMemb']==1) $type="prenomModerateur";
                            else if($ligne9['TypeMemb']==0) $type="prenomAdministrateur";
                            echo '<p><span id="nbmembres">' .$ligne8['totalMemb'].'</span><span id="membrerécent"> Membre le plus récent</span><br><span id="totalmembre">Total des membres</span><span class="'.$type.'avatar2">'.$lettre.'</span><span id="'.$type.'">'.$ligne9['NomMemb'].'</span><br><span id="inscription">Inscription '.temps_ecoule($ligne9['DateIns']).'</span></p>';
                            ?>
                    </div>
                    <fieldset class="statistique">
                        <a href="charte.php"><button type="button" class="retourCharte">(Charte d'utilisation)</button></a>
                    </fieldset> 
                </div>
            </div>
        </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

    <script src="js/vendor/bootstrap.min.js"></script>

    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        // navigation click actions 
        $('.scroll-link').on('click', function(event){
            event.preventDefault();
            var sectionID = $(this).attr("data-id");
            scrollToID('#' + sectionID, 750);
        });
        // scroll to top action
        $('.scroll-top').on('click', function(event) {
            event.preventDefault();
            $('html, body').animate({scrollTop:0}, 'slow');         
        });
        // mobile nav toggle
        $('#nav-toggle').on('click', function (event) {
            event.preventDefault();
            $('#main-nav').toggleClass("open");
        });
    });
    // scroll function
    function scrollToID(id, speed){
        var offSet = 50;
        var targetOffset = $(id).offset().top - offSet;
        var mainNav = $('#main-nav');
        $('html,body').animate({scrollTop:targetOffset}, speed);
        if (mainNav.hasClass("open")) {
            mainNav.css("height", "1px").removeClass("in").addClass("collapse");
            mainNav.removeClass("open");
        }
    }
    if (typeof console === "undefined") {
        console = {
            log: function() { }
        };
    }
    </script>
</body>
</html>