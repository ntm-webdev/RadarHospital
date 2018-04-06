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
		      		<img style="width: 800; height: 280px;" src="<?= Yii::app()->theme->baseUrl?>/imgs/hosp/1.jpg" class="img img-responsive" alt="Los Angeles">
		    	</div>

		    	<div class="item">
		      		<img style="width: 800; height: 280px;" src="<?= Yii::app()->theme->baseUrl?>/imgs/hosp/2.jpg" class="img img-responsive" alt="Chicago">
		    	</div>

		    	<div class="item">
		      		<img style="width: 800; height: 280px;" src="<?= Yii::app()->theme->baseUrl?>/imgs/hosp/4.jpg" class="img img-responsive" alt="New York">
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
			    		<p><b>Nome:</b> Hospital Previna Saúde</p>
			    		<p><b>Região:</b> Zona Oeste</p>
			    		<p><b>Bairro:</b> Centro</p>
						<p><b>Endereço:</b> R. Gen. Vicente de Paula Coutinho, 68/52/32 - Centro, Franco da Rocha - SP</p>
			    		<hr>
			    	</div>

		    		<div>
			    		<p class="text-beauty">Horário de Funcionamento</p>
			    		<p><b>Domingo:</b> Atendimento 24 horas</p>
			    		<p><b>Segunda-feira:</b> Atendimento 24 horas</p>
			    		<p><b>Terça-feira:</b> Atendimento 24 horas</p>
			    		<p><b>Quarta-feira:</b> Atendimento 24 horas</p>
			    		<p><b>Quinta-feira:</b> Atendimento 24 horas</p>
			    		<p><b>Sexta-feira:</b> Atendimento 24 horas</p>
			    		<p><b>Sábado:</b> Atendimento 24 horas</p>
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
			    		<p><i class="fa fa-link"></i> <a href="#">Website</a></p>
			    		<p><i class="fa fa-phone"></i> +55114445-9080</p>
			    		<hr>
			    	</div>
		    	</div>
		    	
			</div>
	    
		    <div role="tabpanel" class="tab-pane fade" id="avaliacoes">
		    	<p></p>
		    	<div class="row row-avaliacoes">
		    		<?=CHtml::tag('a', ['href'=>'http://localhost/RadarHospital/index.php/default/evaluate', 'style'=>'font-size: 15px;'], '<button class="btn btn-purple"><i class="fa fa-user-plus pointer"></i>
		    		Adicionar avaliação</button>')?>
		    		<hr class="hr-beauty">
			    </div>

			    <div class="row row-avaliacoes">
			    	<p>
			    		<b>Leandro Kil, em 23/04/2018</b>
			    	</p>
			    	<p>Ótimo atendimento, equipe muito atenciosa e médicos super-capacitados.</p>
			    	<p class="text-beauty">
			    		Atendimento 
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star-o"></i> 
			    		<i class="fa fa-star-o"></i>
			    	</p>
			    	<p class="text-beauty">
			    		Atendimento Médico
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star-o"></i>
			    	</p>
			    	<p class="text-beauty">
			    		Higiene 
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star"></i>
			    	</p>
			    	<p class="text-beauty">Infraestrutura 
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star-o"></i>
			    	</p>
			    </div>

			   	<hr class="hr-beauty">

			   	<div class="row row-avaliacoes">
			    	<p>
			    		<b>Leandro Kil, em 23/04/2018</b>
			    	</p>
			    	<p>Ótimo atendimento, equipe muito atenciosa e médicos super-capacitados.</p>
			    	<p class="text-beauty">
			    		Atendimento 
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star-o"></i> 
			    		<i class="fa fa-star-o"></i>
			    	</p>
			    	<p class="text-beauty">
			    		Atendimento Médico
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star-o"></i>
			    	</p>
			    	<p class="text-beauty">
			    		Higiene 
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star"></i>
			    	</p>
			    	<p class="text-beauty">Infraestrutura 
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star-o"></i>
			    	</p>
			    </div>
			    
			   	<hr class="hr-beauty">

			   	<div class="row row-avaliacoes">
			    	<p>
			    		<b>Leandro Kil, em 23/04/2018</b>
			    	</p>
			    	<p>Ótimo atendimento, equipe muito atenciosa e médicos super-capacitados.</p>
			    	<p class="text-beauty">
			    		Atendimento 
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star-o"></i> 
			    		<i class="fa fa-star-o"></i>
			    	</p>
			    	<p class="text-beauty">
			    		Atendimento Médico
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star-o"></i>
			    	</p>
			    	<p class="text-beauty">
			    		Higiene 
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star"></i>
			    	</p>
			    	<p class="text-beauty">Infraestrutura 
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star"></i> 
			    		<i class="fa fa-star-o"></i>
			    	</p>
			    </div>
			    
			   	<hr class="hr-beauty">
		    </div>
	    
		    <div role="tabpanel" class="tab-pane fade" id="mapa">
			    <div class="map-responsive">
			    	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3663.598248608264!2d-46.73033238502651!3d-23.3303309847981!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94cee43cc0d9c8a9%3A0x6bf97911c2c29ab3!2sHospital+Previna+-+Franco+da+Rocha!5e0!3m2!1spt-BR!2sbr!4v1520087090405" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
			    </div>   
			</div>
		</div>  
		</div> 
	</div>