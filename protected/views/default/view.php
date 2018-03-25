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
		    	<div class="row row-avaliacoes">
		    		
		    		<div>
			    		<p class="text-beauty">Informações gerais</p>
			    		<p>Nome: Hospital Previna Saúde</p>
			    		<p>Região: Zona Oeste</p>
			    		<p>Bairro: Centro</p>
						<p>Endereço: R. Gen. Vicente de Paula Coutinho, 68/52/32 - Centro, Franco da Rocha - SP</p>
			    		<hr>
			    	</div>

		    		<div>
			    		<p class="text-beauty">Horário de Funcionamento</p>
			    		<p>Domingo: Atendimento 24 horas</p>
			    		<p>Segunda-feira: Atendimento 24 horas</p>
			    		<p>Terça-feira: Atendimento 24 horas</p>
			    		<p>Quarta-feira: Atendimento 24 horas</p>
			    		<p>Quinta-feira: Atendimento 24 horas</p>
			    		<p>Sexta-feira: Atendimento 24 horas</p>
			    		<p>Sábado: Atendimento 24 horas</p>
			    		<hr>
			    	</div>

			    	<div>
			    		<p class="text-beauty">Especialidades</p>
			    		<p>Cardiologia</p>
			    		<p>Clínica Geral</p>
			    		<p>Ortopedia</p>
			    		<p>Alergista</p>
			    		<hr>
			    	</div>

		    		<div>
			    		<p class="text-beauty">Planos de Saúde</p>
			    		<p>Unimed</p>
			    		<p>Bradesco Saúde</p>
			    		<hr>
			    	</div>

		    		<div>
			    		<p class="text-beauty">Contato</p>
			    		<p><i class="fa fa-link"></i> Site</p>
			    		<p><i class="fa fa-phone"></i> +55114445-9080</p>
			    		<hr>
			    	</div>
		    	</div>
		    	
			</div>
	    
		    <div role="tabpanel" class="tab-pane fade" id="avaliacoes">
			    <div class="row row-avaliacoes">
			    	<?=CHtml::tag('a', ['href'=>'http://localhost/RadarHospital/index.php/default/evaluate'], '<i class="fa fa-user-plus pointer"></i>
			    		Adicionar avaliação')?>
			    	<hr>
			    	<p class="text-beauty">Excelente</p>
			    	<p>Ótimo atendimento, equipe muito atenciosa e médicos super-capacitados</p>
			    	<p>
			    		<i class="fa fa-star"></i>
			    		<i class="fa fa-star"></i>
			    		<i class="fa fa-star"></i>
			    		<i class="fa fa-star"></i>
			    		100%
			    	</p>
			    </div> 
			    <hr>
			    <div class="row row-avaliacoes">
			    	<p class="text-beauty">Bom</p>
			    	<p>Bom atendimento, blablabla</p>
			    	<p>
			    		<i class="fa fa-star"></i>
			    		<i class="fa fa-star"></i>
			    		<i class="fa fa-star"></i>
			    		<i class="fa fa-star-o"></i>
			    		75%
			    	</p>
			    </div> 
			    <hr>
			    <div class="row row-avaliacoes">
			    	<p class="text-beauty">Razoável</p>
			    	<p>blablablablablabalbalbalbalbalbalblbalbalba</p>
			    	<p>
			    		<i class="fa fa-star"></i>
			    		<i class="fa fa-star"></i>
			    		<i class="fa fa-star-o"></i>
			    		<i class="fa fa-star-o"></i>
			    		50%
			    	</p>
			    </div> 
			    <hr>
			    <div class="row row-avaliacoes">
			    	<p class="text-beauty">Ruim</p>
			    	<p>blablablablablabalbalbalbalbalbalblbalbalba</p>
			    	<p>
			    		<i class="fa fa-star"></i>
			    		<i class="fa fa-star-o"></i>
			    		<i class="fa fa-star-o"></i>
			    		<i class="fa fa-star-o"></i>
			    		25%
			    	</p>
			    </div> 
		    </div>
	    
		    <div role="tabpanel" class="tab-pane fade" id="mapa">
			    <div class="map-responsive">
			    	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3663.598248608264!2d-46.73033238502651!3d-23.3303309847981!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94cee43cc0d9c8a9%3A0x6bf97911c2c29ab3!2sHospital+Previna+-+Franco+da+Rocha!5e0!3m2!1spt-BR!2sbr!4v1520087090405" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
			    </div>   
			</div>
		</div>  
		</div> 
	</div>