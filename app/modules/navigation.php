<?php
$file = dirname(__FILE__).DS.'navigation'.DS.$params['style'].'.php';
if (file_exists($file))	include $file;
else include dirname(__FILE__).DS.'navigation'.DS.'fulltop.php';
?>