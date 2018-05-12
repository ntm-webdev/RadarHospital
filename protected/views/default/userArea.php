<div class="container-fluid spec">
	<img class="img img-responsive" src="<?=Yii::app()->theme->baseUrl?>/imgs/banner.jpg"">

	<div id="list">
		<ul>
			<li><?=CHtml::tag("a", ['href'=>'favorites'], "<i class='fa fa-fw fa-heart'></i> Lista de Hospitais")?></li>
			<li><?=CHtml::tag("a", ['href'=>'preferences'], "<i class='fa fa-fw fa-cog'></i> Preferências")?></li> 
			<li><?=CHtml::tag("a", ['href'=>'about'], "<i class='fa fa-fw fa-question-circle'></i> Sobre")?></li>
		</ul>
	</div>
</div>