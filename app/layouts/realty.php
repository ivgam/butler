<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head><?php Fw_Module::getModule('head'); ?></head>
	<body>
		<!-- Navigation -->
		<nav class="top-bar fixed">
			<ul>
				<li class="name"><h1><a href="#">Title</a></h1></li>
				<li class="toggle-topbar"><a href="#"></a></li>
			</ul>
			<section>
				<ul class="left">
					<li><a href="#">Link</a></li>
					<li><a href="#">Link</a></li>
					<li><a href="#">Link</a></li>
				</ul>
				<ul class="right">
					<li class="has-dropdown">
						<a href="#">Link</a>
						<ul class="dropdown">
							<li><a href="#">Dropdown Link</a></li>
							<li><a href="#">Dropdown Link</a></li>
							<li><a href="#">Dropdown Link</a></li>
						</ul>
					</li>
				</ul>
			</section>
		</nav><br/><br/>
		<!-- End Navigation -->
		<!-- Header -->
		<img src="http://placehold.it/1600x600&text=Header"/><br/><br/>
		<!-- End Header -->
		<div class="row">
			<div class="three panel columns">
				<img src="http://placehold.it/500x500&text=Image"/>
				<h4>Header</h4>
				<p>Fusce ullamcorper mauris in eros dignissim molestie posuere felis blandit. Aliquam erat volutpat. Mauris ultricies posuere vehicula. Sed sit amet posuere erat. Quisque in ipsum non augue euismod dapibus non et eros.</p><hr>
					<div class="row">
						<div class="four columns">
							<a href="#" class="small button">Link</a>
						</div>
						<div class="four columns">
							<a href="#" class="small button">Link</a>
						</div>
						<div class="four columns">
							<a href="#" class="small button">Link</a>
						</div>
					</div>
			</div>
			<div class="nine columns">
				<div class="panel">
					<div class="row">
						<div class="three columns">
							<img src="http://placehold.it/600x500&text=Thumbnail"/>
						</div>
						<div class="three columns">
							<img src="http://placehold.it/600x500&text=Thumbnail"/>
						</div>
						<div class="three columns">
							<img src="http://placehold.it/600x500&text=Thumbnail"/>
						</div>
						<div class="three columns">
							<img src="http://placehold.it/600x500&text=Thumbnail"/>
						</div>
						<div class="three columns">
							<img src="http://placehold.it/600x500&text=Thumbnail"/>
						</div>
						<div class="three columns">
							<img src="http://placehold.it/600x500&text=Thumbnail"/>
						</div>
						<div class="three columns">
							<img src="http://placehold.it/600x500&text=Thumbnail"/>
						</div>
						<div class="three columns">
							<img src="http://placehold.it/600x500&text=Thumbnail"/>
						</div>
						<div class="three columns">
							<img src="http://placehold.it/600x500&text=Thumbnail"/>
						</div>
						<div class="three columns">
							<img src="http://placehold.it/600x500&text=Thumbnail"/>
						</div>
						<div class="three columns">
							<img src="http://placehold.it/600x500&text=Thumbnail"/>
						</div>
						<div class="three columns end">
							<img src="http://placehold.it/600x500&text=Thumbnail"/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="six columns">
						<div class="panel">
							<h5>Subheader</h5>
							<p>Sed sit amet posuere erat. Quisque in ipsum non augue euismod dapibus non et eros.</p>
							<a href="#" class="small button">Link</a>
						</div>
					</div>
					<div class="six columns">
						<div class="panel">
							<h5>Subheader</h5>
							<p>Sed sit amet posuere erat. Quisque in ipsum non augue euismod dapibus non et eros.</p>
							<a href="#" class="small button">Link</a>
						</div>
					</div>
				</div>
			</div>
		</div>		
		<?php Fw_Module::getModule('footer'); ?>
		<?php Fw_CCC::getAllFrontJs() ?>
	</body>
</html>