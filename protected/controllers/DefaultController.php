<?php

class DefaultController extends CController
{
	public $horas = ['00:00' => '00:00','01:00' => '01:00','02:00' => '02:00','03:00' => '03:00','04:00' => '04:00','05:00' => '05:00','06:00' => '06:00','07:00' => '07:00','08:00' => '08:00','09:00' => '09:00','10:00' => '10:00','11:00' => '11:00','12:00' => '12:00','13:00' => '13:00','14:00' => '14:00','15:00' => '15:00','15:00' => '15:00','16:00' => '16:00','17:00' => '17:00','18:00' => '18:00','19:00' => '19:00','20:00' => '20:00','21:00' => '21:00','22:00' => '22:00','23:00' => '23:00'];

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

    			$filtroUserCadastrado = $this->filterString($_POST['hospital']);
    			
    			return $this->render('resultado', array(
					'model' => $model, 
					'dataProvider' => $dataProvider,
					'usuario'=>$usuario,
					'filtroUserCadastrado'=>$filtroUserCadastrado,
					)
    			);
    		} else {
    			$filtroUserCadastrado = "";

	    		$regiao = regiao::model()->findByPk($usuario->id_regiao)->nome;
	    		$filtroUserCadastrado = "Região: " . $regiao;
	    		$bairro = bairro::model()->findByPk($usuario->id_bairro)->nome;
	    		$filtroUserCadastrado .= ", Bairro: " . $bairro;
	    		$planoSaude = plano_saude::model()->findByPk($usuario->id_planosaude)->nome;
	    		$filtroUserCadastrado .= ", Plano de Saúde: " . $planoSaude;

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
	     			'usuario'=>$usuario,
	     			'filtroUserCadastrado'=>$filtroUserCadastrado,
	     		]);
	     	}
    	
    	} else {
    		$filtroUserCadastrado = "";
    		
	    	if (isset($_POST['hospital'])) {
				$model->attributes = $_POST['hospital'];
				$filtroUserCadastrado = $this->filterString($_POST['hospital']);
			}
			$dataProvider = $model->search();
    	}
    	
    	$this->render('resultado', [
    		'model' => $model,
    		'dataProvider' => $dataProvider,
    		'usuario'=> $usuario,
    		'filtroUserCadastrado'=>$filtroUserCadastrado
    	]);
	}

	public function actionView($id)
	{	
		$model = hospital::model()->findByPk($id);
		$feedback = feedback::model()->findAll([
			'condition' => 'id_hospital=:id',
			'params' => [
				':id' => $id
			]
		]);

    	$this->render('view', [
    		'model' => $model,
    		'feedback' => $feedback
    	]);
	}

	public function actionEvaluate()
	{	
		if (!empty($_REQUEST['idHospital'])) {
			$feedback = new feedback();
			$model = $feedback->verifyEvaluate($_REQUEST['idHospital'], Yii::app()->user->getState("id"));

			if (isset($_REQUEST['Feedback'])) {
				$model->attributes = $_REQUEST['Feedback'];

				$valid = $model->validate(); 
				$error = CActiveForm::validate($model);
				
				if($valid == false) {
					JsonHandler::sendResponse('error', 'O Feedback não pode ser salvo.', $error);
				} else {
					if($model->save()) {
						JsonHandler::sendResponse('ok', 'Feedback salvo com sucesso.');
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
			
			if ($valid == false) {
				JsonHandler::sendResponse('error', 'Falha ao atualizar o cadastro', $error);
			} else {
				if($model->save()) {
					JsonHandler::sendResponse('ok', 'O cadastro foi atualizado com sucesso.');
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

			if (!empty($_POST['nome_hospital'])) {
				$model->partner = 1;
				$hospital = new hospital();
				$hospital->nome = $_POST['nome_hospital'];
				$hospital->save(false);
				$model->id_hospital = $hospital->primaryKey;
			} else {
				$model->partner = 0;
				$model->id_hospital=0;
			}
			
			$valid = $model->validate(); 
			$error = CActiveForm::validate($model);
			
			if ($valid == false) {
				JsonHandler::sendResponse('error', 'O usuário não pode ser cadastrado.', $error);
			} else {
				if ($model->save()) {
					JsonHandler::sendResponse('ok', 'O usuário foi cadastrado com sucesso.');
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
			
			if ($model->favorite($_POST['id_hospital'], $_POST['id_usuario'])) {
				JsonHandler::sendResponse('ok', 'O hospital foi favoritado com sucesso.');
			} else {
				JsonHandler::sendResponse('error', 'Falha na operação, tente novamente.');
			}

		} else {
			$this->redirect(['Login']);
		}
	}
	
	public function actionUnfavorite()
	{
		if (isset($_POST['id_hospital']) && isset($_POST['id_usuario'])) {
			$model = new favorites();
			
			if ($model->unfavorite($_POST['id_hospital'], $_POST['id_usuario'])) {
				JsonHandler::sendResponse('ok', 'O hospital foi removido dos seus favoritos.');
			} else {
				JsonHandler::sendResponse('error', 'Falha na operação, tente novamente.');
			}
		} else {
			$this->redirect(['Login']);
		}
	}

	public function actionMap()
	{
		$this->render("map");
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
		if (empty($_POST['regiao'])) {
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

	public function actionPartner() 
	{
		if (!empty($_POST)) {

			$error = GlobalFunctions::validateFields($_POST);

			if (!empty($error)) {
				JsonHandler::sendResponse('error', 'A Requisição não pode ser feita,', $error);
			} else {
				$partner = new Partner();

				if ($partner->sendEmail($_POST)) {
					JsonHandler::sendResponse('ok', 'O formulário foi entregue com sucesso.', $error);
				}
			}
		} else {
			$this->render("partner");
		}
	}

	public function actionCreateHospital()
	{
		if (isset($_POST['hospital'])) {	

			$erro = GlobalFunctions::validateFields($_POST['hospital'], true);

			if (!empty($erro)) {
				JsonHandler::sendResponse('error', 'A Requisição não pode ser feita.', $erro);
			} else {
        		$codhospital = hospital::model()->findByAttributes(['nome'=>$_POST['hospital']['nome']])->id;
        		
        		if (JsonHandler::generateJsonFile($codhospital, $_POST['hospital'], $_FILES['hospital'])) {
        			JsonHandler::sendResponse('ok', 'Sua solicitação foi realizada com sucesso.');
        		} else {
        			JsonHandler::sendResponse('error', 'Extensão não suportada, favor utilizar .jpg');
        		}
			}
		} else {
			if (Yii::app()->user->hasState("specialAccess") || Yii::app()->user->hasState("masterAccess")) {
				$usuario = usuario::model()->findByPk(Yii::app()->user->getState("id"));
				$model = hospital::model()->findByPk($usuario->id_hospital);
				$imagens = imagem_hospital::model()->findAllByAttributes(['codhospital'=>$model->id]);
				
				$img = [];
				for ($i=0; $i<count($imagens); $i++) { 
					$img[] = $imagens[$i]->codimagem;
				}

				$this->render("createHospital",[
					'model'=>$model,
					'usuario'=>$usuario,
					'horas'=>$this->horas,
					'imagens'=>$imagens,
					'img'=>$img,
				]);
			} else {
				$this->redirect(['Login']);
			}
		}
	}

	public function actionInsertHospital()
	{
		if (Yii::app()->user->hasState("masterAccess")) {
			$this->render('insertHospital');
		} else {
			$this->redirect(['Login']);
		}
	}

	public function actionInsertJson()
	{
		$error = GlobalFunctions::validateFields($_POST);
		
		if (!empty($error)) {
			JsonHandler::sendResponse('error', 'A requisição não pode ser feita.', $error);	
		}

		if (!empty($_FILES['json_file']['name'])) {
			$ext = pathinfo($_FILES['json_file']['name'], PATHINFO_EXTENSION);

			if ($ext == "json") {
				if (!empty(hospital::model()->findByAttributes(['nome'=>$_POST['nome_hospital']]))) {
					$json = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT']."/RadarHospital/themes/classic/json/".$_POST['nome_hospital'].'/data.json'));
					$codhospital = hospital::model()->findByAttributes(['nome'=>$json->nome])->id;
					
					if (hospital::insertHospital($codhospital, $json)) {
						JsonHandler::sendResponse('ok', 'O Hospital foi inserido com sucesso.');
					} else {
						JsonHandler::sendResponse('error', $e->getMessage());
					}

				} else {
					JsonHandler::sendResponse('error', 'Hospital inválido.');
				}
			} else {
				JsonHandler::sendResponse('error', 'Formato inválido, apenas arquivos .json são aceitos.');
			}
		}
	}

	public function actionDeletePhoto()
	{
		if (isset($_REQUEST['codimagem']) && isset($_REQUEST['codhospital'])) {
			$imagens = new imagens();

			if ($imagens->deletePhoto($_REQUEST['codimagem'], $_REQUEST['codhospital'])) {
				JsonHandler::sendResponse('ok', 'A imagem foi deletada com sucesso.');
			} else {
				JsonHandler::sendResponse('error', 'A imagem não pode ser deletada.');
			}
		}
	}

	public function filterString($filtros)
	{
		$str = "";
		$i = 0;

		foreach ($filtros as $attr => $valor) {
			if (!empty($valor)) {
				if ($i == 0) {
					$str .= str_replace("_"," ", $attr).": ".$valor;
				} else {
					$str .= ", ".str_replace("_"," ", $attr).": ".$valor;
				}
				
				$i++;
			}
		}

		return $str;
	}
}
