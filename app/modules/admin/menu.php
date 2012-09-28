<?php $admin_controllers = Fw_Register::getRef('admin_controllers');?>
<div class="highlight" >Admin</div>
<?php foreach($admin_controllers as $controller){?>
<div <?php if($controller == Fw_Register::getRef('current_resource'))echo 'class="current"'?>>
	<?php echo ucfirst($controller)?>
	<a href="<?php echo Fw_Router::getUrl($controller, 'add')?>"><span class="add right"/></a>	
	<a href="<?php echo Fw_Router::getUrl($controller, 'admin')?>"><span class="admin right"/></a>	
</div>
<?php } ?>
<div class="highlight">Config</div>
<?php 
	$methods = get_class_methods('Admin_Controller');
	foreach ($methods as $method) {
		if (strpos($method, 'config_') === 0) {			
			$name = ucfirst(str_replace('config_', '', $method));
			$route = Fw_Router::getUrl('admin',$method);
			?>
			<div <?php if($method == Fw_Register::getRef('current_task')) echo 'class="current"'?>>
				<?php echo $name ?>
				<a href="<?php echo $route?>">
					<span class="config right"/>
				</a>
			</div>
			<?php
		}
	}
?>