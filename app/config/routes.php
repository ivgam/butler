<?php
$routes = array ( 
	"login" => array (
		"controller" => "Auth_Controller",
		"url" => "login",
		"regex" => "/login/",
		"params" => array(),
		"task" => "login",
		"resource" => "auth",
		"cacheable" => false
	),
	"logout" => array (
		"controller" => "Auth_Controller",
		"url" => "logout",
		"regex" => "/logout/",
		"params" => array(),
		"task" => "logout",
		"resource" => "auth",
		"cacheable" => false
	),
	"admin" => array (
		"controller" => "Admin_Controller",
		"url" => "admin",
		"regex" => "/admin/",
		"params" => array(),
		"task" => "home",
		"resource" => "admin",
		"cacheable" => false
	),
	"api" => array (
		"controller" => "Rest_Controller",
		"url" => "api",
		"regex" => "/api/",
		"params" => array(),
		"task" => "router",
		"resource" => "rest",
		"cacheable" => false
	),
	"home" => array (
		"controller" => "Static_Controller",
		"url" => "",
		"regex" => "//",
		"params" => array(),
		"task" => "home",
		"resource" => "static",
		"cacheable" => true
	),
);
