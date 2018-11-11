<?php 
	
	if (empty($data->fkfavoritos)) :
		echo "<p>Não há hospitais em sua lista de favoritos.</p>";
	else :
		foreach ($data->fkfavoritos as $hospital) : ?>
			<div class="row">
				<div class="media resultado">
				 	<div class="media-left">
				      	<img class="media-object" src="<?=Yii::app()->theme->baseUrl?>/imgs/hospital.jpg" alt="...">
				  	</div>
				  	<div class="media-body">
				    	<h5 class="media-heading text-beauty"><i class="fa fa-fw fa-h-square"></i> <?=$hospital->nome?> </h5>
					    <p>
							<i class="fa fa-fw fa-map-marker"></i> <b class="text-beauty">Endereço:</b> <?=$hospital->endereco?>
							<br>
							<i class="fa fa-fw fa-location-arrow"></i> <b class="text-beauty">Bairro:</b> <?=$hospital->fkbairro->nome?>	
						</p>

						<h5 class="media-heading text-beauty"><i class="fa fa-fw fa-heartbeat"></i> Planos:</h5>
						<?php
							$hospital->getRelated("fkplanosaude", true);
							$planos = [];
							 
							foreach ($hospital->fkplanosaude as $plano) : 
								$planos[] = $plano->nome;
							endforeach;


							$str = implode(",", $planos);
							echo "<div class='content-planos'>".$str."</div>";
						?>
				  	</div>
				  	<hr>
				  	<?=CHtml::link("Detalhes", ['default/view', 'id'=>$hospital->id], ['class'=>'btn btn-success pull-right'])?>
				</div>

				<p></p>
			</div>
	<?php 
		endforeach;
	endif; 
	?>