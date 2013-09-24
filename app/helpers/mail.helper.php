<?php

class Mail_Helper {

	public static function send($subject, $to, $html, $attachments = array(), $from = false, $replyto = false) {
		require_once LIBS_PATH . DS . 'phpmailer' . DS . 'class.phpmailer.php';
		if (empty($from)) {
			$from = array(
				'email' => Fw_Register::getConfig('from_email'),
				'name' => Fw_Register::getConfig('from_name')
			);
		}
		if (empty($replyto)) {
			$replyto = array(
				'email' => Fw_Register::getConfig('replyto_email'),
				'name' => Fw_Register::getConfig('replyto_name')
			);
		}
		$mail = new PHPMailer(true);
		$mail->IsSMTP();
		try {
			$mail->Host = Fw_Register::getConfig('mail_host');
			$mail->Port = Fw_Register::getConfig('mail_port');
			$mail->AddReplyTo($replyto['email'], $replyto['name']);
			$mail->SetFrom($from['email'], $from['name']);

			$to_str = '';
			foreach ($to as $address) {
				$mail->AddAddress($address['email'], $address['name']);
				$to_str .= "{$address['name']} < {$address['email']} >\n";
			}
			$mail->Subject = $subject;
			$mail->MsgHTML($html);

			$attachment_str = '';
			foreach ($attachments as $attachment) {
				$mail->AddAttachment($attachment['path'], $attachment['name']);
				$attachment_str .= "{$attachment['path']}\n";
			}
			$mail_user = Fw_Register::getConfig('mail_user');
			if (!empty($mail_user)) {
				$mail->SMTPAuth = true;
				$mail->Username = Fw_Register::getConfig('mail_user');
				$mail->Password = Fw_Register::getConfig('mail_pwd');
			}
			$mail->Send();

			//Track the sending email
			$oDb = Fw_Db::getInstance(DB_INSTANCE);
			$sSQL = <<<SQL
INSERT INTO email_sended
	SET `to` = :to,
		`from` = :from,
		`subject` = :subject,
		`ts_creation` = NOW(),
		`ts_update` = NOW()
SQL;
			$statement = $oDb->prepare($sSQL);
			foreach ($to as $address) {
				$to_str = "{$address['name']} < {$address['email']} >";
				$from_str = "{$from['name']} < {$from['email']} >";
				$statement->bindParam(':to', $to_str, PDO::PARAM_STR);
				$statement->bindParam(':from', $from_str, PDO::PARAM_STR);
				$statement->bindParam(':subject', $subject, PDO::PARAM_STR);
				$statement->execute();
			}
			return true;
		} catch (phpmailerException $e) {
			return false;
		} catch (Exception $e) {
			return false;
		}
	}

	public static function sendTemplate($subject, $to, $template, $replaces = array(), $attachments = array(), $from = false, $replyto = false) {
		$html = file_get_contents(MAIL_TPL_PATH . DS . $template . '.php');
		foreach ($replaces as $search => $replace) {
			$html = str_replace('#' . $search . '#', $replace, $html);
		}
		self::send($subject, $to, $html, $attachments, $from, $replyto);
	}

}

?>
