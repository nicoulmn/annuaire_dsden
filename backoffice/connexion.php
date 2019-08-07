<?php
session_start();

$titre="Connexion";
include("includes/debut.php"); // Inclusion du debut de page commun a toutes les pages
include("includes/connexionDb.php"); //Connexion BDD




 ?>

<body>

	<div class="container">
        <div class="animate two">
        
        	<h1><span id="user">Dsden</span><span>3</span><span>3</span</h1>

        </div>
        <span id="conn"><?= $msgConn; ?></span>
    </div>

<?php

if ($id!=0) erreur(ERR_IS_CO);

?>


<?php
if (!isset($_POST['pseudo'])) //On est dans la page de formulaire
{
?>

		<form  id="connectionForm" method="post" action="connexion.php">
		
			<h4>Connexion</h4>

			 <div class="form-group">
				<label for="pseudo">Login</label>
				<input class="form-control" name="pseudo" type="text" id="pseudo" placeholder="Login.." >
			</div>

			 <div class="form-group">
			 	<label for="password">Mot de Passe :</label>
			 	<input class="form-control" type="password" name="password" id="password" >
			 </div>
				
		
			
				<input class="btnImport" type="submit" value="Connexion" >
		
		</form>
	</body>
</html>
<?php	
}

else
{
    $message='';

    if (empty($_POST['pseudo']) || empty($_POST['password']) ) //Oublie d'un champ
    {
        $message = '<p>une erreur s\'est produite pendant votre identification.
	Vous devez remplir tous les champs</p>
	<p>Cliquez <a href="./connexion.php">ici</a> pour revenir</p>';
    }
    else //On check le mot de passe
    {
        $query=$conn->prepare('SELECT username, password
        FROM user WHERE username = :pseudo ');
        $query->bindValue(':pseudo',$_POST['pseudo'], PDO::PARAM_STR);

        $query->execute();
        $data=$query->fetch();
	if ($data['password'] == md5($_POST['password'])) // Acces OK !
	{
	    $_SESSION['pseudo'] = $data['username'];	    
	    $_SESSION['id'] = 1;
	    echo "<script> window.location.assign('trombiback.php'); </script>";

	
	    $message = '<p>Bienvenue '.$data['username'].', 
			vous êtes maintenant connecté!</p>
			<p>Cliquez <a href="../index.php">ici</a> 
			pour revenir à la page d accueil</p>';  
	}
	else // Acces pas OK !
	{
	    $message = '<p>Une erreur s\'est produite 
	    pendant votre identification.<br /> Le mot de passe ou le pseudo 
            entré n\'est pas correcte.</p><p>Cliquez <a href="./connexion.php">ici</a> 
	    pour revenir à la page précédente
	    <br /><br />Cliquez <a href="../index.php">ici</a> 
	    pour revenir à la page d accueil</p>';
	}
    $query->CloseCursor();
    }
    echo $message.'</div></body></html>';

}
?>
