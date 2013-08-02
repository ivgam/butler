<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php Fw_Module::getModule('admin/head'); ?>
        <style>
            body {
                padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
            }
        </style>
    </head>
    <body>	        
        <?php Fw_Module::getModule('admin/menu'); ?>
        <div class="container">  
            <div class="row" id="messages"><?php Fw_Module::getModule('admin/messages') ?></div>
            <div class="row">
                <?php echo $html; ?>      
            </div>
        </div>
        <?php Fw_CCC::getAllBackJs() ?>
    </body>
</html>