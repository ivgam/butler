<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head><?php Fw_Module::getModule('head'); ?></head>
	<body>				
		<div class="row">
			<div class="twelve columns">
				<div class="panel">
					<h1>Feed Template</h1>
				</div>
			</div>
		</div>		
		<div class="row">    
			<div class="six columns push-three">
				<?php Fw_Module::getModule('blog/feeds') ?>
			</div>		
			<div class="three columns pull-six">
				<?php Fw_Module::getModule('blog/categories',array('style'=>'panel'))?>
			</div>
			<aside class="three columns hide-for-small">
				<p><img src="http://placehold.it/500x640&text=[ad]" /></p>
				<p><img src="http://placehold.it/500x640&text=[ad]" /></p>
			</aside>
		</div>
		<?php Fw_Module::getModule('footer') ?>
		<?php Fw_CCC::getAllFrontJs() ?>
	</body>
</html>
