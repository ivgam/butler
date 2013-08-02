<style type="text/css">
    body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
    }

    .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
        -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
        box-shadow: 0 1px 2px rgba(0,0,0,.05);
    }
    .form-signin .form-signin-heading,
    .form-signin .checkbox {
        margin-bottom: 10px;
    }
    .form-signin input[type="text"],
    .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
    }

</style>
<form class="form-signin" method="post">
    <h2 class="form-signin-heading"><?= _('Please sign in'); ?></h2>
    <input type="text" class="input-block-level" placeholder="Username" name="username"/>
    <input type="password" class="input-block-level" placeholder="Password" name="pwd"/>    
    <button class="btn btn-large btn-primary" type="submit"><?= _('Sign in'); ?></button>
	<a class="pull-right" style="margin-top:15px" href="#recoveryPasswordModal" data-toggle="modal">Recover password</a>
	<p style="margin-top:30px"><i>By default...the username & password are:</i></p>
	<p><strong>Username:</strong> admin</p>
	<p><strong>Password:</strong> admin</p>
	<p><i>And...Please...remove this ( I'm in the file <strong>login.php</strong> in the path <strong>/app/views/auth</strong> )</i></p>
</form>

<!-- Modal -->
<div id="recoveryPasswordModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Recover your password</h3>
	</div>
	<div class="modal-body">
		<form class="form-horizontal" method="post" action="<?= Fw_Router::getUrl('auth', 'recovery')?>">
			<div class="control-group">
				<label class="control-label" for="username">Username</label>
				<div class="controls">
					<input type="text" class="input" name="recovery_username" placeholder="Type your username here..."/>
					<input type="submit" class="btn btn-primary" value="Submit"/>
				</div>
			</div>
		</form>
	</div>
</div>