<?php

$routes = array(
	"login" => array(
		"controller" => "Auth_Controller",
		"url" => "login",
		"regex" => "/^login$/",
		"params" => array(),
		"task" => "login",
		"resource" => "auth",
		"cacheable" => false
	),
	"logout" => array(
		"controller" => "Auth_Controller",
		"url" => "logout",
		"regex" => "/^logout$/",
		"params" => array(),
		"task" => "logout",
		"resource" => "auth",
		"cacheable" => false
	),
	"attribution" => array(
		"controller" => "Attribution_Controller",
		"url" => "attribution",
		"regex" => "/^attribution$/",
		"params" => array(),
		"task" => "view",
		"resource" => "attribution",
		"cacheable" => true
	),
	"sitemap" => array(
		"controller" => "Static_Controller",
		"url" => "sitemap",
		"regex" => "/^sitemap$/",
		"params" => array(),
		"task" => "map",
		"resource" => "static",
		"cacheable" => true
	),
	"about" => array(
		"controller" => "Static_Controller",
		"url" => "about",
		"regex" => "/^about$/",
		"params" => array(),
		"task" => "about",
		"resource" => "static",
		"cacheable" => true
	),
	"contact" => array(
		"controller" => "Static_Controller",
		"url" => "contact",
		"regex" => "/^contact$/",
		"params" => array(),
		"task" => "contact",
		"resource" => "static",
		"cacheable" => true
	),
	"privacy" => array(
		"controller" => "Static_Controller",
		"url" => "privacy",
		"regex" => "/^privacy$/",
		"params" => array(),
		"task" => "privacy",
		"resource" => "static",
		"cacheable" => true
	),
	"landing" => array(
		"controller" => "Landing_Controller",
		"url" => "landing",
		"regex" => "/^subscriptions\/(.*)\/(.*)$/",
		"params" => array('campaign_name' => '', 'landing_name' => ''),
		"task" => "view",
		"resource" => "landing",
		"cacheable" => false
	),
	"admin" => array(
		"controller" => "Admin_Controller",
		"url" => "admin",
		"regex" => "/^admin$/",
		"params" => array(),
		"task" => "home",
		"resource" => "admin",
		"cacheable" => false
	),
	"error" => array(
		"controller" => "Error_Controller",
		"url" => "error",
		"regex" => "/^error\/?([0-9]+)?$/",
		"params" => array('id' => 0),
		"task" => "error",
		"resource" => "error",
		"cacheable" => false
	)
);
