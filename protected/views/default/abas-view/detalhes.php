<?php
	$criteria = new CDbCriteria;
	$criteria->addCondition('id_hospital =:id');
	$criteria->params = [
		':id' => $model->id
	]; 
	$periodo = periodo::model()->findAll($criteria);

	$dias = [
		1 => 'Domingo',
		2 => 'Segunda-Feira',
		3 => 'Terça-Feira',
		4 => 'Quarta-Feira',
		5 => 'Quinta-Feira',
		6 => 'Sexta-Feira',
		7 => 'Sábado',
	];
?>

<div class="row row-avaliacoes">
		    		
	<div class="col-xs-12 no-padding-left">
		<p class="text-beauty">Informações gerais</p>
		<p><b>Nome:</b> <?=$model->nome?></p>
		<p><b>Região:</b> <?=(!empty($model->fkregiao)) ? $model->fkregiao->nome : "" ?></p>
		<p><b>Bairro:</b> <?=(!empty($model->fkbairro)) ? $model->fkbairro->nome : "" ?></p>
		<p><b>Endereço:</b> <?=$model->endereco?></p>
		<p><b>Site:</b> <?=CHtml::tag('a',['href'=>$model->site, 'target'=>'_blank', 'class'=>'text-beauty'], 'Website')?></p>
		<p><b>Telefone:</b> <?=$model->telefone?></p>
		<hr>
	</div>

	<div class="col-xs-12 no-padding-left">
		<p class="text-beauty">Horário de Funcionamento</p>
		<?php foreach ($periodo as $key => $value) : ?>
			<?php $value->horario_final = ($value->horario_inicial== "00:00" && $value->horario_final == "00:00") ? "23:59" : $value->horario_final ?>
			<?="<p><b>".$dias[$value->id_dia_da_semana].": </b> ".$value->horario_inicial." às ". $value->horario_final . "</p>";?>
		<?php endforeach; ?>
		<hr>
	</div>
	<hr>
	<div id="especialidade-area" class="col-xs-12">
		<div class="row no-padding-left">
			<div class="col-xs-6 no-padding-left">
				<p class="text-beauty">Especialidades</p>
				<?php 
					if (!empty($model->fkespecialidade)) :
						foreach($model->fkespecialidade as $especialidade) : ?>
							<p class="especs"><?=$especialidade->nome?></p>	
				<?php   endforeach; 
					endif; ?>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-8"></div>
			<div class="col-xs-4">
				<span style="display: none; cursor: pointer;" id="vejaMaisEspecialidade" class="text-beauty" data-toggle="modal" data-target="#modalEspecialidade">Veja Mais(+)</span>
			</div>
		</div>
	</div>

	<!-- Modal Especialidade-->
	<div class="modal fade" id="modalEspecialidade" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title text-beauty" id="exampleModalLabel">Especialidades</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body" style="overflow: scroll;">
	      		<?php 
				if (!empty($model->fkespecialidade)) :
					foreach($model->fkespecialidade as $especialidade) : ?>
						<p class=""><?=$especialidade->nome?></p>	
			<?php   endforeach; 
				endif; ?>
	      </div>
	    </div>
	  </div>
	</div>

	<div id="planoSaude-area" class="col-xs-12">
		<hr>
		<div class="row no-padding-left">
			<div class="col-xs-6 no-padding-left">
				<p class="text-beauty">Planos de Saúde</p>
				<?php 
					if(!empty($model->fkplanosaude)) :
						foreach($model->fkplanosaude as $plano) : ?>
							<p class="planos"><?=$plano->nome?></p>	
				<?php   endforeach; 
					endif?>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-8"></div>
			<div class="col-xs-4">
				<span style="display: none; cursor: pointer;" id="vejaMaisPlanoSaude" class="text-beauty" data-toggle="modal" data-target="#modalPlanoSaude">Veja Mais(+)</span>
			</div>
		</div>
	</div>

	<!-- Modal Plano de Sáude-->
	<div class="modal fade" id="modalPlanoSaude" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title text-beauty" id="exampleModalLabel">Planos de Saúde</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body" style="overflow: scroll;">
	      		<?php 
					if(!empty($model->fkplanosaude)) :
						foreach($model->fkplanosaude as $plano) : ?>
							<p><?=$plano->nome?></p>	
				<?php   endforeach; 
					endif?>
	      </div>
	    </div>
	  </div>
	</div>
</div>

<?php

	Yii::app()->clientScript->registerScript('abbr', '
		if ($("#especialidade-area").find(".especs").length >= 5) {
			$("#vejaMaisEspecialidade").css("display","");
			$("#especialidade-area .especs:eq(4)").append("<span>...</span>");
			$("#especialidade-area .especs").not("#especialidade-area .especs:eq(0), #especialidade-area .especs:eq(1), #especialidade-area .especs:eq(2), #especialidade-area .especs:eq(3), #especialidade-area .especs:eq(4)").css("display","none");
		}

		if ($("#planoSaude-area").find(".planos").length >= 5) {
			$("#vejaMaisPlanoSaude").css("display","");
			$("#planoSaude-area .planos:eq(4)").append("<span>...</span>");
			$("#planoSaude-area .planos").not("#planoSaude-area .planos:eq(0), #planoSaude-area .planos:eq(1), #planoSaude-area .planos:eq(2), #planoSaude-area .planos:eq(3), #planoSaude-area .planos:eq(4)").css("display","none");
		}
	');