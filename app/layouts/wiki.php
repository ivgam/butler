<!DOCTYPE html>
<html lang="en">
	<head>
		<?php Fw_Module::getModule('head'); ?>
		<style>
			#content {padding-top: 60px;}
			.com { color: #93a1a1; }
			.lit { color: #195f91; }
			.pun, .opn, .clo { color: #93a1a1; }
			.fun { color: #dc322f; }
			.str, .atv { color: #D14; }
			.kwd, .tag { color: #1e347b; }
			.typ, .var, .dec, .var { color: teal; }
			.pln { color: #48484c; }
		</style>
	</head>
	<body data-offset="50" data-target="#navbar" data-spy="scroll">
		<?php echo $html ?>
		<?php Fw_CCC::getAllFrontJs() ?>
		<?php Fw_Module::getModule('google_analytics'); ?>
	</body>
</html>
