<?php

class Fw_Model {

	protected $table;
	protected $database;
	protected $oDb;
	protected $instance_name = DB_INSTANCE;

	public function __construct() {
		$this->oDb = Fw_Db::getInstance($this->instance_name);
		$this->database = $this->oDb->database;
	}

	protected function formatSelectCols($cols) {
		foreach ($cols as $k => $v) {
			$cols[$k] = $this->table . '.' . $v;
		}
		return implode(',', $cols);
	}

	public function getColumn($id, $col) {
		$sSQL = <<<SQL
SELECT $col
		FROM {$this->database}.{$this->table}	
		WHERE id = :id
SQL;
		$statement = $this->oDb->prepare($sSQL);
		$statement->bindParam(':id', $id, PDO::PARAM_INT);
		$statement->execute();
		return $statement->fetchColumn();
	}

	public function getRow($id = 1, $cols = array('*')) {
		$cols = $this->formatSelectCols($cols);
		$sSQL = <<<SQL
SELECT $cols
	FROM {$this->database}.{$this->table}	
		WHERE id = :id
SQL;
		$statement = $this->oDb->prepare($sSQL);
		$statement->bindParam(':id', $id, PDO::PARAM_INT);
		$statement->execute();
		return $statement->fetch();
	}

	public function validate($values) {
		return array();
	}

	public function addErrorMessages($errors) {
		foreach ($errors as $value) {
			Fw_Register::addMessage("The field $value aren't filled correctly", 'error');
		}
	}

	public function setRow($values = array(), $id = 0) {
		$errors = $this->validate($values);
		if (empty($errors)) {
			return ($id == 0) ? $this->insert($values) : $this->update($id, $values);
		}
		$this->addErrorMessages($errors);
		return $errors;
	}

	public function deleteRow($id) {
		$this->delete($id);
	}

	protected function delete($id) {
		$sSQL = "UPDATE {$this->database}.{$this->table} SET deleted = 1 WHERE id = :id";
		$statement = $this->oDb->prepare($sSQL);
		$statement->bindParam(':id', $id, PDO::PARAM_INT);
		$statement->execute();
	}

	public function recoveryRow($id) {
		$sSQL = "UPDATE {$this->database}.{$this->table} SET deleted = 0 WHERE id = :id";
		$statement = $this->oDb->prepare($sSQL);
		$statement->bindParam(':id', $id, PDO::PARAM_INT);
		$statement->execute();
	}

	protected function insert($values) {
		$keys = array_keys($values);
		$values = array_values($values);
		foreach ($keys as $k => $v) {
			$keys[$k] = "`$v`";
		}
		$keys = implode(',', $keys);
		$keys .= ',`ts_creation`, `ts_update`';
		$binds = implode(',', array_fill(0, count($values), '?'));
		$binds .= ', NOW(), NOW()';
		$sSQL = <<<SQL
INSERT INTO {$this->database}.{$this->table}
	($keys)
VALUES
	($binds)
SQL;
		$statement = $this->oDb->prepare($sSQL);
		foreach ($values as $k => &$v) {
			$statement->bindParam($k + 1, $v, (is_numeric($v) ? PDO::PARAM_INT : PDO::PARAM_STR));
		}
		$statement->execute();
		return $this->oDb->lastInsertId();
	}

	protected function update($id, $values) {
		$sSQL = "UPDATE {$this->database}.{$this->table} SET ";
		foreach ($values as $key => $value) {
			if ($value !== false) {
				$sSQL .= " `$key` = :{$key} ,";
			}
		}
		$sSQL = substr($sSQL, 0, -1);
		$sSQL .= " WHERE id = :id";
		$statement = $this->oDb->prepare($sSQL);
		$statement->bindParam(':id', $id, PDO::PARAM_INT);
		foreach ($values as $key => &$value) {
			if ($value !== false) {
				$statement->bindParam(":$key", $value, (is_numeric($value) ? PDO::PARAM_INT : PDO::PARAM_STR));
			}
		}
		$statement->execute();
		return $id;
	}

	public function getData($count = true, $limit = ITEMS_PER_PAGE, $limitstart = ITEMS_OFFSET, $cols = array('*')) {
		$cols = $this->formatSelectCols($cols);
		$filter = Fw_Filter::getFilters();
		$where = 'WHERE deleted = 0';
		foreach ($filter as $col => $val) {
			$col = str_replace('filter_', '', $col);
			$val = trim($val);
			$val = (!preg_match('/^[0-9a-zA-Z ].*$/', $val)) ? $val : ("LIKE '%$val%'");
			$where .= ($where == '') ? " WHERE $col $val " : " AND $col $val ";
		}
		$subquery = '';
		if ($count) {
			$subquery = "SELECT COUNT(*) FROM {$this->database}.{$this->table} $where";
			$statement = $this->oDb->prepare($subquery);
			$statement->execute();
			$row_count = $statement->fetchColumn();
		}
		$sSQL = <<<SQL
SELECT $cols
	FROM {$this->database}.{$this->table}	
	$where	
ORDER BY {$this->database}.{$this->table}.id DESC
LIMIT $limitstart, $limit
SQL;
		$statement = $this->oDb->prepare($sSQL);
		$statement->execute();
		return ($count) ? array('rows' => $statement->fetchAll(), 'total' => $row_count) : $statement->fetchAll();
	}

	public function getAll($cols = array('*')) {
		$cols = $this->formatSelectCols($cols);
		$sSQL = <<<SQL
SELECT $cols
	FROM {$this->database}.{$this->table}	
	WHERE deleted = 0
SQL;
		$statement = $this->oDb->prepare($sSQL);
		$statement->execute();
		return $statement->fetchAll();
	}

	public static function fetchAll($query){
		$oDb = Fw_Db::getInstance(DB_INSTANCE);
		$statement = $oDb->prepare($query);
		$statement->execute();
		return $statement->fetchAll();
	}
	
	public static function fetch($query){
		$oDb = Fw_Db::getInstance(DB_INSTANCE);
		$statement = $oDb->prepare($query);
		$statement->execute();
		return $statement->fetch();
	}
	
	public static function getDataForSelect($table, $field, $join, $where) {
		if ($table == 'acl') {
			return self::getAclDataForSelect($field, $where);
		}
		$oDb = Fw_Db::getInstance(DB_INSTANCE);
		$where = ' WHERE deleted = 0' . ((!empty($where)) ? "AND $where" : '');
		$match_field = '';
		if (!empty($join)) {
			$j = '';
			$c = $table;
			$r = true;
			foreach ($join['tables'] as $k => $t) {
				$j .= ($r) ? " {$join['type'][$k]} JOIN $t ON $t.id_$c = $c.id " : " {$join['type'][$k]} JOIN $t ON $t.id = $c.id_$t ";
				$c = $t;
				$r = !$r;
			}
			$match_field = ", {$join['tables'][0]}.id_$table as match_v ";
			$join = $j;
		}
		$sSQL = 'SELECT ' . $table . '.id, ' . $field . $match_field . ' FROM ' . $table . $join . $where;
		$statement = $oDb->prepare($sSQL);
		$statement->execute();
		return $statement->fetchAll();
	}

	public static function getAclDataForSelect($field, $where) {
		$acl = parse_ini_file(CONFIG_PATH . DS . 'acl.ini', true);
		list($k, $v) = explode('=', $where);
		$result = array();
		foreach ($acl[$field] as $key => $value) {
			if ($value == $v) {
				$result[] = array('id' => $key, $field => $key);
			}
		}
		return $result;
	}

	public static function setNMRelationships($nTable, $mTable, $idNTable, $aIdMTable) {
		$oDb = Fw_Db::getInstance(DB_INSTANCE);
		$sSQL = <<<SQL
DELETE FROM {$mTable}._{$nTable}
WHERE id_{$nTable} = :idNTable
SQL;
		$statement = $oDb->prepare($sSQL);
		$statement->bindParam(':idNTable', $idNTable, PDO::PARAM_INT);
		$statement->execute();
		foreach ($aIdMTable as $idMTable) {
			$sSQL = <<<SQL
INSERT INTO {$mTable}._{$nTable}
	SET id_{$nTable} = :idNTable, 
		id_{$mTable} = :idMTable
SQL;
			$statement = $oDb->prepare($sSQL);
			$statement->bindParam(':idNTable', $idNTable, PDO::PARAM_INT);
			$statement->bindParam(':idMTable', $idMTable, PDO::PARAM_INT);
			$statement->execute();
		}
	}

}

?>