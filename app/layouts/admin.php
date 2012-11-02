<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php Fw_Module::getModule('admin/head'); ?>		
	</head>
	<body>			
		<?php Fw_Module::getModule('admin/topbar') ?>			
		<div class="row">
			<div class="three columns" id="admin_menu">
				<?php Fw_Module::getModule('admin/menu'); ?>
			</div>
			<div class="nine columns">
				<?php Fw_Module::getModule('admin/messages') ?>
				<?php echo $html; ?>
			</div>
		</div>		
		<div class="row">
			<div class="twelve columns">
				<?php Fw_Module::getModule('admin/footer') ?>
			</div>
		</div>
		<?php Fw_CCC::getAllBackJs()?>
	</body>
</html>