<?php

class Request_Helper {

	public static function getBrowser() {
		switch (true) {
			case stristr($_SERVER['HTTP_USER_AGENT'], 'Chrome') : return 'Chrome';
			case stristr($_SERVER['HTTP_USER_AGENT'], 'Safari') : return 'Safari';
			case stristr($_SERVER['HTTP_USER_AGENT'], 'Opera') : return 'Opera';
			case stristr($_SERVER['HTTP_USER_AGENT'], 'Firefox'): return 'Firefox';
			case stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE') : return 'Explorer';
			default : return 'Unknown';
		}
	}

	public static function getOS() {
		switch (true) {
			case stristr($_SERVER['HTTP_USER_AGENT'], 'Windows') : return 'Windows';
			case stristr($_SERVER['HTTP_USER_AGENT'], 'Android') : return 'Android';
			case stristr($_SERVER['HTTP_USER_AGENT'], 'iOS') : return 'iOS';
			case stristr($_SERVER['HTTP_USER_AGENT'], 'Linux') : return 'Linux';
			default : return 'Unknown';
		}
	}

	public static function updateLastRequest() {
		if(isset($_COOKIE['visitor_last_request'])){
			$id = base64_decode($_COOKIE['visitor_last_request']);			
			$oModel = new Visit_Model();
			$oModel->setRow(array('ts_update'=> date('Y-m-d H:i:s',time()+1)), (int)$id);
		}
	}

	public static function registerRequest() {
		//IS A NEW VISITOR
		$visitor_hash = (isset($_COOKIE['visitor_hash'])) ? $_COOKIE['visitor_hash'] : md5(time() . uniqid() . rand(0, 1024));
		if (!isset($_COOKIE['visitor_hash'])) {
			setcookie('visitor_hash', $visitor_hash, time() + 24 * 60 * 60, '/');
		}
		$oModel = new Visit_Model();
		$id = $oModel->setRow(array(
			'visitor_hash' => $visitor_hash,
			'browser' => Request_Helper::getBrowser(),
			'os' => Request_Helper::getOS(),
			'ip' => $_SERVER['REMOTE_ADDR'],
			'user_agent' => $_SERVER['HTTP_USER_AGENT'],
			'uri'=> $_SERVER['REQUEST_URI'],
			'referer' => (isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'')
		));
		setcookie('visitor_last_request', base64_encode($id), time() + 15 * 60, '/');
		define('VISIT_ID', (int)$id);
	}
}

?>
