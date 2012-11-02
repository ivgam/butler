<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head><?php Fw_Module::getModule('head'); ?></head>
	<body>
		<?php Fw_Module::getModule('navigation', array('style' => 'topbar')) ?>
		<div class="row">
			<div class="three columns">
				<div class="panel">
					<h5>Panel Title</h5>
					<p>This is a three columns grid panel with an arbitrary height.</p>
				</div>
			</div>
			<div class="six columns">
				<div class="panel">
					<h5>Panel Title</h5>
					<p>This is a six columns grid panel with an arbitrary height. Bacon ipsum dolor sit amet salami ham hock biltong ball tip drumstick sirloin pancetta meatball short loin.</p>
				</div>
			</div>
			<div class="three columns">
				<div class="panel">
					<h5>Panel Title</h5>
					<p>This is a three columns grid panel with an arbitrary height.</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="six columns">
				<div class="panel">
					<h5>Panel Title</h5>
					<p>This is a six columns grid panel with an arbitrary height. Bacon ipsum dolor sit amet salami ham hock biltong ball tip drumstick sirloin pancetta meatball short loin.</p>
				</div>
			</div>
			<div class="two columns">
				<div class="panel">
					<p>
						<img src="http://placehold.it/250x250" />
					</p>
				</div>
			</div>
			<div class="four columns">
				<div class="panel">
					<h5>Panel Title</h5>
					<p>This is a four columns grid panel with an arbitrary height. Bacon ipsum dolor sit amet salami.</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="four columns">
				<div class="panel">
					<p>
						<img src="http://placehold.it/600x400" />
					</p>
				</div>
			</div>
			<div class="four columns">
				<div class="panel">
					<p>
						<img src="http://placehold.it/600x400" />
					</p>
				</div>
			</div>
			<div class="four columns">
				<div class="panel">
					<p>
						<img src="http://placehold.it/600x400" />
					</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="six columns">
				<div class="panel">
					<h5>Panel Title</h5>
					<p>This is a six columns grid panel with an arbitrary height. Bacon ipsum dolor sit amet salami ham hock biltong ball tip drumstick sirloin pancetta meatball short loin.</p>
				</div>
			</div>
			<div class="three columns">
				<div class="panel">
					<h5>Panel Title</h5>
					<p>This is a three columns grid panel with an arbitrary height.</p>
				</div>
			</div>
			<div class="three columns">
				<div class="panel">
					<h5>Panel Title</h5>
					<p>This is a three columns grid panel with an arbitrary height.</p>
				</div>
			</div>
		</div>
		<!-- End Grid Section -->
		<?php Fw_Module::getModule('footer'); ?>
		<?php Fw_CCC::getAllFrontJs() ?>
	</body>
</html>
