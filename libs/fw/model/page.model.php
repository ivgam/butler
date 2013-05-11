<?php

class Fw_Page_Model extends Fw_Model {

    //OK
    public function getData($count = false, $limit = 20, $limitstart = 0, $cols = array('*')) {
        $acl = parse_ini_file(CONFIG_PATH . DS . 'acl.ini', true);
        $result = array();
        foreach ($acl['subresources'] as $controller => $type) {
            $directory = VIEWS_PATH . DS . $controller;
            if ($type == 'static' && is_dir($directory) && $handler = opendir($directory)) {
                while (false !== ($entry = readdir($handler))) {
                    if (is_file($directory . DS . $entry) && $entry != '.' && $entry != '..') {
                        preg_match('/.*[.](.*)/', $entry, $matches);
                        if ($matches[1] = 'php') {
                            $result[] = array('id' => $controller . '-' . str_replace('.' . $matches[1], '', $entry),
                                'controller' => $controller,
                                'path' => $directory . DS . $entry,
                                'page' => str_replace('.' . $matches[1], '', $entry));
                        }
                    }
                }
            }
        }
        return ($count) ? array('rows' => array_slice($result, $limitstart, $limit), count($result)) : array_slice($result, $limitstart, $limit);
    }

    public function getRow($id = 'static-default', $cols = array('*')) {
        list($controller, $file) = explode('-', $id);
        $entry = VIEWS_PATH . DS . $controller . DS . $file . '.php';
        if (file_exists($entry)) {
            return array('id' => $id, 'controller' => $controller, 'path' => $entry, 'page' => $file, 'content' => file_get_contents($entry));
        }
        return false;
    }

    public function setRow($values = array(), $id = 0) {
        return ($id == 0) ? $this->insert($values) : $this->update($id, $values);
    }

    public function deleteRow($id) {
        $this->delete($id);
    }

    protected function delete($id) {
        $entry = VIEWS_PATH . DS . $controller . DS . $file . '.php';
        if (file_exists($entry)) {
            unlink($entry);
        }
        return $id;
    }

    protected function insert($values) {
        $handler = fopen(VIEWS_PATH . DS . $values['controller'] . DS . $values['page'] . '.php', 'w+');
        fwrite($handler, $values['content']);
        fclose($handler);
        return $values['controller'] . '-' . $values['page'];
    }

    protected function update($id, $values) {
        $entry = VIEWS_PATH . DS . $controller . DS . $file . '.php';
        if (file_exists($entry)) {
            $handler = fopen($entry, 'w+');
            fwrite($handler, $values['content']);
            fclose($handler);
        }
        return $id;
    }

}

?>