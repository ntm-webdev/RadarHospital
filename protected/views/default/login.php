<?php if(Yii::app()->user->hasState("nome")) : 
	$this->redirect(["resultado"]);
else : ?>
	<div class="container">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'login-form',
			'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
			'htmlOptions'=> [
				'class' => 'form-centered',
			]
		)); ?>
			<div class="form-group">
				<h2 class="text-beauty">Faça seu Login</h2>
				<br>
				<?=$form->labelEx($model,'username', ['class'=>'text-beauty']); ?>
				<?=$form->textField($model,'username', ['class'=>'form-control']); ?>
				<?=$form->error($model,'username'); ?>
			</div>

			<div class="form-group">
				<?=$form->labelEx($model,'password',['class'=>'text-beauty']); ?>
				<?=$form->passwordField($model,'password',['class'=>'form-control']); ?>
				<?=$form->error($model,'password'); ?>
			</div>

			<div class="form-group">
				<?=CHtml::submitButton('Enviar', ['class'=>'btn btn-success'])?>
			</div>

			<div class="form-group">
				<?=CHtml::tag("a", ['class'=>'text-beauty', 'href'=>'http://localhost/RadarHospital/index.php/default/registerUser'], "Ainda não se cadastrou? Clique aqui e faça seu cadastro");?>
			</div>
		<?php $this->endWidget(); ?>
	</div>
<?php endif; ?>
