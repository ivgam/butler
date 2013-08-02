<?php Fw_Module::getModule('masthead', array('active' => 'home')) ?>
<div class="jumbotron">
	<h1>Do it simple!</h1>
	<p class="lead">
		Create fast and strong PHP webapps is simple, because we can use
		advanced technologies and a lot of design patterns. The wheel has been
		invented. Why do you think in reinvent it again?
	</p>
	<a class="btn btn-large btn-inverse" href="https://github.com/ivgam">Get started today</a>
</div>
<hr>
<div class="row-fluid">
	<div class="span4">
		<h2>MVC</h2>
		<p>
			All the MVC's haven't the same implementation. For this, we use 
			a very common implementation, that uses a Dispatcher and a Router 
			to ensure that all the request pass, firstly, for the index file. 
			This allows you to securize more quickly and efficiently, 
			your app.
		</p>
		<p><a class="btn" href="<?= BASE_URI ?>static/wiki#mvc">View details &raquo;</a></p>
	</div>
	<div class="span4">
		<h2>Admin Panel</h2>
		<p>
			Sometimes, when you create an APP, you know perfectly what are
			the different views that you offer to the user but...what are
			the different views that you use? Butler, offers a CRUD
			environment that allows to manage a high percentage of the
			possible apps that you need to do.
		</p>
		<p><a class="btn" href="<?= BASE_URI ?>static/wiki">View details &raquo;</a></p>
	</div>
	<div class="span4">
		<h2>Bootstrap</h2>
		<p>
			Responsive, viewport, mobile, HTML5, CSS3, design...Wait a
			moment! What do you say? Don't worry, we use Bootstrap a great
			CSS Framework that reduces the design time. This site is designed
			with a default template of Bootstrap, feels good, no?
		</p>
		<p><a class="btn" href="<?= BASE_URI ?>static/wiki">View details &raquo;</a></p>
	</div>
</div>