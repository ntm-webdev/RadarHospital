<?php if(Yii::app()->user->hasState("nome")) : ?>
<div class="container">
	<?php 
		$form = $this->beginWidget("CActiveForm", [
			'method' => 'POST',
			'htmlOptions' => [
				'id' => 'preferences-form'
			]
		]);
	?>
		<?=CHtml::hiddenField('Usuario[email]', $model->email)?>
		<?=CHtml::hiddenField('Usuario[confEmail]', $model->email)?>
		<?=CHtml::hiddenField('Usuario[pwd]', $model->pwd)?>
		<?=CHtml::hiddenField('Usuario[confPwd]', $model->pwd)?>

		<div class="form-group">
			<h2 class="text-beauty">Olá, <?=$model->nome?> suas informações estão corretas?</h2>
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
			<?=$form->error($model,'id_regiao'); ?>
		</div>

		<div class="form-group">
			<?=CHtml::ajaxSubmitButton('Gravar',Yii::app()->createUrl("Default/preferences"),
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

				            setTimeout(function(){ 
				            	window.location = "'.Yii::app()->createUrl("Default/userArea").'"; 
				            }, 4000);
				        } else {
							$.gritter.add({
				                title: "Erro!",
				                text: data.msg,
				                class_name: "gritter-error"
				            });				        	
				        }
                    }'           
                ),array('class'=>'btn btn-success'));
            ?>
		</div>
	<?php $this->endWidget(); ?>
</div>
<?php 
	else : 
		$this->redirect(["login"]);
	endif;	
?>