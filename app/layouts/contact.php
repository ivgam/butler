<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head><?php Fw_Module::getModule('head'); ?></head>
	<body>	
		<?php Fw_Module::getModule('navigation', array('style' => 'topbar')) ?>						
		<div class="row">			
			<div class="nine columns"><?php Fw_Module::getModule('contact/form') ?></div>
			<div class="three columns"><?php Fw_Module::getModule('contact/map') ?></div>			
		</div>		
		<?php Fw_Module::getModule('footer'); ?>		
		<?php Fw_CCC::getAllFrontJs() ?>
	</body>
</html>
