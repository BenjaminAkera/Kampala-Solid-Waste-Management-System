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

//echo rand(1, 8);
for($i=1; $i < 9; $i++)
{

if($i == 1){
$veh = $a;
}
if($i == 2){
$veh = $b;
}
if($i == 3){
$veh = $c;
}
if($i == 4){
$veh = $d;
}
if($i == 5){
$veh = $e;
}
if($i == 6){
$veh = $f;
}
if($i == 7){
$veh = $g;
}
if($i == 8){
$veh = $h;
}

$cs = rand(5000,11000);
$mil = rand(80000000,100000000);
$wgt = rand(45,59);
$fuel = rand(30000,100000); 
$yr = rand(40,50);


$qry = "INSERT INTO vehicle(vehicle_id, maxi_capacity, capital_cost, loadtime, labour_cost, consumption_rate) VALUES('$veh','$cs','$mil', '$wgt', '$fuel', '$yr')";
$result = @mysql_query($qry);
}

?>