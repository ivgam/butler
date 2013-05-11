<?php

class Fw_Module {

    public static function getModule($name, $params = array()) {
        include MODULES_PATH . DS . $name . '.php';
    }

}

?>
