<?php

class JsonHandler
{
	public static function sendResponse($status, $msg, $fields="")
	{
		header("Content-Type: application/json");
        $data = json_encode(['status'=>$status, 'msg'=>$msg, 'fields']);
        echo $data;
        exit; 
	}
}