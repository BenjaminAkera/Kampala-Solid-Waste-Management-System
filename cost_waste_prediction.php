<?php
	require_once('auth.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="Your description goes here" />
	<meta name="keywords" content="your,keywords,goes,here" />
	<meta name="author" content="Your Name" />
	<link rel="stylesheet" type="text/css" href="css/wstmgt.css" title="m4" media="screen,projection" />
	<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load('visualization', '1',{'packages':['motionchart']});
google.setOnLoadCallback(drawChart);
function drawChart() {
var data = new google.visualization.DataTable();
data.addColumn('string', 'Vehicle');
data.addColumn('date', 'Date');
data.addColumn('number', 'WasteVolume');
data.addColumn('number', 'UnitCost');
data.addColumn('string', 'DumpingSite');
data.addRows([
<?php
	include_once("config.php");
		//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
$extractor  = "SELECT * FROM collection";
$res_ex = mysql_query($extractor);
//['Truck1',new Date (1988,0,1),1000,300,'Kiteezi'],
while($res=mysql_fetch_array($res_ex)){
echo "['".$res['vehicle_id']."',new Date (".$res['date_cap']."),".$res['load_weight'].",".$res['fuel_gauge'].",'".$res['dumping_site']."'],";
}
?>
['LG007712',new Date (2009,8,30),6346,68,'Namuwongo']
]);
var chart = new
google.visualization.MotionChart(document.getElementById('chart_div'));
chart.draw(data,{width: 990, height:600});
}
</script>
</head>
<body>
<div id="container" >
	<div id="header">
		<h1>WASTE MANAGEMENT SYSTEM</h1>
		<h2>Asystem intended to improve solid waste management activities</h2>
	</div>

	<div id="navigation">
		<ul>
			<li><a href="member-index.php">HOME</a></li>
			<li><a href="map.php">MAPS</a></li>
			<li class="selected"><a href="cost_waste_prediction.php">waste-cost</a></li>
            <li><a href="waste_population_prediction.php">Waste-population</a></li>
			<li><a href="logout.php">LOGOUT</a></li>
		</ul>
	</div>

	<div id="content">
				<div class="met_fet">
            <div id="met_fet-header">WASTE-VOLUME, VEHICLE-COST AND TIME ESTIMATION TOOL</div>
            <div id="met_fet-main" class="clearfix">
            <div id="chart_div" style="width: 990px; height: 600px;"></div>
            </div>
			</div>
	</div>

  <div id="footer">
  <div id="copyright">
<p>&copy; 2017 | Resilient African Network Hackathon</p>
</div><!--end copyright-->
</div>
	

</div>
</body>
</html>