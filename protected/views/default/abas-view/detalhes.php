<div class="row row-avaliacoes">
		    		
	<div>
		<p class="text-beauty">Informações gerais</p>
		<p><b>Nome:</b> <?=$model->nome?></p>
		<p><b>Região:</b> <?=$model->fkregiao->nome?></p>
		<p><b>Bairro:</b> <?=$model->fkbairro->nome?></p>
		<p><b>Endereço:</b> <?=$model->endereco?></p>
		<hr>
	</div>

	<div>
		<p class="text-beauty">Horário de Funcionamento</p>
		<p><b>Domingo:</b> Atendimento 24 horas</p>
		<p><b>Segunda-feira:</b> Atendimento 24 horas</p>
		<p><b>Terça-feira:</b> Atendimento 24 horas</p>
		<p><b>Quarta-feira:</b> Atendimento 24 horas</p>
		<p><b>Quinta-feira:</b> Atendimento 24 horas</p>
		<p><b>Sexta-feira:</b> Atendimento 24 horas</p>
		<p><b>Sábado:</b> Atendimento 24 horas</p>
		<hr>
	</div>

	<div>
		<p class="text-beauty">Especialidades</p>
		<?php 
			if(!empty($model->fkespecialidade)) :
				foreach($model->fkespecialidade as $especialidade) : ?>
					<p><?=$especialidade->nome?></p>	
		<?php   
				endforeach; 
			endif
		?>
		<hr>
	</div>

	<div>
		<p class="text-beauty">Planos de Saúde</p>
		<?php 
			if(!empty($model->fkplanosaude)) :
				foreach($model->fkplanosaude as $plano) : ?>
					<p><?=$plano->nome?></p>	
		<?php   
				endforeach; 
			endif
		?>
		<hr>
	</div>

	<div>
		<p class="text-beauty">Contato</p>
		<p><i class="fa fa-link"></i> <?=CHtml::tag('a',['href'=>$model->site], 'Website')?></p>
		<p><i class="fa fa-phone"></i> <?=$model->telefone?></p>
		<hr>
	</div>
</div>