<?php
$oLanding = Fw_Register::getRef('oLanding');
?>
<style>
	/* COMMONS */
	section#content {
		min-height: 600px;
		padding-top:100px;
	}

	@media (max-width: 980px) {
		section#content {padding-top:10px;}
	}
	
	/* HOME */
	html, body{
		margin:0px auto;
		height: 100%;
		background-color:#FFF;
	}
	#home {
		margin: 0 auto;
		width:100%;
		height:100%;
		color:#FFF;
		background: no-repeat center center fixed; 
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		background-attachment : fixed;  /* FIXED FOR IE */
	}
	#home h1 {
		position:relative;
		margin:10% auto 0px auto;
		z-index: 999;
	}
	.centered {
		text-align: center;
	}

	@media (max-width: 1200px) { 
		#home h1{margin: 10% auto 0px auto;}
	}
	@media (max-width: 767px) { 
		#home h1{margin: 10% auto 0px auto;}
	}
	@media (max-width: 480px) { 
		#home h1{margin: 5% auto 0px auto;}
	}

	@media (max-width: 320px){
		#home h1{margin: 10% auto 0px auto;}
	}

	#black-bg{
		display:block;
		position:absolute;
		height:40%;
		width:100%;
		min-height:450px; 
		background-color: black;
		opacity:0.6;
		z-index:1;
		margin-top:11%;

	}
	#home ul.slides li{
		width: 100%;
		float: left; 
		margin-right: -100%; 
		position: relative; 
		display: none;
		text-shadow: rgba(0, 0, 0, 0.8) 2px 1px 1px;
	}
	ul.slides li h3{
		position:relative;
		z-index:9999;
		color:#efefef;
	}
	#home div.row.centered{}
	#home h2{
		font-family: 'Oxygen', Helvetica, sans-serif;
		color: #efefef;
		text-shadow: rgba(0, 0, 0, 0.8) 2px 1px 1px;
		text-rendering: optimizelegibility;
		position:relative;
		z-index: 9999;
	}
</style>
<section id="home" style="padding:0;background-color:#000;<?=(!empty($oLanding['bg_image'])?"background-image: url('{$oLanding['bg_image']}":'')?>')">
	<div id="black-bg"></div>
	<div class="row centered" style="position:relative;top:50px; display:block; overflow:hidden">
		<h1 class="fade-it"><img alt="<?= COMPANY_NAME ?>" src="<?= PUBLIC_URI ?>logo_white.png"></h1>
		<h2><?= SLOGAN ?></h2>
		<div class="flexslider" style="margin-bottom:30px">
			<ul class="slides">
				<li class="flex-active-slide"><h3><?= $oLanding['phrase_1'] ?></h3></li>
				<li><h3><?= $oLanding['phrase_2'] ?></h3></li>
				<li><h3><?= $oLanding['phrase_3'] ?></h3></li>
			</ul>
		</div>
		<form class="form-horizontal" action="<?= BASE_URI ?>customer/subscribe" method="POST" class="centered">
			<div class="control-group">
				<div class="controls" style="margin:0;padding:0; position: relative; z-index:9999">
					<input 
						type="text"
						class="input"
						name="customer_email"
						placeholder="<?= $oLanding['placeholder'] ?>"
						style="font-size:15px;line-height:15px; padding:10px 6px"
						/>
					<input 
						type="hidden" 
						name="landing_visit"
						value="<?= Landing_Helper::registerVisit($oLanding['id_landing_campaign']) ?>"
						/>
					<input 
						type="submit" 
						value="<?= $oLanding['button_text'] ?>" 
						class="btn btn-large btn-<?= $oLanding['button_type'] ?>"
						/>
				</div>
			</div>
		</form>
	</div>
</section>