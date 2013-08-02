<h2>Sitemap</h2>
<div class="row">
	<div class="span3">
		<h3>Pages</h3>
		<ul>
			<li><a href="<?= BASE_URI ?>">Home Page</a></li>
			<li><a href="<?= BASE_URI ?>about">About</a></li>
			<li><a href="<?= BASE_URI ?>contact">Contact</a></li>
			<li><a href="<?= BASE_URI ?>attribution">Image Attribution</a></li>
			<li><a href="<?= BASE_URI ?>partner">Partner with Us</a></li>
			<li><a href="<?= BASE_URI ?>privacy">Privacy Policy</a></li>
			<li><a href="<?= BASE_URI ?>business">Our Partners</a></li>
		</ul>
	</div>
</div>
<div class="row">
	<div class="span3">
		<h3>Landings</h3>
		<ul>
			<?php
			$oResult = Landing_Helper::getActiveLandings();
			foreach ($oResult as $row) {
				?>
				<li><a href="<?= BASE_URI . 'subscriptions/' . urlencode($row['campaign_name']) . '/' . urlencode($row['landing_name']) ?>"><?= $row['campaign_name'] . ' ' . $row['landing_name'] ?></a></li>
			<?php } ?>
		</ul>
	</div>
</div>

