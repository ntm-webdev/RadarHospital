<div class="container-fluid">

	<div class="row">
		<div id="gallery" class="carousel slide" data-ride="carousel">
			
			<ol class="carousel-indicators">
				<?php 
					$i=0; 
					if(!empty($model->fkimagens)) : 
						foreach ($model->fkimagens as $imagem) : 
							if($imagem->nome == "1.jpg") : ?>
								<li data-target="#gallery" data-slide-to="<?=$i?>" class="active"></li>
							<?php else : ?>
								<li data-target="#gallery" data-slide-to="<?=$i?>"></li>
							<?php endif; 
					$i++; 
						endforeach; 
					endif;
				?>
			</ol>

			<div class="carousel-inner">
				<?php
					if(!empty($model->fkimagens)) : 
						foreach ($model->fkimagens as $imagem) : 
							if($imagem->nome == "1.jpg") : 
				?>
								<div class="item active">
						      		<img src="<?= Yii::app()->theme->baseUrl?>/imgs/hosp/<?=$model->nome?>/1.jpg" class="img img-responsive img-view">
							    </div>
							<?php else :?>
						    	<div class="item">
						      		<img src="<?= Yii::app()->theme->baseUrl?>/imgs/hosp/<?=$model->nome?>/<?=$imagem->nome?>" class="img img-responsive img-view">
						    	</div>
			    <?php 		endif; 
			    		endforeach;
			    	endif; 
			    ?>
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

		    <li role="presentation">
		    	<a class="text-beauty" aria-controls="mapa" role="tab" data-toggle="tab" aria-expanded="false">
		    		<span class="glyphicon glyphicon-heart"></span>
		    	</a>
		    </li>
  		</ul>

	  	<!-- Abas -->
	  	<div class="tab-content">
	    	<div role="tabpanel" class="tab-pane fade active in" id="detalhes">
		    	<?=$this->renderPartial('abas-view/detalhes', ['model' => $model, 'feedback'=>$feedback])?>
			</div>
	    
		    <div role="tabpanel" class="tab-pane fade" id="avaliacoes">
			    <?=$this->renderPartial('abas-view/avaliacoes', ['model' => $model, 'feedback'=>$feedback])?>
		    </div>
	    
		    <div role="tabpanel" class="tab-pane fade" id="mapa">
		      <?=$this->renderPartial('abas-view/mapa', ['model' => $model, 'feedback'=>$feedback])?>
			</div>
		</div>  
	</div> 
</div>