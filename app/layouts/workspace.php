<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head><?php Fw_Module::getModule('head'); ?></head>
	<body>
		<div class="row">
			<div class="twelve columns">
				<!-- Navigation -->
				<nav class="top-bar contain-to-grid">
					<ul>
						<li class="name"><h1><a href="#">Title</a></h1></li>
						<li class="toggle-topbar"><a href="#"></a></li>
					</ul>
					<section>
						<ul class="left">
							<li><a href="#">Link 1</a></li>
							<li><a href="#">Link 2</a></li>
						</ul>
						<ul class="right">
							<li class="search">
								<form>
									<input type="search">
								</form>
							</li>
							<li class="has-button">
								<a class="small button" href="#">Search</a>
							</li>
						</ul>
					</section>
				</nav>
				<!-- End Navigation -->
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<!-- Desktop Slider -->
				<div class="hide-for-small">
					<div id="featured">
						<img src="http://placehold.it/1000x400&text=Slide Image" alt="slide image"/>
						<img src="http://placehold.it/1000x400&text=Slide Image" alt="slide image"/>
						<img src="http://placehold.it/1000x400&text=Slide Image" alt="slide image"/>
					</div>
				</div>
				<!-- End Desktop Slider -->
				<!-- Mobile Header -->
				<div class="row">
					<div class="mobile-four show-for-small"><br>
							<img src="http://placehold.it/1000x600&text=For Small Screens" />
					</div>
				</div>
				<!-- End Mobile Header -->
			</div>
		</div><br>
			<div class="row">
				<div class="twelve columns">
					<div class="row">
						<!-- Thumbnails -->
						<div class="three mobile-two columns">
							<img src="http://placehold.it/250x250&text=Thumbnail" />
							<h6 class="panel">Description</h6>
						</div>
						<div class="three mobile-two columns">
							<img src="http://placehold.it/250x250&text=Thumbnail" />
							<h6 class="panel">Description</h6>
						</div>
						<div class="three mobile-two columns">
							<img src="http://placehold.it/250x250&text=Thumbnail" />
							<h6 class="panel">Description</h6>
						</div>
						<div class="three mobile-two columns">
							<img src="http://placehold.it/250x250&text=Thumbnail" />
							<h6 class="panel">Description</h6>
						</div>
						<!-- End Thumbnails -->
					</div>
				</div>
			</div>
			<div class="row">
				<div class="twelve columns">
					<div class="row">
						<!-- Content -->
						<div class="eight columns">
							<div class="panel radius">
								<div class="row">
									<div class="six mobile-two columns">
										<h4>Header</h4><hr/>
										<h5 class="subheader">Risus ligula, aliquam nec fermentum vitae, sollicitudin eget urna. Donec dignissim nibh fermentum odio ornare sagittis.
										</h5>
										<div class="show-for-small" align="center">
											<a href="#" class="small radius button">Call To Action!</a><br>
												<a href="#" class="small radius button">Call To Action!</a>
										</div>
									</div>
									<div class="six mobile-two columns">
										<p>Suspendisse ultrices ornare tempor. Aenean eget ultricies libero. Phasellus non ipsum eros. Vivamus at dignissim massa. Aenean dolor libero, blandit quis interdum et, malesuada nec ligula. Nullam erat erat, eleifend sed pulvinar ac. Suspendisse ultrices ornare tempor. Aenean eget ultricies libero.
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="four columns hide-for-small">
							<h4>Get In Touch!</h4><hr/>
							<a href="#">
								<div class="panel radius callout" align="center">
									<strong>Call To Action!</strong>
								</div>
							</a>
							<a href="#">
								<div class="panel radius callout" align="center">
									<strong>Call To Action!</strong>
								</div>
							</a>
						</div>
						<!-- End Content -->
					</div>
				</div>
			</div>			
			<?php Fw_Module::getModule('footer'); ?>
			<?php Fw_CCC::getAllFrontJs() ?>
			<script type="text/javascript">
				$(window).load(function() {
					$('#featured').orbit({ fluid: '2x1' });
				});
			</script>
	</body>
</html>