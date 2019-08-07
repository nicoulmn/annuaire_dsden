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

 $taberror = array();

 if (isset($_POST['searchString']) && empty($_POST['searchString'])) {
  $taberror[] = "Le champ recherche est vide";
}

elseif (isset($_POST['searchString']) && !empty($_POST['searchString'])) {


  $search = $_POST['searchString'];
    //searchUser($conn, $search);

  $mots = explode(" ", $search); // On sépare les mots

  for ($i=0; $i <count($mots) ; $i++) {  // pour chaque mot, on lance la recherche

    $reponse = $conn->prepare('

      SELECT staff.id, staff.name, staff.firstname, staff.job, staff.email, staff.tel_ext, staff.tel_int, staff.serv_id, staff.off_nbr, service.off_name, service.descr, pictures.picture 
      FROM staff 
      INNER JOIN service ON staff.serv_id = service.id 
      LEFT JOIN pictures ON staff.id = pictures.staff_id 
      WHERE serv_id IS NOT NULL 
      AND 
      staff.name LIKE "%":search"%" 
      OR
      staff.firstname LIKE "%":search"%"
      OR
      service.off_name LIKE "%":search"%" 
      OR
      service.descr LIKE "%":search"%" 
      OR
      service.nom_mere LIKE "%":search"%" 
      ORDER BY staff.name ASC'); 

    $reponse->bindValue(':search', $mots[$i], PDO::PARAM_STR);  
    $reponse->execute();
    $userInfos[] = $reponse->fetchall();    // pour chaque mot on ajoute les résultats au tableau de resultats   
  }
}


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
      <li><a href="index.php"  data-toggle="tooltip"  title="Accueil" data-placement="bottom"><i class="fa fa-home"></i></a></li>
      <li><a target="_blank" href="https://intra.ac-bordeaux.fr/ia33/"  data-toggle="tooltip"  title="Intranet Gesdoc" data-placement="bottom"><i class="fa fa-folder-open"></i></a></li>
      <li><a target="_blank" href="http://www.ac-bordeaux.fr/dsden33/pid31822/accueil.html" data-toggle="tooltip" title="Internet Dsden 33" data-placement="bottom"><i class="fa fa-globe"></i></a></li>
      <li><a target="_blank" href="https://courrier.ac-bordeaux.fr"  data-placement="bottom" data-toggle="tooltip" title="Messagerie académique"><i class="fa fa-envelope-square"></i></a></li>
      <li><a target="_blank" href="backoffice/trombiback.php"  data-toggle="tooltip" data-placement="bottom" title="Administration"><i class="fa fa-unlock-alt"></i></a></li>
    </ul>
  </div>
  </div><!-- .container -->
  </nav>
  </header><!-- End Navigation -->

<div style="text-align:center; margin-top:5em;">

  <?php 

  if (!empty($taberror)){
    for ($i=0; $i < count($taberror[$i]) ; $i++) { 
      echo $taberror[$i];
    }
  }

 ?>
</div>



<form class="form-inline" id="formSearch" method="POST" action="resulstsearch.php">

  <input  class="form-control" type="text" name="searchString" placeholder="Nom, prénom, service.." required>  
  <button id="btnSearch" type="submit" name="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i></button>

</form>




<?php
if (!empty($userInfos) ) {

  ?>

  <section id="resultSearchSection" class="works-section section-padding" >


    <div class="container">
      <div>
        <h3 style="margin-bottom: 5em;">Résultats de votre recherche : "<?= $search ?>"</h3>
        <?php 
        $defaultImg = "default.png";

        for ($i=0; $i < count($userInfos) ; $i++) { 
          foreach ($userInfos[$i] as $key) {
            ?>

            <div class="portfolio-item col-xs-4 col-sm-4 col-md-2" data-groups='["all", "<?= $key['serv_id'] ?>"<?=(!is_null($key['div_id']))? ', "'.$key['div_id'].'"':''; ?>]'>
              <div class="portfolio-bg">
                <div class="portfolio">
                  <?php
                        /*
                        //print_r($mere);
                        echo "Mere : ".$key['div_id'];
                        print_r($mere);
                        */
                        ?>

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
                          <div class="col-md-4"> 
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
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    </div>
                  </div>
                </div>
              </div> <!-- Fin modal-->


                <?php 
              }
            }

            ?>

          </div>
        </div>
      </section>

      <?php
    }
    ?>




    <!-- Scroll-up -->
    <div class="scroll-up">
      <a href="#home"><i class="fa fa-angle-up"></i></a>
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