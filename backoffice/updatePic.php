<?php
include('includes/constants.php');
require("includes/functions.php");
//Connexion BDD
// variables = constantes LES CONSTANTES SONT MODIFIABLES DANS includes/constants.php
$servername = U_SERV_NAME;
$username = U_USERNAME;
$password = U_MDP;
$dbname = U_DB_NAME;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $msgConn = "Connexion à la base trombi OK"; 
    }
catch(PDOException $e)
    {
    $msgConn = "<b>La tentative de connexion à la base de données a échoué. </b><br>" . $e->getMessage();

    }


	$staff_id = $_POST['staff_id'];	
			
	//$pictureExist = pictureExist($conn, $staff_id); 

	if (isset($staff_id) &&  isset($_POST['croppedPicture']) && !empty($_POST['croppedPicture']) /* && $_FILES['imgSrc']['size'] != 0*/ ){ // si on a rentré une nouvelle photo
	
/*
		if (!empty($pictureExist)) { // S'il y a une photo on l'update -> normalement il y en a toujours une puisqu'on ajoute une image par défaut à l'ajout de personnel
			updatePicture($conn, $staff_id);
		}
		else{
			addPicture($conn, $staff_id); // sinon on ajoute
		}
*/

		$data = $_POST['croppedPicture'];
		list($type, $data) = explode(';', $data);
		list(, $data)      = explode(',', $data);
		$data = base64_decode($data);
		$imageName = time().'.png';
		file_put_contents('../img/'.$imageName, $data);


		$reponse = $conn->prepare('
		UPDATE pictures 
		SET picture = :photo 
		WHERE 
		staff_id = :id 
		');

		$reponse->bindValue(':photo', $imageName, PDO::PARAM_STR);
		$reponse->bindValue(':id', $staff_id, PDO::PARAM_INT);
		$reponse->execute();

		$infosUser = getUser($conn, $_POST['staff_id']);
		if (!isset($infosUserJson)) $infosUserJson = new stdClass();
		$infosUserJson->picture = $infosUser['picture'];
		echo json_encode($infosUserJson);
	}

	/*
	elseif (isset($staff_id) && empty($pictureExist)) {
		addPicture($conn, $staff_id); // sinon on ajoute
	}
*/







	


	



?>
