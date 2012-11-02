<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<?php Fw_Module::getModule('head'); ?>
	<body style="background-color: #222">
		<div class="row">
			<div class="grid_4">&nbsp;</div>
			<div class="grid_4">&nbsp;</div>
			<div class="grid_4">&nbsp;</div>
		</div>
		<div class="row">
			<div class="grid_4">&nbsp;</div>
			<div class="grid_4 panel" style="height:275px;margin-top:100px">			
				<div class="row" style="margin-bottom:15px">
					<div class="five columns centered">
						<span class="logo-black" style="height: 75px"></span>
					</div>
				</div>
				<form method="post">				
					<div class="row collapse">
						<div class="two mobile-one columns">
							<span class="prefix">
								<i class="general foundicon-smiley"></i>
							</span>
						</div>
						<div class="ten mobile-three columns">
							<input type="text" name="username" placeholder="Enter your username">
						</div>
					</div>
					<div class="row collapse">
						<div class="two mobile-one columns">
							<span class="prefix">
								<i class="general foundicon-lock"></i>
							</span>
						</div>
						<div class="ten mobile-three columns">
							<input type="text" name="pwd" placeholder="Enter your password">
						</div>
					</div>			
					<input type="submit" value="Login" class="button right" />					
				</form>				
			</div>
			<div class="grid_4">&nbsp;</div>
		</div>
	</body>
</html>