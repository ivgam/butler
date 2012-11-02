<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head><?php Fw_Module::getModule('head'); ?></head>
	<body>		
		<div class="row">
			<div class="twelve columns">
				<?php Fw_Module::getModule('navigation', array('style'=>'fulltop'))?>						
				<p><img src="http://placehold.it/1920x400&text=[banner img]" /></p>
			</div>
		</div>				
		<div class="row">
			<div class="eight columns">			
				<h4>This is a content section.</h4>
				<p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong. Eiusmod swine spare ribs reprehenderit culpa. Boudin aliqua adipisicing rump corned beef.</p>
				<p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong. Eiusmod swine spare ribs reprehenderit culpa. Boudin aliqua adipisicing rump corned beef.</p>
				<p><a href="#" class="secondary small button">Next Page &rarr;</a></p>
			</div>
			<div class="four columns">				
				<ul class="block-grid three-up">
					<li><a href="#"><img src="http://placehold.it/200x200" /></a></li>
					<li><a href="#"><img src="http://placehold.it/200x200" /></a></li>
					<li><a href="#"><img src="http://placehold.it/200x200" /></a></li>
					<li><a href="#"><img src="http://placehold.it/200x200" /></a></li>
					<li><a href="#"><img src="http://placehold.it/200x200" /></a></li>
					<li><a href="#"><img src="http://placehold.it/200x200" /></a></li>
				</ul>
			</div>
		</div>
		<!-- Call to Action Panel -->
		<div class="row">
			<div class="twelve columns"><?php Fw_Module::getModule('contact/getintouch')?></div>
		</div>
		<!-- Map Modal -->
		<div class="reveal-modal" id="mapModal">
			<h4>Where We Are</h4>
			<p><img src="http://placehold.it/800x600" /></p>
			<!-- Any anchor with this class will close the modal. This also inherits certain styles, which can be overriden. -->
			<a href="#" class="close-reveal-modal">&times;</a>
		</div>
	</body>
</html>
