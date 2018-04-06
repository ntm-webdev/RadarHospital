<div class="container">
	<img style="height: 230px" src="<?= Yii::app()->theme->baseUrl?>/imgs/main-logo.png" alt="Radar Hospital" class="img img-responsive center">
	<form>
		<div class="form-group">
			<label for="nome-hospital" class="text-beauty">Nome do Hospital</label>
		  	<input type="text" class="form-control" id="nome-hospital">
		</div>
		

		<div class="form-group">
			<label for="regiao" class="text-beauty">Plano de Saúde</label>
		    <select class="form-control" id="regiao">
		    	<option>Bradesco Saúde</option>
		    	<option>Notredame Intermédica</option>
		    	<option>Unimed</option>
		    </select>
	  	</div>
		

		<div class="form-group">
			<label for="regiao" class="text-beauty">Região</label>
		    <select class="form-control" id="regiao">
		    	<option>Zona Norte</option>
		    	<option>Zona Sul</option>
		    	<option>Zona Leste</option>
		    	<option>Zona Oeste</option>
		    </select>
	  	</div>
	  	
	  	<div class="form-group">
	  		<input class="btn btn-success" type="submit" name="btnPesquisar" value="Pesquisar">
		</div>
	</form>
</div>	