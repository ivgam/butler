<?php

class Fw_Post_Model extends Fw_Model {

    public function __construct() {
        $this->table = 'post';
        parent::__construct();
    }

    public function getData($count = true, $limit = 20, $limitstart = 0, $cols = array('*')) {
        $cols = $this->formatSelectCols($cols);
        $subquery = '';
        if ($count) {
            $subquery = "SELECT COUNT(*) FROM {$this->table}";
            $statement = $this->oDb->prepare($subquery);
            $statement->execute();
            $row_count = $statement->fetchColumn();
        }

        $sSQL = <<<SQL
SELECT $cols, GROUP_CONCAT(DISTINCT category.name) categories
	FROM {$this->database}.{$this->table}
	INNER JOIN {$this->database}.category_post ON {$this->table}.id = category_post.id_post
	INNER JOIN {$this->database}.category ON category.id = category_post.id_category
	GROUP BY post.id
	LIMIT $limitstart, $limit
SQL;
        $statement = $this->oDb->prepare($sSQL);
        $statement->execute();
        return ($count) ? array('rows' => $statement->fetchAll(), 'total' => $row_count) : $statement->fetchAll();
    }

}

?>