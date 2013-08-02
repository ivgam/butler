<?php

class Fw_Campaign_Model extends Fw_Model {

	public function __construct() {
		$this->table = 'campaign';
		parent::__construct();
	}

	public function getLandings($id) {
		$sSQL = <<<SQL
SELECT lc.id as id_landing_campaign, l.*
FROM landing l
INNER JOIN landing_campaign lc
ON l.id = lc.id_landing
AND lc.id_campaign = :id_campaign
SQL;
		$statement = $this->oDb->prepare($sSQL);
		$statement->bindParam(':id_campaign', $id, PDO::PARAM_INT);
		$statement->execute();
		return $statement->fetchAll();
	}

	public function getLandingHistory($id_campaign, $id_landing) {
		$sSQL = <<<SQL
SELECT lc.id as id_landing_campaign, lch.ts_creation, lcs.name, lcs.color_class
	FROM landing_campaign_history lch
	INNER JOIN landing_campaign_state lcs
	ON lcs.id = lch.id_state
	INNER JOIN landing_campaign lc
	ON lc.id = lch.id_landing_campaign
	AND lc.id_campaign = :id_campaign
	AND lc.id_landing = :id_landing
SQL;
		$statement = $this->oDb->prepare($sSQL);
		$statement->bindParam(':id_campaign', $id_campaign, PDO::PARAM_INT);
		$statement->bindParam(':id_landing', $id_landing, PDO::PARAM_INT);
		$statement->execute();
		return $statement->fetchAll();
	}

	public function addLanding($id_campaign, $id_landing) {
		$sSQL = <<<SQL
SELECT COUNT(*)
FROM landing_campaign
WHERE id_campaign = :id_campaign
AND id_landing = :id_landing
SQL;
		$statement = $this->oDb->prepare($sSQL);
		$statement->bindParam(':id_campaign', $id_campaign, PDO::PARAM_INT);
		$statement->bindParam(':id_landing', $id_landing, PDO::PARAM_INT);
		$statement->execute();
		$count = $statement->fetchColumn();
		if (!$count) {
			$state_create = LANDING_CAMPAIGN_CREATED;
			$sSQL = <<<SQL
INSERT INTO landing_campaign
	SET id_landing = :id_landing,
		id_campaign = :id_campaign,
		id_state = $state_create,
		ts_creation = NOW(),
		ts_update = NOW()
SQL;
			$statement = $this->oDb->prepare($sSQL);
			$statement->bindParam(':id_campaign', $id_campaign, PDO::PARAM_INT);
			$statement->bindParam(':id_landing', $id_landing, PDO::PARAM_INT);
			$statement->execute();
			Fw_Register::addMessage('Landing inserted correctly', 'info');
		} else {
			Fw_Register::addMessage('This landing is already in this campaign', 'error');
		}
	}

	public function enableLanding($id_landing_campaign) {
		$id_state = LANDING_CAMPAIGN_ENABLED;
		$sSQL = <<<SQL
UPDATE landing_campaign
	SET id_state = $id_state
	WHERE id = :id_landing_campaign
SQL;
		$statement = $this->oDb->prepare($sSQL);
		$statement->bindParam(':id_landing_campaign', $id_landing_campaign, PDO::PARAM_INT);
		$statement->execute();
		Fw_Register::addMessage('Landing enabled correctly', 'info');
	}

	public function disableLanding($id_landing_campaign) {
		$id_state = LANDING_CAMPAIGN_DISABLED;
		$sSQL = <<<SQL
UPDATE landing_campaign
	SET id_state = $id_state
	WHERE id = :id_landing_campaign
SQL;
		$statement = $this->oDb->prepare($sSQL);
		$statement->bindParam(':id_landing_campaign', $id_landing_campaign, PDO::PARAM_INT);
		$statement->execute();
		Fw_Register::addMessage('Landing disabled correctly', 'info');
	}

}

?>
