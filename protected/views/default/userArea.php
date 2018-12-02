<?php if(Yii::app()->user->hasState("nome")) : ?>
	<div class="container-fluid spec">
		<div id="img-userarea">
			<img class="img img-responsive" style="width: 100%; height: inherit;" src="<?=Yii::app()->theme->baseUrl?>/imgs/banner.jpg">
		</div>
		<div id="list">
			<ul>
				<li><?=CHtml::tag("a", ['href'=>'resultado'], "<i class='fa fa-fw fa-search'></i> Voltar para a pesquisa")?></li>
				<li><?=CHtml::tag("a", ['href'=>'favorites'], "<i class='fa fa-fw fa-heart'></i> Lista de Hospitais")?></li>
				<li><?=CHtml::tag("a", ['href'=>'preferences'], "<i class='fa fa-fw fa-cog'></i> Preferências")?></li> 
				<li><?=CHtml::tag("a", ['href'=>'about'], "<i class='fa fa-fw fa-question-circle'></i> Sobre")?></li>
				<li><?=CHtml::tag("a", ['href'=>'logout'], "<i class='fa fa-fw fa-times'></i> Sair")?></li>
			</ul>
		</div>
	</div>
<?php 
	else : 
		$this->redirect(["login"]);
	endif;	
?>
