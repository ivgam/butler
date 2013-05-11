<?php

class Fw_Filter {

    public static $aVars = array(
        'params' => array(),
        'post' => array(),
        'get' => array(),
        'request' => array(),
        'cookie' => array()
    );

    private function __construct() {
        
    }

    private static function init($params) {
        self::$aVars['params'] = $params;
        self::$aVars['post'] = $_POST;
        self::$aVars['get'] = $_GET;
        self::$aVars['request'] = $_REQUEST;
        self::$aVars['cookie'] = $_COOKIE;
        //unset ($params, $_POST, $_GET, $_REQUEST);
    }

    public static function filter($params) {
        self::init($params);
        foreach (self::$aVars as $container => $vars) {
            foreach ($vars as $k => $v) {
                self::$aVars[$container][$k] = $v;
            }
        }
    }

    public static function getVar($key, $type = "default", $container = 'all') {
        $to_return = false;
        if ($container == 'all') {
            foreach (self::$aVars as $container => $vars) {
                if (key_exists($key, $vars)) {
                    $to_return = $container[$key];
                }
            }
        } else {
            $to_return = (isset(self::$aVars[$container][$key])) ? self::$aVars[$container][$key] : false;
        }
        switch ($type) {
            case 'numeric': return (is_numeric($to_return)) ? $to_return : false;
            case 'string': return $to_return;
            default: return $to_return;
        }
    }

    public static function getFilters() {
        $filters = array();
        foreach (self::$aVars['request'] as $k => $v) {
            if ($filter = strstr($k, 'filter_')) {
                if ($v != '') {
                    $filters[$filter] = $v;
                }
            }
        }
        return $filters;
    }

    public static function getArray($container) {
        return self::$aVars[$container];
    }

}

?>
