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


	if (isset($_POST['idStaff']) && !empty($_POST['idStaff'])) { // si on vient de reset un photo

		$pictureExist = pictureExist($conn, $_POST['idStaff']);

		if (!empty($pictureExist)) {
			resetUserPicture($conn, $_POST['idStaff']);
		}


		$infosUser = getUser($conn, $_POST['idStaff']);
		if (!isset($infosUserJson)) $infosUserJson = new stdClass();
		$infosUserJson->picture = $infosUser['picture'];
		echo json_encode($infosUserJson);
		/*
		$idstaff = $_POST['idStaff'];
		$newPic = getUserPicture($conn, 17);
		var_dump($newPic);

		if (!isset($UserPicJson)) $UserPicJson = new stdClass();
		$UserPicJson->picture = $newPic['picture'];
		echo json_encode($UserPicJson);*/


	}

	
	



?>
