<?php 
class Fw_Auth_Controller extends Fw_Controller{
		public function __construct() {
			$this->layout = 'blank';	
		}	
		public function login(){
			
			$user = Fw_Register::getRef('user');
			if (isset($user['usertype'])){
				switch ($user['usertype']){
					case 'admin': 
						header('Location: '.BASE_URI.'admin/'); 
						exit();
					case 'guest': 
					default:
						header('Location: '.BASE_URI);
						exit();
				}
			}
			
			$oModel = new User_Model();
			$username = Fw_Filter::getVar('username', 'default', 'post');
			$pwd = Fw_Filter::getVar('pwd', 'default', 'post');
			$oUser = $oModel->userExists($username, md5($pwd));
			if ($oUser){															
				$lifetime = time() + 365*24*60*60;
				$value = implode('&&&&', array('username'=>  md5($username), 'pwd'=>md5($pwd)));
				setcookie('user', $value, $lifetime, '/');
				$url = ($oUser['usertype'] == 'guest')?BASE_URI:BASE_URI.'admin/';
				header("Location: $url");
				exit();
			}
			parent::display('login', true);
		}
		public function logout(){
			$lifetime = time() - 365*24*60*60;
			$value = '';
			setcookie('user', $value, $lifetime, '/');
			header('Location: '.BASE_URI);
			exit();
		}
} ?>
