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

if(isset($_POST['name']) && isset($_POST['firstname']) && isset($_POST['serv_id'])){


	$post = array_map('trim', array_map('htmlspecialchars', $_POST));

	updateStaff($conn, $post);

	$infosUser = getUser($conn, $post['staff_id']);



	if (!isset($infosUserJson)) $infosUserJson = new stdClass();
	$infosUserJson->name = $infosUser['name'];
	$infosUserJson->firstname = $infosUser['firstname'];
	$infosUserJson->email = $infosUser['email'];
	$infosUserJson->job = $infosUser['job'];
	$infosUserJson->tel_ext = $infosUser['tel_ext'];
	$infosUserJson->tel_int = $infosUser['tel_int'];
	$infosUserJson->off_name = $infosUser['off_name'];
	$infosUserJson->descr = $infosUser['descr'];
	$infosUserJson->serv_id = $infosUser['serv_id'];
	$infosUserJson->off_nbr = $infosUser['off_nbr'];


	
	echo json_encode($infosUserJson);

	
}


?>
