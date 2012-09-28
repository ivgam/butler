<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php Fw_Module::getModule('admin/head'); ?>
	</head>
	<body>
		<div class="row"> 					
			<?php Fw_Module::getModule('admin/logo') ?>
			<?php Fw_Module::getModule('admin/search') ?>
		</div>
		<div class="row">
			<div class="grid_3" id="admin_menu">
				<?php Fw_Module::getModule('admin/menu'); ?>
			</div>
			<div class="grid_9">
				<?php Fw_Module::getModule('admin/messages') ?>
				<?php echo $html; ?>
			</div>
		</div>		
		<div class="row">
			<div class="grid_12">
				<?php Fw_Module::getModule('admin/footer') ?>
			</div>
		</div>
	</body>
</html>