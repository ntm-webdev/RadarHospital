<?php

class DefaultController extends CController
{
	
	public function actionIndex()
	{	
		$model = new hospital;
		$model->unsetAttributes();
		$usuario = usuario::model()->findByPk(Yii::app()->user->getState("id"));

		if (Yii::app()->user->hasState("nome")) {
	    	$regiao = regiao::model()->findByPk($usuario->id_regiao)->nome;
    		$bairro = bairro::model()->findByPk($usuario->id_bairro)->nome;
    		$planoSaude = plano_saude::model()->findByPk($usuario->id_planosaude)->nome;

  			$model->_regiao = $regiao;
  			$model->_bairro = $bairro;
  			$model->_plano_saude = $planoSaude;
	    }

    	$this->render('index', [
    		'model' => $model,
    		'usuario' => $usuario
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
    			
    			return $this->render('resultado', array(
						'model' => $model, 
						'dataProvider' => $dataProvider,
						'usuario'=>$usuario
					)
    			);
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
	     			'dataProvider' => $dataProvider,
	     			'usuario'=>$usuario
	     		]);
	     	}
    	
    	} else {
	    	if (isset($_POST['hospital'])) {
				$model->attributes = $_POST['hospital'];
			}
			$dataProvider = $model->search();
    	}
    	
    	$this->render('resultado', [
    		'model' => $model,
    		'dataProvider' => $dataProvider,
    		'usuario'=> $usuario
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
		if (!empty($_REQUEST['idHospital'])) {
			$newRecord = feedback::model()->findByAttributes(['id_hospital'=> $_REQUEST['idHospital'], 'id_usuario'=>Yii::app()->user->getState("id")]);

			if (!empty($newRecord)) {
				$model = $newRecord;
			} else {
				$model = new feedback();
			}

			if (!empty($_REQUEST['Feedback'])) {
				$model->attributes = $_REQUEST['Feedback'];
				$model->id_hospital = $_REQUEST['idHospital'];
				$model->id_usuario = Yii::app()->user->getState("id");

				$valid = $model->validate(); 
				$error = CActiveForm::validate($model);
				
				if($valid == false) {
	                $data = json_encode(array('fields' => $error, 'status'=>'error', 'msg'=>'O Feedback não pode ser salvo'));
					exit($data);
				} else {
					if($model->save()) {
						$data = json_encode(array('msg' => 'Feedback salvo com sucesso.', 'status'=>'ok'));
						exit($data);
					}
				}
			} else {
		    	$this->render('evaluate',[
		    		'model' => $model
		    	], false, true, true);
		    }
		} else {
			$this->redirect(['Login']);
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

			$valid = $model->validate(); 
			$error = CActiveForm::validate($model);
			
			if($valid == false) {
                $data = json_encode(array('fields' => $error, 'status'=>'error', 'msg'=>'Falha ao atualizar o cadastro'));
				exit($data);
			} else {
				if($model->save()) {
					$data = json_encode(array('msg' => 'O cadastro foi atualizado com sucesso.', 'status'=>'ok'));
					exit($data);
				}
			}
		} else {
	    	$this->render('preferences',[
	    		'model' => $model,
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

		if (empty($model)) {
			$this->redirect(['Login']);
		} else {
	    	$this->render('favorites', [
	    		'model' => $model,
	    		'dataProvider' => $model->search()
	    	]);
	    }
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
                $data = json_encode(array('fields' => $error, 'status'=>'error', 'msg'=>'O usuário não pode ser cadastrado'));
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
		if (isset($_POST['id_hospital']) && isset($_POST['id_usuario'])) {
			$model = new favorites();
			$model->id_hospital = $_POST['id_hospital'];
			$model->id_usuario = $_POST['id_usuario'];
			
			$model->save();
		} else {
			$this->redirect(['Login']);
		}
	}
	
	public function actionUnfavorite()
	{
		if (isset($_POST['id_hospital']) && isset($_POST['id_usuario'])) {
			favorites::model()->deleteAllByAttributes(['id_hospital' => $_POST['id_hospital'], 'id_usuario'  => $_POST['id_usuario']]);
		} else {
			$this->redirect(['Login']);
		}
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

		$regiao = regiao::model()->findByPk($usuario->id_regiao);
		$bairro = bairro::model()->findByPk($usuario->id_bairro);
		$planoSaude = plano_saude::model()->findByPk($usuario->id_planosaude);

		exit(
			json_encode(
				array(
					'regiao' => $regiao->nome, 
					'bairro' => $bairro->nome, 
					'planoSaude'=>$planoSaude->nome,
					'indiceRegiao' =>$regiao->id,
					'indiceBairro' =>$bairro->id,
					'indicePlanoSaude' =>$planoSaude->id
				)
			)
		);
	}

	public function actionAssociaBairroRegiao()
	{
		if(empty($_POST['regiao'])) {
			$bairros = bairro::model()->findAll();
			
			$nomeBairros = [];
			$idBairros = [];
			for ($i=0; $i < count($bairros); $i++) { 
				$nomeBairros[$i] = $bairros[$i]->nome.",";
				$idBairros[$i] = $bairros[$i]->id.",";
			}

			$strBairros = str_replace(",,", ",",implode(",", $nomeBairros));
			$strBairros .= "";
			$strIdBairros = str_replace(",,", ",",implode(",", $idBairros));
			$strIdBairros .= "";
			
			exit(
				json_encode(
					array( 
						'bairros' => $strBairros, 
						'idBairros' => $strIdBairros, 
					)
				)
			);
		} else {
			if (!is_numeric($_POST['regiao'])) {
				$idRegiao = regiao::model()->findByAttributes(['nome'=>$_POST['regiao']])->id;
			} else {
				$idRegiao = $_POST['regiao'];
			}
			
			$bairros = bairro::model()->findAllByAttributes([
				'id_regiao'=>$idRegiao
			]);
			
			$nomeBairros = [];
			$idBairros = [];
			for ($i=0; $i < count($bairros); $i++) { 
				$nomeBairros[$i] = $bairros[$i]->nome.",";
				$idBairros[$i] = $bairros[$i]->id.",";
			}

			$strBairros = str_replace(",,", ",",implode(",", $nomeBairros));
			$strIdBairros = str_replace(",,", ",",implode(",", $idBairros));
			
			exit(
				json_encode(
					array( 
						'bairros' => $strBairros, 
						'idBairros' => $strIdBairros, 
					)
				)
			);
		}	
	}
}
