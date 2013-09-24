<?php

class Fw_Customer_Controller extends Fw_CrudController {

	public function __construct() {
		$this->model = 'Customer_Model';
		$this->setParams = array(
			'name' => array('type' => 'default', 'container' => 'post'),
			'surname' => array('type' => 'default', 'container' => 'post'),
			'email' => array('type' => 'default', 'container' => 'post'),
			'password' => array('type' => 'default', 'container' => 'post', 'modifier' => 'md5'),
			'confirmed' => array('type' => 'default', 'container' => 'post')
		);
		$this->adminParams = array(
			'ID' => 'id',
			'Name' => 'name',
			'Surname' => 'surname',
			'Email' => 'email',
			'Confirmed' => 'confirmed',
			'Created At' => 'ts_creation',
		);
		$this->editParams = array(
			'Name' => array('type' => 'text', 'name' => 'name', 'populate' => true),
			'Surname' => array('type' => 'text', 'name' => 'surname', 'populate' => true),
			'Email' => array('type' => 'text', 'name' => 'email', 'populate' => true),
			'Password' => array('type' => 'password', 'name' => 'password', 'populate' => false),
			'Confirmed' => array('type' => 'text', 'name' => 'confirmed', 'populate' => true),
		);
	}

	public function login() {
		$customer = Fw_Register::getRef('customer');
		if (isset($customer['id'])) {
			header('Location: ' . BASE_URI . 'customer/profile');
			exit();
		}

		$oModel = new Customer_Model();
		$email = Fw_Filter::getVar('customer_email', 'default', 'post');
		$pwd = Fw_Filter::getVar('customer_password', 'default', 'post');
		$oCustomer = $oModel->customerExists($email, md5($pwd));
		if ($oCustomer) {
			$lifetime = time() + 365 * 24 * 60 * 60;
			$value = implode('&&&&', array('username' => md5($email), 'pwd' => md5($pwd)));
			setcookie('customer', $value, $lifetime, '/');
			header('Location: ' . BASE_URI . 'customer/profile');
			exit();
		}
		Fw_Register::addMessage('Login incorrect', 'error');
		header('Location: ' . BASE_URI);
		exit();
	}

	public function logout() {
		$lifetime = time() - 365 * 24 * 60 * 60;
		$value = '';
		setcookie('customer', $value, $lifetime, '/');
		header('Location: ' . BASE_URI);
		exit();
	}

	public function register() {
		$email = Fw_Filter::getVar('customer_email', 'default', 'post');
		$email = strtolower($email);
		if (Validator_Helper::isEmail($email)) {
			$oModel = new Customer_Model();
			if (!$oModel->isEmailRegistered($email)) {
				$errors = $oModel->setRow(
						array(
							'email' => $email,
							'password' => Fw_Filter::getVar('customer_password', 'default', 'post')
						)
				);
				if (is_numeric($errors)) {
					$body = file_get_contents(MAIL_TXT_PATH . DS . 'customer_create.php');
					$oCustomer = $oModel->getRow($errors);
					$oModel->setRow(
							array(
						'email' => $oCustomer['email'],
						'password' => md5($oCustomer['password'])
							), $oCustomer['id']
					);
					Mail_Helper::sendTemplate(
							'Account confirmation', array(
						array(
							'email' => $oCustomer['email'],
							'name' => $oCustomer['email']
						),
							), 'transactional_with_button', array(
						'TITLE' => 'Account confirmation',
						'SUBJECT' => 'Account confirmation',
						'BODY' => $body,
						'BUTTON_LINK' => Fw_Register::getConfig('fw_base_domain') . 'customer/confirm/' . $oCustomer['id'] . '/' . $oCustomer['seed'],
						'BUTTON_TEXT' => 'Confirm your account'
							)
					);
					Fw_Register::addMessage('Confirmation email sent to your account');
				}
			} else {
				Fw_Register::addMessage('This email is already registered', 'error');
			}
		} else {
			Fw_Register::addMessage('Email field is not an email', 'error');
		}
		header('Location: ' . BASE_URI);
		exit();
	}

	public function subscribe() {
		$email = Fw_Filter::getVar('customer_email', 'default', 'post');
		$email = strtolower($email);
		$landing_visit = Fw_Filter::getVar('landing_visit', 'default', 'post');
		$password = Random_Helper::getPassword();
		$error = false;
		if (Validator_Helper::isEmail($email)) {
			$oModel = new Customer_Model();
			if (!$oModel->isEmailRegistered($email)) {
				$errors = $oModel->setRow(
						array(
							'email' => $email,
							'password' => $password
						)
				);
				if (is_numeric($errors)) {
					$body = file_get_contents(MAIL_TXT_PATH . DS . 'customer_subscription.php');
					$body = str_replace('#USERNAME#', $email, $body);
					$body = str_replace('#PASSWORD#', $password, $body);
					$oCustomer = $oModel->getRow($errors);
					$oModel->setRow(
							array(
						'email' => $oCustomer['email'],
						'password' => md5($oCustomer['password'])
							), $oCustomer['id']
					);
					Mail_Helper::sendTemplate(
							'Account confirmation', array(
						array(
							'email' => $oCustomer['email'],
							'name' => $oCustomer['email']
						),
							), 'transactional_with_button', array(
						'TITLE' => 'Account confirmation',
						'SUBJECT' => 'Account confirmation',
						'BODY' => $body,
						'BUTTON_LINK' => Fw_Register::getConfig('fw_base_domain') . 'customer/confirm/' . $oCustomer['id'] . '/' . $oCustomer['seed'],
						'BUTTON_TEXT' => 'Confirm your account'
							)
					);
					Fw_Register::addMessage('Confirmation email sent to your account');
					if (!empty($landing_visit)) {
						Landing_Helper::linkVisitToCustomer($landing_visit, $oCustomer['id']);
					}
				}
			} else {
				Fw_Register::addMessage('This email is already registered', 'error');
				$error = true;
			}
		} else {
			Fw_Register::addMessage('Email field is not an email', 'error');
			$error = true;
		}
		if ($error) {
			header('Location: ' . (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : BASE_URI));
		} else {
			header('Location: ' . BASE_URI);
		}
		exit();
	}

	public function confirm() {
		$params = Fw_Filter::getArray('params');
		$oModel = new Customer_Model();
		$oModel->confirm($params[0], $params[1]);
		header('Location: ' . BASE_URI);
		exit();
	}

	public function recovery() {
		$oModel = new Customer_Model();
		$email = Fw_Filter::getVar('customer_email', 'default', 'post');
		if (Validator_Helper::isEmail($email)) {
			$oCustomer = $oModel->isEmailRegistered($email);
			if ($oCustomer) {
				$new_password = Random_Helper::getPassword();
				$values = array(
					'email' => $oCustomer['email'],
					'password' => md5($new_password)
				);
				$oModel->setRow($values, $oCustomer['id']);

				$body = file_get_contents(MAIL_TXT_PATH . DS . 'customer_recovery_password.php');
				$body = str_replace('#PASSWORD#', $new_password, $body);
				Mail_Helper::sendTemplate(
						'Password recovery', array(
					array('email' => $oCustomer['email'],
						'name' => $oCustomer['email']
					)
						), 'transactional_with_button', array(
					'TITLE' => 'Password recovery',
					'SUBJECT' => 'Password recovery',
					'BODY' => $body,
					'BUTTON_LINK' => Fw_Register::getConfig('fw_base_domain'),
					'BUTTON_TEXT' => 'Go to '.COMPANY_NAME
						)
				);
				Fw_Register::addMessage('Mail sended. Revise your account.');
			} else {
				Fw_Register::addMessage('This email is not registered', 'error');
			}
		} else {
			Fw_Register::addMessage('Email invalid. Please, put a correct email', 'error');
		}
		header('Location: ' . BASE_URI);
		exit();
	}

	public function profile() {
		$customer = Fw_Register::getRef('customer');
		if (isset($customer['id'])) {
			$oModel = new Customer_Model();
			$oCustomer = $oModel->getRow($customer['id']);
			Fw_Register::setRef('oCustomer', $oCustomer);
			$this->display('profile', true);
		} else {
			Fw_Dispatcher::dispatch('/error/301');
			exit();
		}
	}

	public function save_profile() {
		$customer = Fw_Register::getRef('customer');
		if (isset($customer['id'])) {
			$oModel = new Customer_Model();
			$id = Fw_Filter::getVar('customer_id', 'default', 'post');
			$oCustomer = $oModel->getRow($id);
			$password = Fw_Filter::getVar('customer_password', 'default', 'post');
			$password = ((!empty($password)) ? md5($password) : $oCustomer['password']);
			$values = array(
				'name' => Fw_Filter::getVar('customer_name', 'default', 'post'),
				'surname' => Fw_Filter::getVar('customer_surname', 'default', 'post'),
				'email' => Fw_Filter::getVar('customer_email', 'default', 'post'),
				'password' => $password,
			);
			$errors = $oModel->setRow($values, $id);
			if (is_numeric($errors)) {
				Fw_Register::addMessage('Profile saved successfully');
				header('Location: ' . BASE_URI);
				exit();
			} else {
				Fw_Register::setRef('form_errors', $errors);
				$this->display('profile', true);
			}
		} else {
			Fw_Dispatcher::dispatch('/error/301');
			exit();
		}
	}

	public function admin() {
		$this->layout = 'admin';
		$oModel = new $this->model;
		$oResult = $oModel->getData();
		Fw_Register::setRef('oResult', $oResult['rows']);
		Fw_Register::setRef('count', $oResult['total']);
		Fw_Register::setRef('oParams', $this->adminParams);
		parent::display('admin', true);
	}

}

?>
