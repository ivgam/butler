<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head><?php Fw_Module::getModule('head'); ?></head>
	<body>
		<nav class="top-bar">
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
		</nav>
		<!-- End Navigation -->
		<div class="row">
			<div class="twelve columns">
				<!-- Content Slider -->
				<div class="row">
					<div class="twelve columns hide-for-small">
						<div id="featured">
							<img src="http://placehold.it/1200x500&text=Slide Image" alt="slide image"/>
							<img src="http://placehold.it/1200x500&text=Slide Image" alt="slide image"/>
							<img src="http://placehold.it/1200x500&text=Slide Image" alt="slide image"/>
						</div>
					</div>
				</div>
				<!-- End Content Slider -->
				<!-- Mobile Header -->
				<div class="row">
					<div class="twelve columns show-for-small">
						<img src="http://placehold.it/1200x700&text=Mobile Header"/>
					</div>
				</div><br>
					<!-- End Mobile Header -->
					<div class="row">
						<div class="twelve columns">
							<div class="row">
								<!-- Shows -->
								<div class="four mobile-two push-two-mobile columns">
									<h4>Upcoming Shows</h4><hr/>
									<div class="row">
										<div class="one column">
											<img src="http://placehold.it/50x50&text=[img]" />
										</div>
										<div class="nine columns">
											<h5><a href="#">Venue Name</a></h5>
											<h6 class="subheader show-for-small">Doors at 00:00pm</h6>
										</div>
									</div><hr/>
									<div class="hide-for-small">
										<div class="row">
											<div class="one column">
												<img src="http://placehold.it/50x50&text=[img]" />
											</div>
											<div class="nine columns">
												<h5 class="subheader"><a href="#">Venue Name</a></h5>
											</div>
										</div><hr/>
										<div class="row">
											<div class="one column">
												<img src="http://placehold.it/50x50&text=[img]" />
											</div>
											<div class="nine columns">
												<h5 class="subheader"><a href="#">Venue Name</a></h5>
											</div>
										</div><hr/>
										<div class="row">
											<div class="one column">
												<img src="http://placehold.it/50x50&text=[img]" />
											</div>
											<div class="nine columns">
												<h5 class="subheader"><a href="#">Venue Name</a></h5>
											</div>
										</div>
									</div>
								</div>
								<!-- End Shows -->
								<!-- Image -->
								<div class="four mobile-two pull-two-mobile columns">
									<img src="http://placehold.it/300x465&text=Image" />
								</div>
								<!-- End Image -->
								<!-- Feed -->
								<div class="four mobile-four columns">
									<h4>Blog</h4><hr/>
									<div class="panel">
										<h5><a href="#">Post Title 1</a></h5>
										<h6 class="subheader">
											Risus ligula, aliquam nec fermentum vitae, sollicitudin eget urna. Suspendisse ultrices ornare tempor...
										</h6>
										<h6><a href="#">Read More »</a></h6>
									</div>
									<div class="panel hide-for-small">
										<h5><a href="#">Post Title 2 »</a></h5>
									</div>
									<div class="panel hide-for-small">
										<h5><a href="#">Post Title 3 »</a></h5>
									</div>
									<a href="#" class="right">Go To Blog »</a>
								</div>
								<!-- End Feed -->
							</div>
						</div>
					</div>
					<!-- End Content -->
			</div>
			<?php Fw_Module::getModule('footer'); ?>
			<?php Fw_CCC::getAllFrontJs() ?>
			<script type="text/javascript">
				$(window).load(function() {
					$('#featured').orbit({ fluid: '2x1' });
				});
			</script>
		</div>		
	</body>
</html>