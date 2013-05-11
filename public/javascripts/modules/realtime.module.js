angular.module('realTimeModule', []).
	factory('realtime', function($timeout, $http) {
		var realtime = {};
		
		(function getServerIP(){
			realtime.server_ip = '127.0.0.1';
		})();
		
		(function getLoadAvg(){
			$http({
				url: base_uri+"realtime/getLoadAvg"
			})
			.success(function(data, status, headers, config) {				
				realtime.load_avg = data.load;
				realtime.load_status = (data.load < 50)?'success':((data.load < 75)?'warning':'danger');
			}).error(function(data, status, headers, config) {
				console.log('An error ocurred while processing');
			});				
			$timeout(getLoadAvg, 2000);
		})();
		
		(function getOSPercentages(){
			$http({
				url: base_uri+"realtime/getOSPercentages"
			})
			.success(function(data, status, headers, config) {
				realtime.windows_percentage = (typeof data['Windows']	!= 'undefined')?data['Windows'][0]['percentage']:0;
				realtime.linux_percentage	= (typeof data['Linux']		!= 'undefined')?data['Linux'][0]['percentage']:0;
				realtime.ios_percentage		= (typeof data['iOS']		!= 'undefined')?data['iOS'][0]['percentage']:0;
				realtime.android_percentage = (typeof data['Android']	!= 'undefined')?data['Android'][0]['percentage']:0;										
			}).error(function(data, status, headers, config) {
				console.log('An error ocurred while processing');
			});			
			$timeout(getOSPercentages, 5000);
		})();
		
		(function getBrowserPercentages(){
			$http({
				url: base_uri+"realtime/getBrowserPercentages"
			})
			.success(function(data, status, headers, config) {				
				realtime.chrome_percentage		= (typeof data['Chrome']	!= 'undefined')?data['Chrome'][0]['percentage']:0;
				realtime.firefox_percentage		= (typeof data['Firefox']	!= 'undefined')?data['Firefox'][0]['percentage']:0;
				realtime.safari_percentage		= (typeof data['Safari']	!= 'undefined')?data['Safari'][0]['percentage']:0;
				realtime.opera_percentage		= (typeof data['Opera']		!= 'undefined')?data['Opera'][0]['percentage']:0;
				realtime.explorer_percentage	= (typeof data['Explorer']	!= 'undefined')?data['Explorer'][0]['percentage']:0;
			}).error(function(data, status, headers, config) {
				console.log('An error ocurred while processing');
			});			
			$timeout(getBrowserPercentages, 10000);
		})();
		
		(function getNumberOfVisits(){
			$http({
				url: base_uri+"realtime/getNumVisits"
			})
			.success(function(data, status, headers, config) {				
				realtime.num_visits = data.num_visits;
			}).error(function(data, status, headers, config) {
				console.log('An error ocurred while processing');
			});			
			$timeout(getNumberOfVisits, 2000);
		})();
		
		(function getRequestedPages(){
			$http({
				url: base_uri+"realtime/getRequestedPages"
			})
			.success(function(data, status, headers, config) {				
				realtime.requested_pages = data;
			}).error(function(data, status, headers, config) {
				console.log('An error ocurred while processing');
			});			
			$timeout(getRequestedPages, 5000);
		})();
		
		(function getDatabasesResume(){
			$http({
				url: base_uri+"realtime/getDatabaseResume"
			})
			.success(function(data, status, headers, config) {				
				realtime.database_resume = data;
			}).error(function(data, status, headers, config) {
				console.log('An error ocurred while processing');
			});			
			$timeout(getDatabasesResume, 2000);
		})();
		
		
		return realtime;
	});