<div class="row row-avaliacoes">
		    		
	<div>
		<p class="text-beauty">Informações gerais</p>
		<p>Nome: <?=$model->nome?></p>
		<p>Região: <?=$model->fkregiao->nome?></p>
		<p>Bairro: <?=$model->fkbairro->nome?></p>
		<p>Endereço: <?=$model->endereco?></p>
		<hr>
	</div>

	<div>
		<p class="text-beauty">Horário de Funcionamento</p>
		<p>Domingo: Atendimento 24 horas</p>
		<p>Segunda-feira: Atendimento 24 horas</p>
		<p>Terça-feira: Atendimento 24 horas</p>
		<p>Quarta-feira: Atendimento 24 horas</p>
		<p>Quinta-feira: Atendimento 24 horas</p>
		<p>Sexta-feira: Atendimento 24 horas</p>
		<p>Sábado: Atendimento 24 horas</p>
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