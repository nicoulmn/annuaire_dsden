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
/*
  $reponse = $conn->prepare('
    SELECT * FROM service'); 
  $reponse->execute();
  $services = $reponse->fetchall();  

  foreach ($services as $key) {
    if (!is_null($key['div_id'])) {

      $idmere = $key['div_id'];
      $id = $key['id'];
      
      $reponse2 = $conn->prepare('
      SELECT off_name FROM service WHERE id = :div_id'); 
      $reponse2->bindValue(':div_id', $idmere, PDO::PARAM_INT);  
      $reponse2->execute();
      $servicesmeres = $reponse2->fetchall();

    echo $key['off_name'];

    foreach ($servicesmeres as $key2) {

      $nom_mere = $key2['off_name'];

      $query=$conn->prepare('

        UPDATE
        service 
        SET nom_mere = :nom_mere 
        WHERE
        id = :id 
        ');      

        $query->bindValue(':nom_mere',$nom_mere, PDO::PARAM_STR);
        $query->bindValue(':id',$id, PDO::PARAM_INT);
        $query->execute();

        echo $key2['off_name'].'<br>';
    }
    }
  }



?>