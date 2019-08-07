<?php
session_start();

if(!isset($_SESSION['id'])) //Si pas d'utilisateur connecté on renvoie vers la connexion
{
	header('Location: connexion.php');
	exit();
}
$titre="Trombinoscope - Administration"; //titre de la page (utilisé dans debut.php)
include("includes/debut.php"); // Inclusion du debut de page commun a toutes les pages
include("includes/connexionDb.php"); //Connexion BDD
?>

<!--************************** -->
<!-- IMAGE -->
<!--************************** -->


<div class="container" style="text-align: center;min-width: 950px;">
	<div class="panel panel-default">

	  <div style="margin: 2em 0em;" class="panel-heading">Pour ajouter une photo, choisissez une photo puis validez le recadrage, le résultat s'affiche à droite : </div>
	 	<div style="text-align:center;margin-bottom: 1em;">
			<strong>Selectionnez une image :</strong>			
			<input name="imgSrc" type="file" class="upload" idbtn="newStaff">
	 	</div>

	  <div class="panel-body">
	  	<div class="row">
	  		<div class="col-md-5 text-center">
				<div id="upload-demo_newStaff" style="width:400px"></div>	  	
	  		</div>

	  		<div class="col-md-2" style="min-width:10em;text-align: center;margin-top: 5em;">
	  			<strong>Valider le cadrage : </strong><br><br>
	  			<a class="btnImport upload-result" idbtn="newStaff">Ok <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
	  		</div>


	  		<div class="col-md-5" style="">
				<div id="upload-demo-i_newStaff" style="padding: 20px 0px 0px 40px; background:#e1e1e1;width:350px;height:350px;"></div>
	  		</div>
	  		<div >
	  			<input id="cropped" name="croppedPicture" type="hidden">

	  		</div>
	  	</div>
	  </div>
	</div>
</div>


<div class="container" style="text-align: center;min-width: 950px;">
	<div class="panel panel-default">

	  <div style="margin: 2em 0em;" class="panel-heading">Pour ajouter une photo, choisissez une photo puis validez le recadrage, le résultat s'affiche à droite : </div>
	 	<div style="text-align:center;margin-bottom: 1em;">
			<strong>Selectionnez une image :</strong>			
			<input name="imgSrc" type="file" class="upload" idbtn="20">
	 	</div>

	  <div class="panel-body">
	  	<div class="row">
	  		<div class="col-md-5 text-center">
				<div id="upload-demo_20" style="width:400px"></div>	  	
	  		</div>

	  		<div class="col-md-2" style="min-width:10em;text-align: center;margin-top: 5em;">
	  			<strong>Valider le cadrage : </strong><br><br>
	  			<a class="btnImport upload-result" idbtn="20">Ok <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
	  		</div>


	  		<div class="col-md-5" style="">
				<div id="upload-demo-i_20" style="padding: 20px 0px 0px 40px; background:#e1e1e1;width:350px;height:350px;"></div>
	  		</div>
	  		<div >
	  			<input id="cropped" name="croppedPicture" type="hidden">

	  		</div>
	  	</div>
	  </div>
	</div>
</div>
<!--
	width: 345,
	height: 375,
	width: 800,
	height: 600
    -->

<script type="text/javascript">
	/*
$uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
        width: 276, //345
        height: 300, //375
        type: 'square'
    },
    boundary: {
        width: 350,
        height: 350
    }
});


$('#upload').on('change', function () { 
	var reader = new FileReader();
    reader.onload = function (e) {
    	$uploadCrop.croppie('bind', {
    		url: e.target.result
    	}).then(function(){
    		console.log('jQuery bind complete');
    	});
    	
    }
    reader.readAsDataURL(this.files[0]);
});


$('.upload-result').on('click', function (ev) {
	$uploadCrop.croppie('result', {
		type: 'canvas',
		size: 'viewport'
	}).then(function (resp) {


		$.ajax({
			url: "ajaxpro.php",
			type: "POST",
			data: {"image":resp},
			dataType: 'html',
	
			success: function (data) {
				
				html = '<img src="' + resp + '" />';
				$("#upload-demo-i").html(html);
				//$('<input name="croppedPicture" type="hidden" value="'+ data +'">').appendTo("#cropped"); // On passe code_html à jQuery() qui va nous créer l'arbre DOM !
				$("#cropped").val(data); 
			}


		});
	});
});
*/

</script>


</body>





<script>




$('.upload').on('change', function (e) { 

		var idStaff = $(this).attr('idbtn');
		alert(idStaff);

		var uploadDemo = $('#upload-demo_'+idStaff)


		$uploadCrop = $(uploadDemo).croppie({
	    enableExif: true,
	    viewport: {
	        width: 276, //345
	        height: 300, //375
	        type: 'square'
	    },
	    boundary: {
	        width: 350,
	        height: 350
	    }
	});

	var reader = new FileReader();

    reader.onload = function (e) {
    	$uploadCrop.croppie('bind', {
    		url: e.target.result
    	}).then(function(){
    		console.log('jQuery bind complete');
    	});
    	
    }
    reader.readAsDataURL(this.files[0]);
});


$('.upload-result').on('click', function (ev) {
	var idStaff = $(this).attr('idbtn');
	var uploadResult = $('#upload-demo-i_'+idStaff)
	alert(uploadResult);

	$uploadCrop.croppie('result', {
		type: 'canvas',
		size: 'viewport'
	}).then(function (resp) {


		$.ajax({
			url: "ajaxpro.php",
			type: "POST",
			data: {"image":resp},
			dataType: 'html',
	
			success: function (data) {
				
				html = '<img src="' + resp + '" />';
				$(uploadResult).html(html);
				//$('<input name="croppedPicture" type="hidden" value="'+ data +'">').appendTo("#cropped"); // On passe code_html à jQuery() qui va nous créer l'arbre DOM !
				$("#cropped").val(data); 
			}


		});
	});
});



//});


</script>





</html>