<?php if (!stristr(PHP_OS, 'win')) { ?>
<div class="well span2" style="text-align:center">
	<h4><i class="icon-hdd" style="margin-top:4px"></i> <?= _('Disc Space');?></h4>
	<div><span><strong><?= _('Total');?>:</strong></span>300GB</div>	
	<p style="font-size:40px;margin:20px 0px"><?php echo 30 ?>%</p>
	<div class="progress progress-success">
		<div class="bar" style="width: 30%"></div>
	</div>
</div>
<?php } ?>