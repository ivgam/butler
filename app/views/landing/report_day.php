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
	HOUR(lcv.ts_creation) as group_field,
	HOUR(lcv.ts_creation) as chour,
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
	AND DATE(lcv.ts_creation) = DATE(NOW())
LEFT JOIN visit v
	ON v.id = lcv.id_visit
	AND v.referer != ''
LEFT JOIN landing_campaign_visit_conversion lcvc
	ON lcv.id = lcvc.id_landing_campaign_visit
GROUP BY HOUR(lcv.ts_creation)
SQL;
$statement = $oDb->prepare($sSQL);
foreach ($oResult as $i=>$oRow) {
	$statement->bindParam(':id_landing_campaign', $oRow['id_landing_campaign'], PDO::PARAM_INT);
	$statement->execute();
	$aHours = array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23);
	$aValues = $statement->fetchAll(PDO::FETCH_GROUP);
	?>
				var data = google.visualization.arrayToDataTable([
					['Hour', 'Visits', 'Conversions'],
					<?php foreach($aHours as $hour){?>
					['<?= $hour ?>', <?= isset($aValues[$hour])?$aValues[$hour][0]['num_visits']:0 ?>,<?= isset($aValues[$hour])?$aValues[$hour][0]['num_conversions']:0 ?>],
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
