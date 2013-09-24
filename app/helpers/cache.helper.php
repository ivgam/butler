<?php

class Cache_Helper {
	public static function isCacheable($resource, $task){
		$cacheable = array(
			'static'=>array('about','category','contact','home','partner','privacy','resume','search'),
			'product'=>array('detail'),
		);
		return isset($cacheable[$resource]) && in_array($task, $cacheable[$resource]);
	}
}
?>
