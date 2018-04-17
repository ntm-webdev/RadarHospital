<div class="container">
	<img style="height: 230px" src="<?= Yii::app()->theme->baseUrl?>/imgs/main-logo.png" alt="Radar Hospital" class="img img-responsive center">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'action' => Yii::app()->createUrl('/Default/Resultado'),
		'method' => 'POST'
	)) ?>
		<div class="form-group">
			<?=CHtml::activeLabel($model, 'nome', ['class'=>'text-beauty'])?>
			<?=CHtml::activeTextField($model, 'nome', ['class'=>'form-control', 'empty'=>'Selecione ---'])?>
		</div>
		

		<div class="form-group">
			<?=CHtml::activeLabel($model, 'filtros[plano_saude]', ['class'=>'text-beauty'])?>
			<?=CHtml::activeDropDownList($model, 'filtros[plano_saude]', CHtml::ListData($planos, 'nome', 'nome'),['class'=>'form-control', 'empty'=>'Selecione ---'])?>
	  	</div>
		

		<div class="form-group">
			<?=CHtml::activeLabel($model, 'filtros[regiao]', ['class'=>'text-beauty']);?>
		    <?=CHtml::activeDropDownList($model, 'filtros[regiao]', CHtml::ListData($regioes, 'nome', 'nome'),['class'=>'form-control', 'empty'=>'Selecione ---'])?>
	  	</div>
	  	
	  	<div class="form-group">
	  		<?=CHtml::submitButton('Pesquisar', ['class'=>'btn btn-success'])?>
		</div>
	<?php $this->endWidget() ?>
</div>	