<?php
	$somaAtendimento=0; $somaAtendimentoMedico=0; $somaHigiene=0; $somaInfraestrutura=0; $numAvaliacoes = 0;
?>

<div class="row">
	<div class="col-xs-6 col-md-3">
		<div id="circle1" class="circle">
			<p class="text-beauty">Atendimento</p>
		</div>
	</div>
	<div class="col-xs-6 col-md-3">
		<div id="circle2" class="circle">
			<p class="text-beauty">Atendimento Médico</p>
		</div>
	</div>
	<div class="col-xs-6 col-md-3">
		<div id="circle3" class="circle">
			<p class="text-beauty">Higiene</p>
		</div>
	</div>
	<div class="col-xs-6 col-md-3">
		<div id="circle4" class="circle">
			<p class="text-beauty">Infraestrutura</p>
		</div>
	</div>
</div>
<div class="row row-avaliacoes">
	<hr class="hr-beauty">
	<?=CHtml::link('Adicionar avaliação', ['Default/evaluate', 'idHospital'=>$model->id], ['class'=>'btn btn-purple','style'=>'font-size: 15px'])?>
</div>

<?php for($i=0;$i < count($feedback); $i++) : ?>
	<br>
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
			<?php $somaAtendimento += $feedback[$i]->atendimento; ?>
		</p>
		<p class="text-beauty">
			Atendimento Médico
			<?=$feedback[$i]->getStarts($feedback[$i]->atendimento_medico)?>
			<?php $somaAtendimentoMedico += $feedback[$i]->atendimento_medico; ?>
		</p>
		<p class="text-beauty">
			Higiene 
			<?=$feedback[$i]->getStarts($feedback[$i]->higiene)?>
			<?php $somaHigiene += $feedback[$i]->higiene; ?>
		</p>
		<p class="text-beauty">Infraestrutura 
			<?=$feedback[$i]->getStarts($feedback[$i]->infraestrutura)?>
			<?php $somaInfraestrutura += $feedback[$i]->infraestrutura; ?>
		</p>
	</div>
	
	<hr class="hr-beauty">

<?php
	endfor;
	
	$numAvaliacoes = count($feedback);

	if (!empty($somaAtendimento) && !empty($numAvaliacoes)) {
		$avgAtendimento = (($somaAtendimento * 100) / ($numAvaliacoes * 4) / 100); 
	} else {
		$avgAtendimento = 0;
	}
	
	if (!empty($somaAtendimentoMedico) && !empty($numAvaliacoes)) {
		$avgAtendimentoMedico = (($somaAtendimentoMedico * 100) / ($numAvaliacoes * 4) / 100); 
	} else {
		$avgAtendimentoMedico = 0;
	}

	if (!empty($somaHigiene) && !empty($numAvaliacoes)) {
		$avgHigiente = (($somaHigiene * 100) / ($numAvaliacoes * 4) / 100); 
	} else {
		$avgHigiente = 0;
	}

	if (!empty($somaInfraestrutura) && !empty($numAvaliacoes)) {
		$avgInfraestrutura = (($somaInfraestrutura * 100) / ($numAvaliacoes * 4) / 100); 
	} else {
		$avgInfraestrutura = 0;
	}
?>

<?php

	Yii::app()->clientScript->registerScript('initializeRangeCircle', '
		$("#circle1").circleProgress({
		    value: '.$avgAtendimento.',
		    size: 40,
		    fill: {
		      gradient: ["purple", "blue"]
		    }
		});
		$("#circle2").circleProgress({
		    value: '.$avgAtendimentoMedico.',
		    size: 40,
		    fill: {
		      gradient: ["purple", "blue"]
		    }
		});
		$("#circle3").circleProgress({
		    value: '.$avgHigiente.',
		    size: 40,
		    fill: {
		      gradient: ["purple", "blue"]
		    }
		});
		$("#circle4").circleProgress({
		    value: '.$avgInfraestrutura.',
		    size: 40,
		    fill: {
		      gradient: ["purple", "blue"]
		    }
		});

		$("#circle1 .text-beauty").append("<p>'.number_format($avgAtendimento*100, 2).'%</p>");
		$("#circle2 .text-beauty").append("<p>'.number_format($avgAtendimentoMedico*100, 2).'%</p>");
		$("#circle3 .text-beauty").append("<p>'.number_format($avgHigiente*100, 2).'%</p>");
		$("#circle4 .text-beauty").append("<p>'.number_format($avgInfraestrutura*100, 2).'%</p>");
	');
?>