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
			        	var fields = data.fields;
			        	var msgs = fields.join(); 

			        	$.gritter.add({
			                title: "Erro!",
			                text: data.msg,
			                class_name: "gritter-error"
			            });

			            if (msgs.includes("Nome cannot be blank") > 0) {
			        		$("#nome-error").remove();
			        		$("#nome").after("<label class=\"user-error\" id=\"nome-error\" style=\"color: red\">Nome não pode ser vazio</label>")
			        	} else {
			        		$("#nome-error").remove();
			        	}

			        	if (msgs.includes("E-mail cannot be blank") > 0) {
			        		$("#email-error").remove();
			        		$("#email").after("<label class=\"user-error\" id=\"email-error\" style=\"color: red\">E-mail não pode ser vazio</label>")
			        	} else {
			        		$("#email-error").remove();
			        	}

			        	if (msgs.includes("E-mail not valid") > 0) {
			        		$("#email-valid-error").remove();
			        		$("#email").after("<label class=\"user-error\" id=\"email-valid-error\" style=\"color: red\">Esse não é um e-mail válido</label>")
			        	} else {
			        		$("#email-valid-error").remove();
			        	}

			        	if (msgs.includes("Telefone cannot be blank") > 0) {
			        		$("#telefone-error").remove();
			        		$("#telefone").after("<label class=\"user-error\" id=\"telefone-error\" style=\"color: red\">Telefone não pode ser vazio</label>")
			        	} else {
			        		$("#telefone-error").remove();
			        	}

			        	if (msgs.includes("Telefone not valid") > 0) {
			        		$("#telefoneinvalid").remove();
			        		$("#telefone").after("<label id=\"telefoneinvalid\" class=\"user-error\" style=\"color: red\">Esse não é um telefone válido</label>")
			        	} else {
			        		$("#telefoneinvalid").remove();
			        	}

			        	if (msgs.includes("Mensagem cannot be blank") > 0) {
			        		$("#mensagem-error").remove();
			        		$("#mensagem").after("<label class=\"user-error\" id=\"mensagem-error\" style=\"color: red\">Mensagem não pode ser vazio</label>")
			        	} else {
			        		$("#mensagem-error").remove();
			        	}
			        }
		        }',     
            ),array('class'=>'btn btn-success')); ?>
	    </div>

		<?php $this->endWidget(); ?>
</div>