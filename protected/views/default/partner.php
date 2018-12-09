<div class="container">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'method'=>'POST',
	)); ?>
		<div class="form-group">
			<h2 class="text-beauty">Deseja cadastrar seu hospital? Preencha esse formulário e assim que possível retornaremos o contato</h2>
			<br>
			<?=CHTML::label('Nome','nome', ['class'=>'text-beauty']); ?>
			<?=CHTML::textField('nome', '', ['class'=>'form-control']); ?>
		</div>

		<div class="form-group">
			<?=CHTML::label('E-mail','email', ['class'=>'text-beauty']); ?>
			<?=CHTML::emailField('email', '', ['class'=>'form-control']); ?>
		</div>

		<div class="form-group">
			<?=CHTML::label('Telefone','telefone', ['class'=>'text-beauty']); ?>
			<?=CHTML::textField('telefone', '', ['class'=>'form-control']); ?>
		</div>

		<div class="form-group">
			<?=CHTML::label('Mensagem','mensagem', ['class'=>'text-beauty']); ?>
			<?=CHtml::textArea('mensagem', '', ['class'=>'form-control'])?>
		</div>

		<div class="form-group">
			<?=CHtml::ajaxSubmitButton('Enviar',Yii::app()->createUrl("Default/Partner"), array(
                'type'=>'POST',
                'dataType'=> 'json',                       
                'success'=>'js:function(data){
                	if(data.status == "ok") {
			            $(".user-error").remove();
						
						$.gritter.add({
			                title: "Sucesso!",
			                text: data.msg,
			                class_name: "gritter-success"
			            });

			            window.setTimeout(function(){
			            	location.reload();
			            }, 3000);
					} else {

			        	$.gritter.add({
			                title: "Erro!",
			                text: data.msg,
			                class_name: "gritter-error"
			            });
			            
			            $.each(data.fields, function(index, value) {
			            	$(".user-error").remove();
			            	window.setTimeout(function() {
		            			$("#"+index).after("<label class=\"user-error\" id=\""+index+"-error\" style=\"color: red\">" + value + "</label>");
			            	}, 800);
						});
			        }
		        }',     
            ),array('class'=>'btn btn-success')); ?>
	    </div>

		<?php $this->endWidget(); ?>
</div>