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

$resource = Fw_Register::getRef('current_resource');
$task = Fw_Register::getRef('current_task');
$header_class = ($resource == 'city' && $task == 'home' && !isset($_COOKIE['landing'])) ? '' : ' navbar-fixed-top';
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
		$('#search-form').on('submit', function(event){
			event.preventDefault();
			window.location.href = '<?= BASE_URI ?>search/'+$('#search-text').val()+'/';
		});
	});
</script>
<div class="navbar-wrapper">
	<div id="navigation" class="navbar navbar-inverse bg-color black<?= $header_class ?>">
		<div class="navbar-inner">
			<div class="container">
				<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<h1 id="branding" class="pull-left">
					<a href="<?= BASE_URI ?>">
						<img alt="<?= COMPANY_NAME ?> Logo" title="<?= COMPANY_NAME ?> Logo" src="<?= IMG_URI ?>logo_header.png" style="position:relative;bottom:8px"/>
					</a>
				</h1>
				<?php Fw_Module::getModule('select-city') ?>
				<div class="pull-right">
					<a href="/blog" class="btn btn-success">Blog</a>
					<a href="/search//" class="btn"><i class="icon icon-search" style="color:black"></i></a>
				</div>
				<div id="user-actions" class="nav-collapse collapse pull-right">
					<ul class="nav">
						<li><a id="login" href="#" data-content='<?= $login_form ?>'>Sign In</a></li>
						<li><a id="register" href="#" data-content='<?= $register_form ?>'>Register</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
