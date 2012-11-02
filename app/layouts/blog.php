<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head><?php Fw_Module::getModule('head'); ?></head>
	<body>		
		<div class="row">
			<div class="twelve columns">
				<?php Fw_Module::getModule('navigation', array('style' => 'fulltop')) ?>				
				<h1>Blog <small>This is my blog. It's awesome.</small></h1>
				<hr />
			</div>
		</div>
		<div class="row">			
			<div class="nine columns" role="content">
				<?php
				Fw_Module::getModule('blog/posts', array('type' => 'latest',
						'category' => 'all',
						'num' => 10,
						'comments' => false,
						'readmore' => 150)
				);
				?>
			</div>
			<aside class="three columns">
				<?php Fw_Module::getModule('blog/categories', array('style'=>'default')); ?>
				<?php Fw_Module::getModule('blog/featured'); ?>
			</aside>			
		</div>		
		<?php Fw_Module::getModule('footer'); ?>
		<?php Fw_CCC::getAllFrontJs() ?>
	</body>
</html>
