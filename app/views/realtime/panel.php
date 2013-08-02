<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.6/angular.min.js"></script>
<script src="<?php echo JS_URI ?>/underscore-min.js"></script>
<script type="text/javascript" src="<?php echo JS_URI ?>/modules/realtime.module.js"></script>
<script type="text/javascript" src="<?php echo JS_URI ?>/controllers/realtime.controller.js"></script>

<h2>Real-Time Status</h2>
<div ng-controller="RealTimeCtrl"  ng-app="realTimeModule">
	<div class="row">
		<?php Fw_Module::getModule('realtime/load_avg') ?>
		<?php Fw_Module::getModule('realtime/ram_used') ?>
		<?php Fw_Module::getModule('realtime/disc_space') ?>
		<?php Fw_Module::getModule('realtime/database_resume') ?>
	</div>
	<div class="row">
		<?php Fw_Module::getModule('realtime/browser_resume') ?>
		<?php Fw_Module::getModule('realtime/os_resume') ?>
		<?php Fw_Module::getModule('realtime/visits') ?>
	</div>
	<div class="row">
		<div class="span5 well">
			<div class="row">
				<img class="span1" src="/logo.png">
				<blockquote class="span3" style="text-align: justify">
					<p>
						Butler was born to do things for you. If you need something,
						please, contact with us via e-mail or via GitHub. Thanks for
						this opportunity.					
					</p>
					<small>Butler development team</small>
				</blockquote>
			</div>
		</div>
		<?php Fw_Module::getModule('realtime/requested_pages') ?>
	</div>
</div>