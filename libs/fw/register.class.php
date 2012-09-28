<?php
class Fw_Register{
	public static $aRefs = array();
	
	private function __construct(){}

	public static function setRef($ref_name, $ref_value){		
		self::$aRefs[$ref_name] = $ref_value;
	}
	public static function getRef($ref_name){
		return isset(self::$aRefs[$ref_name])?self::$aRefs[$ref_name]:false;
	}
	public static function getConfig($ref_name){
		return isset(self::$aRefs['config'][$ref_name])?self::$aRefs['config'][$ref_name]:false;
	}
	public static function addInRef($ref_name, $ref_value){
		if(!isset(self::$aRefs[$ref_name])){
			self::$aRefs[$ref_name] = array();
		}
		self::$aRefs[$ref_name][] = $ref_value;
	}
	public static function getMessages(){
		if (!isset($_SESSION['messages'])){
			$_SESSION['messages'] = array();
		}
		return $_SESSION['messages'];
	}
	public static function addMessage($text, $color='blue'){
		$_SESSION['messages'][] = array('color'=>$color, 'text'=>$text);	
	}
	public static function clearMessages(){
		unset($_SESSION['messages']);
	}
}
?>
