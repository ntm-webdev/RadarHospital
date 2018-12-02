<body style="background-color: #f2f2f2">
	<div class="container">
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