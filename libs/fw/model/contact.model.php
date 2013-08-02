<?php

class Fw_Contact_Model extends Fw_Model {

	public function __construct() {
		$this->table = 'contact';
		parent::__construct();
	}

	public function validate($aValues) {
		$errors = array();
		$errors["Name"] = Validator_Helper::required($aValues['name']);
		$errors["Email"] = Validator_Helper::isEmail($aValues['email']);
		$errors["Subject"] = Validator_Helper::required($aValues['subject']);
		$errors["Comment"] = Validator_Helper::required($aValues['comment']);
		return array_keys(array_diff_key($errors, array_filter($errors)));
	}

	public function getData($count = true, $limit = ITEMS_PER_PAGE, $limitstart = ITEMS_OFFSET, $cols = array('*')) {
		$cols = $this->formatSelectCols($cols);
		$filter = Fw_Filter::getFilters();
		$where = 'WHERE contact.deleted = 0';
		foreach ($filter as $col => $val) {
			$col = str_replace('filter_', '', $col);
			switch ($col) {
				case 'state_name':
					$col = 's.name';
					break;
				default:
					$col = 'contact.' . $col;
					break;
			}
			$val = (!preg_match('/^[0-9a-zA-Z ].*$/', $val)) ? $val : ("LIKE '%$val%'");
			$where .= ($where == '') ? " WHERE $col $val " : " AND $col $val ";
		}
		$subquery = '';
		if ($count) {
			$subquery = <<<SQL
SELECT COUNT(*) 
	FROM {$this->database}.contact
	INNER JOIN {$this->database}.contact_state s
		ON contact.id_state = s.id
	$where
SQL;
			$statement = $this->oDb->prepare($subquery);
			$statement->execute();
			$row_count = $statement->fetchColumn();
		}
		$sSQL = <<<SQL
SELECT $cols, s.name as state_name, s.color_class as class
	FROM {$this->database}.contact
	INNER JOIN {$this->database}.contact_state s
		ON contact.id_state = s.id
	$where	
ORDER BY {$this->database}.{$this->table}.id DESC
LIMIT $limitstart, $limit
SQL;
		$statement = $this->oDb->prepare($sSQL);
		$statement->execute();
		return ($count) ? array('rows' => $statement->fetchAll(), 'total' => $row_count) : $statement->fetchAll();
	}
	
	public function getReplies($id_contact){
		$sSQL = "SELECT * FROM contact_reply WHERE id_contact = :id";
		$statement = $this->oDb->prepare($sSQL);
		$statement->bindParam(':id', $id_contact, PDO::PARAM_INT);
		$statement->execute();
		return $statement->fetchAll();
	}
}

?>
