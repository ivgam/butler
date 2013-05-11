<?php

class Fw_Post_Controller extends Fw_CrudController {

    public function __construct() {
        $this->model = 'Post_Model';
        $this->setParams = array(
            'content' => array('type' => 'default', 'container' => 'post'),
            'author' => array('type' => 'default', 'container' => 'post'),
            'title' => array('type' => 'default', 'container' => 'post'),
            'tags' => array('type' => 'default', 'container' => 'post'),
            'published' => array('type' => 'default', 'container' => 'post')
        );
        $this->adminParams = array(
            'ID' => 'id',
            'Title' => 'title',
            'User' => 'author',
            'Created At' => 'ts_creation',
            'Modified At' => 'ts_update',
            'Categories' => 'categories',
            'Published' => 'published',
        );
        $this->editParams = array(
            'Title' => array('type' => 'text', 'name' => 'title', 'populate' => true),
            'Content' => array('type' => 'textarea', 'name' => 'content', 'populate' => true),
            'Author' => array('type' => 'select', 'name' => 'author', 'populate' => true, 'table' => 'user', 'field' => 'username'),
            'Tags' => array('type' => 'text', 'name' => 'tags', 'populate' => true),
            'Categories' => array('type' => 'multi-select', 'name' => 'categories', 'populate' => true, 'table' => 'category', 'field' => 'name',
                'join' => array('type' => array('LEFT', 'LEFT'), 'tables' => array('category_post', 'post'))),
            'Published' => array('type' => 'text', 'name' => 'published', 'populate' => true)
        );
    }

    public function set($redirect = true) {
        $idNTable = parent::set(false);
        $aIdMTable = Fw_Filter::getVar('categories', 'default', 'post');
        Fw_Model::setNMRelationships('post', 'category', $idNTable, $aIdMTable);
        if ($redirect) {
            Fw_Router::redirect(Fw_Register::getRef('current_resource'), 'edit', array($idNTable));
        } else {
            return $idNTable;
        }
    }

}

?>