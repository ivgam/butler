<?php if (!stristr(PHP_OS, 'win')) { ?>
	<div class="well span2" style="text-align:center">
		<h4><i class="icon-wrench" style="margin-top:4px"></i> <?= _('Memory Usage');?></h4>
		<div><span><strong><?= _('Total');?>:</strong></span>16GB</div>	
		<p style="font-size:40px;margin:20px 0px"><?php echo 60 ?>%</p>
		<div class="progress progress-warning">
			<div class="bar" style="width: 60%"></div>
		</div>
	</div>
<?php } ?>