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



<?php





if ($id!=0){  //Si une session est ouverte


	

			// si doublon mail -> erreur
		$res = $conn->prepare("SELECT email FROM staff ");
		$res->execute();
		$resultlistMail = $res->fetchall();

		if (!empty($_POST['email'])) {
			foreach ($resultlistMail as $key ) {
				if ($_POST['email'] == $key['email']) {
					$InsertStaffError[] = "Le mail existe déjà";
				}
			}
		}

		if (empty($_POST['name'])) {
			$InsertStaffError[] = "Champ nom vide ou incorrect";
		}
		if (empty($_POST['firstname'])) {
			$InsertStaffError[] = "Champ prénom vide ou incorrect";
		}
		if (empty($_POST['job'])) {
			$InsertStaffError[] = "Champ fonction vide ou incorrect";
		}
		if (empty($_POST['email'])) {
			$InsertStaffError[] = "Champ mail vide ou incorrect";
		}

		if(empty($InsertStaffError)){	

			$last_id = insertStaff($conn);		

			if (isset($last_id)){

				addPicture($conn, $last_id);
			}



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


			<br><a class=\"btnImport\" href=\"trombiback.php\">Accueil </a>   <a class=\"btnImport\" href=\"trombiback.php?nav=newAddStaff\">Nouvelle inscription <i class=\"fa fa-redo\"></i></a>    <a class=\"btnImport\" href=\"trombiback.php?listStaff=1\">Liste du Personnel </a>
	
			";

		}
		

		?>


		<?php

	


}
?>
