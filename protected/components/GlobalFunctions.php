<?php
	
	class GlobalFunctions 
	{
		private static $error = [];

		public static function die_dump($attr) 
		{
			echo "<pre>";
			print_r($attr);
			echo "</pre>";
			die;
		}

		public static function validateFields($fields, $createHospital=false)
		{
			if (!empty($fields)) {

				foreach ($fields as $key => $value) {
					if (empty($fields[$key])) {
						self::$error[$key] = $key." não pode ser vazio";
					} else {
						if ($key == "email" && !filter_var($fields['email'], FILTER_VALIDATE_EMAIL)) {
							self::$error[$key] = "O e-mail informado não é valido";
						}

						if ($key == "telefone" && !filter_var($fields['telefone'], FILTER_VALIDATE_INT)) {
							self::$error[$key] = "O Telefone informado não é valido";
						}

						if ($createHospital) {
							if (empty($fields['fkplanosaude'])) {
								self::$error['fkplanosaude'] = "Plano de saúde não pode ser vazio";
							}

							if (empty($fields['fkespecialidade'])) {
								self::$error['fkespecialidade'] = "Especialidades não pode ser vazio";
							}
						}
					}
				}

				return self::$error;
			}
		}
	}