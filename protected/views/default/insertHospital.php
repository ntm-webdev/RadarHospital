<div class="container">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'method'=>'POST',
		'htmlOptions' => array('enctype' => 'multipart/form-data'),
	)); ?>

		<h1 class="text-beauty">Inserção via Json</h1>
		<hr class="hr-beauty">
		
		<div class="form-group">
			<?=CHtml::Label('Nome do Hospital', '',['class'=>'text-beauty'])?>
			<?=CHtml::textField('nome_hospital', '', ['class'=>'form-control'])?>	
		</div>

		<div class="form-group">
			<?=CHtml::Label('Json', '', ['class'=>'text-beauty'])?>
			<?=CHtml::fileField('json_file', '', ['class'=>'form-control-file'])?>	
			<small class="form-text text-muted">Coloque o json aqui</small>
		</div>

		<div class="form-group">
			<?=CHtml::submitButton('Enviar', array('class'=>'btn btn-success', 'id'=>'submit')); ?>
	    </div>

	<?php $this->endWidget(); ?>
</div>

<?php

	Yii::app()->clientScript->registerScript('insertJson', '

		$("#submit").click(function(e){
		    var formData = new FormData($("form")[0]);
		    
		    $.ajax({
		        url: "'.Yii::app()->createUrl('Default/insertHospital').'",  
		        type: "POST",
		        data: formData,
		        dataType: json,
		        cache: false,
		        contentType: false,
		        processData: false,
	            success: function (data) {
	                if (data.status == "ok") {
						
						$.gritter.add({
			                title: "Sucesso!",
			                text: data.msg,
			                class_name: "gritter-success"
			            });

					} else {
			        	var fields = data.fields;
			        	console.log(fields);
	
			        	$.gritter.add({
			                title: "Erro!",
			                text: data.msg,
			                class_name: "gritter-error"
			            });
			        }
	            }
		    });
		});
                	
	');
?>