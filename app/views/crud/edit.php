<?php
$resource = Fw_Register::getRef('current_resource');
$set_route = Fw_Router::getUrl($resource, 'set');
$oResult = Fw_Register::getRef('oResult');
$oParams = Fw_Register::getRef('oParams');
$sExtraForm = Fw_Register::getRef('sExtraForm');
?>
<h4><?php echo ($oResult['id'])?_('Edit'):_('Create')?> <?php echo ucfirst($resource)?></h4>
<form action="<?php echo $set_route ?>" 
	  method="post" 
	  class="form-horizontal" 
	  enctype="multipart/form-data"
>	  
	<input type="hidden" name="id" value="<?php echo $oResult['id'] ?>"/>
	<?php echo Fw_View::displayEditInputs($oResult, $oParams); ?>
	<?php if (!empty($sExtraForm)) {
		Fw_Module::getModule('admin/' . $sExtraForm);
	} ?>
	<div class="pull-right">
		<input type="reset" value="Reset" class="btn"/>
		<input type="submit" value="Submit" class="btn"/>
		<a href="<?php echo Fw_Router::getUrl($resource, 'admin'); ?>" class="btn"/><?= _('Return');?> </a>
	</div>
</form>
