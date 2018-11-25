<?php
	
	class GlobalFunctions 
	{
		public static function cryptPwd($pwd)
		{
			return md5($pwd);
		}

		public static function die_dump($attr) 
		{
			echo "<pre>";
			print_r($attr);
			echo "</pre>";
			die;
		}
	}