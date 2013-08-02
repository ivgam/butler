<?php
$resource = Fw_Register::getRef('current_resource');
$set_route = Fw_Router::getUrl($resource, 'set');
$oResult = Fw_Register::getRef('oResult');
$aLanding = Fw_Register::getRef('aLanding');
$oParams = Fw_Register::getRef('oParams');
$sExtraForm = Fw_Register::getRef('sExtraForm');
?>
<h4 style="margin-bottom:25px">
	<?php echo ($oResult['id']) ? _('Edit') : _('Create') ?> <?php echo ucfirst($resource) ?> 
	<a href="#" class="btn pull-right"><i class="icon-signal"></i> Statistics</a>
</h4>
<form action="<?php echo $set_route ?>" 
	  method="post" 
	  class="form-horizontal" 
	  enctype="multipart/form-data"
	  >	  
	<input type="hidden" name="id" value="<?php echo $oResult['id'] ?>"/>
	<?php echo Fw_View::displayEditInputs($oResult, $oParams); ?>
	<?php
	if (!empty($sExtraForm)) {
		Fw_Module::getModule('admin/' . $sExtraForm);
	}
	?>
	<div class="pull-right">
		<input type="reset" value="Reset" class="btn"/>
		<input type="submit" value="Submit" class="btn"/>
		<a href="<?php echo Fw_Router::getUrl($resource, 'admin'); ?>" class="btn"/><?= _('Return'); ?> </a>
	</div>
</form>
<div class="row" style="margin-top:80px">
	<div class="span6">
		<h4>Landings</h4>
	</div>
	<div class="pull-right">
		<?php Fw_Module::getModule('admin/landing/add-landing', array('id_campaign'=>$oResult['id']))?>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('a.landing-switch').on('click', function(event){
			event.preventDefault();
			$(this).parent('form').submit();
		});
	});
</script>
<ul class="unstyled" id="landings-assoc">
	<?php foreach($aLanding as $oLanding){?>
	<li>
		<div class="well">
			<div class="row">
				<div class="span6">
					<ul class="unstyled inline">
						<li><strong>ID:</strong> <?= $oLanding['id']?></li>
						<li><strong>Name:</strong> <?= $oLanding['name']?></li>
						<li><strong>Link:</strong> <?= BASE_URL.'/subscriptions/'.urlencode($oResult['name']).'/'.urlencode($oLanding['name'])?></li>
					</ul>
				</div>
				<div class="pull-right">
					<a href="#" class="btn"><i class="icon-signal"></i> Statistics</a>					
					<a href="<?= BASE_URI ?>landing/edit/<?=$oLanding['id']?>" class="btn"><i class="icon-pencil"></i> Edit</a>					
					<a href="<?= BASE_URI.'subscriptions/'.urlencode($oResult['name']).'/'.urlencode($oLanding['name'])?>" class="btn"><i class="icon-eye-open"></i> Preview</a>					
				</div>
			</div>
			<div class="row" style="margin-top:10px">
				<div class="span4">
					<img class="img-polaroid" src="<?= $oLanding['bg_image']?>"/>
				</div>
				<div class="span4">
					<span><strong>Rolling Phrases:</strong></span>
					<ul style="margin-bottom:10px">
						<li><i><?= $oLanding['phrase_1']?></i></li>
						<li><i><?= $oLanding['phrase_2']?></i></li>
						<li><i><?= $oLanding['phrase_3']?></i></li>
					</ul>
					<span><strong>Preview of the form</strong></span>
					<div class="control-group">
						<div class="controls">
							<input 
								type="text" 
								class="input" 
								name="customer_email" 
								placeholder="<?= $oLanding['placeholder']?>" 
								style="margin-top:10px;width:150px"
								/>
							<input type="submit" value="<?= $oLanding['button_text']?>" class="btn tiny btn-<?= $oLanding['button_type']?>">
						</div>
					</div>
				</div>
				<div class="span3">
					<?php Fw_Module::getModule('admin/landing/history', array('id_campaign'=>$oResult['id'],'id_landing'=>$oLanding['id']));?>
				</div>
			</div>
		</div>
	</li>
	<?php } ?>
</ul>
