<?php $admin_controllers = Fw_Register::getRef('admin_controllers');?>
<!--h5><a href="#">Admin</a></h5-->
<dl class="vertical tabs">
<?php foreach($admin_controllers as $controller){?>
<dd <?php if($controller == Fw_Register::getRef('current_resource'))echo 'class="active"'?>>	
	<a href="<?php echo Fw_Router::getUrl($controller, 'admin')?>">
		<?php echo ucfirst($controller)?>		
		<span class="general foundicon-website"></span>
	</a>
</dd>
<?php } ?>
</dl>
<!--
<h5><a href="#">Config</a></h5>
<dl class="vertical tabs">
<?php 
	$methods = get_class_methods('Admin_Controller');
	foreach ($methods as $method) {
		if (strpos($method, 'config_') === 0) {			
			$name = ucfirst(str_replace('config_', '', $method));
			$route = Fw_Router::getUrl('admin',$method);
			?>
			<dd <?php if($method == Fw_Register::getRef('current_task')) echo 'class="active"'?>>
				<a href="<?php echo $route?>">
					<?php echo $name ?>
					<span class="general foundicon-settings"></span>
				</a>
			</dd>
			<?php
		}
	}
?>
</dl>
-->