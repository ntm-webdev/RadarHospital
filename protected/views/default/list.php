<div class="row">
	<div class="media resultado">
	 	<div class="media-left">
	      	<img class="media-object" src="<?=Yii::app()->theme->baseUrl?>/imgs/hospital.jpg" alt="...">
	  	</div>
	  	<div class="media-body">
	    	<h5 class="media-heading text-beauty"><i class="fa fa-fw fa-h-square"></i> <?=$data->nome?></h5>
		    <p>
				<i class="fa fa-fw fa-map-marker"></i> <b class="text-beauty">Endereço:</b> <?=$data->endereco?>
				<br>
				<i class="fa fa-fw fa-location-arrow"></i> <b class="text-beauty">Bairro:</b> <?=$data->fkbairro->nome?>
			</p>

			<h5 class="media-heading text-beauty"><i class="fa fa-fw fa-heartbeat"></i> Planos:</h5>
			<?php
				$data->getRelated("fkplanosaude", true);
				$planos = [];
				 
				foreach ($data->fkplanosaude as $plano) : 
					$planos[] = $plano->nome;
				endforeach;


				$str = implode(",", $planos);
				echo trim(str_replace(' ', '', $str));
			?>
	  	</div>
	  	<hr>
	  	<?=CHtml::link("Detalhes", ['default/view', 'id'=>$data->id], ['class'=>'btn btn-success pull-right'])?>
	</div>

	<p></p>
</div>