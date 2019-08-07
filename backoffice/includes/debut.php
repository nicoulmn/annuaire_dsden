<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<?= (!empty($titre))?'<title>'.$titre.'</title>':'<title> Forum </title>';?>
	<title>Usertempo</title>
	<!--
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	-->


		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">		
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/anim_accueil.css">
		<link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
		<script src="js/JQuery/jquery-3.2.1.min.js"></script>
		<script src="js/popper.min.js" ></script>
		<script src="bootstrap/js/bootstrap.min.js" ></script>
		<script type="text/javascript" src="js/tablesorter-master/js/jquery.tablesorter.js"></script>	
  		<script src="js/Croppie-2.6.1/croppie.js"></script>  
  		<link rel="stylesheet" href="js/Croppie-2.6.1/croppie.css">

	<script>

	  $( "#target" ).click(function() {
	    $('#profile-tab').tab('show');

	 
	  });


	</script>


</head>


<?php

//Attribution des variables de session
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

//On inclue les 2 pages restantes
include("./includes/functions.php");
include("./includes/constants.php");


?>