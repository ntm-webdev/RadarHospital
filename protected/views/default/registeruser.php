<div class="container">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'method'=>'POST',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>

		<div class="form-group">
			<h2 class="text-beauty">Cadastre-se</h2>
			<br>
			<?=CHtml::activeLabel($model, 'nome', ['class'=>'text-beauty'])?>
			<?=CHtml::activeTextField($model, 'nome', ['class'=>'form-control'])?>
			<?=$form->error($model,'nome'); ?>
		</div>

		<div class="form-group">
			<?=CHtml::activeLabel($model, 'email', ['class'=>'text-beauty'])?>
			<?=CHtml::activeEmailField($model, 'email', ['class'=>'form-control'])?>
			<?=$form->error($model,'email'); ?>
		</div>

		<div class="form-group">
			<?=CHtml::activeLabel($model, 'confEmail', ['class'=>'text-beauty'])?>
			<?=CHtml::activeEmailField($model, 'confEmail', ['class'=>'form-control'])?>
			<?=$form->error($model,'confEmail'); ?>
		</div>

		<div class="form-group">
			<?=CHtml::activeLabel($model, 'pwd', ['class'=>'text-beauty'])?>
			<?=CHtml::activePasswordField($model, 'pwd', ['class'=>'form-control'])?>
			<?=$form->error($model,'pwd'); ?>
		</div>

		<div class="form-group">
			<?=CHtml::activeLabel($model, 'confPwd', ['class'=>'text-beauty'])?>
			<?=CHtml::activePasswordField($model, 'confPwd', ['class'=>'form-control'])?>
			<?=$form->error($model,'confPwd'); ?>
		</div>

		<div class="form-group">		
			<label class="text-beauty">Plano de Saude</label>
			<?=CHtml::activeDropDownList($model, 'id_planosaude', [
					CHtml::listData(plano_saude::model()->findAll(), 'id', 'nome') 
				],['class'=>'form-control'])
			?>
			<?=$form->error($model,'id_planosaude'); ?>
		</div>

		<div class="form-group">
			<label class="text-beauty">Região</label>
			<?=CHtml::activeDropDownList($model, 'id_regiao', [
					CHtml::listData(regiao::model()->findAll(), 'id', 'nome') 
				],['class'=>'form-control'])
			?>
			<?=$form->error($model,'id_regiao'); ?>
		</div>

		<div class="form-group">
			<label class="text-beauty">Bairro</label>
			<?=CHtml::activeDropDownList($model, 'id_bairro', [
					CHtml::listData(bairro::model()->findAll(), 'id', 'nome') 
				],['class'=>'form-control'])
			?>
			<?=$form->error($model,'id_bairro'); ?>
		</div>

		<div class="form-group">
			<?=CHtml::submitButton('Enviar', ['class'=>'btn btn-success', 'id'=>'btnRegisterUser'])?>
		</div>
	<?php $this->endWidget(); ?>
</div>

<?php
	
	Yii::app()->clientScript->registerScript('registerUser', '
		
		$("#btnRegisterUser").on("click", function(){
			$.post("'.Yii::app()->createUrl("Default/registerUser").'");
		});
	');

?>