<!DOCTYPE html>
<html lang="en">
  <head>
      <?php Fw_Module::getModule('head')?>
  </head>
  <body>
    <div class="container">
        <?php echo $html?>
    </div>
    <?php Fw_CCC::getAllFrontJs()?>
	<?php Fw_Module::getModule('google_analytics'); ?>
  </body>
</html>
