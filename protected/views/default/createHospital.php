<?php 
	$model->getRelated("fkplanosaude", true);
	$model->getRelated("fkespecialidade", true);
?>
<div class="container">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'method'=>'POST',
		'htmlOptions' => array('enctype' => 'multipart/form-data'),
	)); ?>

		<div class="form-group">
			<h2 class="text-beauty">Dados do Hospital</h2>
			<br>
			<?=CHtml::activeLabel($model, 'nome', ['class'=>'text-beauty'])?>
			<?=CHtml::activeTextField($model, 'nome', ['class'=>'form-control'])?>
			<?=$form->error($model,'nome'); ?>
		</div>

		<div class="form-group">
			<?=CHtml::activeLabel($model, 'endereco', ['class'=>'text-beauty'])?>
			<?=CHtml::activeTextField($model, 'endereco', ['class'=>'form-control'])?>
			<?=$form->error($model,'endereco'); ?>
		</div>

		<div class="form-group">
			<?=CHtml::activeLabel($model, 'latitude', ['class'=>'text-beauty'])?>
			<?=CHtml::activeTextField($model, 'latitude', ['class'=>'form-control'])?>
			<?=$form->error($model,'latitude'); ?>
		</div>

		<div class="form-group">
			<?=CHtml::activeLabel($model, 'longitude', ['class'=>'text-beauty'])?>
			<?=CHtml::activeTextField($model, 'longitude', ['class'=>'form-control'])?>
			<?=$form->error($model,'longitude'); ?>
		</div>

		<div class="form-group">
            <?=CHtml::activeLabel($model, '_plano_saude', ['class'=>'text-beauty'])?><br>
            <?=CHtml::activeDropDownList($model, 'fkplanosaude', CHtml::ListData(plano_saude::model()->findAll(), 'id', 'nome'),['class'=>'form-control', 'empty'=>'Selecione ---', 'multiple'=>'multiple'])?>
        </div>

        <div class="form-group">
            <?=CHtml::activeLabel($model, '_especialidade', ['class'=>'text-beauty'])?><br>
            <?=CHtml::activeDropDownList($model, '_especialidade', CHtml::ListData(especialidades::model()->findAll(), 'id', 'nome'),['class'=>'form-control', 'empty'=>'Selecione ---', 'multiple'=>'multiple'])?>
        </div>

        <div class="form-group">
	        <div class="row">
	    		<div class="col-xs-12 col-md-6">
	    			<fieldset>
	    				<legend>Dia de Semana</legend>
	    				<div class="col-xs-12 col-md-6">
	    					<?=CHtml::label('Início', '', ['class'=>'text-beauty'])?>
	    					<?=CHtml::dropDownlist('hospital[hora_inicio_semana]', '', $horas , ['class'=>'form-control'])?>
	    				</div>
	    				<div class="col-xs-12 col-md-6">
	    					<?=CHtml::label('Fim', '', ['class'=>'text-beauty'])?>
	    					<?=CHtml::dropDownlist('hospital[hora_fim_semana]', '', $horas , ['class'=>'form-control'])?>
	    				</div>
	    			</fieldset>
	    		</div>

	    		<div class="col-xs-12 col-md-6">
	    			<fieldset>
	    				<legend>Final de Semana</legend>
	    				<div class="col-xs-12 col-md-6">
	    					<?=CHtml::label('Início', '', ['class'=>'text-beauty'])?>
	    					<?=CHtml::dropDownlist('hospital[hora_inicio_finalsemana]', '', $horas , ['class'=>'form-control'])?>
	    				</div>
	    				<div class="col-xs-12 col-md-6">
	    					<?=CHtml::label('Fim', '', ['class'=>'text-beauty'])?>
	    					<?=CHtml::dropDownlist('hospital[hora_fim_finalsemana]', '', $horas , ['class'=>'form-control'])?>
	    				</div>
	    			</fieldset>
	    		</div>
	        </div>
	    </div>

		<div class="form-group">
			<?=CHtml::activeLabel($model, 'id_regiao', ['class'=>'text-beauty']);?>
		    <?=CHtml::activeDropDownList($model, 'id_regiao', CHtml::ListData(regiao::model()->findAll(), 'id', 'nome'),['class'=>'form-control', 'empty'=>'Selecione ---'])?>
	  	</div>

        <div class="form-group">
            <?=CHtml::activeLabel($model, 'id_bairro', ['class'=>'text-beauty'])?>
            <?=CHtml::activeDropDownList($model, 'id_bairro', CHtml::ListData(bairro::model()->findAll(), 'id', 'nome'),['class'=>'form-control', 'empty'=>'Selecione ---'])?><br>
        </div>

        <div class="form-group">
			<?=CHtml::activeLabel($model, 'telefone', ['class'=>'text-beauty'])?>
			<?=CHtml::activeTextField($model, 'telefone', ['class'=>'form-control'])?>
			<?=$form->error($model,'telefone'); ?>
		</div>

		<div class="form-group">
			<?=CHtml::activeLabel($model, 'site', ['class'=>'text-beauty'])?>
			<?=CHtml::activeTextField($model, 'site', ['class'=>'form-control'])?>
			<?=$form->error($model,'site'); ?>
		</div>

		<div class="form-group">
			<?=CHtml::activeLabel($model, 'url_mapa', ['class'=>'text-beauty'])?>
			<?=CHtml::activeTextField($model, 'url_mapa', ['class'=>'form-control'])?>
			<?=$form->error($model,'url_mapa'); ?>
		</div>

		<div class="row">
			<div class="form-group">
				<div class="col-xs-12">
					<?=CHtml::Label('Foto 1', '', ['class'=>'text-beauty'])?>
					<?=CHtml::fileField('hospital[foto1]', '', ['class'=>'form-control-file'])?>	
    				<small class="form-text text-muted">Apenas extensões .jpg</small>
				</div>

				<div class="col-xs-12">
					<?=CHtml::Label('Foto 2', '', ['class'=>'text-beauty'])?>
					<?=CHtml::fileField('hospital[foto2]', '', ['class'=>'form-control-file'])?>	
    				<small class="form-text text-muted">Apenas extensões .jpg</small>	
				</div>

				<div class="col-xs-12">
					<?=CHtml::Label('Foto 3', '', ['class'=>'text-beauty'])?>
					<?=CHtml::fileField('hospital[foto3]', '', ['class'=>'form-control-file'])?>	
    				<small class="form-text text-muted">Apenas extensões .jpg</small>
				</div>

				<div class="col-xs-12">
					<?=CHtml::Label('Foto 4', '', ['class'=>'text-beauty'])?>
					<?=CHtml::fileField('hospital[foto4]', '', ['class'=>'form-control-file'])?>	
    				<small class="form-text text-muted">Apenas extensões .jpg</small>
				</div>
			</div>
		</div>

		<div class="form-group">
			<?=CHtml::submitButton('Enviar', array('class'=>'btn btn-success', 'id'=>'submit')); ?>
	    </div>
	<?php $this->endWidget(); ?>
</div>

<?php

	Yii::app()->clientScript->registerScript('createHospitalFunctions', '

		/*$(document).on("click","#hospital_fkplanosaude option", function() {
			var e = jQuery.Event("click");
			e.ctrlKey = true;
			$("#hospital_fkplanosaude option").trigger(e); 
		});*/

		$("#hospital__regiao").on("change", function() {
            var descricao = $(this).val();
            $.post("'.Yii::app()->createUrl("default/associaBairroRegiao").'", {regiao:descricao}, function(data) {
                var bairros = data.bairros;
                bairros = bairros.substring(0, (bairros.length-1));
                arrayBairros = bairros.split(",");

                var idBairros = data.idBairros;
                idBairros = idBairros.substring(0, (idBairros.length-1));
				arrayIdBairros = idBairros.split(",");                

                var strOpcoesBairros = "";
                strOpcoesBairros += "<option value=\"\">Selecione ---</option>";

                for (var i=0;i<=arrayBairros.length;i++) {
                    if(arrayBairros[i] != undefined && arrayBairros != "") {
                        strOpcoesBairros += "<option value="+arrayIdBairros[i]+">"+arrayBairros[i]+"</option>";
                    }
                }
                $("#hospital__bairro").empty().append(strOpcoesBairros);
            }, "json");
        });

		$("#submit").click(function(e){
		    var formData = new FormData($("form")[0]);
		    
		    $.ajax({
		        url: "'.Yii::app()->createUrl('Default/createHospital').'",  
		        type: "POST",
		        //data: formData,
		        dataType: json,
		        cache: false,
		        contentType: false,
		        processData: false,
	            success: function (data) {
	                if (data.status == "ok") {
			            $(".user-error").remove();
						
						$.gritter.add({
			                title: "Sucesso!",
			                text: data.msg,
			                class_name: "gritter-success"
			            });

			            location.reload();

					} else {
			        	var fields = data.fields;
			        	console.log(fields);
	
			        	$.gritter.add({
			                title: "Erro!",
			                text: data.msg,
			                class_name: "gritter-error"
			            });

			            $.each(data.fields, function(index, value) {
			            	$(".user-error").remove();
			            	window.setTimeout(function(){
			            		$("#hospital_"+index).after("<label class=\"user-error\" id=\""+index+"-error\" style=\"color: red\">"+ index + " não pode ser vazio</label>");
			            	}, 800);
						});


			        	if (fields.search("Telefone not valid") > 0) {
			        		$("#telefoneinvalid").remove();
			        		$("#hospital_telefone").after("<label id=\"telefoneinvalid\" class=\"user-error\" style=\"color: red\">Esse não é um telefone válido</label>")
			        	} else {
			        		$("#telefoneinvalid").remove();
			        	}
			        }
	            }
		    });
		});
                	
	');
?>