<?php

class DefaultController extends CController
{
	
	public function actionIndex()
	{	
    	$this->render('index');
	}

	public function actionResultado()
	{	
    	$this->render('resultado');
	}

	public function actionView()
	{	
    	$this->render('view');
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