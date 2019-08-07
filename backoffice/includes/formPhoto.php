<!--************************** -->
<!-- IMAGE -->
<!--************************** -->


<div class="container" style="text-align: center;min-width: 950px;">
	<div class="panel panel-default">

	  <div style="margin: 2em 0em;" class="panel-heading">Pour ajouter une photo, choisissez une photo puis validez le recadrage, le résultat s'affiche à droite : </div>
	 	<div style="text-align:center;margin-bottom: 1em;">
			<strong>Selectionnez une image :</strong>			
			<input name="imgSrc" type="file" id="upload">
	 	</div>

	  <div class="panel-body">
	  	<div class="row">
	  		<div class="col-md-5 text-center">
				<div id="upload-demo" style="width:400px"></div>	  	
	  		</div>

	  		<div class="col-md-2" style="min-width:10em;text-align: center;margin-top: 5em;">
	  			<strong>Valider le cadrage : </strong><br><br>
	  			<a class="btnImport upload-result">Ok <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
	  		</div>


	  		<div class="col-md-5" style="">
				<div id="upload-demo-i" style="padding: 20px 0px 0px 40px; background:#e1e1e1;width:350px;height:350px;"></div>
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


</script>

<!--************************** -->
<!-- IMAGE FIN -->
<!--************************** -->