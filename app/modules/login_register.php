<?php
$templates = array(
	'login_form' => 'login_form',
	'register_form' => 'register_form'
);

foreach ($templates as $var => $path) {
	ob_start();
	Fw_Module::getModule($path);
	$$var = ob_get_contents();
	$$var = str_replace("\n", "", $$var);
	$$var = str_replace("\r", "", $$var);
	$$var = str_replace("\t", "", $$var);
	ob_end_clean();
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		var customer = $.cookie('customer');
		if(typeof(customer) != 'undefined'){
			$.ajax({
				url:'<?= BASE_URI ?>ajax/login',
				dataType:'html',
				success: function(data){
					$('#user-actions').html(data);
				}
			});
		}
		$('#login').on('click',function(event){
			event.preventDefault();
			$('#register').popover('hide');
		});
		$('#register').on('click',function(event){
			event.preventDefault();
			$('#login').popover('hide');
		});
		
		$('#login').popover(
		{
			animation: true,
			html: true,
			placement: 'bottom',
			title: 'Sign In'
		});
		$('#register').popover(
		{
			animation: true,
			html: true,
			placement: 'bottom',
			title: 'Register'
		});
	});
</script>
<div id="user-actions">
	<ul class="unstyled inline">
		<li><a class="btn btn-success" id="login" href="#" data-content='<?= $login_form ?>'>Login</a></li>
		<li><a class="btn btn-info" id="register" href="#" data-content='<?= $register_form ?>'>Register</a></li>
	</ul>
</div>