<?php

class Fw_Comment_Controller extends Fw_CrudController {

    public function __construct() {
        $this->model = 'Comment_Model';
        $this->setParams = array(
            'email' => array('type' => 'default', 'container' => 'post'),
            'content' => array('type' => 'default', 'container' => 'post'),
            'approved' => array('type' => 'default', 'container' => 'post'),
            'id_post' => array('type' => 'default', 'container' => 'post')
        );
        $this->adminParams = array(
            'ID' => 'id',
            'Email' => 'email',
            'Post' => 'id_post',
            'Created At' => 'ts_creation',
            'Updated At' => 'ts_update',
            'Approved' => 'approved'
        );
        $this->editParams = array(
            'Email' => array('type' => 'text', 'name' => 'email', 'populate' => true),
            'Content' => array('type' => 'textarea', 'name' => 'content', 'populate' => true),
            'Post' => array('type' => 'text', 'name' => 'id_post', 'populate' => true),
            'Approved' => array('type' => 'text', 'name' => 'approved', 'populate' => true)
        );
    }

}

?>