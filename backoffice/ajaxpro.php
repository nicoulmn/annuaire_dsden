
<?php 

$data = $_POST['image'];
/*

list($type, $data) = explode(';', $data);
list(, $data)      = explode(',', $data);


$data = base64_decode($data);

$imageName = time().'.png';

//file_put_contents('upload/'.$imageName, $data);

/*
//Connexion BDD
// variables = constantes LES CONSTANTES SONT MODIFIABLES DANS includes/constants.php
$servername = "localhost";
$username = "dsicdti";
$password ="di2003";
$dbname = "trombi";

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

$nom="testssss";
$staff_id="testss555";
$reponse = $conn->prepare('INSERT INTO pictures(picture, staff_id) VALUES (:photo, :staff_id)');

$reponse->bindValue(':photo', $nom. '.' . $extension, PDO::PARAM_STR);
$reponse->bindValue(':staff_id', $staff_id, PDO::PARAM_INT);

$reponse->execute();

*/
echo $data;



?>
