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
				if ($model->save()) {
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

	public function actionPartner() 
	{
		$error = [];
		if (!empty($_POST)) {

			if (empty($_POST['nome'])) {
				$error[] = "Nome cannot be blank"; 
			}

			if (empty($_POST['email'])) {
				$error[] = "E-mail cannot be blank"; 
			} else {
				if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
					$error[] = "E-mail not valid"; 
				}
			}

			if (empty($_POST['telefone'])) {
				$error[] = "Telefone cannot be blank"; 
			} else {
				if (!filter_var($_POST['telefone'], FILTER_VALIDATE_INT)) {
					$error[] = "Telefone not valid"; 
				}
			}

			if (empty($_POST['mensagem'])) {
				$error[] = "Mensagem cannot be blank"; 
			}
			
			if (empty($_POST['nome']) || empty($_POST['email']) || empty($_POST['telefone']) || empty($_POST['mensagem'])) {
				$data = json_encode(array('fields' => $error, 'status'=>'error', 'msg'=>'A Requisição não pode ser feita'));
				exit($data);
			} else {
				Yii::import('application.extensions.phpmailer.JPhpMailer');
				$mail = new JPhpMailer;
				$mail->IsSMTP();
				$mail->SMTPAuth = true;
				$mail->SMTPSecure = 'tls';
				$mail->Host = 'smtp.gmail.com';
				$mail->Port = '587';
				$mail->Username = 'ntm.webdev@gmail.com';
				$mail->Password = 't14c20b7';
				$mail->SetFrom('ntm.webdev@gmail.com', 'Radar Hospital');
				$mail->Subject = 'Nova parceria';
				$mail->Body .= "Nome: ".$_POST['nome']."<br>"; 
				$mail->Body .= "E-mail: ".$_POST['email']."<br>"; 
				$mail->Body .= "Telefone: ".$_POST['telefone']."<br>"; 
				$mail->Body .= "Mensagem: ".$_POST['mensagem'];
				$mail->IsHTML(true); 
				$mail->AddAddress('suporte.radarhospital@gmail.com', $_POST['nome']);
				
				if ($mail->Send()) {
					$data = json_encode(array('msg' => 'O usuário foi cadastrado com sucesso.', 'status'=>'ok'));
					exit($data);
				}
			}
		} else {
			$this->render("partner");
		}
	}

	public function actionCreateHospital()
	{
		if (isset($_POST['hospital'])) {

			$error = [];
			$erro = false;

			if (!filter_var($_POST['hospital']['telefone'], FILTER_VALIDATE_INT)) {
				$error['telefone'] = "Telefone not valid"; 
			}

			foreach ($_POST['hospital'] as $key => $value) {
				if (empty($_POST['hospital'][$key])) {
					$error[$key] = $key." cannot be blank";
					$erro = true; 
				}
			}

			if ($erro == true) {
				$data = json_encode(array('fields' => $error, 'status'=>'error', 'msg'=>'A Requisição não pode ser feita'));
				exit($data);
			} else {
	        	if (!empty($_FILES)) {
	        		$fotos = [];

	        		$destino = $_SERVER['DOCUMENT_ROOT']."/RadarHospital/themes/classic/imgs/hosp/".$_POST['hospital']['nome'];
	        		if(!is_dir($destino)) { 
		        		mkdir($destino,0777,true);
		        	}

	        		if (!empty($_FILES['hospital']['tmp_name']['foto1'])) {
	        			$foto1_tmp = $_FILES['hospital']['tmp_name']['foto1'];
    					move_uploaded_file($foto1_tmp, $destino."/1.jpg");
    					$fotos['foto'][] = 1;
	        		}

	        		if (!empty($_FILES['hospital']['tmp_name']['foto2'])) {
	        			$foto2_tmp = $_FILES['hospital']['tmp_name']['foto2'];
    					move_uploaded_file($foto2_tmp, $destino."/2.jpg");
    					$fotos['foto'][] = 2;
	        		}

	        		if (!empty($_FILES['hospital']['tmp_name']['foto3'])) {
	        			$foto3_tmp = $_FILES['hospital']['tmp_name']['foto3'];
    					move_uploaded_file($foto3_tmp, $destino."/3.jpg");
    					$fotos['foto'][] = 3;
	        		}

	        		if (!empty($_FILES['hospital']['tmp_name']['foto4'])) {
	        			$foto4_tmp = $_FILES['hospital']['tmp_name']['foto4'];
    					move_uploaded_file($foto4_tmp, $destino."/4.jpg");
    					$fotos['foto'][] = 4;
	        		}
	        	}

	        	$folder = $_SERVER['DOCUMENT_ROOT']."/RadarHospital/themes/classic/json/".$_POST['hospital']['nome'];
	        	if (!is_dir($folder)) { 
	        		mkdir($folder,0777,true);
	        	}

	        	$arr = array_merge($_POST['hospital'], $fotos);
				$data = json_encode($arr);
				$fp = fopen($folder.'/data.json', 'w+');
				fwrite($fp, $data);
				chmod($folder.'/data.json', 0777);
				fclose($fp);
				
				$data = json_encode(array('msg' => 'Sua solicitação foi realizada com sucesso.', 'status'=>'ok'));
				exit($data);
			}
		} else {
			if (Yii::app()->user->hasState("specialAccess")) {
				$horas = [
					'00:00' => '00:00',
					'01:00' => '01:00',
					'02:00' => '02:00',
					'03:00' => '03:00',
					'04:00' => '04:00',
					'05:00' => '05:00',
					'06:00' => '06:00',
					'07:00' => '07:00',
					'08:00' => '08:00',
					'09:00' => '09:00',
					'10:00' => '10:00',
					'11:00' => '11:00',
					'12:00' => '12:00',
					'13:00' => '13:00',
					'14:00' => '14:00',
					'15:00' => '15:00',
					'15:00' => '15:00',
					'16:00' => '16:00',
					'17:00' => '17:00',
					'18:00' => '18:00',
					'19:00' => '19:00',
					'20:00' => '20:00',
					'21:00' => '21:00',
					'22:00' => '22:00',
					'23:00' => '23:00',
				];
				$model = new hospital();
				$usuario = usuario::model()->findByPk(Yii::app()->user->getState("id"));
				$this->render("createHospital",[
					'model'=>$model,
					'usuario'=>$usuario,
					'horas'=>$horas
				]);
			} else {
				$this->redirect(['Login']);
			}
		}
	}

	public function actionInsertHospital()
	{
		if (isset($_POST['yt0'])) {
			if (!empty($_FILES['json_file']['name'])) {
				$str = file_get_contents($_SERVER['DOCUMENT_ROOT']."/RadarHospital/themes/classic/json/".$_POST['nome_hospital'].'/data.json');
				$json = json_decode($str);
				
				$transaction = Yii::app()->db->beginTransaction();
				try {
					#hospital
					$model = new hospital();
					$model->nome = $json->nome;
					$model->endereco = $json->endereco;
					$model->latitude = $json->latitude;
					$model->longitude = $json->longitude;
					$model->id_regiao = $json->_regiao;
					$model->id_bairro = $json->_bairro;
					$model->telefone = $json->telefone;
					$model->site = $json->site;
					$model->url_mapa = $json->url_mapa;
					$model->save();

					#especialidade
					$codhospital = hospital::model()->findByAttributes(['nome'=>$json->nome])->id;
					foreach ($json->_especialidade as $key => $value) {
						$parameters = array(
							":codespecialidade"=>$value,
							":codhospital"=>$codhospital,
						);
						Yii::app()->db->createCommand('INSERT INTO especialidade_hospital VALUES (:codespecialidade, :codhospital)')->execute($parameters);
					}
					
					#plano saude
					$codhospital = hospital::model()->findByAttributes(['nome'=>$json->nome])->id;
					foreach ($json->_plano_saude as $key => $value) {
						$parameters = array(
							":codplano"=>$value,
							":codhospital"=>$codhospital,
						);
						Yii::app()->db->createCommand('INSERT INTO plano_hospital VALUES (:codplano, :codhospital)')->execute($parameters);
					}

					#imagens
					$codhospital = hospital::model()->findByAttributes(['nome'=>$json->nome])->id;
					foreach ($json->foto as $key => $value) {
						$parameters = array(
							":codimagem"=>$value,
							":codhospital"=>$codhospital,
						);
						Yii::app()->db->createCommand('INSERT INTO imagem_hospital VALUES (:codhospital, :codimagem)')->execute($parameters);
						
					}


					//$data = json_encode(array('msg' => 'O hospital foi cadastrado com sucesso.', 'status'=>'ok'));
					//echo($data);
					
					/*
					echo "<pre>";
					print_r($model->attributes);
					echo "</pre>";
					die;*/

				    $transaction->commit();
				} catch(Exception $e) {
				   $transaction->rollBack();
				}

			} else {
				$data = json_encode(array('msg' => 'Selecione um arquivo json.', 'status'=>'error'));
				exit($data);
			}
		} else {
			if (Yii::app()->user->hasState("masterAccess")) {
				$this->render('insertHospital');
			} else {
				$this->redirect(['Login']);
			}
		}
	}
}
