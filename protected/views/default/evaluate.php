<?php if(Yii::app()->user->hasState('nome')) : ?>
	<div class="container">
		<?php 
			$form = $this->beginWidget("CActiveForm", [
				'htmlOptions' => [
					'id' => 'evaluate-form',
					'class' => 'form-centered',
				],
				'method' => 'GET'
			]);
		?>
			<div class="form-group">
				<h2 class="text-beauty">Deixe sua opinião</h2>
				<br>
				<?=CHtml::activeLabel($model, 'atendimento', ['class'=>'text-beauty'])?>
				<?=CHtml::activeDropDownList($model, 'atendimento',[
					1 => '&#xf005;&#xf006;&#xf006;&#xf006;',
					2 => '&#xf005;&#xf005;&#xf006;&#xf006;',
					3 => '&#xf005;&#xf005;&#xf005;&#xf006;',
					4 => '&#xf005;&#xf005;&#xf005;&#xf005;',
					],['class'=>'form-control select-evaluate', 'encode'=>false])
				?>
			</div>

			<div class="form-group">
				<?=CHtml::activeLabel($model, 'atendimento_medico', ['class'=>'text-beauty'])?>
				<?=CHtml::activeDropDownList($model, 'atendimento_medico',[
					1 => '&#xf005;&#xf006;&#xf006;&#xf006;',
					2 => '&#xf005;&#xf005;&#xf006;&#xf006;',
					3 => '&#xf005;&#xf005;&#xf005;&#xf006;',
					4 => '&#xf005;&#xf005;&#xf005;&#xf005;',
					],['class'=>'form-control select-evaluate', 'encode'=>false])
				?>
			</div>

			<div class="form-group">
				<?=CHtml::activeLabel($model, 'higiene', ['class'=>'text-beauty'])?>
				<?=CHtml::activeDropDownList($model, 'higiene',[
					1 => '&#xf005;&#xf006;&#xf006;&#xf006;',
					2 => '&#xf005;&#xf005;&#xf006;&#xf006;',
					3 => '&#xf005;&#xf005;&#xf005;&#xf006;',
					4 => '&#xf005;&#xf005;&#xf005;&#xf005;',
					],['class'=>'form-control select-evaluate', 'encode'=>false])
				?>
			</div>

			<div class="form-group">
				<?=CHtml::activeLabel($model, 'infraestrutura', ['class'=>'text-beauty'])?>
				<?=CHtml::activeDropDownList($model, 'infraestrutura',[
					1 => '&#xf005;&#xf006;&#xf006;&#xf006;',
					2 => '&#xf005;&#xf005;&#xf006;&#xf006;',
					3 => '&#xf005;&#xf005;&#xf005;&#xf006;',
					4 => '&#xf005;&#xf005;&#xf005;&#xf005;',
					],['class'=>'form-control select-evaluate', 'encode'=>false])
				?>
			</div>

			<div class="form-group">
				<?=CHtml::label("Comentário", 'Feedback_descricao', ['class'=>'text-beauty'])?>
				<?=CHtml::activeTextArea($model, 'descricao', ['class'=>'form-control'])?>
			</div>

			<div class="form-group">
				<?=CHtml::ajaxSubmitButton('Gravar',Yii::app()->createUrl("default/Evaluate", ['idHospital'=>$_GET['idHospital']]), array(
                    'type'=>'GET',
                    'dataType'=> 'json',                       
                    'success'=>'js:function(data){
                        if(data.status == "ok") {
	                        $.gritter.add({
				                title: "Sucesso!",
				                text: data.msg,
				                class_name: "gritter-success"
				            });

				            $("label .feedback-error").remove();

				            setTimeout(function(){ 
			            		window.location = "'.Yii::app()->createUrl("Default/view/".$_GET['idHospital']).'"; 
			            	}, 4000);
				        } else {
				        	$.gritter.add({
				                title: "Erro!",
				                text: data.msg,
				                class_name: "gritter-error"
				            });

				            var fields = data.fields;
				        }
			            
			        }'           
                ),array('class'=>'btn btn-success'));
            ?>
			</div>
		<?php $this->endWidget(); ?>
	</div>
<?php else : 
	$this->redirect(['login']);
endif;
?>