<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<?php Fw_Module::getModule('head'); ?>
	<body>
		<div class="row">
			<div class="grid_4">&nbsp;</div>
			<div class="grid_4">&nbsp;</div>
			<div class="grid_4">&nbsp;</div>
		</div>
		<div class="row">
			<div class="grid_4">&nbsp;</div>
			<div class="grid_4">			
				<form method="post">				
					<div class="wrapper-block">
						<label for="username">Username:</label>
						<input  type="text" 
								placeholder="Enter your username" 
								name="username" autocomplete="off"/>
					</div>
					<div class="wrapper-block">
						<label for="pwd">Password:</label>
						<input  type="password"
								placeholder="Enter your password" 
								name="pwd" autocomplete="off"/>
					</div>
					<input type="submit" value="Login" class="submit btn-form" />
				</form>				
			</div>
			<div class="grid_4">&nbsp;</div>
		</div>
	</body>
</html>