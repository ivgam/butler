<div class="well span4" style="height: 200px">
	<ul class="unstyled" style="margin-top:25px">
		<li class="os">
			<div class="row">
				<span class="span1">Windows</span>
				<div class="progress progress-info span2">
					<div class="bar" style="width: {{realtime.windows_percentage}}%"></div>
				</div>
				<span class="span1">{{realtime.windows_percentage}}%</span>
			</div>
		</li>
		<li class="os">
			<div class="row">
				<span class="span1">Linux</span>
				<div class="progress progress-danger span2">
					<div class="bar" style="width: {{realtime.linux_percentage}}%"></div>
				</div>
				<span class="span1">{{realtime.linux_percentage}}%</span>
			</div>
		</li>
		<li class="os">
			<div class="row">
				<span class="span1">iOS</span>				
				<div class="progress progress-warning span2">
					<div class="bar" style="width: {{realtime.ios_percentage}}%"></div>
				</div>
				<span class="span1">{{realtime.ios_percentage}}%</span>
			</div>
		</li>
		<li class="os">
			<div class="row">
				<span class="span1">Android</span>				
				<div class="progress progress-success span2">
					<div class="bar" style="width: {{realtime.android_percentage}}%"></div>
				</div>
				<span class="span1">{{realtime.android_percentage}}%</span>
			</div>
		</li>
	</ul>
</div>