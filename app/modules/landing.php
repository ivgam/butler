<?php
$resource = Fw_Register::getRef('current_resource');
$task = Fw_Register::getRef('current_task');
if (($resource == 'city' && $task == 'home') && !isset($_COOKIE['landing'])) {
	$oCity = Fw_Register::getRef('oCity');
	$lifetime = time() + 3 * 24 * 60 * 60;
	setcookie('landing', true, $lifetime, '/');
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
		$(document).ready(function(){
			$('#down_button a').click(function(e) {
				$('html,body').scrollTo(this.hash, this.hash);
				e.preventDefault();
			});
		});
		$(function() {
			// Do our DOM lookups beforehand
			var nav_container = $(".navbar-wrapper");
			var nav = $(".navbar");
			var top_spacing = 0;
			var waypoint_offset = -60;
			nav_container.waypoint({
				handler: function(event, direction) {
					if (direction == 'down') {
						nav_container.css({'height': nav.outerHeight()});
						nav.stop().addClass("navbar-fixed-top").css("top", -nav.outerHeight()).animate({"top": top_spacing});
					} else {
						nav_container.css({'height': 'auto'});
						nav.stop().removeClass("navbar-fixed-top").css("top", nav.outerHeight() + waypoint_offset).animate({"top": ""});
					}
				},
				offset: function() {
					return -nav.outerHeight() - waypoint_offset;
				}
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
			<h1 class="fade-it"><img alt="<?= COMPANY_NAME ?> Logo" title="<?= COMPANY_NAME ?> Logo" src="<?= IMG_URI ?>logo_home.png"></h1>
			<h2>Save Time, Experience More</h2>
			<div class="flexslider" style="margin-bottom:30px">
				<ul class="slides">
					<li><h3>Curated Selection of activities</h3></li>
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
							placeholder="Enter your email address"
							style="font-size:15px;line-height:15px; padding:10px 6px"
							/>
						<input 
							type="submit" 
							value="Go!" 
							class="btn btn-large btn-success"
							/>
					</div>
				</div>
			</form>
		</div>
		<div id="down_button" class="fade-it"><a href="#content" style="z-index:9999"></a></div>
	</section>
<?php } ?>