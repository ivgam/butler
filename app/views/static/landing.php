<?php
$oModel = new City_Model();
$oCity = $oModel->getRow();
?>
<script type="text/javascript">
	$(window).load(function() {
		$('.flexslider').flexslider({
			animation: "fade",
			controlNav: false,
			directionNav: false,
			slideshowSpeed: 3000
		});
	});
</script>
<style>
	#black-bg{
		display:block;
		position:absolute;
		height:40%;
		width:100%;
		min-height:450px; 
		background-color: black;
		opacity:0.6;
		z-index:1;
		margin-top:8%;

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
<section id="home" style="background-image: url('<?= Image_Helper::getMainImage('city', $oCity['id'], 'background') ?>')">
	<div id="black-bg"></div>
	<div class="row centered">
		<h1 class="fade-it"><img alt="<?= COMPANY_NAME ?>" src="<?= IMG_URI ?>logo_home.png"></h1>
		<h2>Save Time, Experience More</h2>
		<div class="flexslider" style="margin-bottom:30px">
			<ul class="slides">
				<li><h3>Curated selection of activities</h3></li>
				<li class="flex-active-slide"><h3>Easy booking process</h3></li>
				<li><h3>Bringing you closer to your experiences</h3></li>
			</ul>
		</div>
		<form class="form-horizontal" action="<?= BASE_URI ?>customer/subscribe" method="POST" class="centered">
			<div class="control-group">
				<div class="controls" style="margin:0;padding:0; position: relative; z-index:9999">
					<input 
						type="text"
						class="input"
						name="customer_email"
						placeholder="Put your email here..."
						style="font-size:15px;line-height:15px; padding:10px 6px"
						/>
					<input 
						type="submit" 
						value="Subscribe" 
						class="btn btn-large btn-success"
						/>
				</div>
			</div>
		</form>
	</div>
</section>