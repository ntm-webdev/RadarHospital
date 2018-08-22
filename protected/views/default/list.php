<div class="row">
	<div class="media resultado">
	 	<div class="media-left">
	      	<img class="media-object" src="<?=Yii::app()->theme->baseUrl?>/imgs/hosp/<?=$data->nome?>/1.jpg" alt="<?=$data->nome?>" width="129" height="110">
	  	</div>
	  	<div class="media-body">
	    	<h5 class="media-heading text-beauty"><i class="fa fa-fw fa-h-square"></i> <?=$data->nome?></h5>
		    <p>
		    	<h5 class="media-heading text-beauty">
					<i class="fa fa-fw fa-map-marker"></i> <b class="text-beauty">Endereço:</b> <?="<span style='color: #333'>".$data->endereco."</span>"?>
					<br>
					<i class="fa fa-fw fa-location-arrow"></i> <b class="text-beauty">Bairro:</b> <?="<span style='color: #333'>".$data->fkbairro->nome."</span>"?>
				</h5>
			</p>

			<h5 class="media-heading text-beauty"><i class="fa fa-fw fa-heartbeat"></i> Planos:
			<?php
				$data->getRelated("fkplanosaude", true);
				$planos = [];
				 
				foreach ($data->fkplanosaude as $plano) : 
					$planos[] = $plano->nome;
				endforeach;


				$str = implode(",", $planos);
				echo "<span style='color: #333'>".$str."</span>";
			?>
			</h5>
	  	</div>
	  	<hr>
	  	<?=CHtml::link("Detalhes", ['default/view', 'id'=>$data->id], ['class'=>'btn btn-success pull-right'])?>
	</div>

	<p></p>
</div>