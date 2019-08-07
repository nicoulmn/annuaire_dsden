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

if(isset($_POST['nomNewServ']) && isset($_POST['idServ']) && isset($_POST['descrNewServ']) && !empty($_POST['nomNewServ']) && !empty($_POST['descrNewServ'])){

	if ($_POST['idServ'] == "NewDiv") {
		$div_id = NULL;
		$nom_mere='';
	}
	else {

		$div_id = $_POST['idServ'];
		//On cherche le nom de la mere qui est rentré en base notamment pour la recherche
		$reponse2 = $conn->prepare('
		SELECT off_name FROM service WHERE id = :div_id'); 
		$reponse2->bindValue(':div_id', $div_id, PDO::PARAM_INT);  
		$reponse2->execute();
		$servicesmeres = $reponse2->fetch();
		$nom_mere = $servicesmeres['off_name'];
	} 



		

	$query=$conn->prepare('
	INSERT INTO 
	service
	(off_name, descr, div_id, nom_mere)
	VALUES 
	(:off_name, :descr, :div_id, :nom_mere)');    

	$query->bindValue(':off_name',$_POST['nomNewServ'], PDO::PARAM_STR);
	$query->bindValue(':descr',$_POST['descrNewServ'], PDO::PARAM_STR);
	$query->bindValue(':div_id',$div_id, PDO::PARAM_INT);
	$query->bindValue(':nom_mere',$nom_mere, PDO::PARAM_STR);
	$query->execute();

	$last_id = $conn->lastInsertId(); 

	$reponse=$conn->prepare('
	SELECT * FROM
	service
	WHERE
	id = :id 
	');    
	$reponse->bindValue(':id',$last_id, PDO::PARAM_INT);	
	$reponse->execute();
	$result = $reponse->fetch();  

	if (!isset($resultAdd)) $resultAdd = new stdClass();

	$resultAdd->name = $result['off_name'];
	$resultAdd->descr = $result['descr'];
	$resultAdd->id = $result['id'];

	
	echo json_encode($resultAdd);

}


?>
