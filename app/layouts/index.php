<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head><?php Fw_Module::getModule('head'); ?></head>
	<body>
		<div class="row">
			<div class="twelve columns">
				<h2>Welcome to Foundation</h2>
				<p>This is version <strong>3.1.1</strong> generated on October 03, 2012.</p>
				<hr />
			</div>
		</div>
		<div class="row">
			<div class="eight columns">
				<h3>The Grid</h3>
				<!-- Grid Example -->
				<div class="row">
					<div class="twelve columns">
						<div class="panel">
							<p>This is a twelve column section in a row. Each of these includes a div.panel element so you can see where the columns are - it's not required at all for the grid.</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="six columns">
						<div class="panel">
							<p>Six columns</p>
						</div>
					</div>
					<div class="six columns">
						<div class="panel">
							<p>Six columns</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="four columns">
						<div class="panel">
							<p>Four columns</p>
						</div>
					</div>
					<div class="four columns">
						<div class="panel">
							<p>Four columns</p>
						</div>
					</div>
					<div class="four columns">
						<div class="panel">
							<p>Four columns</p>
						</div>
					</div>
				</div>
				<h3>Tabs</h3>
				<dl class="tabs">
					<dd class="active"><a href="#simple1">Simple Tab 1</a></dd>
					<dd><a href="#simple2">Simple Tab 2</a></dd>
					<dd><a href="#simple3">Simple Tab 3</a></dd>
				</dl>
				<ul class="tabs-content">
					<li class="active" id="simple1Tab">This is simple tab 1's content. Pretty neat, huh?</li>
					<li id="simple2Tab">This is simple tab 2's content. Now you see it!</li>
					<li id="simple3Tab">This is simple tab 3's content. It's, you know...okay.</li>
				</ul>
				<h3>Buttons</h3>
				<div class="row">
					<div class="six columns">
						<p><a href="#" class="small button">Small Button</a></p>
						<p><a href="#" class="button">Medium Button</a></p>
						<p><a href="#" class="large button">Large Button</a></p>
					</div>
					<div class="six columns">
						<p><a href="#" class="small alert button">Small Alert Button</a></p>
						<p><a href="#" class="success button">Medium Success Button</a></p>
						<p><a href="#" class="large secondary button">Large Secondary Button</a></p>
					</div>
				</div>

			</div>

			<div class="four columns">
				<h4>Getting Started</h4>
				<p>We're stoked you want to try Foundation! To get going, this file (index.html) includes some basic styles you can modify, play around with, or totally destroy to get going.</p>

				<h4>Other Resources</h4>
				<p>Once you've exhausted the fun in this document, you should check out:</p>
				<ul class="disc">
					<li><a href="http://foundation.zurb.com/docs">Foundation Documentation</a><br />Everything you need to know about using the framework.</li>
					<li><a href="http://github.com/zurb/foundation">Foundation on Github</a><br />Latest code, issue reports, feature requests and more.</li>
					<li><a href="http://twitter.com/foundationzurb">@foundationzurb</a><br />Ping us on Twitter if you have questions. If you build something with this we'd love to see it (and send you a totally boss sticker).</li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<h3>Orbit</h3>
				<div id="featured">
					<img src="http://placehold.it/1920x450&text=Slide_1" alt="slide image"/>
					<img src="http://placehold.it/1920x450&text=Slide_2" alt="slide image"/>
					<img src="http://placehold.it/1920x450&text=Slide_3" alt="slide image"/>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="twelve columns">
				<h3>Reveal</h3>
				<p><a href="#" data-reveal-id="exampleModal" class="button">Example modal</a></p>
			</div>
		</div>
		<div id="exampleModal" class="reveal-modal">
			<h2>This is a modal.</h2>
			<p>
				Reveal makes these very easy to summon and dismiss. The close button is simple an anchor with a unicode 
				character icon and a class of <code>close-reveal-modal</code>. Clicking anywhere outside the modal will 
				also dismiss it.
			</p>
			<a class="close-reveal-modal">×</a>
		</div>
		<?php Fw_CCC::getAllFrontJs() ?>
	</body>
</html>
