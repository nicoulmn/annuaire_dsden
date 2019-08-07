<?php
include('includes/constants.php');

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

if(isset($_POST['idServ']) && !empty($_POST['idServ'])){


	$reponse = $conn->prepare('
	DELETE FROM service WHERE id = :id 
	');

	$reponse->bindValue(':id', $_POST['idServ'], PDO::PARAM_INT);

	$reponse->execute();


	echo "OK";

}


?>
