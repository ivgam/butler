<?php 
	$form_errors = Fw_Register::getRef('form_errors');
?>
<div class="row" id="static">
	<div class="span10 offset1">
		<div class="row">
			<div class="span3">
				<h4><?= COMPANY_NAME ?></h4>
				<div>
					<i>Email:</i><br/>
					<a href="mailto:<?= Fw_Register::getConfig('fw_email'); ?>">
						<?= Fw_Register::getConfig('fw_email'); ?>
					</a>
				</div>
			</div>
			<div class="span7">
				<h4>Write us a message</h4>
				<div class="well" style="padding-bottom: 35px;">
					<form action="<?= BASE_URI ?>contact/send" method="post" id="contact-form">
						<div class="control-group">
							<label class="control-label">Name</label>
							<div class="controls">
								<input 
									name="contact_name" 
									type="text" 
									class="input-xlarge" 
									value="<?= !empty($form_errors)?Fw_Filter::getVar('contact_name', 'default', 'post'):''?>"
								/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Email (never published)</label>
							<div class="controls">
								<input 
									name="contact_email" 
									type="text" 
									class="input-xlarge" 
									value="<?= !empty($form_errors)?Fw_Filter::getVar('contact_email', 'default', 'post'):''?>"
								/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Subject</label>
							<div class="controls">
								<input 
									name="contact_subject" 
									type="text" 
									class="input-block-level" 
									value="<?= !empty($form_errors)?Fw_Filter::getVar('contact_subject', 'default', 'post'):''?>"
								/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Comment</label>
							<div class="controls">
								<textarea 
									name="contact_comment" 
									class="input-block-level" 
									rows="10"><?= !empty($form_errors)?Fw_Filter::getVar('contact_comment', 'default', 'post'):''?>
								</textarea>
							</div>
						</div>
						<input type="submit" name="form_submision" class="btn btn-inverse pull-right" value="Send Message"/>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
