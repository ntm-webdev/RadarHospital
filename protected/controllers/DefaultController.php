<?php

class DefaultController extends CController
{
	
	public function actionIndex()
	{	
		$model = new hospital;
		$planos = plano_saude::model()->findAll();
		$regioes = regiao::model()->findAll();
		$bairros = bairro::model()->findAll();
		$especialidades = especialidades::model()->findAll();

    	$this->render('index', [
    		'model' => $model,
    		'planos' => $planos,
    		'regioes' => $regioes,
    		'bairros' => $bairros,
    		'especialidades' => $especialidades,
    	]);
	}

	public function actionResultado()
	{	
    	$model = new hospital();
    	$model->unsetAttributes();

    	$planos = plano_saude::model()->findAll();
		$regioes = regiao::model()->findAll();
		$bairros = bairro::model()->findAll();
		$especialidades = especialidades::model()->findAll();

    	if (isset($_POST['hospital'])) {
			$model->attributes = $_POST['hospital'];
		}

    	$this->render('resultado', [
    		'dataProvider' => $model->search(),
    		'model' => $model,
    		'planos' => $planos,
    		'regioes' => $regioes,
    		'bairros' => $bairros,
    		'especialidades' => $especialidades,
    	]);
	}

	public function actionView($id)
	{	
		$model = hospital::model()->findByPk($id);
		$feedback = feedback::model()->findAllByAttributes(['id_hospital'=>$id]);

    	$this->render('view', [
    		'model' => $model,
    		'feedback' => $feedback
    	]);
	}

	public function actionEvaluate()
	{	
		$model = new feedback();

		if (!empty($_GET['Feedback'])) {
			$model->attributes = $_GET['Feedback'];
			$model->id_hospital = $_GET['idHospital'];
			$model->id_usuario = 1;
			
			if ($model->save()) {
				$this->redirect(['view', 'id'=>$_GET['idHospital']]);
			}
		} else {
	    	$this->render('evaluate',[
	    		'model' => $model
	    	], false, true, true);
	    }
	}

	public function actionuserArea()
	{	
    	$this->render('userArea');
	}
	
}
