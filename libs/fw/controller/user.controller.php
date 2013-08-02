<?php

class Fw_User_Controller extends Fw_CrudController {
	//TODO: Use user_type TABLE
    public function __construct() {
        $this->model = 'User_Model';
        $this->setParams = array(
            'username' => array('type' => 'default', 'container' => 'post'),
            'password' => array('type' => 'default', 'container' => 'post', 'modifier' => 'md5'),
            'usertype' => array('type' => 'default', 'container' => 'post')
        );
        $this->adminParams = array(
            'ID' => 'id',
            'Username' => 'username',
            'Type' => 'usertype'
        );
        $this->editParams = array(
            'Username' => array('type' => 'text', 'name' => 'username', 'populate' => true),
            'Password' => array('type' => 'password', 'name' => 'password', 'populate' => false),
            'Type' => array('type' => 'text', 'name' => 'usertype', 'populate' => true)
        );
    }

    public function set($redirect = true) {
        if (Fw_Filter::getVar('password', 'default', 'post') == '') {
            unset($this->setParams['password']);
        }
        parent::set($redirect);
    }

}

?>
