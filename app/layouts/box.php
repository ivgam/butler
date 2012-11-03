<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head><?php Fw_Module::getModule('head'); ?></head>
	<body>
		<div class="row">
			<div class="twelve columns">
				<!-- Navigation -->
				<ul class="nav-bar">
					<li class="active"><a href="#">Nav Item 1</a></li>
					<li><a href="#">Nav Item 2</a></li>
					<li><a href="#">Nav Item 3</a></li>
				</ul>
				<!-- End Navigation -->
				<!-- Header Content -->
				<div class="row">
					<div class="six columns">
						<img src="http://placehold.it/500x500&text=Image"/><br>
					</div>
					<div class="six columns">
						<h3 class="show-for-small">Header<hr/></h3>
						<div class="panel">
							<h4 class="hide-for-small">Header<hr/></h4>
							<h5 class="subheader">Fusce ullamcorper mauris in eros dignissim molestie posuere felis blandit. Aliquam erat volutpat. Mauris ultricies posuere vehicula. Sed sit amet posuere erat. Quisque in ipsum non augue euismod dapibus non et eros. Pellentesque consectetur tempus mi iaculis bibendum. Ut vel dolor sed eros tincidunt volutpat ac eget leo.</h5>
						</div>
						<div class="row">
							<div class="six mobile-two columns">
								<div class="panel">
									<h5>Header</h5>
									<h6 class="subheader">Praesent placerat dui tincidunt elit suscipit sed.</h6>
									<a href="#" class="small button">BUTTON TIME!</a>
								</div>
							</div>
							<div class="six mobile-two columns">
								<div class="panel">
									<h5>Header</h5>
									<h6 class="subheader">Praesent placerat dui tincidunt elit suscipit sed.</h6>
									<a href="#" class="small button">BUTTON TIME!</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- End Header Content -->
				<!-- Search Bar -->
				<div class="row">
					<div class="twelve columns">
						<div class="radius panel">
							<form>
								<div class="row collapse">
									<div class="ten mobile-three columns">
										<input type="text" />
									</div>
									<div class="two mobile-one columns">
										<a href="#" class="postfix button expand">Search</a>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- End Search Bar -->
				<!-- Thumbnails -->
				<div class="row">
					<div class="twelve show-for-small columns">
						<h3>Header</h3><hr>
					</div>
					<div class="three mobile-two columns">
						<img src="http://placehold.it/500x500&text=Thumbnail"/>
						<div class="panel">
							<p>Description</p>
						</div>
					</div>
					<div class="three mobile-two columns">
						<img src="http://placehold.it/500x500&text=Thumbnail"/>
						<div class="panel">
							<p>Description</p>
						</div>
					</div>
					<div class="three mobile-two columns">
						<img src="http://placehold.it/500x500&text=Thumbnail"/>
						<div class="panel">
							<p>Description</p>
						</div>
					</div>
					<div class="three mobile-two columns">
						<img src="http://placehold.it/500x500&text=Thumbnail"/>
						<div class="panel">
							<p>Description</p>
						</div>
					</div>
				</div>
				<!-- End Thumbnails -->
			</div>
			<?php Fw_Module::getModule('footer'); ?>
			<?php Fw_CCC::getAllFrontJs() ?>
		</div>
		</div>
	</body>
</html>