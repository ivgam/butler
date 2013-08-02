<h2>Image Attribution</h2>
<div class="row">
	<?php
	$aAttribution = Fw_Register::getRef('aAttribution');
	foreach ($aAttribution as $used_for => $gAttribution) {
		?>
		<div class="span6">
			<h4><?= ucwords($used_for) ?></h4>
			<?php
			if (!empty($gAttribution)) {
				echo '<ul>';
				$author = $gAttribution[0]['author'];
				echo '<li>' . ucwords($author);
				echo '<ul>';
				foreach ($gAttribution as $oAttribution) {
					if ($author != $oAttribution['author']) {
						echo '</ul>';
						$author = $oAttribution['author'];
						echo '<li>' . ucwords($author) . '</li>';
						echo '<ul>';
					}
					echo '<li><a href="' . $oAttribution['url'] . '">' . $oAttribution['url'] . '</a></li>';
				}
				echo '</ul>';
				echo '</li>';
			}
			?>
		</div>
<?php } ?>
</div>