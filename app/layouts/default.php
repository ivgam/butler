<?php 
if(!isset($_GET['tpl'])){
//include('banded.php');
//include('banner.php');
include('blog.php');
//include('contact.php');
//include('feed.php');
//include('grid.php');
//include('index.php');
//include('orbit.php');
//include('sidebar.php');
} else {
	include($_GET['tpl'].'.php');
}
?>