<?php

class DefaultController extends CController
{
	
	public function actionIndex()
	{	
		$model = new hospital;

    	$this->render('index', [
    		'model' => $model,
    	]);
	}

	public function actionResultado()
	{	
    	$model = new hospital();
    	$model->unsetAttributes();
		$usuario = usuario::model()->findByPk(Yii::app()->user->getState("id"));

    	if (Yii::app()->user->hasState("nome")) {

    		if (isset($_POST['hospital'])) {
    			$model->attributes = $_POST['hospital'];
    			
    			$dataProvider = $model->search();
    			return $this->render('resultado', array('model' => $model, 'dataProvider' => $dataProvider));
    		} else {   			
	    		$regiao = regiao::model()->findByPk($usuario->id_regiao)->nome;
	    		$bairro = bairro::model()->findByPk($usuario->id_bairro)->nome;
	    		$planoSaude = plano_saude::model()->findByPk($usuario->id_planosaude)->nome;

	  			$model->_regiao = $regiao;
	  			$model->_bairro = $bairro;
	  			$model->_plano_saude = $planoSaude;

	    		$criteria = new CDbCriteria();
	    		$criteria->compare('fkregiao.nome', $regiao);
	    		$criteria->compare('fkplanosaude.nome', $planoSaude);
	    		$criteria->compare('fkbairro.nome', $bairro);


	    		$criteria->together = true;
	        	$criteria->with = ['fkplanosaude','fkregiao','fkbairro'];
	    		
	    		$dataProvider = new CActiveDataProvider($model, [
	    			'criteria' => $criteria,
	    		]);
	     		
	     		return $this->render('resultado', [
	     			'model' => $model, 
	     			'dataProvider' => $dataProvider
	     		]);
	     	}
    	
    	} else {
	    	if (isset($_POST['hospital'])) {
				$model->attributes = $_POST['hospital'];
			}
			$dataProvider = $model->search();
    	}
    	
    	$this->render('resultado', [
    		'dataProvider' => $dataProvider,
    		'model' => $model,
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
		$newRecord = feedback::model()->findByAttributes(['id_hospital'=> $_GET['idHospital'], 'id_usuario'=>Yii::app()->user->getState("id")]);

		if (!empty($newRecord)) {
			$model = $newRecord;
		} else {
			$model = new feedback();
		}

		if (!empty($_GET['Feedback'])) {
			$model->attributes = $_GET['Feedback'];
			$model->id_hospital = $_GET['idHospital'];
			$model->id_usuario = Yii::app()->user->getState("id");
			
			if ($model->save()) {
				$data = json_encode(array('msg' => "Feedback salvo com sucesso."));
				exit($data);
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
				$data = json_encode(array('msg' => "O cadastro foi atualizado com sucesso."));
				exit($data);
			} else {
				$this->render("preferences", [
					'model'=>$model
				]);
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

			$valid = $model->validate(); 
			$error = CActiveForm::validate($model);
			
			if($valid == false) {
                $data = json_encode(array('fields' => $error, 'status'=>'error'));
				exit($data);
			} else {
				if($model->save()) {
					$data = json_encode(array('msg' => 'O usuário foi cadastrado com sucesso.', 'status'=>'ok'));
					exit($data);
				}
			}
			
		} else {
			$this->render("registeruser", [
				'model'=>$model,
			]);
		}
	}

	public function actionFavorite()
	{
		$model = new favorites();
		$model->id_hospital = $_POST['id_hospital'];
		$model->id_usuario = $_POST['id_usuario'];
		
		$model->save();
	}
	
	public function actionUnfavorite()
	{
		favorites::model()->deleteAllByAttributes(['id_hospital' => $_POST['id_hospital'], 'id_usuario'  => $_POST['id_usuario']]);
	}

	public function actionMap()
	{
		$this->renderPartial("map");
	}

	public function actionresultMaps()
	{
		$this->renderPartial("resultMaps");
	}

	public function actionrebuildFilter()
	{
		$model = new hospital();
    	$model->unsetAttributes();
		$usuario = usuario::model()->findByPk(Yii::app()->user->getState("id"));

		$regiao = regiao::model()->findByPk($usuario->id_regiao)->nome;
		$bairro = bairro::model()->findByPk($usuario->id_bairro)->nome;
		$planoSaude = plano_saude::model()->findByPk($usuario->id_planosaude)->nome;

		exit(
			json_encode(
				array(
					'regiao' => $regiao, 
					'bairro' => $bairro, 
					'planoSaude'=>$planoSaude
				)
			)
		);
	}
}
