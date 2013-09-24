<?php

class Fw_Auth_Controller extends Fw_Controller {

	public function __construct() {
		$this->layout = 'blank';
	}

	public function login() {
		//TODO: Funcs OK, but can be done more well. (A config file, for example).
		$this->layout = 'form';
		$user = Fw_Register::getRef('user');
		if (isset($user['usertype'])) {
			switch ($user['usertype']) {
				case 'admin' : 
					$url = BASE_URI.'admin'; 
					break;
				case 'guest' :
				default : $url = BASE_URI;
					break;
			}
			header("Location: $url");
			exit();
		}

		$oModel = new User_Model();
		$username = Fw_Filter::getVar('username', 'default', 'post');
		$pwd = Fw_Filter::getVar('pwd', 'default', 'post');
		$oUser = $oModel->userExists($username, md5($pwd));
		if ($oUser) {
			$lifetime = time() + 365 * 24 * 60 * 60;
			$value = implode('&&&&', array('username' => md5($username), 'pwd' => md5($pwd)));
			setcookie('user', $value, $lifetime, '/');
			switch ($oUser['usertype']) {
				case 'admin' : 
					$url = BASE_URI.'admin'; 
					break;
				case 'guest' :
				default : $url = BASE_URI;
					break;
			}
			header("Location: $url");
			exit();
		}
		parent::display('login', true);
	}

	public function logout() {
		$lifetime = time() - 365 * 24 * 60 * 60;
		$value = '';
		setcookie('user', $value, $lifetime, '/');
		header('Location: ' . BASE_URI);
		exit();
	}

	public function recovery() {
		$username = Fw_Filter::getVar('recovery_username', 'default', 'post');
		if (!empty($username) && $username != 'admin') {
			$oModel = new User_Model();
			$oUser = $oModel->getByUsername($username);
			if (!empty($oUser)) {
				$password = Random_Helper::getPassword();
				$oModel->setRow(array('password' => md5($password)), $oUser['id']);
				if (Validator_Helper::isEmail($username)) {
					$subject = 'Recovery Password';
					$template = 'transactional_with_button';
					$body = file_get_contents(MAIL_TXT_PATH . DS . 'user_recovery_password.php');
					$body = str_replace('#USERNAME#', $username, $body);
					$body = str_replace('#PASSWORD#', $password, $body);
					$replaces = array(
						'TITLE' => 'Recovery Password',
						'SUBJECT' => 'Recovery Password',
						'BODY' => $body,
						'BUTTON_LINK' => Fw_Register::getConfig('fw_base_domain') . 'login',
						'BUTTON_TEXT' => 'Go to the Admin Panel',
					);
					$to = array(
						array(
							'name' => $username,
							'email' => $username
						)
					);
				}
				Fw_Register::addMessage('Email sent to your account.');
			} else {
				Fw_Register::addMessage('This username is not registered in the system.', 'error');
			}
		} else {
			Fw_Register::addMessage('Empty or invalid username.', 'error');
		}
		header("Location: " . BASE_URI . 'login');
		exit();
	}

}

?>
