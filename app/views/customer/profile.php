<?php
$form_errors = Fw_Register::getRef('form_errors');
$oCustomer = Fw_Register::getRef('oCustomer');
?>
<h3>My Profile</h3>
<form action="<?= BASE_URI ?>customer/save_profile" method="post" id="contact-form">
	<input type="hidden" name="customer_id" value="<?= $oCustomer['id']?>"/>
	<div class="control-group">
		<label class="control-label">Name</label>
		<div class="controls">
			<input 
				name="customer_name" 
				type="text" 
				class="input-block-level" 
				value="<?= !empty($form_errors) ? Fw_Filter::getVar('customer_name', 'default', 'post') : $oCustomer['name'] ?>"
				/>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Surname</label>
		<div class="controls">
			<input 
				name="customer_surname" 
				type="text" 
				class="input-block-level" 
				value="<?= !empty($form_errors) ? Fw_Filter::getVar('customer_surname', 'default', 'post') : $oCustomer['surname'] ?>"
				/>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Email</label>
		<div class="controls">
			<input 
				name="customer_email" 
				type="text" 
				class="input-block-level" 
				autocomplete="false"
				value="<?= !empty($form_errors) ? Fw_Filter::getVar('customer_email', 'default', 'post') : $oCustomer['email'] ?>"
				/>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label">Password</label>
		<div class="controls">
			<input 
				name="customer_password" 
				type="password" 
				class="input-block-level" 
				autocomplete="false"
				value=""
				/>
		</div>
	</div>
	<input type="submit" name="form_submision" class="btn btn-large btn-primary pull-right" value="Save"/>
</form>