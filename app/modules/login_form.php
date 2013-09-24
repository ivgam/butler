<form id="login-form" method="POST" action="<?= BASE_URI ?>customer/login">
	<div class="control-group">
		<div class="control-label">
			<label for="customer_email">Email</label>
		</div>
		<div class="controls">
			<input type="text" name="customer_email"/>
		</div>
	</div>
	<div class="control-group">
		<div class="control-label">
			<label for="customer_password">Password</label>
		</div>
		<div class="controls">
			<input type="password" name="customer_password"/>
		</div>
	</div>
	<a href="#recovery-modal" data-toggle="modal" id="recovery">Recovery my password</a>
	<input type="submit" class="btn btn-inverse pull-right" value="Submit">
</form>