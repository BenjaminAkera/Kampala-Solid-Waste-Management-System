<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="Your description goes here" />
	<meta name="keywords" content="your,keywords,goes,here" />
	<meta name="author" content="Your Name" />
	<link rel="stylesheet" type="text/css" href="css/prediction.css" title="m4" media="screen,projection" />
	<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
google.load('visualization', '1',{'packages':['motionchart']});
google.setOnLoadCallback(drawChart);
function drawChart() {
var data = new google.visualization.DataTable();
data.addColumn('string', 'Vehicle');
data.addColumn('date', 'Date');
data.addColumn('number', 'WasteWeight');
data.addColumn('number', 'Fuel');
data.addColumn('string', 'DumpingSite');
data.addRows([
['Truck1',new Date (1988,0,1),1000,300,'Kiteezi'],
['Truck2',new Date (1988,0,1),1150,200,'Namuwongo'],
['Truck3',new Date (1988,0,1),300,250,'Namuwongo'],
['Truck1',new Date (1989,6,1),1200,400,'Kiteezi'],
['Truck2',new Date (1989,6,1),750,150,'Namuwongo'],
['Truck3',new Date (1989,6,1),788,617,'Namuwongo'],
['Truck1',new Date (1990,0,1),2600,400,'Kiteezi'],
['Truck2',new Date (1990,0,1),3300,150,'Namuwongo'],
['Truck3',new Date (1990,0,1),2340,617,'Namuwongo'],
['Truck1',new Date (1991,0,1),1300,400,'Kiteezi'],
['Truck2',new Date (1991,0,1),12200,150,'Namuwongo'],
['Truck3',new Date (1991,0,1),4540,617,'Namuwongo']
]);
var chart = new
google.visualization.MotionChart(document.getElementById('chart_div'));
chart.draw(data,{width: 920, height:700});
}
</script>
</head>
<body>
<div id="container" >
	<div id="header">
		<h1>WASTE MANAGEMENT SYSTEM</h1>
		<h2>Asystem intended to improve   solid waste management activities</h2>
	</div>

	<div id="navigation">
		<ul>
			<li><a href="index.php">HOME</a></li>
			<li><a href="about_us.html">userlogin</a></li>
			<li><a href="maps/m4wmaps.php">MAPS</a></li>
			<li  class="selected"><a href="partners.html">Predictions</a></li>
                     <li><a href="resources.html">scheduling</a></li>
			<li><a href="contact.html">vehicle and routing</a></li>
		</ul>
	</div>

	<div id="content">
		<div class="splitcontentleft">
		  <div class="box">
<div id="featured-post">
<div id="featured-news-header">WASTE(volume), COST(fuel) AND TIME(years) PREDICTIONS</div>
<div id="chart_div" style="width: 920px; height: 700px;"></div>
</div>
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