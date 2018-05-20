<?php if(Yii::app()->user->hasState('nome')) : ?>
	<div class="container">
		<?php 
			$form = $this->beginWidget("CActiveForm", [
				'method' => 'GET',
				'action' => Yii::app()->createUrl("Default/evaluate", ['idHospital'=>$_GET['idHospital']]),
				'htmlOptions' => [
					'id' => 'evaluate-form',
					'class' => 'form-centered',
				]
			]);
		?>
			<div class="form-group">
				<h2 class="text-beauty">Deixe sua opinião</h2>
				<br>
				<?=CHtml::activeLabel($model, 'atendimento', ['class'=>'text-beauty'])?>
				<?=CHtml::activeDropDownList($model, 'atendimento',[
					1 => '&#xf005;&#xf006;&#xf006;&#xf006;',
					2 => '&#xf005;&#xf005;&#xf006;&#xf006;',
					3 => '&#xf005;&#xf005;&#xf005;&#xf006;',
					4 => '&#xf005;&#xf005;&#xf005;&#xf005;',
					],['class'=>'form-control select-evaluate', 'encode'=>false])
				?>
			</div>

			<div class="form-group">
				<?=CHtml::activeLabel($model, 'atendimento_medico', ['class'=>'text-beauty'])?>
				<?=CHtml::activeDropDownList($model, 'atendimento_medico',[
					1 => '&#xf005;&#xf006;&#xf006;&#xf006;',
					2 => '&#xf005;&#xf005;&#xf006;&#xf006;',
					3 => '&#xf005;&#xf005;&#xf005;&#xf006;',
					4 => '&#xf005;&#xf005;&#xf005;&#xf005;',
					],['class'=>'form-control select-evaluate', 'encode'=>false])
				?>
			</div>

			<div class="form-group">
				<?=CHtml::activeLabel($model, 'higiene', ['class'=>'text-beauty'])?>
				<?=CHtml::activeDropDownList($model, 'higiene',[
					1 => '&#xf005;&#xf006;&#xf006;&#xf006;',
					2 => '&#xf005;&#xf005;&#xf006;&#xf006;',
					3 => '&#xf005;&#xf005;&#xf005;&#xf006;',
					4 => '&#xf005;&#xf005;&#xf005;&#xf005;',
					],['class'=>'form-control select-evaluate', 'encode'=>false])
				?>
			</div>

			<div class="form-group">
				<?=CHtml::activeLabel($model, 'infraestrutura', ['class'=>'text-beauty'])?>
				<?=CHtml::activeDropDownList($model, 'infraestrutura',[
					1 => '&#xf005;&#xf006;&#xf006;&#xf006;',
					2 => '&#xf005;&#xf005;&#xf006;&#xf006;',
					3 => '&#xf005;&#xf005;&#xf005;&#xf006;',
					4 => '&#xf005;&#xf005;&#xf005;&#xf005;',
					],['class'=>'form-control select-evaluate', 'encode'=>false])
				?>
			</div>

			<div class="form-group">
				<?=CHtml::activeLabel($model, 'descricao', ['class'=>'text-beauty'])?>
				<?=CHtml::activeTextArea($model, 'descricao', ['class'=>'form-control'])?>
			</div>

			<div class="form-group">
				<?=CHtml::submitButton('Enviar', ['class'=>'btn btn-success'])?>
			</div>
		<?php $this->endWidget(); ?>
	</div>
<?php else : 
	$this->redirect(['login']);
endif;
?>