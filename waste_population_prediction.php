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
data.addColumn('string', 'Demographies');
data.addColumn('date', 'Date');
data.addColumn('number', 'WasteVolume');
data.addColumn('number', 'Population');
data.addColumn('number', 'TotalPopulation');
data.addRows([
['High income',new Date (1988,1,1),3644,6073,114364],
['Medium income',new Date (1988,1,1),5764,19213,114364],
['Low income',new Date (1988,1,1),8909,89090,114364],
['High income',new Date (1992,1,1),4446,7410,139541],
['Medium income',new Date (1992,1,1),7034,23443,139541],
['Low income',new Date (1992,1,1),7409.6,74096,139541],
['High income',new Date (1995,1,1),5161.2,8602,161998],
['Medium income',new Date (1995,1,1),8164.8,27216,161998],
['Low income',new Date (1995,1,1),12619.6,126196,161998],
['High income',new Date (2020,1,1),17898.6,29831,561796],
['Medium income',new Date (2020,1,1),28314.6,94382,561796],
['Low income',new Date (2020,1,1),43763.9,437639,561796],
['High income',new Date (2002,1,1),7297.2,12162,229472],
['Medium income',new Date (2002,1,1),11565.3,38551,229472],
['Low income',new Date (2002,1,1),17875.9,178759,229472]
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
			<li><a href="cost_waste_prediction.php">waste-cost</a></li>
            <li class="selected"><a href="waste_population_prediction.php">Waste-population</a></li>
			<li><a href="logout.php">LOGOUT</a></li>
		</ul>
	</div>

	<div id="content">
				<div class="met_fet">
            <div id="met_fet-header">WASTE-VOLUME WITH POPULATION AND TIME PREDICTION TOOL</div>
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