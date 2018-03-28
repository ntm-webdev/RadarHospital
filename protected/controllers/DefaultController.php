<?php

class DefaultController extends CController
{
	
	public function actionIndex()
	{	
    	$this->render('index');
	}

	public function actionResultado()
	{	
    	$model = hospital::model()->findAll();

    	$this->render('resultado', [
    		'model' => $model
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