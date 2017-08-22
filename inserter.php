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

$a = 'LG006010';
$b = 'LG002311';
$c = 'LG007712';
$d = 'LG008890';
$e = 'LG186213';
$f = 'LG306012';
$g = 'LG206040';
$h = 'LG906910';
$coll_site = 'site';
$kite = 'Kiteezi';
$nam = 'Namuwongo';
$year = 200;
//echo rand(1, 8);
for($i=2; $i < 10; $i++)
{

$dump = rand(1,2);
if($dump == 1){
$dum = $kite;
}
if($dump == 2){
$dum = $nam;
}
$cs = $coll_site.rand(1,10);
$mil = rand(50,60);
$wgt = rand(5000,7000);
$fuel = rand(50,70); 
$yr = $year.$i.",".rand(0,11).",".rand(1,31);
//echo $cs."|".$dum."|".$a."|".$mil."|".$wgt."|".$fuel."|".$yr."</br>";

$qry = "INSERT INTO collection(collection_site, dumping_site, vehicle_id, mileage, load_weight, fuel_gauge, date_cap) VALUES('$cs','$dum','$c', '$mil', '$wgt', '$fuel', '$yr')";
$result = @mysql_query($qry);
}

?>