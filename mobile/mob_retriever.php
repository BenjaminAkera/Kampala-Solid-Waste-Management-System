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
//$password = trim($_GET["password"]);
$vehicle= trim($_GET["vehicle"]);

//connect to the DB
$stqu = "SELECT * FROM collection WHERE vehicle_id = '$vehicle'";
$stres = mysql_query($stqu);
$row = @mysql_fetch_assoc($stres);

//set the query to check the credentials
$query = "SELECT * FROM members WHERE login='$username' AND passwd='".md5($_GET['password'])."'";

//execute the query
$result = mysql_query($query);

if(mysql_num_rows($result) == 0)
{
	// wrong cedentials
	echo "Wrong username and/or password";
	die();
}
else
{
	//right credentials
	
	//set the query to extract the latest post form the author $author
	$query = "SELECT collection_site, dumping_site, vehicle_id, mileage, load_weight, fuel_gauge, collection_date_time FROM collection WHERE vehicle_id ='$row[vehicle_id]' ORDER BY collection_id DESC LIMIT 0,1";
	//execute it
	$result = mysql_query($query);
	if(mysql_num_rows($result) == 0)
	{
		echo "No collection Data for $vehicle";
		die();
	}
	else
	{

	$waste = @mysql_fetch_assoc($result);
		echo $vehicle."|".$waste['collection_site']."|".$waste['dumping_site']."|".$waste['mileage']."|".$waste['load_weight']."|".$waste['fuel_gauge']."|".$waste['collection_date_time'];

}
}
?>
	