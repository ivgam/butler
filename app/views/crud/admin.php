<?php
$resource = Fw_Register::getRef('current_resource');
$edit_route = Fw_Router::getUrl($resource, 'edit');
$delete_route = Fw_Router::getUrl($resource, 'delete');
$oResult = Fw_Register::getRef('oResult');
$count = Fw_Register::getRef('count');
$oParams = Fw_Register::getRef('oParams');
$request = Fw_Filter::getArray('request');
$filters = Fw_Filter::getFilters();
?>
<!--
<h4>Admin <?php echo ucfirst($resource)?></h4>
<br/>
-->
<form name="results" method="POST">
<input type="submit" style="visibility: hidden;" />
<div class="row">
	<table class="eleven columns centered">
		<tr>
			<?php foreach ($oParams as $header => $fieldname) { ?>
				<th><?php echo $header ?></th>
			<?php } ?>		
			<th></th>
		</tr>
		<tr>
			<?php foreach ($oParams as $header => $fieldname) { ?>
			<td><input type="text" name="filter_<?php echo $fieldname?>"
								 value="<?php echo (isset($request['filter_'.$fieldname]))?$request['filter_'.$fieldname]:''?>"/></td>
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
</form>
<?php Fw_Module::getModule('paginator', array('page' => $request['p'], 'count'=>$count, 'params'=>$filters)) ?>