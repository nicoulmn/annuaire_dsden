<?php
session_start();

if(!isset($_SESSION['id'])) //Si pas d'utilisateur connecté on renvoie vers la connexion
{
	header('Location: connexion.php');
	exit();
}
$titre="Trombinoscope - Administration"; //titre de la page (utilisé dans debut.php)
include("includes/debut.php"); // Inclusion du debut de page commun a toutes les pages
include("includes/connexionDb.php"); //Connexion BDD


?>

 <script> // Jquery pour classer les tableaux
 $(document).ready(function() 
 { 
 	$("#tableListStaff").tablesorter({
 		dateFormat : "ddmmyyyy"
 	});

 } 
 );
</script>



<?php
if ($id!=0){  //Si une session est ouverte

/////////////////////
/////TRAITEMENTS/////
/////////////////////

	if (isset($_GET['nav']) && $_GET['nav'] == "newAddStaff") {
		?>

		<script>

			$(function () {
			$('#addStaff-tab').tab('show') // On redirige vers l'onglet d'ajout de personnel
		})

	</script>
	<?php
	}



	if (isset($_GET['nav']) && $_GET['nav'] == "addStaff") { // si on a validé le formulaire d'ajout de personnel
	?>
		<script>

			$(function () {
				$('#addStaff-tab').tab('show') // On redirige vers l'onglet d'ajout de personnel
			})

		</script>

		<?php
	}




	if (isset($_GET['listStaff']) && !empty($_GET['listStaff'])) { // useless ?

		?>

		<script>

			$(function () {
				$('#listStaff-tab').tab('show') // On redirige vers la liste des user
			})

		</script>

		<?php
	}

	if (isset($_GET['nav']) && $_GET['nav'] == "update") { // useless ?

		?>
		<script>

			$(function () {
			$('#profile-tab').tab('show') // On redirige vers l'onglet de mise a jours de la table
		})

	</script>

	<?php
	}


}
?>








<body>

	<div class="container">
		<div class="animate two"> <!-- Titre Usertempo animé -->

			<h1><span id="user">DSDEN 33</span>&nbsp;<span>T</span><span>r</span><span>o</span><span>m</span><span>b</span><span id="last">i</span></h1>

		</div>
	</div>

	<span id="conn"><?= $msgConn; ?></span> <!-- Msg de confirmation si connexion ok ou non-->
	<br>Afficher l'accueil du site : <a class="btnImport" style="font-size:28px;padding:2px 10px;margin-top: 1em;"  target="_blank" href="../index.php"><i class="fa fa-home"></i></a>
	<div style="margin-top: 5em;"></div>


	<!-- NAVIGATION -->

	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Accueil</a>
		</li>
		<li class="nav-item">
			<a class="nav-link " id="addStaff-tab" data-toggle="tab" href="#addStaff" role="tab" aria-controls="addStaff" aria-selected="false">Ajouter un Personnel </a>
		</li>
		<li class="nav-item">
			<a class="nav-link " id="listStaff-tab" data-toggle="tab" href="#listStaff" role="tab" aria-controls="listStaff" aria-selected="false">Liste du personnel</a>
		</li>
		<!--
		<li class="nav-item">
			<a class="nav-link " id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Mise à jour </a>
		</li>
		-->
		<li class="nav-item">
			<a class="nav-link " id="services-tab" data-toggle="tab" href="#services" role="tab" aria-controls="services" aria-selected="false">Services</a>
		</li>

		<li class="nav-item">
			<a class="nav-link " id="config-tab" data-toggle="tab" href="#config" role="tab" aria-controls="config" aria-selected="false">Configuration</a>
		</li>
	</ul>

	<!-- div tabcontent contient les 3 tab -->
	<div class="tab-content" id="myTabContent"> 


		<!-- *** Accueil Tab *** -->
		<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"> 
			
			Administration du trombinoscope interne de la DSDEN 33

		</div>

		<!-- *** Tab Ajout de personnel *** -->
		<div class="tab-pane fade" id="addStaff" role="tabpanel" aria-labelledby="addStaff-tab"> 
			
			<?php 



			if (!isset($_GET['nav']) || $_GET['nav']!="addStaff" || !empty($InsertStaffError)){		


				if (isset($InsertStaffError) && count($InsertStaffError)>0) {
					
					?>
					<div id="erreurStaffInsert">
						<h3>Erreurs : </h3>
						<?php
						for ($i=0; $i < count($InsertStaffError) ; $i++) { 

							echo "<p>". $InsertStaffError[$i] ."</p>";

						}	
						?>
					</div>
					<?php	

				}

				?>






				<form style="max-width: 70%;" id="addStaffForm" enctype="multipart/form-data" method="post" action="ajouter.php">

					<h4 style="margin-bottom: 2em;">Ajouter un personnel de la DSDEN 33</h4>


					<div class="form-group row">						
						<label class="col-2 col-form-label" for="firstname">Prénom</label>
						<div class="col-10">
							<input <?=(!empty($_POST['firstname']))?'value="'.$_POST['firstname'].'"':' '; ?> class="form-control" name="firstname" type="text" id="firstname" placeholder="Prénom.." required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-2 col-form-label" for="name">Nom</label>
						<div class="col-10">
							<input <?=(!empty($_POST['name']))?'value="'.$_POST['name'].'"':' '; ?> class="form-control" name="name" type="text" id="name" placeholder="Nom.." required>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-2 col-form-label" for="job">Fonction</label>
						<div class="col-10">    
							<textarea class="form-control" name="job" id="job" placeholder="Fonction.." ><?=(!empty($_POST['job']))? $_POST['job']:' '; ?> </textarea>						
						</div>
					</div>
					<div class="form-group row">
						<label class="col-2 col-form-label" for="email">Email</label>
						<div class="col-10">
							<input  <?=(!empty($_POST['email']))?'value="'.$_POST['email'].'"':' '; ?> class="form-control" name="email" type="text" id="email" placeholder="adresse@ac-bordeaux.fr.." required>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-2 col-form-label" for="telint">Téléphone Interne</label>
						<div class="col-10">
							<input  <?=(!empty($_POST['telint']))?'value="'.$_POST['telint'].'"':' '; ?> class="form-control" name="telint" type="text" id="telint" placeholder="" >
						</div>
					</div>
					<div class="form-group row">
						<label class="col-2 col-form-label" for="telext">Téléphone Externe</label>
						<div class="col-10">
							<input <?=(!empty($_POST['telext']))?'value="'.$_POST['telext'].'"':' '; ?> class="form-control" name="telext" type="text" id="telext" placeholder="" >
						</div>
					</div>					
					<div class="form-group row">
						<label class="col-2 col-form-label" for="offnbr">Numéro de Bureau</label>
						<div class="col-10">
							<input  <?=(!empty($_POST['offnbr']))?'value="'.$_POST['offnbr'].'"':' '; ?> class="form-control" name="offnbr" type="text" id="offnbr" placeholder="" >
						</div>
					</div>			

					<div class="form-group row">
						<label class="col-2 col-form-label" for="serv_id">Service</label>
						<div class="col-10">
							<select class="form-control" id="serv_id" name="serv_id" required>
								<option disabled selected value> -- selectionnez un service -- </option>
								<?php 

								$divMeres = showDivMeres($conn);
								$divFilles = showDivFilles($conn);



								foreach ($divMeres as $key2 ) {

									echo "<option value='".$key2['id']."''>".$key2['off_name']."</option>";

									foreach ($divFilles as $key3) {

										if ($key3['div_id']== $key2['id']) {

											echo "<option value='".$key3['id']."''>&nbsp - &nbsp;".$key3['off_name']."</option>";

										}
									}
								}
								?>

							</select>
						</div>
					</div>

					<div class="panel panel-default">

						<div style="margin: 2em 0em;" class="panel-heading">Pour ajouter une photo, choisissez une photo puis validez le recadrage, le résultat s'affiche à droite : </div>
					 	
					 	<div style="text-align:center;margin-bottom: 1em;">
							<strong>Selectionnez une image :</strong>			
							<input name="imgSrc" type="file" class="upload" idbtn="newStaff">
					 	</div>

						<div class="panel-body">
							<div class="row">
								<div class="col-md-5 text-center">
									<div id="upload-demo_newStaff" style="width:400px;height:400px; border:1px dotted #CCCCCC;"></div>	  	
								</div>

								<div class="col-md-2" style="min-width:10em;text-align: center;margin-top: 5em;">
									<strong>Valider le cadrage : </strong><br><br>
									<a class="btnImport upload-result" idbtn="newStaff">Ok <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
								</div>

								<div class="col-md-5" style="">
									<div id="upload-demo-i_newStaff" style="padding: 20px 0px 0px 40px; background:#e1e1e1;width:350px;height:350px;"></div>
								</div>
								<div>
									<input id="cropped_newStaff" name="croppedPicture" type="hidden">
								</div>
							</div>
						</div>
					</div>

					
					<div style="text-align:center; margin-top: 2em;">
						<input class="btnImport" type="submit" value="Ajouter au trombinoscope !" >
					</div>			


				</form>

			<?php

			
		}

		else{

			$resultNewPic = '';

			if (isset($_POST['croppedPicture'])) {
				$resultnewPic = $_POST['croppedPicture'];
			}


			echo "<p style=\"font-weight:bold; font-size :2em\">Inscription effectuée : </p>
			<p style=\"font-weight:bold;\">" . ucfirst($_POST['firstname']) ." ". ucfirst($_POST['name']) ."</p>

			<table id=\"resume\">

				<tr style=\"border-bottom:1px solid #999999;padding:5px;\">
					<td>Fonction : </td><td>".$_POST['job']."</td>
				</tr>
				<tr style=\"border-bottom:1px solid #999999;padding:5px;\">
					<td>Mail : </td><td>".$_POST['email']."</td>
				</tr>
				<tr style=\"border-bottom:1px solid #999999;padding:5px;\">
					<td>Téléphone : </td><td>".$_POST['telext']."</td>
				</tr>
				<tr style=\"border-bottom:1px solid #999999;padding:5px;\">
					<td>Bureau : </td><td>".$_POST['offnbr']."</td>
				</tr>
				<tr style=\"border-bottom:1px solid #999999;padding:5px;\">
					<td>Photo : </td><td><img style=\"max-width:150px;\" src=".$_POST['croppedPicture']."></td>
				</tr>

			</table>


			<br><a class=\"btnImport\" href=\"trombiback.php?nav=newAddStaff\">Nouvelle inscription <i class=\"fa fa-redo\"></i></a>
	
			";
		}
		



		?>

	</div>

	<!-- 
	///////////////////////////////////////////////////////////////////////////
	////////////////////////////ONGLET LISTE PERSONNEL ///////////////////////////////
	///////////////////////////////////////////////////////////////////////////
	-->
	

	<div class="tab-pane fade" id="listStaff" role="tabpanel" aria-labelledby="listStaff-tab"> 


		<?php 

		$listStaff = showStaff($conn);
$a = 20%3;
echo $a;
		?>



		<table id="tableListStaff"  class="table table-striped" style="margin: auto;">
			<thead>

				<tr>
					<th scope="col">Nom&nbsp;<i class="fa fa-sort" aria-hidden="true"></i></th>
					<th scope="col">Prénom&nbsp;<i class="fa fa-sort" aria-hidden="true"></i></th>
					<th scope="col">Email&nbsp;<i class="fa fa-sort" aria-hidden="true"></i></th>
					<th scope="col">Mission(s)</th>
					<th scope="col">Télephone Externe&nbsp;<i class="fa fa-sort" aria-hidden="true"></i></th>
					<th scope="col">Télephone Interne&nbsp;<i class="fa fa-sort" aria-hidden="true"></i></th>
					<th scope="col">Service&nbsp;<i class="fa fa-sort" aria-hidden="true"></i></th>
					<th scope="col">N° Bureau&nbsp;<i class="fa fa-sort" aria-hidden="true"></i></th>
					<th scope="col">Date d'ajout&nbsp;<i class="fa fa-sort" aria-hidden="true"></i></th>
					<th scope="col">Modifier</th>
					<th scope="col">Photo</th>		
					<th scope="col">Supprimer</th>					
				</tr>
			</thead>
			<tbody>
				<?php 
				$defaultImg = "default.png";
				foreach ($listStaff as $key) {

					?>

					<tr id="rowStaff_<?= $key['id']?>" style="max-height: 20px !important;">
						

							<td style="">
								<div class="divStaff_<?= $key['id']?>">							
									<div class="staffInfos_<?= $key['id'] ?>">
										<div id="staffName_<?= $key['id'] ?>">
											<?= $key['name'] ?>									
										</div>
									</div>
									<div class="updateStaffForm_<?= $key['id']?>" style="display:none;">								
											<input  class="form-control" type="text" style=" max-width: 100px; font-size: 11px;" id="name_<?= $key['id']?>"  name="name<?= $key['id']?>" value="<?= $key['name'] ?>">	
										
									</div>
								</div>
																						
							</td>

							<td style="">
								<div class="divStaff_<?= $key['id']?>">	
									<div style="width:100px;" class="staffInfos_<?= $key['id'] ?>">
										<div id="staffFirstName_<?= $key['id'] ?>">
											<?= $key['firstname'] ?>								
										</div>
									</div>
									<div class="updateStaffForm_<?= $key['id']?>" style="display:none;width:100px;">
									
											<input  class="form-control" type="text" style=" max-width: 100px; font-size: 11px;" id="firstname_<?= $key['id']?>"  name="firstname<?= $key['id']?>" value="<?= $key['firstname'] ?>">									
															
									</div>
								</div>						
							</td>

							<td   style="max-width: 200px !important;">
								<div class="divStaff_<?= $key['id']?>">	
									<div class="staffInfos_<?= $key['id'] ?>">
										<div id="staffEmail_<?= $key['id'] ?>">
											<?= $key['email'] ?>							
										</div>
									</div>
									<div class="updateStaffForm_<?= $key['id']?>" style="display:none; min-width: 120px !important;">
										
											<input  class="form-control" type="text" style="font-size: 11px;" id="mail_<?= $key['id']?>"  name="mail<?= $key['id']?>" value="<?= $key['email'] ?>">	
															
									</div>
								</div>														
							</td>

							<td style="max-width: 200px !important;">
								<div class="divStaff_<?= $key['id']?>">							
									<div class="staffInfos_<?= $key['id'] ?>">
										<div style="height: 100px !important;overflow:auto;" id="staffJob_<?= $key['id'] ?>">
											<?= $key['job']; ?>					
										</div>
									</div>
									<div class="updateStaffForm_<?= $key['id']?>" style="display:none; ">								
										<textarea rows="7" class="form-control" style=" max-width: 200px; font-size: 11px;" id="job_<?= $key['id']?>"  name="job<?= $key['id']?>" value="<?= $key['job'] ?>"><?= $key['job'] ?>										
										</textarea>															
									</div>
								</div>
							</td>

							<td>
								<div class="divStaff_<?= $key['id']?>">							
									<div style="min-width: 130px;" class="staffInfos_<?= $key['id'] ?>">
										<div id="staffTelext_<?= $key['id'] ?>">	
											<?= $key['tel_ext'] ?>							
										</div>
									</div>
									<div class="updateStaffForm_<?= $key['id']?>" style="display:none;">
									
											<input  class="form-control" type="text" style=" max-width: 100px; font-size: 11px;" id="telext_<?= $key['id']?>"  name="telext<?= $key['id']?>" value="<?= $key['tel_ext'] ?>">	
															
									</div>
								</div>
							</td>

							<td>
								<div class="divStaff_<?= $key['id']?>">							
									<div class="staffInfos_<?= $key['id'] ?>">
										<div id="staffTelint_<?= $key['id'] ?>">	
											<?= $key['tel_int'] ?>						
										</div>
									</div>
									<div class="updateStaffForm_<?= $key['id']?>" style="display:none;">
									
										<input  class="form-control" type="text" style=" max-width: 100px; font-size: 11px;" id="telint_<?= $key['id']?>"  name="telint<?= $key['id']?>" value="<?= $key['tel_int'] ?>">												
									</div>
								</div>								
							</td>

							<td >
								<div class="divStaff_<?= $key['id']?>">							
									<div class="staffInfos_<?= $key['id'] ?>">
										<div id="staffOffname_<?= $key['id'] ?>">	
											<?= $key['off_name'] ?>						
										</div>
										<div id="staffOffdescr_<?= $key['id'] ?>" style="font-style:italic;width: 250px;height: 10em;overflow:auto;">
											<?= $key['descr'];	?>
										</div>
									</div>
									<div class="updateStaffForm_<?= $key['id']?>" style="display:none; min-width:180px;max-width: 250px !important;">
									
										<select style="font-size: 11px;" class="form-control" id="servid_<?= $key['id']?>" name="serv_id">
											<?php 

												$divMeres = showDivMeres($conn);
												$divFilles = showDivFilles($conn);
											

												foreach ($divMeres as $key2 ) {
												?>

													<option <?=($key['serv_id']== $key2['id'])?' selected ':' '; ?> value="<?= $key2['id'] ?>" > <?= $key2['off_name'] ?></option>

													<?php

													foreach ($divFilles as $key3) {

														if ($key3['div_id']== $key2['id']) {
														?>

															<option <?=($key['serv_id']== $key3['id'])?' selected ':' '; ?> value="<?= $key3['id'] ?>"><?= "&nbsp;-&nbsp;".$key3['off_name'] ?></option>

														<?php
															foreach ($divFilles as $key4) {

																if ($key4['div_id']== $key3['id']) {
																	?>

																		<option <?=($key['serv_id']== $key4['id'])?' selected ':' '; ?> value="<?= $key4['id'] ?>"><?= "&nbsp;&nbsp;&nbsp;-&nbsp;".$key4['off_name'] ?>	
																		</option>
																	<?php
																}
															}
														}
													}
												}
											?>									
										</select>																		
									</div>
								</div>
							</td>

							<td>
								<div class="divStaff_<?= $key['id']?>">	
									<div style="width:100px;" class="staffInfos_<?= $key['id'] ?>">
										<div id="staffOffnbr_<?= $key['id'] ?>">	
											<?= $key['off_nbr'] ?>						
										</div>
									</div>
									<div class="updateStaffForm_<?= $key['id']?>" style="display:none;">
										
										<input  class="form-control" type="text" style=" max-width: 100px; font-size: 11px;" id="offnbr_<?= $key['id']?>"  name="offnbr<?= $key['id']?>" value="<?= $key['off_nbr'] ?>">	
																
									</div>
								</div>
							</td>

							<td>
								<div class="divStaff_<?= $key['id']?>">	
									<?= $key['add_date'] ?>
								</div>								
							</td>

							<td>
								<div class="divStaff_<?= $key['id']?>">	
									<div style="min-width: 15em;">
										<div style="margin-top:1em;text-align:center;cursor:pointer;text-decoration:none;color:green;width:150px;background:white;border:1px solid green;border-radius:6px;padding:2px 1px;text-decoration:none;color:green;font-size:1.1em; " id="modif<?= $key['id']?>" data-toggle="tooltip" title="Modifier" data-placement="bottom" idFormStaff="<?= $key['id'] ?>" class="showUpdtStaffForm" >
											<i class="fa fa-edit"></i> Modifier infos
										</div>

										<div  style="margin-top:1em;text-align:center;cursor:pointer;width:150px;background:green;border:1px solid green;border-radius:6px;padding:2px 1px;text-align:center;text-decoration:none;color:#fff;font-size:1.1em;display:none;" id="valid<?= $key['id']?>" data-toggle="tooltip" title="Valider" data-placement="bottom" idbtn="<?= $key['id']?>" class="sendUpdtStaff" >
											Valider <i class="fa fa-check"></i>
										</div><br>


										<div style="cursor:pointer;	text-align:center;width:150px;cursor:pointer;background:white;border:1px solid #A5CB22;border-radius:6px;padding:2px 1px;text-decoration:none;color:#A5CB22;font-size:1.1em;" data-toggle="modal" data-target="#updateStaffPic_<?= $key['id'] ?>" class="showUpdatePicForm" href="#" ><i class="fa fa-image"></i> Modifier photo </div>
									</div>
								</div>									
							</td>


							<td>
								<div class="divStaff_<?= $key['id']?>">							
									<div id="staffPic_<?= $key['id']?>">
										<img style="max-height: 120px;border: 1px solid black;" src="../img/<?=( !empty($key['picture']))? $key['picture']:$defaultImg; ?>" alt="image">								
									</div>
									

									<br>
									<a class="resetLink" idbtn="<?= $key['id'] ?>" onclick="return confirm('Cette action supprimera la photo existante et la remplacera par la photo par défaut : Êtes-vous sûr ?')" href="trombiback.php?resetPic=<?= $key['id'];?>">Suppr. photo</a>
								</div>								
							</td>

							<td>
								<div class="divStaff_<?= $key['id']?>">							
									<div style="margin-top:1em;cursor:pointer;	text-align:center;width:150px;cursor:pointer;background:white;border:1px solid red;border-radius:6px;padding:6px;text-decoration:none;color:red;font-size:1em;" data-toggle="modal" data-target="#supprStaffModal_<?= $key['id'] ?>" href="#" >Supprimer <br><i style="font-size:1.5em;" class="fa fa-ban"></i><br> Utilisateur </div>

								</div>	

							</td>
						


					</tr>


					<div style="margin-top:5em;" class="modal fade" id="updateStaffPic_<?= $key['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document" style="min-width:1000px;">
						  <div style="text-align:center;" class="modal-content" >
						    <div style="text-align:center"; class="modal-header">
						      
						      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						        <span aria-hidden="true">&times;</span>
						      </button>
						    </div>
						    <div class="modal-body">
						    	<form  style="margin-top: 1em;" id="updtStaffForm"  enctype="multipart/form-data" method="post" action="modifierStaff.php">
							     	<div class="container" style="text-align: center;min-width: 950px;">
							     		<h5  class="modal-title" id="exampleModalLabel">Modifier la photo de <?= $key['firstname'].' '.$key['name'] ?></h5>
										<div class="panel panel-default">

											<div style="margin: 2em 0em;" class="panel-heading">Pour ajouter une photo, choisissez une photo puis validez le recadrage, le résultat s'affiche à droite : </div>
										 	
										 	<div style="text-align:center;margin-bottom: 1em;">
												<strong>Selectionnez une image :</strong>			
												<input name="imgSrc" type="file" class="upload" idbtn="<?= $key['id'] ?>">
										 	</div>

											<div class="panel-body">
												<div class="row">
													<div class="col-md-5 text-center">
														<div id="upload-demo_<?= $key['id'] ?>" style="width:400px;height:400px; border:1px dotted #CCCCCC;"></div>	  	
													</div>

													<div class="col-md-2" style="min-width:10em;text-align: center;margin-top: 5em;">
														<strong>Valider le cadrage : </strong><br><br>
														<a class="btnImport upload-result" idbtn="<?= $key['id'] ?>">Ok <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
													</div>

													<div class="col-md-5" style="">
														<div id="upload-demo-i_<?= $key['id'] ?>" style="padding: 20px 0px 0px 40px; background:#e1e1e1;width:350px;height:350px;"></div>
													</div>
													<div>
														<input id="cropped_<?= $key['id'] ?>" name="croppedPicture" type="hidden">
													</div>
												</div>
											</div>
										</div>
									</div>

									<input style="margin-top:1em;text-align:center;width:150px;cursor:pointer;background:#A5CB22;border:1px solid #A5CB22;border-radius:6px;padding:5px;text-decoration:none;color:#fff;font-size:1.2em;" idbtn="<?= $key['id'] ?>" data-dismiss="modal" aria-label="Close"  class="updatePicBtn" type="submit" value="Mettre à jour !" > 
								</form>
						    </div>
							    <div class="modal-footer">
							    </div>
						  </div>
						</div>
					</div>





					<div style="text-align:center; color:red;" class="modal fade" id="supprStaffModal_<?= $key['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
						  <div class="modal-content">
						    <div class="modal-header" >
						      <h5 class="modal-title" id="exampleModalLabel">Confirmer la <b>suppression</b> de l'utilisateur <?= $key['firstname'].' '.$key['name']?> ?</h5>
						      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						        <span aria-hidden="true">&times;</span>
						      </button>
						    </div>
						    <div class="modal-body">
						      	<p>
									<form method="post" action="">

										<div>
											<button type="submit"  idbtn="<?= $key['id']?> " class="sendStaffSuppr"  data-dismiss="modal" aria-label="Close" required>Supprimer</button>
										</div>

									</form>	
						        </p>
						    </div>
						    <div class="modal-footer">

			
						    </div>
						  </div>
						</div>
					</div>

					<?php

				}								

				?>


			</tbody>
		</table>
	</div>




	<!-- 
	///////////////////////////////////////////////////////////////////////////
	////////////////////////////ONGLET SERVICES ///////////////////////////////
	///////////////////////////////////////////////////////////////////////////
	-->
		


	<div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="services-tab">

		<h4>Ajouter / Modifier des services</h4>

		<div class="helpServices">
			<i>Pour ajouter un <b>service</b> DANS une division (par exemple, ajouter le service DRH4 dans la division DRH), cliquez sur le <i style="color: #A5CB22;" class="fa fa-plus"></i> à droite de la division en question.
				<br>Pour ajouter une <b>division</b> cliquez sur "ajouter une nouvelle division <i style="color: #A5CB22;" class="fa fa-plus-circle"></i>".
				<br> Pour modifier un service ou une division, cliquez sur le <i style="color: #A5CB22;" class="fa fa-edit"></i> à droite du service ou de la division, le formulaire de modification s'affichera à droite.

			</i>
		</div>


		<!-- ///////////////// NOUVELLE DIVISION ///////////////-->

		<p style="margin-top: 2em;"><a style="text-decoration:none;color:#A5CB22;font-size:1.2em;" data-toggle="modal" data-target="#addModalNewDiv" class="showAddForm" href="#" >Ajouter une nouvelle division <i class="fa fa-plus-circle"></i></a></p>

		<div style="" class="modal fade" id="addModalNewDiv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
			  <div style="text-align:center;" class="modal-content">
			    <div class="modal-header">
			      <h5 style="text-align:center;" class="modal-title" id="exampleModalLabel">Ajouter une division</h5>
			      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			        <span aria-hidden="true">&times;</span>
			      </button>
			    </div>
			    <div class="modal-body">
			      	<p>
						<form method="post" action="trombiback.php?addServ='.$key2['id'].'">

							<div>
							<span style="margin-top: 3em;text-align:left;">Nom du service : <input type="text" style="width:200px;" id="newNom_NewDiv" required></span><br>
							<span style="margin-top: 3em;text-align:left;">Description : <input type="text" style="width:250px;" id="newDescr_NewDiv" required></span><br>

							<button type="submit"  idbtn="NewDiv" class="sendAdd" data-dismiss="modal" aria-label="Close" required>Ajouter</button>
							</div>

						</form>	
			        </p>
			    </div>
				    <div class="modal-footer">
				    </div>
			  </div>
			</div>
		</div>	
		<div class="childOf_NewDiv"><!-- Div qui sert comme repère pour afficher le résultat de la requête ajaj quand on ajoute une division -->
		</div>	



		<!-- ////////////// LISTE DIVISION ET SERVICES //////////////// -->

		<?php 

		$divMeres = showDivMeres($conn);
		$divFilles = showDivFilles($conn);


		foreach ($divMeres as $key2 ) {


			echo '

  			<div class="row" id="row_'.$key2['id'].'" style="margin-top:1em;">

				<div class="col-md-6"><b class="nom_descr" style="font-size:1.3em;"><span id="afficheOffname_'.$key2['id'].'" >'.$key2["off_name"].'</span>&nbsp;(<i id="afficheOffdescr_'.$key2["id"].'">'.$key2["descr"].'</i>) </b>
					<a  data-toggle="tooltip" title="Modifier" data-placement="bottom" idform="'.$key2['id'].'" class="showUpdtForm" href="#" ><i class="fa fa-edit"></i></a>
					<a  data-toggle="modal" title="Ajouter un service ici" data-target="#addModal'.$key2['id'].'" class="showAddForm" href="#" ><i class="fa fa-plus"></i></a>
					<a  data-toggle="modal" title="Supprimer" data-target="#supprModal'.$key2["id"].'" class="showSupprForm" href="#" ><i class="fa fa-ban"></i></a>

				</div>

				<div class="col-md-6">
					<span id="result_'.$key2["id"].'"></span>


					<form id="form_'.$key2["id"].'" style="display:none" method="post" action="updateServ.php?serv='.$key2['id'].'">

						<div>Nom du service : <input id="nom_'.$key2['id'].'" style="width:200px;" name="nom'.$key2["id"].'" value="'.$key2["off_name"].'">	Description : <input id="descr_'.$key2["id"].'" style="width:250px;" name="descr'.$key2['id'].'" value="'.$key2['descr'].'">

						<button type="submit" idbtn="'.$key2["id"].'" class="sendUpdt">Modifier</button>
						</div>
						
					</form>	

				</div>	
			</div>	


			<!-- Modal Suppression -->


			<div style="text-align:center; color:red;" class="modal fade" id="supprModal'.$key2['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
				  <div class="modal-content">
				    <div class="modal-header" >
				      <h5 class="modal-title" id="exampleModalLabel">Confirmer la <b>suppression</b> du service / de la division '.$key2["off_name"].' ?</h5>
				      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				        <span aria-hidden="true">&times;</span>
				      </button>
				    </div>
				    <div class="modal-body">
				      	<p>
							<form method="post" action="">

								<div>
									<button type="submit"  idbtn="'.$key2["id"].'" class="sendSuppr"  data-dismiss="modal" aria-label="Close" required>Supprimer</button>
								</div>

							</form>	
				        </p>
				    </div>
				    <div class="modal-footer">

	
				    </div>
				  </div>
				</div>
			</div>				

			  <!-- Modal Ajout -->
			<div style="text-align:center;" class="modal fade" id="addModal'.$key2['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
				  <div class="modal-content">
				    <div class="modal-header" >
				      <h5 class="modal-title" id="exampleModalLabel">Ajouter un service dans :<br>'.$key2["off_name"].'</h5>
				      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				        <span aria-hidden="true">&times;</span>
				      </button>
				    </div>
				    <div class="modal-body">
				      	<p>
							<form method="post" action="trombiback.php?addServ='.$key2['id'].'">

								<div>
									<span style="text-align:left;">Nom du service : <input type="text" style="width:200px;" id="newNom_'.$key2["id"].'" required></span><br><br>
									<span style="text-align:left;margin-top:4em;">Description : <input type="text" style="width:250px;" id="newDescr_'.$key2['id'].'"></span><br><br>
									<button type="submit"  idbtn="'.$key2["id"].'" class="sendAdd"  data-dismiss="modal" aria-label="Close" required>Ajouter</button>
								</div>

							</form>	
				        </p>
				    </div>
				    <div class="modal-footer">

	
				    </div>
				  </div>
				</div>
			</div>	
			<div class="childOf_'.$key2["id"].'">
			</div>	

			';

			?>		

			<?php


			foreach ($divFilles as $key3) {
				?> <?php 
				if ($key3['div_id']== $key2['id']) {

					echo '
						<div class="childOf_'.$key2["id"].'">
							<div class="child">
								<div class="row" id="row_'.$key3['id'].'">
									<div class="col-md-6">
										<li style="margin-left:1em;"><span id="afficheOffname_'.$key3["id"].'">'.$key3["off_name"].'</span>&nbsp;(<i id="afficheOffdescr_'.$key3["id"].'">'.$key3["descr"].'</i>) 
										<a style="text-decoration:none;color:#A5CB22;" data-toggle="tooltip"  title="Modifier" data-placement="bottom" idform="'.$key3["id"].'" class="showUpdtForm" href="#" ><i class="fa fa-edit"></i></a>
										<a data-toggle="modal" title="Supprimer" data-target="#supprModal'.$key3["id"].'" class="showSupprForm" href="#" ><i class="fa fa-ban"></i></a>
										</li>
									</div>

									<div class="col-md-6">
										<span id="result_'.$key3["id"].'"></span>
										<form id="form_'.$key3["id"].'" style="display:none" method="post" action="updateServ.php?serv='.$key3["id"].'">
											<div>Nom du service : <input id="nom_'.$key3["id"].'" style="width:200px;" name="nom'.$key3["id"].'" value="'.$key3["off_name"].'"> Description : 
												<input id="descr_'.$key3["id"].'" style="width:250px;" name="descr'.$key3["id"].'" value="'.$key3["descr"].'">

												<button type="submit" idbtn="'.$key3["id"].'" class="sendUpdt">Modifier</button>
											</div>												
										</form>	
									</div>	
								</div>
							</div>
						</div>	



						<!-- Modal Suppression -->


						<div style="text-align:center; color:red;" class="modal fade" id="supprModal'.$key3['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
							  <div class="modal-content">
							    <div class="modal-header" >
							      <h5 class="modal-title" id="exampleModalLabel">Confirmer la <b>suppression</b> du service / de la division '.$key3["off_name"].' ?</h5>
							      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							        <span aria-hidden="true">&times;</span>
							      </button>
							    </div>
							    <div class="modal-body">
							      	<p>
										<form method="post" action="">

											<div>
												<button type="submit"  idbtn="'.$key3["id"].'" class="sendSuppr"  data-dismiss="modal" aria-label="Close" required>Supprimer</button>
											</div>

										</form>	
							        </p>
							    </div>
							    <div class="modal-footer">

				
							    </div>
							  </div>
							</div>
						</div>							

					';

				}
			}
			?>	
		<?php
		}
		?>

	</div> <!-- FIN div tabcontent s-->


	<!-- 
	///////////////////////////////////////////////////////////////////////////
	////////////////////////////ONGLET CONFIG /////////////////////////////////
	///////////////////////////////////////////////////////////////////////////
	-->

	<div class="tab-pane fade" id="config" role="tabpanel" aria-labelledby="config-tab">

		<h4>Configuration de l'application Trombi</h4>

		Configuration actuelle : <br><br>

		<ul>
			<li>Nom du serveur :  <span class="config"><?= U_SERV_NAME ?></span></li>
			<li>Nom d'utilisateur :  <span class="config"><?= U_USERNAME ?></span></li>
			<li>MDP :   <span class="config"><?= U_MDP ?></span class="config"></li>
			<li>Nom de la base :  <span class="config"><?= U_DB_NAME ?></span></li>
		</ul>

		<p>Ces valeurs sont modifiables dans le fichier includes/constants.php</p>

	</div>

</body>





<script>

//$(document).ready(function(){  sendUpdtStaff







	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();   
	});

//////////////////////////////
///////////* AJAX *//////////
/////////////////////////////


	$("#listStaff").on("click",".sendUpdtStaff", function(e){ // AJAX pour l'update de Personnel

		//Recup des valeurs
	    var idStaff = $(this).attr('idbtn');
	    var nomStaff = $('#name_'+idStaff).val();
	    var prenomStaff = $('#firstname_'+idStaff).val();
	    var mailStaff = $('#mail_'+idStaff).val();
	    var jobStaff = $('#job_'+idStaff).val();
	    var telextStaff = $('#telext_'+idStaff).val();
	    var telintStaff = $('#telint_'+idStaff).val();
	    var servidStaff = $("#servid_"+ idStaff +" option:selected").val();
	    var offnbrStaff = $('#offnbr_'+idStaff).val();

	    //Zones d'affichages
	    var afficheStaffName = '#staffName_'+$(this).attr('idbtn');
	    var afficheStaffFirst = '#staffFirstName_'+$(this).attr('idbtn');
	    var afficheStaffMail = '#staffEmail_'+$(this).attr('idbtn');
	    var afficheStaffJob = '#staffJob_'+$(this).attr('idbtn');
	    var afficheStaffTelext = '#staffTelext_'+$(this).attr('idbtn');
	    var afficheStaffTelint = '#staffTelint_'+$(this).attr('idbtn');
	    var afficheStaffOffname = '#staffOffname_'+$(this).attr('idbtn');
	    var afficheStaffOffdescr = '#staffOffdescr_'+$(this).attr('idbtn');
	    var afficheStaffOffnbr = '#staffOffnbr_'+$(this).attr('idbtn');
	    
	    var resultSpan = '#result_'+$(this).attr('idbtn');	  
	    var staffInfos = '.staffInfos_'+$(this).attr('idbtn');
	    var form = '.updateStaffForm_'+$(this).attr('idbtn');
	    var validBtn = '#valid'+$(this).attr('idbtn');
	    var modifBtn = '#modif'+$(this).attr('idbtn');	    

	    e.preventDefault();

	 // alert(+ idStaff + '//'+ nomStaff + '//'+ prenomStaff + '//'+ mailStaff + '//'+ jobStaff + '//'+ telextStaff + '//'+ telintStaff + '//'+ servidStaff + '//' + offnbrStaff);	
	  
		$.post(
	       	'updateStaff.php', // Script de traitement de la req update qui renvoie le json
	        {
	        	name : nomStaff ,
	        	firstname : prenomStaff,
	        	serv_id : servidStaff,
	        	job : jobStaff,
	        	email : mailStaff,
	        	telext : telextStaff,
	        	telint : telintStaff,
	        	offnbr : offnbrStaff,
	        	staff_id : idStaff

	        },

	        function(data){

	            if(data){ //si ok ( a revoir)	            	            	
					
	              	var newUserinfos = JSON.parse(data); //recup du json
	                 
	                //console.log(newServOuDiv.name);

	                //$(resultSpan).html('<div style="padding: 6px 10px" class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Ok !</strong> Changements enregistrés !</div>'); //affichage div succes
	                $(afficheStaffName).html( newUserinfos.name );  // Remplissage nouvelles infos
	                $(afficheStaffFirst).html( newUserinfos.firstname ); // Remplissage nouvelles infos
	                $(afficheStaffMail).html( newUserinfos.email );  // Remplissage nouvelles infos
	                $(afficheStaffJob).html( newUserinfos.job ); // Remplissage nouvelles infos
	                $(afficheStaffTelext).html( newUserinfos.tel_ext );  // Remplissage nouvelles infos
	                $(afficheStaffTelint).html( newUserinfos.tel_int ); // Remplissage nouvelles infos
	                $(afficheStaffOffname).html( newUserinfos.off_name ); // Remplissage nouvelles infos
	                $(afficheStaffOffdescr).html( newUserinfos.descr );
	                $(afficheStaffOffnbr).html( newUserinfos.off_nbr );

					$(form).add(validBtn).css('display', 'none');    
					$(modifBtn).add(staffInfos).css('display', 'block');

	               /* window.setTimeout(function() {
	                    $(".alert").fadeTo(500, 0).slideUp(500, function(){
	                        $(this).remove(); 
	                    });
	                }, 1000);*/


	            }
	            else{
	              alert('erreur :' + data + ' ');   //a revoir                 

	            }
	    
	        },
	        'text'
		);
	
	});	


	$("#listStaff").on("click",".updatePicBtn", function(e){ // AJAX pour l'update de SERVICE

		//valeurs
		var idStaff = $(this).attr('idbtn');
		var picture = $('#cropped_'+$(this).attr('idbtn')).val();

		//Zones d'affichages
	    var afficheStaffPic = '#staffPic_'+$(this).attr('idbtn');

		

		e.preventDefault();
	

			
		$.post(
            'updatePic.php', // Script de traitement de la req update qui renvoie le json
            {
                croppedPicture : picture,  // recup des input
                staff_id : idStaff
            },
 
            function(data){

                if(data){ //si ok ( a revoir)

                	var newUserPic = JSON.parse(data); //recup du json

	                $(afficheStaffPic).html('<img style="max-height: 120px;border: 1px solid black;" src="../img/'+  newUserPic.picture +'" alt="image">' );  // Remplissage nouvelles infos
                }
                else{
                	alert('erreur !! :' + data + ' ');   //a revoir                 

                }
        
            },
            'text'
         );
	});



		$("#listStaff").on("click",".resetLink", function(e){ // AJAX pour reset la photo


		var idStaff = $(this).attr('idbtn');
		var afficheStaffPic = '#staffPic_'+$(this).attr('idbtn');

		e.preventDefault();

		

			
		$.post(
            'resetPicture.php', // Script de traitement de la req update qui renvoie le json
            {

                idStaff : idStaff
                
            },
 
            function(data){

                if(data){ //si ok ( a revoir)

         			var newUserPic = JSON.parse(data); //recup du json

	                $(afficheStaffPic).html('<img style="max-height: 120px;border: 1px solid black;" src="../img/'+  newUserPic.picture +'" alt="image">' );  //
					

                }
                else{
                	alert('erreur :' + data + ' ');   //a revoir                 

                }
        
            },
            'text'
         );
         
	});



	$("#listStaff").on("click",".sendStaffSuppr", function(e){ // AJAX pour l'update

		var idStaff =  $(this).attr('idbtn');

		var removeLine = '#rowStaff_'+$(this).attr('idbtn');
		var removeDiv = '.divStaff_'+$(this).attr('idbtn');

		

		e.preventDefault();

		

			
		$.post(
            'supprStaff.php', // Script de traitement de la req update qui renvoie le json
            {

                idStaff : idStaff
                
            },
 
            function(data){

                if(data == "OK"){ //si ok ( a revoir)


                	//$(removeLine).html('<div style="padding: 6px 10px; width:100em;height:160px;" class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Ok !</strong>&nbsp;Personnel supprimé</div>'); //affichage div succes
                   	
 					window.setTimeout(function() {
					    $(removeDiv).fadeTo(500, 0).slideUp(500, function(){
					       $(this).remove(); 
					    });
					     $(removeLine).fadeTo(500, 0).slideUp(500, function(){
					       $(this).remove(); 
					    });
					    
					}, 500);		
					

                }
                else{
                	alert('erreur :' + data + ' ');   //a revoir                 

                }
        
            },
            'text'
         );
         
	});


	$("#services").on("click",".sendUpdt", function(e){ // AJAX pour l'update de SERVICE

		var idService = $(this).attr('idbtn');
		var nomService = $('#nom_'+$(this).attr('idbtn')).val();
		var descrService = $('#descr_'+$(this).attr('idbtn')).val();
		var resultSpan = '#result_'+$(this).attr('idbtn');
		var afficheName = '#afficheOffname_'+$(this).attr('idbtn');
		var afficheDescr = '#afficheOffdescr_'+$(this).attr('idbtn');
		var form = '#form_'+$(this).attr('idbtn');
		

		e.preventDefault();

			
		$.post(
            'updateServ.php', // Script de traitement de la req update qui renvoie le json
            {
                nomServ : nomService,  // recup des input
                idServ : idService,
                descrServ :  descrService
            },
 
            function(data){

                if(data){ //si ok ( a revoir)

                	var newServOuDiv = JSON.parse(data); //recup du json                     

                    //console.log(newServOuDiv.name);

                    $(resultSpan).html('<div style="padding: 6px 10px;" class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Ok !</strong> Changements enregistrés !</div>'); //affichage div succes
                    $(afficheName).html( newServOuDiv.name );  // Remplissage nouvelles infos
                    $(afficheDescr).html( newServOuDiv.descr ); // Remplissage nouvelles infos

                    

 					$(form).css('display', 'none'); // on cache le form

 					window.setTimeout(function() {
					    $(".alert").fadeTo(500, 0).slideUp(500, function(){
					        $(this).remove(); 
					    });
					}, 1000);
                }
                else{
                	alert('erreur :' + data + ' ');   //a revoir                 

                }
        
            },
            'text'
         );
	});


	$("#services").on("click",".sendAdd", function(e){ // AJAX pour l'ajout d'un service dans une div

		e.preventDefault();

		var idService = $(this).attr('idbtn');
		var nomNewService = $('#newNom_'+$(this).attr('idbtn')).val();
		var descrNewService = $('#newDescr_'+$(this).attr('idbtn')).val();
		var afficheName = '#afficheOffname_'+$(this).attr('idbtn');
		var afficheNewServ = '.childOf_'+$(this).attr('idbtn');


			
		$.post(
            'addServ.php', 
            {
                nomNewServ : nomNewService,  
                idServ : idService,
                descrNewServ :  descrNewService
            },
 
            function(data){

                if(data){

                	var newServOuDiv = JSON.parse(data);
        
                    console.log(newServOuDiv.name + newServOuDiv.descr + newServOuDiv.id);

              		
                    if (idService == "NewDiv") {

                    	$(  afficheNewServ ).last().append( '<div id="row_'+ newServOuDiv.id +'" class="row" style="margin-top:1em;"><div class="col-md-6"><b class="nom_descr"><span id="afficheOffname_'+ newServOuDiv.id +'" >'+ newServOuDiv.name +'</span>&nbsp;(<i id="afficheOffdescr_'+ newServOuDiv.id +'">'+ newServOuDiv.descr +'</i>)<b><a style="text-decoration:none;color:#A5CB22;" data-toggle="tooltip"  title="Modifier" data-placement="bottom" idform="'+ newServOuDiv.id +'" class="showUpdtForm" href="#" ><i class="fa fa-edit"></i></a><a style="text-decoration:none;color:#A5CB22;" data-toggle="modal" title="Ajouter un service ici" data-target="#addModal'+ newServOuDiv.id +'" class="showAddForm" href="#" ><i class="fa fa-plus"></i></i></a><a data-toggle="modal" title="Supprimer" data-target="#supprModal'+ newServOuDiv.id +'" class="showSupprForm" href="#" ><i class="fa fa-ban"></i></a></div><div class="col-md-6"><span id="result_'+ newServOuDiv.id +'"></span><form id="form_'+ newServOuDiv.id +'" style="display:none" method="post" action="updateServ.php?serv='+ newServOuDiv.id +'"><div>Nom du service : <input id="nom_'+ newServOuDiv.id +'" style="width:200px;" name="nom'+ newServOuDiv.id +'" value="'+ newServOuDiv.name +'">	Description : <input id="descr_'+ newServOuDiv.id +'" style="width:250px;" name="descr'+ newServOuDiv.id +'" value="'+ newServOuDiv.descr +'"><button type="submit" idbtn="'+ newServOuDiv.id +'" class="sendUpdt">Modifier</button></div></form></div></div><!-- Modal Suppression --><div style="text-align:center; color:red;" class="modal fade" id="supprModal'+ newServOuDiv.id +'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header" ><h5 class="modal-title" id="exampleModalLabel">Confirmer la <b>suppression</b> du service / de la division '+ newServOuDiv.name +' ?</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><p><form method="post" action=""><div><button type="submit"  idbtn="'+ newServOuDiv.id +'" class="sendSuppr"  data-dismiss="modal" aria-label="Close" required>Supprimer</button></div></form></p></div><div class="modal-footer"></div></div></div></div><!-- Modal --><div style="font-weight:normal;text-align:center;" class="modal fade" id="addModal'+ newServOuDiv.id +'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLabel">Ajouter un service dans '+ newServOuDiv.name +'</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><p><form method="post" action="trombiback.php?addServ='+ newServOuDiv.id +'"><div><span style="text-align:left;">Nom du service : <input type="text" style="width:200px;" id="newNom_'+ newServOuDiv.id +'" required></span><br><span style="text-align:left;margin-top:4em;">Description : <input type="text" style="width:250px;" id="newDescr_'+ newServOuDiv.id +'"></span><br><button type="submit"  idbtn="'+ newServOuDiv.id +'" class="sendAdd"  data-dismiss="modal" aria-label="Close" required>Ajouter</button></div></form></p></div><div class="modal-footer"></div></div></div></div><div class="childOf_'+ newServOuDiv.id +'"></div>	' );

                    }

                    else{
                    	$(  afficheNewServ ).last().append( '<div class="childOf_'+ idService +'"><div class="row" id="row_'+ newServOuDiv.id +'"><div class="col-md-6"><li style="margin-left:1em;"><span id="afficheOffname_'+ newServOuDiv.id +'">'+ newServOuDiv.name +'</span>&nbsp;(<i id="afficheOffdescr_'+ newServOuDiv.id +'">'+ newServOuDiv.descr +'</i>) <a style="text-decoration:none;color:#A5CB22;" data-toggle="tooltip"  title="Modifier" data-placement="bottom" idform="'+ newServOuDiv.id +'" class="showUpdtForm" href="#" ><i class="fa fa-edit"></i></a><a data-toggle="modal" title="Supprimer" data-target="#supprModal'+ newServOuDiv.id +'" class="showSupprForm" href="#" ><i class="fa fa-ban"></i></a></li></div><div class="col-md-6"><span id="result_'+ newServOuDiv.id +'"></span><form id="form_'+ newServOuDiv.id +'" style="display:none" method="post" action="updateServ.php?serv='+ newServOuDiv.id +'"><div>Nom du service : <input id="nom_'+ newServOuDiv.id +'" style="width:200px;" name="nom'+ newServOuDiv.id +'" value="'+ newServOuDiv.name +'"> Description : <input id="descr_'+ newServOuDiv.id +'" style="width:250px;" name="descr'+ newServOuDiv.id +'" value="'+ newServOuDiv.descr +'"><button type="submit" idbtn="'+ newServOuDiv.id +'" class="sendUpdt">Modifier</button></div></form></div></div><!-- Modal Suppression --><div style="text-align:center; color:red;" class="modal fade" id="supprModal'+ newServOuDiv.id +'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header" ><h5 class="modal-title" id="exampleModalLabel">Confirmer la <b>suppression</b> du service / de la division '+ newServOuDiv.name +' ?</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><p><form method="post" action=""><div><button type="submit"  idbtn="'+ newServOuDiv.id +'" class="sendSuppr"  data-dismiss="modal" aria-label="Close" required>Supprimer</button></div></form></p></div><div class="modal-footer"></div></div></div></div></div>' );
                    }					
                }
                else{

                	alert('erreur :' + data + ' ');
                     
                }
        
            },
            'text'
        );
	});


	$("#services").on("click",".sendSuppr", function(e){ // AJAX pour l'update

		var idService =  $(this).attr('idbtn');	
		var removeLine = '#row_'+$(this).attr('idbtn');
		var removeChild = '.childOf_'+$(this).attr('idbtn');

		e.preventDefault();
			
		$.post(
            'supprServ.php', // Script de traitement de la req update qui renvoie le json
            {
                idServ : idService                
            },
 
            function(data){

                if(data == "OK"){ //si ok ( a revoir)

                	

                    $(removeLine).html('<div style="padding: 6px 10px" class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Ok !</strong>&nbsp;Service/division supprimé(e)</div>'); //affichage div succes

					
 					window.setTimeout(function() {
					    $(removeLine).fadeTo(500, 0).slideUp(500, function(){
					        $(this).remove(); 
					    });

					    $(removeChild).fadeTo(500, 0).slideUp(500, function(){
					        $(this).remove(); 
					    });
					}, 500);					

                }
                else{
                	alert('erreur :' + data + ' ');   //a revoir                 

                }        
            },
            'text'
         );         
	});

	//var $cropped = $('#cropped');


	$("#services").on("click",".showUpdtForm", function(e){

		e.preventDefault();
		var form = '#form_'+$(this).attr('idform');
		$(form).css('display', 'block');

	});
		$("#listStaff").on("click",".showUpdtStaffForm", function(e){

		e.preventDefault();

		var staffInfos = '.staffInfos_'+$(this).attr('idFormStaff');
		//var nom = '#staffName_'+$(this).attr('idFormStaff');
		//var prenom = '#staffFirstName_'+$(this).attr('idFormStaff');
		var form = '.updateStaffForm_'+$(this).attr('idFormStaff');
		var validBtn = '#valid'+$(this).attr('idFormStaff');
		var modifBtn = '#modif'+$(this).attr('idFormStaff');

		$(form).add(validBtn).css('display', 'block');		
		$(modifBtn).add(staffInfos).css('display', 'none');

	});




	$('.upload').on('change', function (e) { 

			var idStaff = $(this).attr('idbtn');
		

			var uploadDemo = $('#upload-demo_'+idStaff)


			$uploadCrop = $(uploadDemo).croppie({
		    enableExif: true,
		    viewport: {
		        width: 276, //345
		        height: 300, //375
		        type: 'square'
		    },
		    boundary: {
		        width: 350,
		        height: 350
		    }
		});

		var reader = new FileReader();

	    reader.onload = function (e) {
	    	$uploadCrop.croppie('bind', {
	    		url: e.target.result
	    	}).then(function(){
	    		console.log('jQuery bind complete');
	    	});
	    	
	    }
	    reader.readAsDataURL(this.files[0]);
	});


	$('.upload-result').on('click', function (ev) {
		var idStaff = $(this).attr('idbtn');
		var uploadResult = $('#upload-demo-i_'+idStaff);
		var inputFinal = $('#cropped_'+idStaff);
		

		$uploadCrop.croppie('result', {
			type: 'canvas',
			size: 'viewport'
		}).then(function (resp) {


			$.ajax({
				url: "ajaxpro.php",
				type: "POST",
				data: {"image":resp},
				dataType: 'html',
		
				success: function (data) {
					
					html = '<img src="' + resp + '" />';
					$(uploadResult).html(html);
					//$('<input name="croppedPicture" type="hidden" value="'+ data +'">').appendTo("#cropped"); // On passe code_html à jQuery() qui va nous créer l'arbre DOM !
					$(inputFinal).val(data); 
				}


			});
		});
	});







</script>





</html>