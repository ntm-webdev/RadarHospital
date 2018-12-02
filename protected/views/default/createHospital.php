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
            <?=CHtml::activeDropDownList($model, 'fkespecialidade', CHtml::ListData(especialidades::model()->findAll(['order'=>'nome ASC']), 'id', 'nome'),['class'=>'form-control', 'empty'=>'Selecione ---', 'multiple'=>'multiple'])?>
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
					<?=CHtml::fileField('hospital[foto1]', '', ['class'=>'form-control-file', 'style'=>'display:none;'])?>
					<br>

					<?php if (!empty($imagens)): ?>
						<label class="input-label" for="hospital_foto1"><?=(in_array(1, $img)) ? "Você já cadastrou uma foto aqui" : "Selecione uma foto"?></label>
						<?php if (in_array(1, $img)) : ?>
							<?=CHtml::ajaxSubmitButton('Excluir Foto ?',Yii::app()->createUrl("default/deletePhoto", ['codhospital'=>$model->id, 'codimagem'=>1]), array(
			                    'type'=>'GET',
			                    'dataType'=> 'json',                       
			                    'success'=>'js:function(data){
			                        if(data.status == "ok") {
				                        $.gritter.add({
							                title: "Sucesso!",
							                text: data.msg,
							                class_name: "gritter-success"
							            });

							            $("label[for=hospital_foto1]").text("Selecione uma foto");
							            $("#btn-removePhoto-1").css("display", "none");
							            
							        } else {
							        	$.gritter.add({
							                title: "Erro!",
							                text: data.msg,
							                class_name: "gritter-error"
							            });
							        }
						            
						        }'),array('class'=>'button-remove','id'=>'btn-removePhoto-1'));
						    ?>
						<?php endif; ?>
					<?php else: ?>
						<label class="input-label" for="hospital_foto1">Selecione uma foto</label>
					<?php endif ;?>
					
					<br>		
    				<small class="form-text text-muted">Apenas extensões .jpg</small>
				</div>

				<div class="col-xs-12">
					<?=CHtml::Label('Foto 2', '', ['class'=>'text-beauty'])?>
					<?=CHtml::fileField('hospital[foto2]', '', ['class'=>'form-control-file', 'style'=>'display:none;'])?>
					<br>

					<?php if (!empty($imagens)): ?>
						<label class="input-label" for="hospital_foto2"><?=(in_array(2, $img)) ? "Você já cadastrou uma foto aqui" : "Selecione uma foto"?></label>
						<?php if (in_array(2, $img)) : ?>
							<?=CHtml::ajaxSubmitButton('Excluir Foto ?',Yii::app()->createUrl("default/deletePhoto", ['codhospital'=>$model->id, 'codimagem'=>2]), array(
			                    'type'=>'GET',
			                    'dataType'=> 'json',                       
			                    'success'=>'js:function(data){
			                        if(data.status == "ok") {
				                        $.gritter.add({
							                title: "Sucesso!",
							                text: data.msg,
							                class_name: "gritter-success"
							            });

							            $("label[for=hospital_foto2]").text("Selecione uma foto");
							            $("#btn-removePhoto-2").css("display", "none");
							            
							        } else {
							        	$.gritter.add({
							                title: "Erro!",
							                text: data.msg,
							                class_name: "gritter-error"
							            });
							        }
						            
						        }'),array('class'=>'button-remove','id'=>'btn-removePhoto-2'));
						    ?>
						<?php endif; ?>
					<?php else: ?>
						<label class="input-label" for="hospital_foto2">Selecione uma foto</label>
					<?php endif ;?>

					<br>	
    				<small class="form-text text-muted">Apenas extensões .jpg</small>	
				</div>

				<div class="col-xs-12">
					<?=CHtml::Label('Foto 3', '', ['class'=>'text-beauty'])?>
					<?=CHtml::fileField('hospital[foto3]', '', ['class'=>'form-control-file', 'style'=>'display:none;'])?>
					<br>
					
					<?php if (!empty($imagens)): ?>
						<label class="input-label" for="hospital_foto3"><?=(in_array(3, $img)) ? "Você já cadastrou uma foto aqui" : "Selecione uma foto"?></label>
						<?php if (in_array(3, $img)) : ?>
							<?=CHtml::ajaxSubmitButton('Excluir Foto ?',Yii::app()->createUrl("default/deletePhoto", ['codhospital'=>$model->id, 'codimagem'=>3]), array(
			                    'type'=>'GET',
			                    'dataType'=> 'json',                       
			                    'success'=>'js:function(data){
			                        if(data.status == "ok") {
				                        $.gritter.add({
							                title: "Sucesso!",
							                text: data.msg,
							                class_name: "gritter-success"
							            });

							            $("label[for=hospital_foto3]").text("Selecione uma foto");
							            $("#btn-removePhoto-3").css("display", "none");
							            
							        } else {
							        	$.gritter.add({
							                title: "Erro!",
							                text: data.msg,
							                class_name: "gritter-error"
							            });
							        }
						            
						        }'),array('class'=>'button-remove','id'=>'btn-removePhoto-3'));
						    ?>
						<?php endif; ?>
					<?php else: ?>
						<label class="input-label" for="hospital_foto3">Selecione uma foto</label>
					<?php endif ;?>
					
					<br>	
    				<small class="form-text text-muted">Apenas extensões .jpg</small>
				</div>

				<div class="col-xs-12">
					<?=CHtml::Label('Foto 4', '', ['class'=>'text-beauty'])?>
					<?=CHtml::fileField('hospital[foto4]', '', ['class'=>'form-control-file', 'style'=>'display:none;'])?>
					<br>

					<?php if (!empty($imagens)): ?>
						<label class="input-label" for="hospital_foto4"><?=(in_array(4, $img)) ? "Você já cadastrou uma foto aqui" : "Selecione uma foto"?></label>
						<?php if (in_array(4, $img)) : ?>
							<?=CHtml::ajaxSubmitButton('Excluir Foto ?',Yii::app()->createUrl("default/deletePhoto", ['codhospital'=>$model->id, 'codimagem'=>4]), array(
			                    'type'=>'GET',
			                    'dataType'=> 'json',                       
			                    'success'=>'js:function(data){
			                        if(data.status == "ok") {
				                        $.gritter.add({
							                title: "Sucesso!",
							                text: data.msg,
							                class_name: "gritter-success"
							            });

							            $("label[for=hospital_foto4]").text("Selecione uma foto");
							            $("#btn-removePhoto-4").css("display", "none");
							            
							        } else {
							        	$.gritter.add({
							                title: "Erro!",
							                text: data.msg,
							                class_name: "gritter-error"
							            });
							        }
						            
						        }'),array('class'=>'button-remove','id'=>'btn-removePhoto-4'));
						    ?>
						<?php endif; ?>
					<?php else: ?>
						<label class="input-label" for="hospital_foto4">Selecione uma foto</label>
					<?php endif ;?>

					<br>	
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

	Yii::app()->clientScript->registerScript('beforeLoad', '
        if ($("#hospital_id_regiao").val().length > 0) {
            var descricao = $("#hospital_id_regiao").val();
            $.post("'.Yii::app()->createUrl("default/associaBairroRegiao").'", {regiao:descricao}, function(data) {
                var bairros = data.bairros;
                bairros = bairros.substring(0, (bairros.length-1));
                arrayBairros = bairros.split(",");

                var idBairros = data.idBairros;
                idBairros = idBairros.substring(0, (idBairros.length-1));
				arrayIdBairros = idBairros.split(",");                

                var strOpcoesBairros = "";
                strOpcoesBairros += "<option value=\"\">Selecione ---</option>";
                $("#hospital_id_bairro").empty();

                for (var i=0;i<=arrayBairros.length;i++) {
                    if(arrayBairros[i] != undefined && arrayBairros != "") {
                    	$("<option>").val(arrayIdBairros[i]).text(arrayBairros[i]).appendTo("#hospital_id_bairro");
                    }
                }
            }, "json");

            window.setTimeout(function(){
                $("#hospital_id_bairro option[value=\"'.$model->id_bairro.'\"]").prop("selected", "true");                
            },50);
        }
    ');

	Yii::app()->clientScript->registerScript('createHospitalFunctions', '

		/*$(document).on("click","#hospital_fkplanosaude option", function() {
			var e = jQuery.Event("click");
			e.ctrlKey = true;
			$("#hospital_fkplanosaude option").trigger(e); 
		});*/

		$("#hospital_foto1").on("change", function(){
			$("label[for=hospital_foto1]").text("Foto 1 Selecionada");
		});
		$("#hospital_foto2").on("change", function(){
			$("label[for=hospital_foto2]").text("Foto 2 Selecionada");
		});
		$("#hospital_foto3").on("change", function(){
			$("label[for=hospital_foto3]").text("Foto 3 Selecionada");
		});
		$("#hospital_foto4").on("change", function(){
			$("label[for=hospital_foto4]").text("Foto 4 Selecionada");
		});

		$("#hospital_id_regiao").on("change", function() {
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
                $("#hospital_id_bairro").empty();

                for (var i=0;i<=arrayBairros.length;i++) {
                    if(arrayBairros[i] != undefined && arrayBairros != "") {
                    	$("<option>").val(arrayIdBairros[i]).text(arrayBairros[i]).appendTo("#hospital_id_bairro");
                    }
                }
            }, "json");
        });

		$("#submit").click(function(e){
		    var formData = new FormData($("form")[0]);
		    
		    $.ajax({
		        type: "POST",
		        url: "'.Yii::app()->createUrl('Default/createHospital').'",  
		        data: formData,
		        cache: false,
		        contentType: false,
		        processData: false,
		        dataType: "json",
	            success: function (data) {
	                if (data.status == "ok") {
			            $(".user-error").remove();
						
						$.gritter.add({
			                title: "Sucesso!",
			                text: data.msg,
			                class_name: "gritter-success"
			            });

			            window.setTimeout(function() {
			            	location.reload();
			            }, 4000);
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
			            	window.setTimeout(function() {
			            		if (value == "wrong") {
			            			$("#hospital_"+index).after("<label class=\"user-error\" id=\""+index+"-error\" style=\"color: red\"> formato incorreto, apenas .jpg</label>");
			            		} else {
			            			$("#hospital_"+index).after("<label class=\"user-error\" id=\""+index+"-error\" style=\"color: red\">"+ index + " não pode ser vazio</label>");
			            		}
			            	}, 800);
						});
			        }
	            }
		    });

		    return false;
		});
                	
	');
?>