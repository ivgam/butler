<?php

$routes = array(
    "login" => array(
        "controller" => "Auth_Controller",
        "url" => "login",
        "regex" => "/login$/",
        "params" => array(),
        "task" => "login",
        "resource" => "auth",
        "cacheable" => false
    ),
    "logout" => array(
        "controller" => "Auth_Controller",
        "url" => "logout",
        "regex" => "/logout$/",
        "params" => array(),
        "task" => "logout",
        "resource" => "auth",
        "cacheable" => false
    ),
    "admin" => array(
        "controller" => "Admin_Controller",
        "url" => "admin",
        "regex" => "/admin$/",
        "params" => array(),
        "task" => "home",
        "resource" => "admin",
        "cacheable" => false
    ),
	"error" => array(
        "controller" => "Error_Controller",
        "url" => "error",
        "regex" => "/error\/?([0-9]+)?$/",
        "params" => array('id'=>0),
        "task" => "error",
        "resource" => "error",
        "cacheable" => true
    )
);
