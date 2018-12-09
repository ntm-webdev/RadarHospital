<div class="container">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'method'=>'POST',
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

		<?php if (Yii::app()->user->hasState("masterAccess")) : ?>
			<div class="form-group">
				<?=CHtml::activeCheckBox($model, 'partner')?>
				<?=CHtml::activeLabel($model, 'partner', ['class'=>'text-beauty'])?>
				<?=CHtml::textField('nome_hospital', '', ['class'=>'form-control', 'placeholder'=>'Nome do Hospital', 'style'=>'display:none;'])?>
			</div>
		<?php endif; ?>

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
			<?=CHtml::ajaxSubmitButton('Gravar',Yii::app()->createUrl("Default/registerUser"),
                array(
                    'type'=>'POST',
                    'dataType'=> 'json',                       
                    'success'=>'js:function(data){
                    	if(data.status == "ok") {
	                        $.gritter.add({
				                title: "Sucesso!",
				                text: data.msg,
				                class_name: "gritter-success"
				            });

				            $("label .user-error").remove();

				            setTimeout(function(){ 
			            		window.location = "'.Yii::app()->createUrl("Default/login").'"; 
			            	}, 4000);
				        } else {
				        	
				        	$.gritter.add({
				                title: "Erro!",
				                text: data.msg,
				                class_name: "gritter-error"
				            });

				            var fields = JSON.parse(data.fields);

				           	$.each(fields, function(index, value) {
				            	$(".user-error").remove();
				            	
				            	window.setTimeout(function() {
				            		msg = value.join(",");
				            		msg = msg.replace("cannot be blank", "não pode ser vazio");
				            		msg = msg.replace("is not a valid email address", "não é valido"); 

			            			$("#"+index).after("<label class=\"user-error\" id=\""+index+"-error\" style=\"color: red\">" + msg + "</label>");
				            	}, 800);
							});
				        }
			        }'	       
                ),array('class'=>'btn btn-success'));
            ?>
		</div>
	<?php $this->endWidget(); ?>
</div>

<?php
	
	Yii::app()->clientScript->registerScript('beforeLoad', '
        if ($("#Usuario_id_regiao").val().length > 0) {
            var descricao = $("#Usuario_id_regiao").val();
            $.post("'.Yii::app()->createUrl("default/associaBairroRegiao").'", {regiao:descricao}, function(data) {
                var bairros = data.bairros;
                bairros = bairros.substring(0, (bairros.length-1));
                arrayBairros = bairros.split(",");

                var idBairros = data.idBairros;
                idBairros = idBairros.substring(0, (idBairros.length-1));
				arrayIdBairros = idBairros.split(",");                

                var strOpcoesBairros = "";
                strOpcoesBairros += "<option value=\"\">Selecione ---</option>";
                $("#Usuario_id_bairro").empty();

                for (var i=0;i<=arrayBairros.length;i++) {
                    if(arrayBairros[i] != undefined && arrayBairros != "") {
                    	$("<option>").val(arrayIdBairros[i]).text(arrayBairros[i]).appendTo("#Usuario_id_bairro");
                    }
                }
            }, "json");
        }
    ');

	Yii::app()->clientScript->registerScript('registeruserJS', '
		$("#Usuario_partner").on("change", function(){
			if (this.checked) {
				$("#nome_hospital").css("display", "");
			} else {
				$("#nome_hospital").val("");
				$("#nome_hospital").css("display", "none");
			}
		});

		$("#Usuario_id_regiao").on("change", function() {
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
                $("#Usuario_id_bairro").empty();

                for (var i=0;i<=arrayBairros.length;i++) {
                    if(arrayBairros[i] != undefined && arrayBairros != "") {
                    	$("<option>").val(arrayIdBairros[i]).text(arrayBairros[i]).appendTo("#Usuario_id_bairro");
                    }
                }
            }, "json");
        });
	');
?>