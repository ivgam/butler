<div class="masthead">
    <h3 class="muted"><?= _('Butler: The PHP Framework for fast developing'); ?></h3>
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container">
                <ul class="nav">
                    <li <?= ($params['active'] == 'home')?'class="active"':''?>><a href="<?= BASE_URI ?>"><?= _('Home'); ?></a></li>
                    <li <?= ($params['active'] == 'wiki')?'class="active"':''?>><a href="<?= BASE_URI ?>static/wiki"><?= _('Wiki'); ?></a></li>
                    <li <?= ($params['active'] == 'examples')?'class="active"':''?>><a href="<?= BASE_URI ?>static/examples"><?= _('Examples'); ?></a></li>
                    <li <?= ($params['active'] == 'about')?'class="active"':''?>><a href="<?= BASE_URI ?>static/about"><?= _('About'); ?></a></li>
                    <li <?= ($params['active'] == 'admin')?'class="active"':''?>><a href="<?= BASE_URI ?>admin"><?= _('Admin Panel'); ?></a></li>
                </ul>
            </div>
        </div>
    </div>
	<?php
	$templates = array(
		'login_form' => 'login_form',
		'register_form' => 'register_form'
	);
	?>
</div>