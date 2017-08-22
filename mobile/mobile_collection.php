<?php
require("config.php");
$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
if(!$link)
{
		die('Failed to connect to server: ' . mysql_error());
}
$db = mysql_select_db(DB_DATABASE);
if(!$db)
{
die('failed to select data base');
}
//retrieve the data
$username = trim($_GET["username"]);
$password = trim($_GET["password"]);
$vh_nm = $_GET['vehicle'];
$collectionSite = $_GET['collectionSite'];
$dumpingSite = $_GET['dumpingSite'];
$mileage = $_GET['mileage'];
$loadWeight = $_GET['loadWeight'];
$fuelGauge = $_GET['fuelGauge'];
$date=date("y,m,d"); //create date	
$yr = 20;
$coldate = $yr.$date;

//set the query to check the credentials
$qry="SELECT * FROM members WHERE login='$username' AND passwd='".md5($_GET['password'])."'";

//execute the query
$result = mysql_query($qry);

if(mysql_num_rows($result) == 0)
{
	// wrong cedentials
	echo "Wrong username and/or password";
	die();
}
else
{

	$sql = "INSERT INTO waste.collection (collection_site, dumping_site, vehicle_id, mileage, load_weight, fuel_gauge,date_cap) 
	VALUES ('$collectionSite', '$dumpingSite', '$vh_nm', '$mileage', '$loadWeight', '$fuelGauge','$coldate') ;";
$wth_result = @mysql_query($sql);
	if(!$wth_result)
	{
		echo "Collection Data not inserted. Try again later";
	}
	else
	{
		echo "Collection Data inserted correctly";
	}

	}
?>
	