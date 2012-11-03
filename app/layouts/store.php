<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head><?php Fw_Module::getModule('head'); ?></head>
	<body>
		<div class="row">
			<div class="twelve columns">
				<!-- Navigation -->
				<div class="row">
					<div class="twelve columns">
						<ul class="top-bar">
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
								</ul>
							</section>
					</div>
				</div>
				<!-- End Navigation -->
				<div class="row">
					<!-- Side Bar -->
					<div class="four mobile-four columns">
						<img src="http://placehold.it/500x500&text=Logo">
							<div class="hide-for-small panel">
								<h3>Header</h3>
								<h5 class="subheader">Risus ligula, aliquam nec fermentum vitae, sollicitudin eget urna. Donec dignissim nibh fermentum odio ornare sagittis.
								</h5>
							</div>
							<a href="#">
								<div class="panel callout radius" align="center">
									<h6>99&nbsp; items in your cart</h6>
								</div>
							</a>
					</div>
					<!-- End Side Bar -->
					<!-- Thumbnails -->
					<div class="eight columns">
						<div class="row">
							<div class="four mobile-two columns">
								<img src="http://placehold.it/1000x1000&text=Thumbnail">
									<div class="panel">
										<h5>Item Name</h5>
										<h6 class="subheader">$000.00</h6>
									</div>
							</div>
							<div class="four mobile-two columns">
								<img src="http://placehold.it/500x500&text=Thumbnail">
									<div class="panel">
										<h5>Item Name</h5>
										<h6 class="subheader">$000.00</h6>
									</div>
							</div>
							<div class="four mobile-two columns">
								<img src="http://placehold.it/500x500&text=Thumbnail">
									<div class="panel">
										<h5>Item Name</h5>
										<h6 class="subheader">$000.00</h6>
									</div>
							</div>
							<div class="four mobile-two columns">
								<img src="http://placehold.it/500x500&text=Thumbnail">
									<div class="panel">
										<h5>Item Name</h5>
										<h6 class="subheader">$000.00</h6>
									</div>
							</div>
							<div class="four mobile-two columns">
								<img src="http://placehold.it/500x500&text=Thumbnail">
									<div class="panel">
										<h5>Item Name</h5>
										<h6 class="subheader">$000.00</h6>
									</div>
							</div>
							<div class="four mobile-two columns">
								<img src="http://placehold.it/500x500&text=Thumbnail">
									<div class="panel">
										<h5>Item Name</h5>
										<h6 class="subheader">$000.00</h6>
									</div>
							</div>
							<!-- End Thumbnails -->
							<!-- Managed By -->
							<div class="twelve columns">
								<div class="panel">
									<div class="row">
										<div class="two mobile-two columns">
											<img src="http://placehold.it/300x300&text=Site Owner">
										</div>
										<div class="ten mobile-two columns">
											<strong>This Site Is Managed By<hr/></strong>
											Risus ligula, aliquam nec fermentum vitae, sollicitudin eget urna. Donec dignissim nibh fermentum odio ornare sagittis
										</div>
									</div>
								</div>
							</div>
							<!-- End Managed By -->
						</div>
					</div>
				</div>
			</div>
			<?php Fw_Module::getModule('footer'); ?>
			<?php Fw_CCC::getAllFrontJs() ?>
		</div>
		</div>
	</body>
</html>