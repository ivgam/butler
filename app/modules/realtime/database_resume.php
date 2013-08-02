<div class="well span2" style="text-align: center" ng-repeat="database in realtime.database_resume">
	<h4><i class="icon-cog" style="margin-top:4px"></i> <?= _('Status');?> "{{database.name}}"</h4>   
	<div>
		<span><i class="icon-random" title="<?= _('Threads connected');?>"></i>:{{database.threads}}</span>
		<span><i class="icon-cog" title="<?= _('Number of queries executing');?>"></i>:{{database.queries}}</span>
		<span><i class="icon-time" title="<?= _('Uptime');?>"></i>: {{database.uptime}}</span>
	</div>			
	<p style="font-size: 40px;margin:20px 0px; text-align: center">{{database.load}}%</p>
	<div class="progress progress-{{database.load_status}}">
		<div class="bar" style="width: {{database.load}}%"></div>
	</div>
</div>