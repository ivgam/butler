<?php 
	$oModel = new Landing_Model();
	$aLanding = $oModel->getAll();
?>
<form method="post" action="<?= Fw_Router::getUrl('campaign', 'addLanding');?>">
	<select name="id_landing" style="margin-top:10px">
		<option value="0">Select a Landing Page</option>
		<?php foreach($aLanding as $oLanding){?>
		<option value="<?= $oLanding['id']?>"><?= $oLanding['id'].': '.$oLanding['name']?></option>
		<?php }?>
	</select>
	<input type="submit" class="btn" value="Add"/>
	<input type="hidden" name="id_campaign" value="<?= $params['id_campaign']?>"/>
</form>