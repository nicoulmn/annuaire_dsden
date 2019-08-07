  <?php 

  include("backoffice/includes/functions.php");
  include("backoffice/includes/constants.php");
  include("backoffice/includes/connexionDb.php"); 
  include("backoffice/includes/debutFront.php"); 

  ?>

 




    <body>
     <!-- Preloader -->
     <div id="tt-preloader">
      <div id="pre-status">
       <div class="preload-placeholder"></div>
     </div>
   </div>

   <!-- Home Section -->

   <?php

   $tabStaff = showStaff($conn);

   ?>


   <!-- Navigation -->
   <header class="header">
    <nav class="navbar navbar-custom" role="navigation">
     <div class="container">
      <div class="navbar-header">
       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#custom-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <div class="containAnim">
        <div class="animate two"> <!-- Titre Usertempo animé -->

          <a class="navbar-brand" href="index.php"><span id="user">DSDEN 33</span>&nbsp;<span>T</span><span>r</span><span>o</span><span>m</span><span>b</span><span id="last">i</span>   </a>

        </div>
      </div>

    </div>

    <div class="collapse navbar-collapse" id="custom-collapse">
     <ul class="nav navbar-nav navbar-right">
      <li><a href="#toppage"  data-toggle="tooltip"  title="Accueil" data-placement="bottom"><i class="fa fa-home"></i></a></li>
      <li><a target="_blank" href="https://intra.ac-bordeaux.fr/ia33/"  data-toggle="tooltip"  title="Intranet Gesdoc" data-placement="bottom"><i class="fa fa-folder-open"></i></a></li>
      <li><a target="_blank" href="http://www.ac-bordeaux.fr/dsden33/pid31822/accueil.html" data-toggle="tooltip" title="Internet Dsden 33" data-placement="bottom"><i class="fa fa-globe"></i></a></li>
      <li><a target="_blank" href="https://courrier.ac-bordeaux.fr"  data-placement="bottom" data-toggle="tooltip" title="Messagerie académique"><i class="fa fa-envelope-square"></i></a></li>
      <!--<li><a target="_blank" href="#contact" data-placement="bottom" data-toggle="tooltip" title="Contacts"><i class="fa fa-question-circle"></i></a></li>-->
      <li><a target="_blank" href="backoffice/trombiback.php"  data-toggle="tooltip" data-placement="bottom" title="Administration"><i class="fa fa-unlock-alt"></i></a></li>
    </ul>
  </div>
  </div><!-- .container -->
  </nav>
  </header><!-- End Navigation -->


  <section id="toppage"></section>

  <!-- Works Section -->
  <section id="works" class="works-section section-padding">
    <div class="container" style="min-height:8000px;">
      <div style="">
     
          <h2 class="section-title wow fadeInUp">Trombinoscope</h2>

          
      </div>
    
      <!-- Formulaire de recherche-->
      <form class="form-inline" id="formSearch" method="POST" action="resulstsearch.php">
        <input  class="form-control" type="text" name="searchString" placeholder="Nom, prénom, service.." required>  
        <button id="btnSearch" type="submit" name="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>

        

      </form>
      <h2 style="text-align: center;">
        <span id="helpbtn" data-toggle="modal" data-target="#helpModal" ><i class="fa fa-info-circle" aria-hidden="true"></i><span style="font-size: 10px;">&nbsp;Aide</span></span>
      </h2>
      <div class="row" style="text-align: center;">
        <div id="infosUser" class="col-md-12" >   
         
        </div>
      </div>

      <!-- Button trigger modal -->



  <!-- Modal -->
  <div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 style="text-align:center;margin:auto;" class="modal-title" id="exampleModalLabel">Aide</h5>
          <button  type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>
              Bienvenue sur le trombinoscope de la DSDEN 33. </p><br>
              
              <ul style="text-align: justify; list-style-type: circle;margin-left: 6px;">
                <li><p> Vous pouvez cliquer sur les noms de divisions pour filtrer le personnel par division.<br> 

                  Le bouton "Filtres <span style="font-size:1.2em;cursor: pointer; " class="show_hide"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>" vous permet d'afficher les différents services compris dans chaque division.</p></li>
                <li><p>             Vous pouvez aussi rechercher un agent via son nom / prénom / division ou service.           </p></li>
                <li><p>En cliquant sur l'icône  <span style="font-size:1.2em;cursor: pointer;" class="show_hide"><i class="fa fa-id-badge" aria-hidden="true"></i></span> qui apparait au survol d'une photo, vous pouvez afficher la fiche détaillée d'un utilisateur comprenant sa mission, ses moyens de contact, ou son numéro de Bureau. </p></li>
              </ul>

            
            
            <p>
              Merci de contacter <a href="mailto:Mandy.Gatouillat@ac-bordeaux.fr">Mandy.Gatouillat@ac-bordeaux.fr</a> ou <a href="mailto:nicolas.ulmann@ac-bordeaux.fr">nicolas.ulmann@ac-bordeaux.fr</a> pour tout problème rencontré ou demande de modification.
            </p>
        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>

      <div id="bordureTab">  
        <table class="table" id="filter" style="line-height: 20px;">
          <tr><td id="tdTous" colspan="10" style=""><p style="width: 10em;margin:auto;min-height: 2em;"><a class="active" data-group="all">Tous</a></p></td></tr>
          <tr>
            <?php

            $divMeres = showDivMeres($conn);
            $divFilles = showDivFilles($conn);


            foreach ($divMeres as $key2 ){
              ?>

              <td style=" padding-bottom: 10px;">
                <p style="min-height: 25px;max-width: 7em;margin:auto;">
                  <a style="font-size: 11px;" data-group="<?= $key2['id']?>"> <?= $key2['off_name'] ?></a> 
                </p>
              </td>

             
              
            <?php
            }



          
            ?>
          </tr>

          <tr style="padding-top: 80px;" id="sousFiltres">

            <?php
            foreach ($divMeres as $key2 ){

              $isMother = fillesParMere($conn, $key2['id']);


              ?> 
              <td >

                <?php
                if (!empty($isMother)) {
                  ?>                 



                  <div class="dropdown">
                    <button style="border-color: transparent;background-color:transparent;color: #68c3a3;font-weight:normal;font-size:1em;padding: 1px 6px 1px 6px;"  class="dropdown-toggle" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Filtres &nbsp;  <i class="fa fa-caret-down"></i>


                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <?php 
                      foreach ($divFilles as $key3) {

                        if ($key3['div_id'] == $key2['id']) {          
                        ?> 
                          <a style="margin: 1px 3px;" class="dropdown-item"  data-group="<?= $key3['id']?>"> <?= $key3['off_name'] ?> </a>
                        <?php
                        }
                      }
                      ?>

                    </div>
                  </div>

                  <?php
                 }
                
                ?>
             
              </td>
              <?php
            }
            ?>


          </tr>
        </table>
      </div>

      <div class="row">
        <div id="grid">
          <?php

          $defaultImg = "default.png";

          foreach ($tabStaff as $key ) {

            ?> 

            <div class="portfolio-item col-xs-4 col-sm-4 col-md-2" data-groups='["all", "<?= $key['serv_id'] ?>"<?=(!is_null($key['div_id']))? ', "'.$key['div_id'].'"':''; ?>]'>
              <div class="portfolio-bg">
                <div class="portfolio">
                  <div class="tt-overlay"></div>
                  <div class="links">
                    <a href="#"  data-toggle="modal" data-target="#exampleModal<?= $key['id'] ?>"><i class="fa fa-id-badge" aria-hidden="true"></i></a>
                  </div><!-- /.links -->
                  <img src="img/<?=( !empty($key['picture']))? $key['picture']:$defaultImg; ?>" alt="image"> 
                  <div class="portfolio-info">
                    <h3><?= $key['firstname']." ".$key['name'] ?></h3>
                  </div><!-- /.portfolio-info -->
                </div><!-- /.portfolio -->
              </div><!-- /.portfolio-bg -->
            </div><!-- /.portfolio-item -->

            <div style="padding: 15em;" class="modal fade" id="exampleModal<?= $key['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <div class="trucaflex">
                        <div class="logo2img">
                          
                          <img class="imgFiche" style="max-width:10em;" src="img/<?=( !empty($key['picture']))? $key['picture']:$defaultImg; ?>" alt="image">          
                          <img class="logoeduc" style="" src="assets/images/EducTrans2.png"> <div class="test-overlay"></div>
                        </div>
                        <h5 class="modal-title" id="exampleModalLabel"><?= $key['firstname']." ".$key['name'] ?></h5>
                      </div>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>

                    </div>
                    <div class="modal-body">
                      <div class="row" style="margin-left: 1em;margin-right: 1em;">
                        <ul>
                          <li style="text-align: center;font-size: 20px;margin-bottom: 10px;">
                            <?php 
                              //Ici on triche pour ne pas afficher service devant IENA SECRETAIRE ou DASEN - A améliorer.

                              $service = 'Service : ';

                              if ($key['off_name'] == 'IENA' || $key['off_name'] == 'DASEN' || $key['off_name'] == 'Secretaire General' || $key['off_name'] == 'Secrétaire Général') {
                                 $service = '';
                              }
                            ?>  

                            <?= $service ?>                           
                            <span style="font-weight: bold;">
                             <?= $key['off_name']?>
                           </span>
                           <?=( !empty($key['descr']))? ' ('.$key['descr'].')':'' ?>
                          </li>
                        </ul>
                        <div class="row" style="margin-top: 2em;">
                          <div class="col-md-4" > 
                            <span style="font-weight: bold;">Mission : </span><br>
                          </div>    

                          <div class="col-md-8">
                            <p><?= $key['job']?></p>
                          </div>
                        </div> <hr> 
                        <div class="row">      
                          <div class="col-md-4"> 
                            <span style="font-weight: bold;">Téléphone interne : </span><br>
                          </div>                            
                          <div class="col-md-8">
                            <p><?= $key['tel_int']?></p>
                          </div>
                        </div> <hr>
                        <div class="row">
                          <div class="col-md-4"> 
                            <span style="font-weight: bold;">Téléphone externe : </span><br>
                          </div>                            
                          <div class="col-md-8">                        
                            <p><?= $key['tel_ext']?></p>
                          </div>
                        </div> <hr>
                        <div class="row">
                          <div class="col-md-4"> 
                            <span style="font-weight: bold;">Email : </span><br>
                          </div>                            
                          <div class="col-md-8">
                            <p><?= $key['email']?></p>
                          </div>
                        </div> <hr>
                        <div class="row">
                          <div class="col-md-4"> 
                            <span style="font-weight: bold;">Bureau n° : </span><br>
                          </div>                            
                          <div class="col-md-8">
                            <p><?= $key['off_nbr']?></p>
                          </div>
                        </div> 
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button style="background-color: #68C3A3;" type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    </div>
                  </div>
                </div>
              </div> <!-- Fin modal-->
          <?php
          }// Fin foreach
          ?>
        </div><!-- /#grid -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </section><!-- End Works Section -->

<!--


  <section id="contact" class="contact-section section-padding">
    <div class="container">
      <h2 class="section-title wow fadeInUp">Contact</h2>

      <div class="row">
        <div class="col-md-6">
          <div class="contact-form">
            <strong>Une remarque, un problème ? Contactez l'administrateur du site</strong>
            <form name="contact-form" id="contactForm" action="sendemail.php" method="POST">

              <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" name="name" class="form-control" id="name" required="">
              </div>

              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="email" required="">
              </div>

              <div class="form-group">
                <label for="subject">Sujet</label>
                <input type="text" name="subject" class="form-control" id="subject">
              </div>

              <div class="form-group">
                <label for="message">Message</label>
                <textarea name="message" class="form-control" id="message" rows="5" required=""></textarea>
              </div>

              <button type="submit" name="submit" class="btn btn-primary">Envoyer</button>
            </form>
          </div>
        </div>


      </div>
    </div><
  </section>
-->

  <!-- Footer Section -->
  <footer style="margin-bottom:0px;" class="footer-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="copyright text-center">

          </div>
        </div>
      </div>
    </div>
  </footer><!-- End Footer Section -->


  <!-- Scroll-up -->
  <div class="scroll-up">
    <a href="#toppage"><i class="fa fa-angle-up"></i></a>
  </div>

  <!-- Javascript files -->
  <script src="assets/js/jquery.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/jquery.stellar.min.js"></script>
  <script src="assets/js/jquery.sticky.js"></script>
  <script src="assets/js/smoothscroll.js"></script>
  <script src="assets/js/wow.min.js"></script>
  <script src="assets/js/jquery.countTo.js"></script>
  <script src="assets/js/jquery.inview.min.js"></script> 
  <script src="assets/js/jquery.easypiechart.js"></script>
  <script src="assets/js/jquery.shuffle.min.js"></script>
  <script src="assets/js/jquery.magnific-popup.min.js"></script>
  <script src="assets/js/froogaloop2.min.js"></script>
  <script src="assets/js/showHide.js"></script>
  <script src="assets/js/jquery.fitvids.js"></script>
  <script src="assets/js/scripts.js"></script>

  </body>
  </html>