<div class="span6">
	<h5><?= _('TOP 5 Requested Pages (Last Hour)');?></h5>
	<div class="row">
		<table class="table table-striped span6">
			<thead>
				<tr>
					<th style="width:20%"><?= _('URI');?> </th>
					<th style="width:70%"><?= _('%Visits');?> </th>
					<th style="width:10%"><?= _('N.Visits');?> </th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="requested in realtime.requested_pages">
					<td>{{requested.uri}}</td>
					<td>
						<div class="progress progress-info">
							<div class="bar" style="width: {{requested.percentage}}%"></div>
						</div>
					</td>
					<td>{{requested.num}}</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>