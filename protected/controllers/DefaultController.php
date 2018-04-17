<?php

class DefaultController extends CController
{
	
	public function actionIndex()
	{	
		$model = new hospital;
		$planos = plano_saude::model()->findAll();
		$regioes = regiao::model()->findAll();

    	$this->render('index', [
    		'model' => $model,
    		'planos' => $planos,
    		'regioes' => $regioes,
    	]);
	}

	public function actionResultado()
	{	
    	$model = new hospital();
    	$model->unsetAttributes();

    	if (isset($_POST['hospital'])) {
			$model->attributes = $_POST['hospital'];
		}

    	$this->render('resultado', [
    		'dataProvider' => $model->search()
    	]);
	}

	public function actionView($id)
	{	
		$model = hospital::model()->findByPk($id);

    	$this->render('view', [
    		'model' => $model
    	]);
	}

	public function actionevaluate()
	{	
    	$this->render('evaluate');
	}

	public function actionuserArea()
	{	
    	$this->render('userArea');
	}
	
}