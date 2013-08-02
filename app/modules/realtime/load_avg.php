<?php
$load = Server_Helper::get_server_load();
$status = ($load < 50) ? 'success' : (($load < 75) ? 'warning' : 'danger');
?>
<div class="well span2" style="text-align: center">
	<h4><i class="icon-heart" style="margin-top:4px"></i><?= _('Load AVG')?></h4>
	<div><span><strong>IP:</strong>{{realtime.server_ip}}</span></div>	
	<p style="font-size: 40px;margin:20px 0px" >{{realtime.load_avg}}%</p>
	<div class="progress progress-{{realtime.load_status}}">
		<div class="bar" style="width: {{realtime.load_avg}}%"></div>
	</div>
</div>