<?php

class Landing_Helper {

	public static function getActiveLandings() {
		$oDb = Fw_Db::getInstance(DB_INSTANCE);
		$id_state = LANDING_CAMPAIGN_DISABLED;
		$sSQL = <<<SQL
SELECT 
	l.name as landing_name,
	c.name as campaign_name, 
	lc.id as id_landing_campaign
FROM landing_campaign lc
INNER JOIN landing l 
	ON l.id = lc.id_landing
	AND lc.deleted = 0
	AND lc.id_state != $id_state
INNER JOIN campaign c
	ON c.id = lc.id_campaign
	AND c.deleted = 0
SQL;
		$statement = $oDb->prepare($sSQL);
		$statement->execute();
		return $statement->fetchAll();
	}

	public static function getLandingCampaignByName($campaign_name, $landing_name) {
		$campaign_name = urldecode($campaign_name);
		$landing_name = urldecode($landing_name);
		$oDb = Fw_Db::getInstance(DB_INSTANCE);
		$sSQL = <<<SQL
SELECT l.*, lc.id as id_landing_campaign
FROM landing_campaign lc
INNER JOIN landing l
	ON l.id = lc.id_landing
	AND l.name = :landing_name
INNER JOIN campaign c
	ON c.id = lc.id_campaign
	AND c.name = :campaign_name
SQL;
		$statement = $oDb->prepare($sSQL);
		$statement->bindParam(':landing_name', $landing_name, PDO::PARAM_STR);
		$statement->bindParam(':campaign_name', $campaign_name, PDO::PARAM_STR);
		$statement->execute();
		return $statement->fetch();
	}

	public static function registerVisit($id_landing_campaign) {
		$id_visit = VISIT_ID;
		$oDb = Fw_Db::getInstance(DB_INSTANCE);
		$sSQL = <<<SQL
INSERT INTO landing_campaign_visit
	SET id_landing_campaign = :id_landing_campaign,
		id_visit = :id_visit,
		ts_creation = NOW(),
		ts_update = NOW()
SQL;
		$statement = $oDb->prepare($sSQL);
		$statement->bindParam(':id_landing_campaign', $id_landing_campaign, PDO::PARAM_INT);
		$statement->bindParam(':id_visit', $id_visit, PDO::PARAM_INT);
		$statement->execute();
		return $oDb->lastInsertId();
	}

	public static function linkVisitToCustomer($id_landing_campaign_visit, $id_customer) {
		$oDb = Fw_Db::getInstance(DB_INSTANCE);
		$sSQL = <<<SQL
INSERT INTO landing_campaign_visit_conversion
	SET id_landing_campaign_visit = :id_landing_campaign_visit,
		id_customer = :id_customer,
		ts_creation = NOW(),
		ts_update = NOW()
SQL;
		$statement = $oDb->prepare($sSQL);
		$statement->bindParam(':id_landing_campaign_visit', $id_landing_campaign_visit, PDO::PARAM_INT);
		$statement->bindParam(':id_customer', $id_customer, PDO::PARAM_INT);
		$statement->execute();
		return $oDb->lastInsertId();
	}

}

?>
