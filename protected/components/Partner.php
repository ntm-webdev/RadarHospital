<?php

class Partner 
{
	public function sendEmail($fields)
	{
		Yii::import('application.extensions.phpmailer.JPhpMailer');

		$mail = new JPhpMailer;
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tls';
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = '587';
		$mail->Username = 'root.radarhospital@gmail.com';
		$mail->Password = 'admin1234LX';
		$mail->SetFrom('root.radarhospital@gmail.com', 'Radar Hospital');
		$mail->Subject = 'Nova parceria';
		$mail->Body .= "Nome: ".$fields['nome']."<br>"; 
		$mail->Body .= "E-mail: ".$fields['email']."<br>"; 
		$mail->Body .= "Telefone: ".$fields['telefone']."<br>"; 
		$mail->Body .= "Mensagem: ".$fields['mensagem'];
		$mail->IsHTML(true); 
		$mail->AddAddress('suporte.radarhospital@gmail.com', $fields['nome']);

		if ($mail->Send()) {
			return true;
		} else {
			return false;
		}
	}
	
}