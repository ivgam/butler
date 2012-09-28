<?php
$resource	= Fw_Register::getRef('current_resource');
$set_route	= Fw_Router::getUrl($resource, 'set');
$oResult	= Fw_Register::getRef('oResult');
$oParams	= Fw_Register::getRef('oParams');
$sExtraForm = Fw_Register::getRef('sExtraForm');
?>
<div id="stylized-form">
	<form action="<?php echo $set_route?>" method="post">				
		<input type="hidden" name="id" value="<?php echo $oResult['id'] ?>"/>
		<?php echo Fw_View::displayEditInputs($oResult, $oParams);?>
		<?php if (!empty($sExtraForm)){Fw_Module::getModule('admin/'.$sExtraForm);}?>											
		<input type="reset" value="Reset" class="submit btn-form"  />						
		<input type="submit" value="Submit" class="submit btn-form" />
		<a href="<?php echo Fw_Router::getUrl($resource, 'admin');?>" class="submit btn-form" />Volver</a>
	</form>
</div>
