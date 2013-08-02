<<<<<<< HEAD
<?php
header('Content-Type: text/html; charset=UTF-8');
$meta = SEO_Helper::meta();
?>
<meta charset="utf-8"/>
<link rel="shortcut icon" href="<?= PUBLIC_URI?>favicon.ico">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
<meta name="title" content="<?= $meta['title']?>"/>
<meta name="description" content="<?= strip_tags($meta['description']) ?>"/>
<meta name="keywords" content=""/>
<meta name="author" content="<?= $meta['author'] ?>"/>
<meta name="robots" content="<?= $meta['robots'] ?>, NOODP"/>
<meta name="copyright" content="<?= COMPANY_NAME ?>"/>
<meta name="googlebot" content="noarchive"/>
<meta http-equiv="expires" content="<?= date('D, d F Y H:i:s', time() + 60*60)?> GMT"/>
<meta http-equiv="cache-control" content="no-cache"/>
<meta http-equiv="pragma" content="no-cache"/>
<meta http-equiv="content-language" content="en-GB"/>

<title><?= $meta['title'] ?></title>

<link rel="canonical" href="<?= $meta['canonical'] ?>"/>

<!-- CSS -->
<?php Fw_CCC::getAllFrontCss() ?>

<!-- Custom Fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300,500' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href="http://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet" type="text/css">

=======
<meta charset="utf-8">
<title>Butler</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
>>>>>>> e9b6a406a4cdf7bd79b4deb817f8b33ce0720f2a
<!-- IE Fix for HTML5 Tags -->
<!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<<<<<<< HEAD
<script type="text/javascript">
	var base_uri = '<?= BASE_URI ?>';
	var csign = '€';
</script>
<style>
	*{ font-family: Tahoma, sans-serif}
	::selection{
		background: #b8d107;
		color: #fff;
		text-shadow: none;
	}
</style>
<script src="<?= JS_URI ?>jquery-1.9.1.min.js"></script>
=======
<!-- CSS -->
<?php Fw_CCC::getAllFrontCss() ?>
<script type="text/javascript">
	var base_uri = '<?= BASE_URI?>';
</script>
<script src="<?= JS_URI?>jquery-1.9.1.min.js"></script>
>>>>>>> e9b6a406a4cdf7bd79b4deb817f8b33ce0720f2a
<!-- Fav and touch icons -->
<!--
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="../assets/ico/favicon.png">
<<<<<<< HEAD
-->
=======
-->
<style>
    body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
    }
</style>
>>>>>>> e9b6a406a4cdf7bd79b4deb817f8b33ce0720f2a
