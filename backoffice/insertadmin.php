<?php
session_start();

$titre="Ajouter un administrateur";
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
/*
if (!isset($_POST['pseudo'])) //On est dans la page de formulaire
{
?>

		<form  id="connectionForm" method="post" action="insertadmin.php">
		
			<h4>Ajout admin</h4>

			 <div class="form-group">
				<label for="pseudo">Login</label>
				<input class="form-control" name="pseudo" type="text" id="pseudo" placeholder="Login.." >
			</div>

			 <div class="form-group">
			 	<label for="password">Mot de Passe :</label>
			 	<input class="form-control" type="password" name="password" id="password" >
			 </div>
				
		
			
				<input class="btnImport" type="submit" value="ajouter" >
		
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
        $message = '<p>
	Vous devez remplir tous les champs</p>
	<p>Cliquez <a href="./insertadmin.php">ici</a> pour revenir</p>';
    }
    else //On check le mot de passe
    {
        $query=$conn->prepare('INSERT INTO `trombi`.`user` ( `username`, `password` ) VALUES (:pseudo, :password ); ');
        $query->bindValue(':pseudo',$_POST['pseudo'], PDO::PARAM_STR);
        $query->bindValue(':password',md5($_POST['password']), PDO::PARAM_INT);
    
		

		if ($query->execute()) {
			
		    $message = '<p>L\'utilisateur '.$data['username'].', 
				a bien été ajouté</p>
				<p>Cliquez <a href="../index.php">ici</a> 
				pour revenir à la page d accueil</p>';  
		}
		
		else 
		{
		    $message = '<p>Une erreur s\'est produite 
		    pendant l\'ajout du nouvel utilisateur.<br />Cliquez <a href="../index.php">ici</a> 
		    pour revenir à la page d accueil</p>';
		}

	    $query->CloseCursor();
    }
    echo $message.'</div></body></html>';

}


*/
?>
