<?php
//TODO: contact edit
$resource = Fw_Register::getRef('current_resource');
$set_route = Fw_Router::getUrl($resource, 'set');
$reply_route = Fw_Router::getUrl($resource, 'reply');
$oResult = Fw_Register::getRef('oResult');
$aReplies = Fw_Register::getRef('aReplies');
$oParams = Fw_Register::getRef('oParams');
$sExtraForm = Fw_Register::getRef('sExtraForm');
?>
<h4><?php echo ($oResult['id']) ? _('Edit') : _('Create') ?> <?php echo ucfirst($resource) ?></h4>
<form action="<?php echo $set_route ?>" 
	  method="post" 
	  class="form-horizontal"
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
<br/><br/>
<h4>Replies</h4>
<div class="accordion" id="replies">
	<?php
	if (!empty($aReplies)) {
		foreach ($aReplies as $k => $reply) {
			?>
			<div class="accordion-group">
				<div class="accordion-heading">
					<a class="accordion-toggle" data-toggle="collapse" data-parent="#replies" href="#collapse<?= $k+1 ?>">
						Reply #<?= $k+1 ?>, sended at: <?= $reply['ts_creation']?>
					</a>
				</div>
				<div id="collapse<?=$k+1?>" class="accordion-body collapse">
					<div class="accordion-inner">
						<?= $reply['reply_text'] ?>
					</div>
				</div>
			</div>
		<?php }
	} else {?>
	<h4><small>There are no replies for this message</small></h4>
	<?php }?>
</div>
<h4>Reply to the user</h4>
<form action="<?= $reply_route ?>"
	  method="post"
	  class="form"
	  >
	<input type="hidden" name="id" value="<?php echo $oResult['id'] ?>"/>
	<div class="control-group">
		<div class="controls">
			<textarea 
				name="reply_text" 
				placeholder="Type here your reply..."
				class="input-block-level wysihtml"
				rows="8"
			></textarea>
		</div>
	</div>
	<input type="submit" class="btn btn-medium pull-right" value="Send"/>
</form>
<br/><br/>