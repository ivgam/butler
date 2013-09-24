<form id="register-form" method="POST" action="<?= BASE_URI ?>customer/register">
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
	<input type="submit" class="btn btn-inverse pull-right" value="Submit" style="margin-bottom: 10px;">
</form>