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
		    		
	<div>
		<p class="text-beauty">Informações gerais</p>
		<p><b>Nome:</b> <?=$model->nome?></p>
		<p><b>Região:</b> <?=$model->fkregiao->nome?></p>
		<p><b>Bairro:</b> <?=$model->fkbairro->nome?></p>
		<p><b>Endereço:</b> <?=$model->endereco?></p>
		<hr>
	</div>

	<div>
		<p class="text-beauty">Horário de Funcionamento</p>
		<?php foreach ($periodo as $key => $value) : ?>
			<?="<p><b>".$dias[$value->id_dia_da_semana].": </b> ".$value->horario_inicial." às ". $value->horario_final . "</p>";?>
		<?php endforeach; ?>
		<hr>
	</div>

	<div>
		<p class="text-beauty">Especialidades</p>
		<?php 
			if (!empty($model->fkespecialidade)) :
				foreach($model->fkespecialidade as $especialidade) : ?>
					<p><?=$especialidade->nome?></p>	
		<?php   endforeach; 
			endif; ?>
		<hr>
	</div>

	<div>
		<p class="text-beauty">Planos de Saúde</p>
		<?php 
			if(!empty($model->fkplanosaude)) :
				foreach($model->fkplanosaude as $plano) : ?>
					<p><?=$plano->nome?></p>	
		<?php   endforeach; 
			endif?>
		<hr>
	</div>

	<div>
		<p class="text-beauty">Contato</p>
		<p><i class="fa fa-link"></i> <?=CHtml::tag('a',['href'=>$model->site], 'Website')?></p>
		<p><i class="fa fa-phone"></i> <?=$model->telefone?></p>
		<hr>
	</div>
</div>