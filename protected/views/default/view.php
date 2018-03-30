<div class="container-fluid">

	<div class="row">
		<div id="gallery" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#gallery" data-slide-to="0" class="active"></li>
			    <li data-target="#gallery" data-slide-to="1"></li>
			    <li data-target="#gallery" data-slide-to="2"></li>
			</ol>

		  	<!-- Wrapper for slides -->
			<div class="carousel-inner">
		    	<div class="item active">
		      		<img src="<?= Yii::app()->theme->baseUrl?>/imgs/hosp/1.jpg" class="img img-responsive" alt="Los Angeles">
		    	</div>

		    	<div class="item">
		      		<img src="<?= Yii::app()->theme->baseUrl?>/imgs/hosp/2.jpg" class="img img-responsive" alt="Chicago">
		    	</div>

		    	<div class="item">
		      		<img src="<?= Yii::app()->theme->baseUrl?>/imgs/hosp/4.jpg" class="img img-responsive" alt="New York">
		    	</div>
		  	</div>

			<!-- Left and right controls -->
			<a class="left carousel-control" href="#gallery" data-slide="prev">
		    	<span class="glyphicon glyphicon-chevron-left"></span>
		    	<span class="sr-only">Previous</span>
		  	</a>
		  	
		  	<a class="right carousel-control" href="#gallery" data-slide="next">
		    	<span class="glyphicon glyphicon-chevron-right"></span>
		    	<span class="sr-only">Next</span>
		  	</a>
		</div>
	</div>
	
	<div class="row">
  		<!-- Navegacao -->
			<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active">
				<a href="#detalhes" class="text-beauty" aria-controls="detalhes" role="tab" data-toggle="tab" aria-expanded="true">Detalhes</a>
			</li>

		    <li role="presentation">
		    	<a href="#avaliacoes" class="text-beauty" aria-controls="avaliacoes" role="tab" data-toggle="tab" aria-expanded="false">Avaliações</a>
		    </li>

		    <li role="presentation">
		    	<a href="#mapa" class="text-beauty" aria-controls="mapa" role="tab" data-toggle="tab" aria-expanded="false">Mapa</a>
		    </li>
  		</ul>

	  	<!-- Abas -->
	  	<div class="tab-content">
	    	<div role="tabpanel" class="tab-pane fade active in" id="detalhes">
		    	<?=$this->renderPartial('abas-view/detalhes', ['model' => $model])?>
			</div>
	    
		    <div role="tabpanel" class="tab-pane fade" id="avaliacoes">
			    <?=$this->renderPartial('abas-view/avaliacoes')?>
		    </div>
	    
		    <div role="tabpanel" class="tab-pane fade" id="mapa">
		      <?=$this->renderPartial('abas-view/mapa')?>
			</div>
		</div>  
	</div> 
</div>