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
			$model->id_usuario = Yii::app()->user->getState("id");
			
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

	public function actionPreferences()
	{	
		$model = usuario::model()->findByPk(Yii::app()->user->getState("id"));

		if (isset($_POST['Usuario'])) {
			$model->attributes = $_POST['Usuario'];

			if ($model->save()) {
				$this->redirect(['userArea']);
			}
		} else {
	    	$this->render('preferences',[
	    		'model' => $model
	    	]);
	    }
	}

	public function actionAbout()
	{	
    	$this->render('about');
	}

	public function actionFavorites()
	{	
		$model = usuario::model()->findByPk(Yii::app()->user->getState("id"));

    	$this->render('favorites', [
    		'model' => $model,
    		'dataProvider' => $model->search()
    	]);
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()) {
				$this->redirect(['userArea']);
			}
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(['index']);
	}

	public function actionregisterUser()
	{
		$model = new usuario();

		if (isset($_POST['Usuario'])) {
			$model->attributes = $_POST['Usuario'];
			
			$criteria=new CDbCriteria;
			$criteria->select='max(id) AS maxColumn';
			$row = $model->model()->find($criteria);
			$somevariable = $row['maxColumn'] + 1;
			$model->id = $somevariable;
			
			if ($model->save()) {
				$this->redirect(['login']);
			}
		} else {
			$this->render("registeruser", [
				'model'=>$model
			]);
		}
	}
	
}
