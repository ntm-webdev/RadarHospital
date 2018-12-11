<?php

class JsonHandler
{
	public static function sendResponse($status, $msg, $fields="")
	{
		header("Content-Type: application/json");
        $data = json_encode(['status'=>$status, 'msg'=>$msg, 'fields'=>$fields]);
        echo $data;
        exit; 
	}

	public static function generateJsonFile($idHospital, $attr, $file="")
	{
		if (!empty($file)) {
			$fotos = [];

			$destino = $_SERVER['DOCUMENT_ROOT']."/RadarHospital/themes/classic/imgs/hosp/".$attr['nome'];
			if (!is_dir($destino)) { 
	    		mkdir($destino,0777,true);
	    	}

	    	$wrongPicturesFormat = false;
        	$errorPhotos= [];

	    	for ($i=1; $i<=4; $i++) {
	    		$indice = (string)$i;

	    		if (!empty(imagem_hospital::model()->findByAttributes(['codimagem'=>$i,'codhospital'=>$idHospital])) || !empty($file['tmp_name']['foto'.$indice])) {
	    			$ext = pathinfo($file['name']['foto'.$indice], PATHINFO_EXTENSION);

	    			if (!empty($file['tmp_name']['foto'.$indice]) && $ext != "jpg") {
						$errorPhotos['foto'.$indice] = 'wrong';
						$wrongPicturesFormat = true;
	    			} else {
						$wrongPicturesFormat = false;
						move_uploaded_file($file['tmp_name']['foto'.$indice], $destino."/".$indice.".jpg");
						$fotos['foto'][] = $i;
	    			}
	    		}
	    	}

			if ($wrongPicturesFormat == true) {
				return false;
			} else {
				$arr = array_merge($attr, $fotos);
			}
		} else {
			$arr = array_merge($attr);
		}

		$folder = $_SERVER['DOCUMENT_ROOT']."/RadarHospital/themes/classic/json/".$attr['nome'];
		if (!is_dir($folder)) { 
			mkdir($folder,0777,true);
		}

		$data = json_encode($arr);
		$fp = fopen($folder.'/data.json', 'w+');
		fwrite($fp, $data);
		chmod($folder.'/data.json', 0777);
		fclose($fp);

		return true;
	}
}