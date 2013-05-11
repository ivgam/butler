<?php

class Fw_Dumper_Model extends Fw_Model {

    public function dump($data = false) {

        function escape_sql_value(&$item, $key, &$con) {
            $item = $con->quote($item);
        }

        $statement = $this->oDb->prepare("SHOW TABLES");
        $statement->execute();
        $tables = $statement->fetchAll();
        $database = $this->oDb->database;
        foreach ($tables as $table) {
            $table = $table['Tables_in_' . $database];
            $statement = $this->oDb->prepare("SHOW CREATE TABLE $table");
            $statement->execute();
            $res = $statement->fetch();
            echo "DROP TABLE IF EXISTS $table;\n\n";
            echo $res['Create Table'] . ';';
            echo "\n\n";
            if ($data) {
                $statement = $this->oDb->prepare("SELECT * FROM $table");
                $statement->execute();
                $res = $statement->fetchAll();
                foreach ($res as $row) {
                    array_walk($row, 'escape_sql_value', $this->oDb);
                    echo "INSERT INTO $table VALUES (" . implode(',', $row) . ");\n";
                }
                echo "\n\n";
            }
        }
    }

}

?>
