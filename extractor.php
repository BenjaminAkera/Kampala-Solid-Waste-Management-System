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
echo "['".$res['vehicle_id']."',new Date (".$res['date_cap']."),".$res['load_weight'].",".$res['fuel_gauge'].",'".$res['dumping_site']."'],"."</br>";
}
?>