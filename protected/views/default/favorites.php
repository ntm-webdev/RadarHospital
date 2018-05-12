<div class="container">
	<h2 class="text-beauty">Olá, <?=$model->nome?>, esses são seus hospitais favoritos</h2>
	<?php
        $this->widget('zii.widgets.CListView', array(
           'dataProvider'=>$dataProvider,
           'itemView'=> 'listfavorites',
        )); 
    ?>
</div>