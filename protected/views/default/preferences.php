<div class="container">
	<h2 class="text-beauty">Olá, <?=$model->nome?> suas informações estão corretas?</h2>
	<br>
	<?php 
		$form = $this->beginWidget("CActiveForm", [
			'method' => 'POST',
			'action' => Yii::app()->createUrl("Default/preferences"),
			'htmlOptions' => [
				'id' => 'preferences-form'
			]
		]);
	?>
		<div class="form-group">
			<label class="text-beauty">Plano de Saude</label>
			<?=CHtml::activeDropDownList($model, 'id_planosaude', [
					CHtml::listData(plano_saude::model()->findAll(), 'id', 'nome') 
				],['class'=>'form-control'])
			?>
		</div>

		<div class="form-group">
			<label class="text-beauty">Região</label>
			<?=CHtml::activeDropDownList($model, 'id_regiao', [
					CHtml::listData(regiao::model()->findAll(), 'id', 'nome') 
				],['class'=>'form-control'])
			?>
		</div>

		<div class="form-group">
			<label class="text-beauty">Bairro</label>
			<?=CHtml::activeDropDownList($model, 'id_bairro', [
					CHtml::listData(bairro::model()->findAll(), 'id', 'nome') 
				],['class'=>'form-control'])
			?>
		</div>

		<div class="form-group">
			<?=CHtml::submitButton('Gravar', ['class'=>'btn btn-success'])?>
		</div>
	<?php $this->endWidget(); ?>
</div>