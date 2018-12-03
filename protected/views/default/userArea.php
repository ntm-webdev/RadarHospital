<?php if(Yii::app()->user->hasState("nome")) : ?>
	<div class="container-fluid spec">
		<div id="img-userarea">
			<img class="img img-responsive" style="width: 100%; height: inherit;" src="<?=Yii::app()->theme->baseUrl?>/imgs/banner.jpg">
		</div>
		<div id="list">
			<ul>
				<?php if (Yii::app()->user->hasState("masterAccess")) : ?>
					<li><?=CHtml::tag("a", ['href'=>'insertHospital'], "<i class='fa fa-fw fa-save'></i> Registrar Hospital")?></li>
					<li><?=CHtml::tag("a", ['href'=>'registerUser'], "<i class='fa fa-fw fa-users'></i> Registrar Parceiro")?></li>
				<?php endif; ?>
				<li><?=CHtml::tag("a", ['href'=>'resultado'], "<i class='fa fa-fw fa-search'></i> Ir para pesquisa")?></li>
				<li><?=CHtml::tag("a", ['href'=>'favorites'], "<i class='fa fa-fw fa-heart'></i> Lista de Hospitais")?></li>
				<li><?=CHtml::tag("a", ['href'=>'preferences'], "<i class='fa fa-fw fa-cog'></i> Preferências")?></li> 
				<li><?=CHtml::tag("a", ['href'=>'logout'], "<i class='fa fa-fw fa-times'></i> Sair")?></li>
			</ul>
		</div>
	</div>
<?php 
	else : 
		$this->redirect(["login"]);
	endif;	
?>
