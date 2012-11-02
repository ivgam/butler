<?php
switch ($params['style']) {
	case 'panel':
		?>
		<div class="panel">
			<a href="#"><img src="http://placehold.it/500x240&text=[img]" /></a>
			<h5><a href="#">Your Name</a></h5>
			<dl class="vertical tabs">
				<dd><a href="#">Section 1</a></dd>
				<dd><a href="#">Section 2</a></dd>
				<dd><a href="#">Section 3</a></dd>
				<dd><a href="#">Section 4</a></dd>
				<dd><a href="#">Section 5</a></dd>
				<dd><a href="#">Section 6</a></dd>
			</dl>
		</div>
		<?php
		break;
	default:
		?>
		<h5>Categories</h5>
		<ul class="side-nav">
			<li><a href="#">News</a></li>
			<li><a href="#">Code</a></li>
			<li><a href="#">Design</a></li>
			<li><a href="#">Fun</a></li>
			<li><a href="#">Weasels</a></li>
		</ul>
		<?php
		break;
}
?>

