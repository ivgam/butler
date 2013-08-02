<?php $crud_controllers = Fw_Register::getRef('crud_controllers'); ?>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="brand" href="<?= BASE_URI?>admin"><img src="<?= PUBLIC_URI?>logo_admin.png"/></a>
            <div class="nav-collapse collapse">
                <ul class="nav">  
					<li><a href="<?= BASE_URI?>realtime/panel">Realtime</a></li>
                    <li class="dropdown">
                        <a id="crud-dropdown" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"><?= _('CRUD');?> <b class="caret"></b></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="crud-dropdown">
                            <?php foreach ($crud_controllers as $controller) { ?>
                                <li>	
                                    <a href="<?php echo Fw_Router::getUrl($controller, 'admin') ?>">
                                        <?php echo ucfirst($controller) ?>                                        
                                    </a>
                                </li>
                            <?php } ?>                            
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a id="conf-tools" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"><?= _('Tools');?> <b class="caret"></b></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="conf-tools">
                            <li><a href="<?php echo Fw_Router::getUrl('minify', 'generateAll') ?>"><?= _('Minify Scripts');?></a></li>                            
                            <li><a href="<?php echo Fw_Router::getUrl('dumper', 'all') ?>"><?= _('Export DB');?></a></li>                            
                            <li><a href="<?php echo Fw_Router::getUrl('dumper', 'schema') ?>"><?= _('Export DB Schema');?></a></li>                            
                        </ul>
                    </li>
                </ul>
                <ul class="nav nav-pills pull-right">
                    <li><a href="#"><?= _('Wiki');?></a></li>                
                    <li><a href="<?= BASE_URI?>"><?= _('Go to Web');?></a></li>                
                    <li><a href="<?= BASE_URI?>logout"><?= _('Logout');?></a></li>                
                </ul>
            </div>
        </div>
    </div>
</div>