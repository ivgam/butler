<!DOCTYPE html>
<html lang="en">
	<head>
		<?php Fw_Module::getModule('head'); ?>
	</head>
	<body>
		<?php Fw_Module::getModule('messages'); ?>
		<?php echo $html ?>
		<?php Fw_CCC::getAllFrontJs() ?>
		<?php Fw_Module::getModule('google_analytics'); ?>
	</body>
</html>
