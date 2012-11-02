<?php
$resource = Fw_Register::getRef('current_resource');
$edit_route = Fw_Router::getUrl($resource, 'edit');
$delete_route = Fw_Router::getUrl($resource, 'delete');
$oResult = Fw_Register::getRef('oResult');
$oParams = Fw_Register::getRef('oParams');
?>
<h4>Admin <?php echo ucfirst($resource)?></h4>
<div class="row">
	<table class="eleven columns centered">
		<tr>
			<?php foreach ($oParams as $header => $fieldname) { ?>
				<th><?php echo $header ?></th>
			<?php } ?>		
			<th></th>
		</tr>
		<?php foreach ($oResult as $oRow) { ?>
			<tr>
				<?php foreach ($oParams as $header => $fieldname) { ?>
					<td><?php echo (isset($oRow[$fieldname])) ? $oRow[$fieldname] : ''; ?></td>
				<?php } ?>
				<td class="one">
					<a href="<?php echo $edit_route . $oRow['id'] ?>" title="edit"><span class="general foundicon-edit"></span></a>
					<a href="<?php echo $delete_route . $oRow['id'] ?>" title="delete"><span class="general foundicon-remove"></span></a>
				</td>
			</tr>
		<?php } ?>
	</table>
</div>
<div class="row">
	<div class="four columns centered" style="margin-top:25px">
		<ul class="pagination">
			<li class="arrow unavailable"><a href="">&laquo;</a></li>
			<li class="current"><a href="">1</a></li>
			<li><a href="">2</a></li>
			<li><a href="">3</a></li>
			<li><a href="">4</a></li>
			<li class="unavailable"><a href="">&hellip;</a></li>
			<li><a href="">12</a></li>
			<li><a href="">13</a></li>
			<li class="arrow"><a href="">&raquo;</a></li>
		</ul>
	</div>
</div>