<?php
class Fw_Db extends PDO {

	public $engine;
	public $host;
	public $database;
	public $user;
	public $pass;
	protected static $instances;

	public function __construct($instance = 'local') {
		$databases		= parse_ini_file(CONFIG_PATH.DS.'databases.ini', true);
		$this->engine	= $databases[$instance]['engine'];
		$this->host		= $databases[$instance]['host'];
		$this->database = $databases[$instance]['database'];
		$this->user		= $databases[$instance]['user'];
		$this->pass		= $databases[$instance]['pass'];
		$dns = $this->engine . ':dbname=' . $this->database . ";host=" . $this->host.';charset=utf8';
		parent::__construct($dns, $this->user, $this->pass);
		parent::setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);		
		parent::setAttribute(PDO::ATTR_STATEMENT_CLASS, array('Fw_Statement'));
	}
	
	public static function getInstance($instance){
		if (!isset(self::$instances[$instance])){
			self::$instances[$instance] = new Fw_Db($instance);
		}
		return self::$instances[$instance];
	}
	
}
?>