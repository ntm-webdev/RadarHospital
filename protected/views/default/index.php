<div class="container">
	<a href="http://localhost/RadarHospital/index.php/default/userArea">
		<span class="text-beauty pull-right">
			<i class="fa fa-fw fa-lg pointer fa-user"></i>
			<?=(Yii::app()->user->hasState("id") ? "Olá, ".Yii::app()->user->getState("nome") : "Faça seu Login") ?>
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
            <?=CHtml::checkBox('radioLocation',false, ['class'=>'form-check-input'])?>
            <?=CHtml::label('Buscar hospitais através de minha posição atual?','lblPosition',['class'=>'text-beauty form-check-label'])?>
        </div>

		<div class="form-group">
			<?=CHtml::activeLabel($model, '_regiao', ['class'=>'text-beauty']);?>
		    <?=CHtml::activeDropDownList($model, '_regiao', CHtml::ListData(regiao::model()->findAll(), 'nome', 'nome'),['class'=>'form-control', 'empty'=>'Selecione ---'])?>
            <?=CHtml::label("Para fazer a pesquisa de região, desative o filtro de localização mais abaixo","",['style'=>'display: none', 'id'=>"regiao", 'class'=>'text-warning'])?>
	  	</div>

        <div class="form-group">
            <?=CHtml::activeLabel($model, '_bairro', ['class'=>'text-beauty'])?>
            <?=CHtml::activeDropDownList($model, '_bairro', CHtml::ListData(bairro::model()->findAll(), 'nome', 'nome'),['class'=>'form-control', 'empty'=>'Selecione ---'])?><br>
            <?=CHtml::label("Para fazer a pesquisa de bairro, desative o filtro de localização mais abaixo","",['style'=>'display: none', 'id'=>"bairro", 'class'=>'text-warning'])?>
        </div>
	  	
	  	<div class="form-group">
	  		<?=CHtml::submitButton('Pesquisar', ['class'=>'btn btn-success', 'id'=>'btnPesq1'])?>
            <?=CHtml::button("Limpar filtros", ['class'=>'btn btn-default', 'id'=>'cleanFilter'])?>
            <?php
                if (Yii::app()->user->hasState("id")) {
                    echo CHtml::ajaxSubmitButton('Refazer filtros',Yii::app()->createUrl('default/rebuildFilter'),
                    array(
                        'type'=>'POST',
                        'dataType'=> 'json',                       
                        'success'=>'js:function(data){
                            $("#form-index #hospital__regiao").prop("selectedIndex", data.indiceRegiao);
                            $("#form-index #hospital__bairro").prop("selectedIndex", data.indiceBairro);
                            $("#form-index #hospital__plano_saude").prop("selectedIndex", data.indicePlanoSaude);
                        }'           
                    ),array('class'=>'btn btn-primary'));
                }
            ?>
		</div>

		
	<?php $this->endWidget() ?>
</div>
<?php

    Yii::app()->clientScript->registerScript('askGeolocation', '
        
        $("#form-index #radioLocation").prop("checked", false);
        
        var options = {
          enableHighAccuracy: true,
          timeout: 5000,
          maximumAge: 0
        };

        function success(pos) {
        	var crd = pos.coords;

          	$("#form-index #hospital_latitude").val(crd.latitude);	
          	$("#form-index #hospital_longitude").val(crd.longitude);

            $("#form-result #hospital_latitude").val(crd.latitude);
            $("#form-result #hospital_latitude").val(crd.longitude);	
        };

        function error(err) {
          console.warn(err.message);
        };

        $("#form-index #radioLocation").on("change", function() {
        	if(this.checked) {
                $("#form-index #hospital__regiao").prop("disabled", true);
                $("#form-index #hospital__regiao").val("");
                $("#form-index #hospital__bairro").prop("disabled", true);
                $("#form-index #hospital__bairro").val("");
                $("#regiao, #bairro").css("display","");
            	navigator.geolocation.getCurrentPosition(success, error, options);
        	} else {
                $("#regiao, #bairro").css("display","none");
        		$("#form-index #hospital__regiao").prop("disabled", false);
                $("#form-index #hospital__bairro").prop("disabled", false);

        		$("#form-index #hospital_latitude").val("");	
            	$("#form-index #hospital_longitude").val("");

                $("#form-result #hospital_latitude").val("");
                $("#form-result #hospital_latitude").val("");
        	}
        	
        });

        $("#cleanFilter").on("click", function(){
            $("#form-index").find("#hospital_nome").val("");
            $("#form-index").find("select, :hidden").val("");
            $("#form-index").find(":checkbox").prop("checked", false);
            $("#radioLocation").trigger("change");
        });
    ');
?>	