<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(drawCharts);
	function drawCharts() {
		
<?php
$oDb = Fw_Db::getInstance(DB_INSTANCE);
$oResult = Landing_Helper::getActiveLandings();
$sSQL = <<<SQL
SELECT 
	DAY(lcv.ts_creation) as group_field,
	DAY(lcv.ts_creation) as cday,
	COUNT(DISTINCT lcv.id) as num_visits,
	COUNT(DISTINCT lcvc.id) as num_conversions
FROM landing_campaign lc
INNER JOIN landing l 
	ON l.id = lc.id_landing
	AND lc.id = :id_landing_campaign
INNER JOIN campaign c
	ON c.id = lc.id_campaign
LEFT JOIN landing_campaign_visit lcv
	ON lc.id = lcv.id_landing_campaign
	AND YEAR(lcv.ts_creation) = YEAR(NOW())
	AND MONTH(lcv.ts_creation) = MONTH(NOW())
LEFT JOIN visit v
	ON v.id = lcv.id_visit
	AND v.referer != ''
LEFT JOIN landing_campaign_visit_conversion lcvc
	ON lcv.id = lcvc.id_landing_campaign_visit
GROUP BY DAY(lcv.ts_creation)
SQL;
$statement = $oDb->prepare($sSQL);
foreach ($oResult as $i=>$oRow) {
	$statement->bindParam(':id_landing_campaign', $oRow['id_landing_campaign'], PDO::PARAM_INT);
	$statement->execute();
	$aDays = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31);
	$aValues = $statement->fetchAll(PDO::FETCH_GROUP);
	?>
				var data = google.visualization.arrayToDataTable([
					['Date', 'Visits', 'Conversions'],
					<?php foreach($aDays as $day){?>
					['<?= $day ?>', <?= isset($aValues[$day])?$aValues[$day][0]['num_visits']:0 ?>,<?= isset($aValues[$day])?$aValues[$day][0]['num_conversions']:0 ?>],
					<?php }?>
				]);

				var options = {
					title: 'Campaign: <?= $oRow['campaign_name']?>, Landing: <?= $oRow['landing_name']?>'
				};

				var chart = new google.visualization.LineChart(document.getElementById('chart_div_<?=$i?>'));
				chart.draw(data, options);

<?php } ?>
	}
</script>
<?php
$num_landings = count($oResult);
for ($i = 0; $i < $num_landings; $i++) {
	?>
	<div id="chart_div_<?= $i ?>" style="width: 100%; height: 500px;"></div>
<?php } ?>
