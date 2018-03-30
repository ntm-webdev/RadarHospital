<body style="background-color: #f2f2f2">
	<div id="main">
		<div class="container">
			<div id="mySidenav" class="sidenav">
			  	<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			  	<form>
			  		<div class="form-group">
			  			<label class="text-beauty">Bairro</label>
			  			<select class="form-control">
			  				<option>Paraíso</option>
			  				<option>Alto da Lapa</option>
			  				<option>Consolação</option>
			  				<option>Pirituba</option>
			  			</select>
			  		</div>

			  		<div class="form-group">
			  			<label class="text-beauty">Especialidade</label>
			  			<select class="form-control">
			  				<option>Pediatria</option>
			  				<option>Alergista</option>
			  				<option>Ortopedia</option>
			  				<option>Neurologia</option>
			  			</select>
			  		</div>

			  		<div class="form-group">
						<label class="text-beauty" for="regiao">Região</label>
					    <select class="form-control" id="regiao">
					    	<option>Zona Norte</option>
					    	<option>Zona Sul</option>
					    	<option>Zona Leste</option>
					    	<option>Zona Oeste</option>
					    </select>
				  	</div>

				  	<div class="form-group">
						<label class="text-beauty" for="regiao">Plano de Saúde</label>
					    <select class="form-control" id="regiao">
					    	<option>Bradesco Saúde</option>
					    	<option>Notredame Intermédica</option>
					    	<option>Unimed</option>
					    </select>
				  	</div>

				  	<div class="form-group">
				  		<input class="btn btn-success" type="submit" name="btnPesquisar" value="Pesquisar">
					</div>
			  	</form>
			</div>

			<div class="row resultado">
				<p></p>

				<div class="col-xs-4">
					<i class="fa fa-filter pointer" onclick="openNav()"></i>
				</div>

				<div class="col-xs-4">
					<i class="fa fa-map pointer"></i>
				</div>

				<div class="col-xs-4">
					<?=CHtml::tag('a', ['href'=>'http://localhost/RadarHospital/index.php/default/userArea', 'class'=> 'no-link'], '<i class="fa fa-user pointer"></i>')?>
				</div>

				<br>

			</div>
			
			<br>

			<?php for($i=0;$i < count($model); $i++) : ?>
				<div class="row">
					<div class="media resultado">
					 	<div class="media-left">
					      	<img class="media-object" src="<?=Yii::app()->theme->baseUrl?>/imgs/hospital.jpg" alt="...">
					  	</div>
					  	<div class="media-body">
					    	<h5 class="media-heading text-beauty"><?=$model[$i]->nome?></h5>
						    <p>
								<i class="fa fa-map-marker"></i> 
								<?=$model[$i]->endereco?>
								<hr>
								<?=CHtml::link("Detalhes", ['default/view', 'id'=>$model[$i]->id], ['class'=>'btn btn-success pull-right'])?>
							</p>
					  	</div>
					</div>
				</div>

				<p></p>
			<?php endfor ?>
			
		</div>
	</div>
</body>
