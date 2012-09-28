<?php
$resource = Fw_Register::getRef('current_resource');
$edit_route = Fw_Router::getUrl($resource, 'edit');
$delete_route = Fw_Router::getUrl($resource, 'delete');
$oResult = Fw_Register::getRef('oResult');
$oParams = Fw_Register::getRef('oParams');
?>
<form id="mainform" action="">
	<table>
		<tr>
			<?php foreach ($oParams as $header => $fieldname) { ?>
				<th class="highlight"><?php echo $header ?></th>
			<?php } ?>		
				<th class="highlight"></th>
		</tr>
		<?php foreach ($oResult as $oRow) {	?>
			<tr>
				<?php							
					foreach ($oParams as $header => $fieldname) { ?>
						<td><?php echo (isset($oRow[$fieldname]))?$oRow[$fieldname]:''; ?></td>
					<?php } ?>
					<td>
						<a href="<?php echo $edit_route . $oRow['id'] ?>" 	title="edit"><span class="edit"/></a>
						<a href="<?php echo $delete_route . $oRow['id'] ?>" title="delete"><span class="delete"/></a>
					</td>
			</tr>
		<?php } ?>
	</table>
	<div class="clear"></div>
	<table border="0" cellpadding="0" cellspacing="0" id="paging-table">
		<tr>
			<td>
				<a href="" class="page-far-left"></a>
				<a href="" class="page-left"></a>
				<div id="page-info">Page <strong>1</strong> / 15</div>
				<a href="" class="page-right"></a>
				<a href="" class="page-far-right"></a>
			</td>
		</tr>
	</table>
	<div class="clear"></div>
</form>