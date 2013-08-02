<?php
$error_no = Fw_Register::getRef('error_no');
$error_message = Fw_Register::getRef('error_message');
?>
<style type="text/css">
    body {
        padding-top: 20px;
        padding-bottom: 60px;
    }

    /* Custom container */
    .container {
        margin: 0 auto;
        max-width: 1000px;
    }
    .container > hr {
        margin: 60px 0;
    }

    /* Main marketing message and sign up button */
    .jumbotron {
        margin: 80px 0;
        text-align: center;
    }
    .jumbotron h1 {
        font-size: 100px;
        line-height: 1;
    }
    .jumbotron .lead {
        font-size: 24px;
        line-height: 1.25;
    }
    .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
    }

    /* Supporting marketing content */
    .marketing {
        margin: 60px 0;
    }
    .marketing p + h4 {
        margin-top: 28px;
    }


    /* Customize the navbar links to be fill the entire space of the .navbar */
    .navbar .navbar-inner {
        padding: 0;
    }
    .navbar .nav {
        margin: 0;
        display: table;
        width: 100%;
    }
    .navbar .nav li {
        display: table-cell;
        width: 1%;
        float: none;
    }
    .navbar .nav li a {
        font-weight: bold;
        text-align: center;
        border-left: 1px solid rgba(255,255,255,.75);
        border-right: 1px solid rgba(0,0,0,.1);
    }
    .navbar .nav li:first-child a {
        border-left: 0;
        border-radius: 3px 0 0 3px;
    }
    .navbar .nav li:last-child a {
        border-right: 0;
        border-radius: 0 3px 3px 0;
    }
</style>
<div class="container">
    <div class="jumbotron">
		<img alt="<?= COMPANY_NAME ?> Logo" title="<?= COMPANY_NAME ?> Logo" src="<?= PUBLIC_URI ?>logo_black.png"/>
        <h1>Error <?= $error_no ?>!</h1>
        <p class="lead">
			<?= $error_message ?>
        </p>
        <a class="btn btn-large btn-inverse" href="<?= BASE_URI?>">Go to Home</a>
    </div>
</div>