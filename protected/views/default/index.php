<div class="container">
	<a href="http://localhost/RadarHospital/index.php/default/userArea">
		<span class="text-beauty pull-right">
			<i class="fa fa-fw fa-lg pointer fa-user"></i>
			<?=(Yii::app()->user->hasState("id") ? Yii::app()->user->getState("nome") : "Faça seu Login") ?>
		</span>
	</a>
	<br>
	<img style="height: 230px" src="<?= Yii::app()->theme->baseUrl?>/imgs/main-logo.png" alt="Radar Hospital" class="img img-responsive center">
	
	<?php $form=$this->beginWidget("CActiveForm", array(
        'action' => Yii::app()->createUrl("Default/resultado"),
        'method' => 'POST',
        'htmlOptions'=> [
            'class' => 'form-centered',
            'id' => 'form-index',
        ],
    )) ;?>

		<div class="form-group">
			<?=CHtml::activeLabel($model, 'nome', ['class'=>'text-beauty'])?>
			<?=CHtml::activeTextField($model, 'nome', ['class'=>'form-control', 'empty'=>'Selecione ---'])?>
		</div>
		

		<div class="form-group">
			<?=CHtml::activeLabel($model, '_plano_saude', ['class'=>'text-beauty'])?>
			<?=CHtml::activeDropDownList($model, '_plano_saude', CHtml::ListData(plano_saude::model()->findAll(), 'nome', 'nome'),['class'=>'form-control', 'empty'=>'Selecione ---'])?>
	  	</div>
		

		<div class="form-group">
			<?=CHtml::activeLabel($model, '_regiao', ['class'=>'text-beauty']);?>
		    <?=CHtml::activeDropDownList($model, '_regiao', CHtml::ListData(regiao::model()->findAll(), 'nome', 'nome'),['class'=>'form-control', 'empty'=>'Selecione ---'])?>
	  	</div>
	  	
	  	<div class="form-group">
	  		<?=CHtml::submitButton('Pesquisar', ['class'=>'btn btn-success'])?>
		</div>
		
	<?php $this->endWidget() ?>
</div>	