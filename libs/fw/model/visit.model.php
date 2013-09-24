<?php

class Fw_Visit_Model extends Fw_Model {

	public function __construct() {
		$this->table = 'visit';
		parent::__construct();
	}

	public function getRealTimeVisits() {
		$grace_time = date('Y-m-d H:i:s', time() - 60);
		$sSQL = <<<SQL
SELECT COUNT(*) as num
FROM {$this->database}.{$this->table}
WHERE ts_creation = ts_update
AND ts_creation > '$grace_time'
SQL;
		$statement = $this->oDb->prepare($sSQL);
		$statement->execute();
		return $statement->fetchColumn();
	}

	public function getBrowserPercentages() {
		$time = date('Y-m-d H:i:s', time() - 60 * 60 * 24 * 7);
		$sSQL = <<<SQL
SELECT 
	browser,
	ROUND(COUNT(*)/(SELECT COUNT(*) 
				FROM {$this->database}.{$this->table}
				WHERE ts_creation > '$time') * 100,2) as percentage
FROM {$this->database}.{$this->table}
WHERE ts_creation > '$time'
GROUP BY browser
SQL;
		$statement = $this->oDb->prepare($sSQL);
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_GROUP);
	}

	public function getOSPercentages() {
		$time = date('Y-m-d H:i:s', time() - 60 * 60 * 24 * 7);
		$sSQL = <<<SQL
SELECT 
	os,
	ROUND(COUNT(*)/(SELECT COUNT(*) 
				FROM {$this->database}.{$this->table}
				WHERE ts_creation > '$time') * 100,2) as percentage
FROM {$this->database}.{$this->table}
WHERE ts_creation > '$time'
GROUP BY os
SQL;
		$statement = $this->oDb->prepare($sSQL);
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_GROUP);
	}
	
	public function getRequestedPages(){
		$time = date('Y-m-d H:i:s', time()-60*60);
		$sSQL = <<<SQL
SELECT uri, 
	ROUND(COUNT(*)/(SELECT COUNT(*) 
			FROM {$this->database}.{$this->table}
			WHERE ts_creation > '$time') * 100,2) as percentage,
	COUNT(*) as num
FROM {$this->database}.{$this->table}
WHERE ts_creation > '$time'
GROUP BY uri
ORDER BY num DESC
LIMIT 5
SQL;
		$statement = $this->oDb->prepare($sSQL);
		$statement->execute();
		return $statement->fetchAll();
	}

}

?>
