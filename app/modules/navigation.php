<?php
switch ($params['style']) {
	case 'fulltop':
		?>
		<ul class="nav-bar">
			<li><a href="#">Link 1</a></li>
			<li><a href="#">Link 2</a></li>
			<li><a href="#">Link 3</a></li>
			<li><a href="#">Link 4</a></li>
		</ul>
		<?php
		break;
	case 'topbar':
		?>
		<nav class="top-bar">
			<ul>
				<!-- Title Area -->
				<li class="name">
					<h1>
						<a href="#">
							Top Bar Title
						</a>
					</h1>
				</li>
				<li class="toggle-topbar"><a href="#"></a></li>
			</ul>
			<section>
				<!-- Right Nav Section -->
				<ul class="right">
					<li class="divider"></li>
					<li class="has-dropdown">
						<a href="#">Main Item 1</a>
						<ul class="dropdown">
							<li><label>Section Name</label></li>
							<li class="has-dropdown">
								<a href="#" class="">Has Dropdown, Level 1</a>
								<ul class="dropdown">
									<li><a href="#">Dropdown Options</a></li>
									<li><a href="#">Dropdown Options</a></li>
									<li><a href="#">Level 2</a></li>
									<li><a href="#">Subdropdown Option</a></li>
									<li><a href="#">Subdropdown Option</a></li>
									<li><a href="#">Subdropdown Option</a></li>
								</ul>
							</li>
							<li><a href="#">Dropdown Option</a></li>
							<li><a href="#">Dropdown Option</a></li>
							<li class="divider"></li>
							<li><label>Section Name</label></li>
							<li><a href="#">Dropdown Option</a></li>
							<li><a href="#">Dropdown Option</a></li>
							<li><a href="#">Dropdown Option</a></li>
							<li class="divider"></li>
							<li><a href="#">See all &rarr;</a></li>
						</ul>
					</li>
					<li class="divider"></li>
					<li><a href="#">Main Item 2</a></li>
					<li class="divider"></li>
					<li class="has-dropdown">
						<a href="#">Main Item 3</a>
						<ul class="dropdown">
							<li><a href="#">Dropdown Option</a></li>
							<li><a href="#">Dropdown Option</a></li>
							<li><a href="#">Dropdown Option</a></li>
							<li class="divider"></li>
							<li><a href="#">See all &rarr;</a></li>
						</ul>
					</li>
				</ul>
			</section>
		</nav>

		<?php
		break;
	case 'topright':
	default:
		?>
		<ul class="nav-bar right">
			<li><a href="#">Link 1</a></li>
			<li><a href="#">Link 2</a></li>
			<li><a href="#">Link 3</a></li>
			<li><a href="#">Link 4</a></li>
		</ul>
		<?php
		break;
}
?>