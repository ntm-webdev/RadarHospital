<div class="container">
	<?php 
		$form = $this->beginWidget("CActiveForm", [
			'method' => 'POST',
			'action' => Yii::app()->createUrl("Default/registerUser"),
		]);
	?>
		<div class="form-group">
			<h2 class="text-beauty">Cadastre-se</h2>
			<br>
			<?=CHtml::activeLabel($model, 'nome', ['class'=>'text-beauty'])?>
			<?=CHtml::activeTextField($model, 'nome', ['class'=>'form-control'])?>
		</div>

		<div class="form-group">
			<?=CHtml::activeLabel($model, 'email', ['class'=>'text-beauty'])?>
			<?=CHtml::activeEmailField($model, 'email', ['class'=>'form-control'])?>
		</div>

		<div class="form-group">
			<?=CHtml::activeLabel($model, 'pwd', ['class'=>'text-beauty'])?>
			<?=CHtml::activePasswordField($model, 'pwd', ['class'=>'form-control'])?>
		</div>

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
			<?=CHtml::submitButton('Enviar', ['class'=>'btn btn-success'])?>
		</div>
	<?php $this->endWidget(); ?>
</div>