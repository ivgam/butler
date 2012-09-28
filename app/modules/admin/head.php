<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Login Title</title>
	<meta name="description" content="">
	<meta name="author" content="">
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
	<script type="application/x-javascript">
		addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){
			window.scrollTo(0,1);
		}
	</script>
	
	<!-- CSS -->
	<?php Fw_CCC::getAllBackCss()?>
	
	<!-- Favicons -->
	<link rel="shortcut icon" href="<?php echo IMG_URI?>favicon.ico">
	<link rel="apple-touch-icon-precomposed" href="<?php echo IMG_URI?>apple-touch-icon.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo IMG_URI?>apple-touch-icon-72x72.png" />
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo IMG_URI?>apple-touch-icon-114x114.png" />
	
	<!-- To Top scripts -->
	<script src="<?php echo JS_URI?>smoothscroll.js"type="text/javascript" ></script>
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script src="<?php echo JS_URI?>jquery.easing.1.3.js" type="text/javascript"></script>
	<script src="<?php echo JS_URI?>jquery.ui.totop.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$().UItoTop({ easingType: 'easeOutQuart' });
			$({visitors:parseInt($('#visitors_count').text())}).animate({visitors:175},{
				duration:1000,
				easing:'swing',
				step:function(){
					$('#visitors_count').text(Math.ceil(this.visitors));
				}
			});			
		});
	</script>
</head>