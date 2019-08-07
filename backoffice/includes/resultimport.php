<section id="result">

		<h3 style="text-align: center; margin-bottom: 1em;"> Nombre de lignes traitées : <b><?= $cpt; ?></b><br><small><a class="newImport" href="trombiback.php?nav=update">>>Nouvelle importation</a></small></h3> 

		<div class="row">
			<div class="col-md-6">
				<div style="text-align: center;">
					<button class="btnToggle" type="button" data-toggle="collapse" data-target="#collapseDoublon" aria-expanded="false" aria-controls="collapseDoublon">



					<?php 
					if (count($doublons['login'])>1) {
						$messageDoublon = count($doublons['login'])." doublons n'ont pas été insérés";
					}
					else{
						$messageDoublon = count($doublons['login'])." doublon n'a pas été inséré";
					}
					?>

					<?= !empty($doublons['login'])?$messageDoublon:"Aucun doublon trouvé"; ?>


					</button>
				</div>
				<div class="collapse" id="collapseDoublon">
			
						<table id="tableDoublon" class="table table-striped" style="margin: auto;">
							<thead>
								
								<tr>
									<th scope="col">Nom</th>
									<th scope="col">Prénom</th>
									<th scope="col">Email</th>
									<th scope="col">Fonction</th>
									<th scope="col">Télephone</th>
									<th scope="col">Bureau</th>
								</tr>
							</thead>
							<tbody>
						<?php
						for ($i=0; $i < count($doublons['login']); $i++) { 
						?>
							<tr>
								<td><?= $doublons['nom'][$i] ?></td>
								<td><?= $doublons['prenom'][$i] ?></td>
								<td style="max-width: 200px !important;"><?= $doublons['mail'][$i] ?></td>
								<td><?= $doublons['fonction'][$i] ?></td>
								<td><?= $doublons['telephone'][$i] ?></td>
								<td><?= $doublons['bureau'][$i] ?></td>
							</tr>
						<?php


						}
						?>
							</tbody>
						</table>

						
					
				</div>
			</div>

				<div class="col-md-6">
					<div style="text-align: center;">
						<button class="btnToggle" type="button" data-toggle="collapse" data-target="#collapseInserted" aria-expanded="false" aria-controls="collapseInserted">
						
						<?php 
						if (count($tabAdd['login'])>1) {
							$messageAdd = count($tabAdd['login'])." lignes ont été insérées";
						}
						else{
							$messageAdd = count($tabAdd['login'])." ligne a été insérée";
						}
						?>

						<?= !empty($tabAdd['login'])?$messageAdd:"Aucune ligne insérée"; ?>

						</button>	
					</div>
				<div class="collapse" id="collapseInserted">
				  
						<table id="tableInsert" class="table table-striped " style="margin: auto;">
							<thead>
			
							<tr>
									<th>Nom</th>
									<th>Prénom</th>
									<th>Email</th>
									<th>Fonction</th>
									<th>Télephone</th>
									<th>Bureau</th>
							</tr>
							</thead>
						<?php
				
						for ($i=0; $i < count($tabAdd['login']); $i++) { 
						?>
							<tr>							
								<td><?= $tabAdd['nom'][$i] ?></td>
								<td><?= $tabAdd['prenom'][$i] ?></td>							
								<td><?= $tabAdd['mail'][$i] ?></td>
								<td><?= $tabAdd['fonction'][$i] ?></td>
								<td><?= $tabAdd['telephone'][$i] ?></td>
								<td><?= $tabAdd['bureau'][$i] ?></td>
							</tr>
						<?php


						}
						?>
						</table>
					
				</div>
			</div>
		</div>
		
	</section>