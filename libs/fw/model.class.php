<?php

class Fw_Model {

	protected $table;
	protected $database;
	protected $oDb;
	protected $instance_name = 'local';

	public function __construct() {
		$this->oDb = Fw_Db::getInstance($this->instance_name);
		$this->database = $this->oDb->database;
	}

	protected function formatSelectCols($cols){
		foreach ($cols as $k => $v) {	$cols[$k] = $this->table . '.' . $v;}
		return implode(',', $cols);
	}
	
	public function getRow($id = 1, $cols = array('*')) {
		$cols = $this->formatSelectCols($cols);
		$sSQL = <<<SQL
SELECT $cols
	FROM {$this->database}.{$this->table}	
		WHERE id = $id
SQL;
		$statement = $this->oDb->prepare($sSQL);
		$statement->execute();
		return $statement->fetch();
	}
	
	public function setRow($values = array(),$id = 0){
		return ($id == 0)?$this->insert($values):$this->update($id,$values);
	}
	
	public function deleteRow($id){
		$this->delete($id);
	}
	
	protected function delete($id){
		$sSQL = "DELETE FROM {$this->database}.{$this->table} WHERE id = $id";
		$statement = $this->oDb->prepare($sSQL);
		$statement->execute();
	}
	
	protected function insert($values){
		$keys = array_keys($values);
		$values = array_values($values);
		foreach ($keys as $k=>$v)		{$keys[$k]		= "`$v`";}
		foreach ($values as $k=>$v)	{$values[$k]	= "'$v'";}
		$keys = implode(',', $keys);
		$keys .= ',`ts_creation`, `ts_update`';
		$values = implode(',', $values);
		$values .= ', NOW(), NOW()';
		$sSQL = <<<SQL
INSERT INTO {$this->database}.{$this->table}
	($keys)
VALUES
	($values)
SQL;
		$statement = $this->oDb->prepare($sSQL);
		$statement->execute();
		return $this->oDb->lastInsertId();
	}
	
	protected function update($id,$values){
		$sSQL = "UPDATE {$this->database}.{$this->table} SET ";
		foreach ($values as $key => $value){
			$sSQL .= " `$key` = '$value' ,";
		}
		$sSQL = substr($sSQL, 0, -1);
		$sSQL .= " WHERE id = $id";		
		$statement = $this->oDb->prepare($sSQL);
		$statement->execute();		
		return $id;
	}

	public function getData($count = false, $limit = 20, $limitstart = 0, $cols = array('*')) {
		$cols = $this->formatSelectCols($cols);
		
		$subquery = '';
		if($count){	
			$subquery = "SELECT COUNT(*) FROM {$this->table}";	
			$statement = $this->oDb->prepare($subquery);
			$statement->execute();
			$row_count = $statement->fetchColumn();
		}
		
		$sSQL = <<<SQL
SELECT $cols
	FROM {$this->database}.{$this->table}	
	LIMIT $limitstart, $limit
SQL;
		$statement = $this->oDb->prepare($sSQL);
		$statement->execute();		
		return ($count)
			?array('rows'=>$statement->fetchAll(), 'total'=>$row_count)
			:$statement->fetchAll();
	}

	public static function getDataForSelect($table, $field, $join, $where){
		if ($table == 'acl'){
			return self::getAclDataForSelect($field, $where);			
		}
		$oDb = Fw_Db::getInstance('local');		
		$where = (!empty($where))?"WHERE $where":'';		
		$match_field = '';
		if (!empty($join)){			
			$j = '';
			$c = $table;
			$r = true;
			foreach($join['tables'] as $k=>$t){
				$j .= ($r)?" {$join['type'][$k]} JOIN $t ON $t.id_$c = $c.id "
						  :" {$join['type'][$k]} JOIN $t ON $t.id = $c.id_$t ";
				$c = $t;
				$r = !$r;
			}		
			$match_field = ", {$join['tables'][0]}.id_$table as match_v ";
			$join = $j;									
		}		
		$sSQL = 'SELECT '.$table.'.id, '.$field.$match_field.' FROM '.$table.$join.$where;		
		$statement = $oDb->prepare($sSQL);
		$statement->execute();
		return $statement->fetchAll();
	}
	
	public static function getAclDataForSelect($field, $where){
		$acl = parse_ini_file(CONFIG_PATH . DS . 'acl.ini', true);
		list($k, $v) = explode('=', $where);
		$result = array();
		foreach($acl[$field] as $key=>$value){
			if($value==$v){
				$result[] = array('id'=>$key, $field=>$key);
			}
		}
		return $result;
	}

	public static function setNMRelationships($nTable, $mTable, $idNTable, $aIdMTable){
		$oDb = Fw_Db::getInstance('local');
		$sSQL = 'DELETE FROM '.$mTable.'_'.$nTable.' WHERE id_'.$nTable.' = '.$idNTable;		
		$statement = $oDb->prepare($sSQL);
		$statement->execute();
		foreach($aIdMTable as $idMTable){
			$sSQL = 'INSERT INTO '.$mTable.'_'.$nTable.' SET id_'.$nTable.' = '.$idNTable.' , id_'.$mTable.' = '.$idMTable;			
			$statement = $oDb->prepare($sSQL);
			$statement->execute();
		}		
	}

}

?>