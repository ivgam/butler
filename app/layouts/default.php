<!DOCTYPE html>
<html lang="en">
  <head>
    <?php Fw_Module::getModule('head');?>
  </head>
  <body>
    <?php echo $html?>
    <?php Fw_CCC::getAllFrontJs()?>
  </body>
</html>
