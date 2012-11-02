<?php

abstract class Fw_Controller {

	protected $layout = 'default';

	public function __construct() {}
	public function pre() {}
	public function post() {}
	public function execute($task) {
		ob_start();
		$this->pre();
		$this->display($task);
		$this->post();
		$html = ob_get_contents();		
		ob_end_clean();
		
		ob_start();
		Fw_View::display($this->layout, $html);
		$html = ob_get_contents();
		ob_end_clean();

		return $html;
	}
	public function display($task, $bExecuted = false, $controller = false) {
		if (method_exists($this, $task) && !$bExecuted) {
			$this->$task();
		} else {
			$controller = ($controller != false)?$controller:strtolower(str_ireplace('_Controller', '', get_class($this)));
			require_once VIEWS_PATH . DS . $controller . DS . $task . '.php';
		}
	}
	public function getResponse($resource, $task) {
		/*
		 * Contains the result of the access check
		 * NLWP:	Not logged with permissions		-> Execute the task
		 * NLWOP:	Not logged without permissions	-> Redirect to login page
		 * LWP:		Logged with permissions			-> Execute the task
		 * LWOP:	Logged without permissions		-> Redirect to 301 page
		 */
		$result = Fw_Acl::checkAccess(Fw_Register::getRef('user'), $resource, $task);		
		switch ($result) {
			case 'NLWP':
			case 'LWP':
				return $this->execute($task);
				break;
			case 'NLWOP':
				header('Location: '.BASE_URI.'login');
				break;
			case 'LWOP':
				die('301');
				break;
		}
	}
}

?>