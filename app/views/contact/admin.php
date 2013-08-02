<?php
//TODO: Contact admin (filters)
$resource = Fw_Register::getRef('current_resource');
$edit_route = Fw_Router::getUrl($resource, 'edit');
$delete_route = Fw_Router::getUrl($resource, 'delete');
$add_route = Fw_Router::getUrl($resource, 'add');
$oResult = Fw_Register::getRef('oResult');
$count = Fw_Register::getRef('count');
$oParams = Fw_Register::getRef('oParams');
$request = Fw_Filter::getArray('request');
$filters = Fw_Filter::getFilters();
?>
<h4>Admin <?php echo ucfirst($resource) ?></h4>
<form name="results" method="POST">
    <input type="submit" style="visibility: hidden;" />
    <div class="row">
        <table class="table table-hover table-condensed span12">
            <tr>
				<?php foreach ($oParams as $header => $fieldname) { ?>
					<th><?php echo $header ?></th>
				<?php } ?>		
                <th style="min-width:70px"><a class="btn btn-tiny" href="<?php echo $add_route ?>"><i class="icon icon-plus"></i>Add</a></th>
            </tr>
            <tr>
				<?php foreach ($oParams as $header => $fieldname) { ?>
					<td>
						<input type="text" 
							   name="filter_<?php echo $fieldname ?>"
							   class="input-medium"
							   value="<?php echo (isset($request['filter_' . $fieldname])) ? $request['filter_' . $fieldname] : '' ?>"/></td>
					<?php } ?>		
                <td></td>
            </tr>
			<?php foreach ($oResult as $oRow) { ?>
				<tr>
					<?php foreach ($oParams as $header => $fieldname) { ?>
						<td <?= ($fieldname == 'state_name') ? 'class="' . $oRow['class'] . '"' : '' ?>>
							<?php echo (isset($oRow[$fieldname])) ? $oRow[$fieldname] : ''; ?>
						</td>
					<?php } ?>
					<td>
						<div>
							<a href="<?php echo $edit_route . $oRow['id'] ?>" title="edit"><i class="icon-pencil"></i></a>
							<a href="<?php echo $delete_route . $oRow['id'] ?>" title="delete"><i class="icon-trash"></i></a>
						</div>
					</td>
				</tr>
			<?php } ?>
        </table>
    </div>
</form>
<?php Fw_Module::getModule('paginator', array('page' => $request['p'], 'count' => $count, 'params' => $filters)) ?>