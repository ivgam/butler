<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head><?php Fw_Module::getModule('head'); ?></head>
	<body>		
		<div class="row">
			<div class="three columns"><?php Fw_Module::getModule('logo')?></div>
			<div class="nine columns"><?php Fw_Module::getModule('navigation', array('style'=>'topright'))?></div>
		</div>		
		<!-- First Band (Image) -->
		<div class="row">
			<div class="twelve columns">
				<img src="http://placehold.it/1920x400&text=[img]" />    
				<hr />
			</div>
		</div>
		<!-- Second Band (Image Left with Text) -->
		<div class="row">
			<div class="four columns">
				<img src="http://placehold.it/600x300&text=[img]" />
			</div>
			<div class="eight columns">
				<h4>This is a content section.</h4>
				<div class="row">
					<div class="six columns">
						<p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong. Eiusmod swine spare ribs reprehenderit culpa. Boudin aliqua adipisicing rump corned beef.</p>
					</div>
					<div class="six columns">
						<p>Pork drumstick turkey fugiat. Tri-tip elit turducken pork chop in. Swine short ribs meatball irure bacon nulla pork belly cupidatat meatloaf cow. Nulla corned beef sunt ball tip, qui bresaola enim jowl. Capicola short ribs minim salami nulla nostrud pastrami.</p>
					</div>
				</div>
			</div>
		</div>
		<!-- Third Band (Image Right with Text) -->
		<div class="row">
			<div class="eight columns">
				<h4>This is a content section.</h4>    
				<p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit, dolore aliqua non est magna in labore pig pork biltong. Eiusmod swine spare ribs reprehenderit culpa. Boudin aliqua adipisicing rump corned beef.</p>     
				<p>Pork drumstick turkey fugiat. Tri-tip elit turducken pork chop in. Swine short ribs meatball irure bacon nulla pork belly cupidatat meatloaf cow. Nulla corned beef sunt ball tip, qui bresaola enim jowl. Capicola short ribs minim salami nulla nostrud pastrami.</p>      
			</div>
			<div class="four columns">
				<img src="http://placehold.it/600x300&text=[img]" />
			</div>
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
