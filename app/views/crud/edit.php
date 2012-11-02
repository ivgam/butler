<?php
$resource = Fw_Register::getRef('current_resource');
$set_route = Fw_Router::getUrl($resource, 'set');
$oResult = Fw_Register::getRef('oResult');
$oParams = Fw_Register::getRef('oParams');
$sExtraForm = Fw_Register::getRef('sExtraForm');
?>
<h4><?php echo ($oResult['id'])?'Edit':'Create' ?> <?php echo ucfirst($resource)?></h4>
<form action="<?php echo $set_route ?>" method="post">				
	<input type="hidden" name="id" value="<?php echo $oResult['id'] ?>"/>
	<?php echo Fw_View::displayEditInputs($oResult, $oParams); ?>
	<?php if (!empty($sExtraForm)) {
		Fw_Module::getModule('admin/' . $sExtraForm);
	} ?>
	<div style="float:right">
		<input type="reset" value="Reset" class="tiny button"/>
		<input type="submit" value="Submit" class="tiny button"/>
		<a href="<?php echo Fw_Router::getUrl($resource, 'admin'); ?>" class="tiny button"/>Volver</a>
	</div>
</form>
