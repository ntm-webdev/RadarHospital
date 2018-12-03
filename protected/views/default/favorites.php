<body style="background-color: #f2f2f2">
	<div class="container">
		<br><br>
		<a href="<?=Yii::app()->createUrl('Default/resultado')?>">
	      <span class="btn btn-purple">
	        <i class="fa fa-fw fa-lg pointer fa-search"></i>
	        Buscador
	      </span>
	    </a>
	    <a href="<?=Yii::app()->createUrl('Default/userArea')?>" class="text-beauty btn btn-default">
	      Voltar para minhas preferências
	    </a>
	    <br><br>
		<h4 class="text-beauty">Olá, <?=$model->nome?>, esses são seus hospitais favoritos</h4>
		<hr class="hr-beauty">
		<?php
	        $this->widget('zii.widgets.CListView', array(
	           'dataProvider'=>$dataProvider,
	           'itemView'=> 'listfavorites',
	        )); 
	    ?>
	</div>
</body>