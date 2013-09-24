<?php
$oModel = new Campaign_Model();
$aHistory = $oModel->getLandingHistory($params['id_campaign'], $params['id_landing']);
?>
<span><strong>History</strong></span>
<table class="table table-condensed">
	<thead>
		<tr>
			<th>Time</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($aHistory as $row) { ?>
			<tr class="<?= $row['color_class'] ?>">
				<td><?= $row['ts_creation'] ?></td>
				<td><?= $row['name'] ?></td>
			</tr>
		<?php } ?>
		<tr class="<?= (($row['color_class'] == 'error') ? 'success' : 'error') ?>">
			<td></td>
			<?php if ($row['color_class'] == 'error') { ?>
				<td>
					<form action="<?= Fw_Router::getUrl('campaign', 'enableLanding') ?>" method="post">
						<a href="#" class="btn landing-switch" title="Enable">
							<i class="icon-off"></i>
						</a>
						<input type="hidden" name="id_landing_campaign" value="<?= $row['id_landing_campaign'] ?>"/>
						<input type="hidden" name="id_campaign" value="<?= $params['id_campaign'] ?>"/>
					</form>
				</td>
			<?php } else { ?>
				<td>
					<form action="<?= Fw_Router::getUrl('campaign', 'disableLanding') ?>" method="post">
						<a href="#" class="btn landing-switch" title="Disable">
							<i class="icon-off"></i>
						</a>
						<input type="hidden" name="id_landing_campaign" value="<?= $row['id_landing_campaign'] ?>"/>
						<input type="hidden" name="id_campaign" value="<?= $params['id_campaign'] ?>"/>
					</form>
				</td>
			<?php } ?>
		</tr>
	</tbody>
</table>