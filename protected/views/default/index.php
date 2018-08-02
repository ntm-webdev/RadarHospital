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

    	<?=CHtml::activeHiddenField($model, 'latitude')?>
    	<?=CHtml::activeHiddenField($model, 'longitude')?>

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
	  		<?=CHtml::checkBox('radioLocation',false, ['class'=>'form-check-input'])?>
			<?=CHtml::label('Buscar hospitais através de minha posição atual?','lblPosition',['class'=>'text-beauty form-check-label'])?>
		</div>

	  	<div class="form-group">
	  		<?=CHtml::submitButton('Pesquisar', ['class'=>'btn btn-success', 'id'=>'btnPesq1'])?>
		</div>

		
	<?php $this->endWidget() ?>
</div>
<?php

    Yii::app()->clientScript->registerScript('askGeolocation', '
        
        var options = {
          enableHighAccuracy: true,
          timeout: 5000,
          maximumAge: 0
        };

        function success(pos) {
        	var crd = pos.coords;

          	$("#hospital_latitude").val(crd.latitude);	
          	$("#hospital_longitude").val(crd.longitude);	
        };

        function error(err) {
          console.warn(err.message);
        };

        $("#radioLocation").on("change", function() {
        	if(this.checked) {
        		$("#hospital__regiao").prop("disabled", true);
            	navigator.geolocation.getCurrentPosition(success, error, options);
        	} else {
        		$("#hospital__regiao").prop("disabled", false);

        		$("#hospital_latitude").val("");	
            	$("#hospital_longitude").val("");
        	}
        	
        });
    ');
?>	