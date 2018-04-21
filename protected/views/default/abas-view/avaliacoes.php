<p></p>
<div class="row row-avaliacoes">
	<?=CHtml::link('Adicionar avaliação', ['Default/evaluate', 'idHospital'=>$model->id], ['class'=>'btn btn-purple','style'=>'font-size: 15px'])?>
	<hr class="hr-beauty">
</div>

<?php for($i=0;$i < count($feedback); $i++) : ?>
	
	<div class="row row-avaliacoes">
		<p>
			<b><?=$feedback[$i]->fkusuario->nome?>, em <?=$feedback[$i]->ParseDate($feedback[$i]->datahora)?></b>
		</p>
		<p>
			<?=$feedback[$i]->descricao?>
		</p>
		<p class="text-beauty">
			Atendimento
			<?=$feedback[$i]->getStarts($feedback[$i]->atendimento)?>
		</p>
		<p class="text-beauty">
			Atendimento Médico
			<?=$feedback[$i]->getStarts($feedback[$i]->atendimento_medico)?>
		</p>
		<p class="text-beauty">
			Higiene 
			<?=$feedback[$i]->getStarts($feedback[$i]->higiene)?>
		</p>
		<p class="text-beauty">Infraestrutura 
			<?=$feedback[$i]->getStarts($feedback[$i]->infraestrutura)?>
		</p>
	</div>
	
	<hr class="hr-beauty">

<?php endfor; ?>