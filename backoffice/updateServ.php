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

if(isset($_POST['nomServ']) && isset($_POST['idServ']) && isset($_POST['descrServ'])){


	$reponse = $conn->prepare('
	SELECT div_id FROM service WHERE id = :id'); 
	$reponse->bindValue(':id', $_POST['idServ'], PDO::PARAM_INT);  
	$reponse->execute();
	$myresult = $reponse->fetch();

	if ($myresult['div_id'] == NULL) {
		$id_mere = NULL;
		$nom_mere='';
	}

	else {

		$id_mere = $myresult['div_id'];

	
		//On cherche le nom de la mere qui est rentré en base notamment pour la recherche
		$reponse2 = $conn->prepare('
		SELECT off_name FROM service WHERE id = :div_id'); 
		$reponse2->bindValue(':div_id', $id_mere, PDO::PARAM_INT);  
		$reponse2->execute();
		$servicesmeres = $reponse2->fetch();
		$nom_mere = $servicesmeres['off_name'];
	} 

	$query=$conn->prepare('
	UPDATE
	service
	SET nom_mere = :nom_mere , off_name = :off_name , descr = :descr
	WHERE
	id = :id 
	');    

	$query->bindValue(':off_name',stripslashes($_POST['nomServ']), PDO::PARAM_STR);
	$query->bindValue(':descr',stripslashes($_POST['descrServ']), PDO::PARAM_STR);
	$query->bindValue(':nom_mere',stripslashes($nom_mere), PDO::PARAM_STR);
	$query->bindValue(':id',$_POST['idServ'], PDO::PARAM_INT);
	$query->execute();



	$reponse=$conn->prepare('
	SELECT * FROM
	service
	WHERE
	id = :id 
	');    

	$reponse->bindValue(':id',$_POST['idServ'], PDO::PARAM_INT);	
	$reponse->execute();
	$result = $reponse->fetch();  

	if (!isset($myObj)) $myObj = new stdClass();
	$myObj->name = $result['off_name'];
	$myObj->descr = $result['descr'];


	
	echo json_encode($myObj);

}


?>
