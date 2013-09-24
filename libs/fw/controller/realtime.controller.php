<?php

class Fw_RealTime_Controller extends Fw_Controller {

	public function __construct() {
		$this->layout = 'admin';
	}

	public function getNumVisits() {
		$this->layout = '_blank';
		$oModel = new Visit_Model();
		$visits = $oModel->getRealTimeVisits();
		echo json_encode(array('num_visits' => $visits));
		exit();
	}

	public function getLoadAvg() {
		$this->layout = '_blank';
		echo json_encode(array('load' => Server_Helper::get_server_load()));
		exit();
	}

	public function getOSPercentages() {
		$this->layout = '_blank';
		$oModel = new Visit_Model();
		echo json_encode($oModel->getOSPercentages());
		exit();
	}

	public function getBrowserPercentages() {
		$this->layout = '_blank';
		$oModel = new Visit_Model();
		echo json_encode($oModel->getBrowserPercentages());
		exit();
	}

	public function getRequestedPages() {
		$this->layout = '_blank';
		$oModel = new Visit_Model();
		echo json_encode($oModel->getRequestedPages());
		exit();
	}

	public function getDatabaseResume() {
		$databases = Fw_Register::getRef('databases');
		$to_return = array();
		foreach ($databases as $name => $v) {
			$oDb = Fw_Db::getInstance($name);
			$statement = $oDb->prepare("SHOW GLOBAL STATUS;");
			$statement->execute();
			$aStatus = $statement->fetchAll();

			$load = Server_Helper::getDatabaseVariable('Com_load', $aStatus);
			$status = ($load < 50) ? 'success' : (($load < 75) ? 'warning' : 'danger');

			$statement = $oDb->prepare("SHOW PROCESSLIST");
			$statement->execute();
			$queries = $statement->fetchAll();
			
			$to_return[] = array(
				'name'=>$name,
				'queries'=>count($queries),
				'threads'=>Server_Helper::getDatabaseVariable('Threads_connected', $aStatus),
				'uptime'=>Server_Helper::uptimeFormat(Server_Helper::getDatabaseVariable('Uptime', $aStatus)),	
				'load'=>$load,
				'load_status'=>$status
			);
		}
		echo json_encode($to_return);
		exit();
	}

}

?>
