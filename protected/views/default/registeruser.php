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
				        	var fields = data.fields;
				        	
				        	$.gritter.add({
				                title: "Erro!",
				                text: data.msg,
				                class_name: "gritter-error"
				            });

				        	if (fields.search("Nome cannot be blank.") > 0) {
				        		$("#nome-error").remove();
				        		$("#Usuario_nome").after("<label class=\"user-error\" id=\"nome-error\" style=\"color: red\">Nome não pode ser vazio</label>")
				        	} else {
				        		$("#nome-error").remove();
				        	}

				        	if (fields.search("Senha cannot be blank.") > 0) {
				        		$("#pwd-error").remove();
				        		$("#Usuario_pwd").after("<label class=\"user-error\" id=\"pwd-error\" style=\"color: red\">Senha não pode ser vazia</label>")
				        	} else {
				        		$("#pwd-error").remove();
				        	}

				        	if (fields.search("E-mail cannot be blank.") > 0) {
				        		$("#email-error").remove();
				        		$("#Usuario_email").after("<label class=\"user-error\" id=\"email-error\" style=\"color: red\">E-mail não pode ser vazio</label>")
				        	} else {
				        		$("#email-error").remove();
				        	}

				        	if (fields.search("Confirme seu e-mail cannot be blank.") > 0) {
				        		$("#confemail-error").remove();
				        		$("#Usuario_confEmail").after("<label class=\"user-error\" id=\"confemail-error\" style=\"color: red\">Confirme seu e-mail não pode ser vazio</label>")
				        	} else {
				        		$("#confemail-error").remove();
				        	}

				        	if (fields.search("Confirme sua senha cannot be blank.") > 0) {
				        		$("#confpwd-error").remove();
				        		$("#Usuario_confPwd").after("<label id=\"confpwd-error\" class=\"user-error\" style=\"color: red\">Confirme sua senha não pode ser vazia</label>")
				        	} else {
				        		$("#confpwd-error").remove();
				        	}

				        	if (fields.search("E-mail is not a valid email address.") > 0) {
				        		$("#emailinvalid").remove();
				        		$("#Usuario_email").after("<label id=\"emailinvalid\" class=\"user-error\" style=\"color: red\">Esse não é um e-mail válido</label>")
				        	} else {
				        		$("#emailinvalid").remove();
				        	}

				        	if (fields.search("Os emails nao correspondem.") > 0) {
				        		$("#confemailcorrespondent-error, #emailcorrespondent-error").remove();
				        		$("#Usuario_email").after("<label id=\"confemailcorrespondent-error\" class=\"user-error\" style=\"color: red\">Os e-mails não correspondem</label><br>");
				        		$("#Usuario_confEmail").after("<label id=\"emailcorrespondent-error\" class=\"user-error\" style=\"color: red\">Os e-mails não correspondem</label><br>")
				        	} else {
				        		$("#confemailcorrespondent-error, #emailcorrespondent-error").remove();
				        	}

				        	if (fields.search("As senhas nao correspondem.") > 0) {
				        		$("#confpwdcorrespondent-error, #pwdcorrespondent-error").remove();
				        		$("#Usuario_pwd").after("<label id=\"confpwdcorrespondent-error\" class=\"user-error\" style=\"color: red\">As senhas não correspondem</label>");
				        		$("#Usuario_confPwd").after("<label id=\"pwdcorrespondent-error\" class=\"user-error\" style=\"color: red\">As senhas não correspondem</label>")
				        	} else {
				        		$("#confpwdcorrespondent-error, #pwdcorrespondent-error").remove();
				        	}
				        }
			        }'	       
                ),array('class'=>'btn btn-success'));
            ?>
		</div>
	<?php $this->endWidget(); ?>
</div>