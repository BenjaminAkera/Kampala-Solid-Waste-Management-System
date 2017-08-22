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
// Start XML file, create parent node
$idy =1;
$dom = new DOMDocument('1.0','UTF-8');
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node); 

$wtpntquery = 'SELECT collection.collection_id, collection.collection_site, collection.dumping_site, collection.vehicle_id, collection.mileage, 
collection.load_weight, collection.fuel_gauge, collection.collection_date_time,collection_site.site_id, collection_site.lat, collection_site.lon,collection_site.category
FROM (collection, collection_site) 

	WHERE collection.collection_site = collection_site.site_id';
	
	$wtpntres = mysql_query($wtpntquery );
if (!$wtpntres) {  
  die('Invalid query: ' . mysql_error());
} 

header("Content-type: text/xml"); 

// Iterate through the rows, adding XML nodes for each

while ($row = @mysql_fetch_assoc($wtpntres)){  
  // ADD TO XML DOCUMENT NODE  
  $node = $dom->createElement("marker");  
  $newnode = $parnode->appendChild($node);
  
  $ide = "m".$idy++;
  $newnode->setAttribute("nr", $ide);
  //$idy++;  
  $newnode->setAttribute("CollectionSiteName",$row['site_id']);
  $newnode->setAttribute("DumpSiteName", $row['dumping_site']);
  $newnode->setAttribute("Vehicle", $row['vehicle_id']);
  $newnode->setAttribute("Mileage", $row['mileage']);  
  $newnode->setAttribute("Volume", $row['load_weight']);
  $newnode->setAttribute("Fuel", $row['fuel_gauge']);
  $newnode->setAttribute("CollectionTime", $row['collection_date_time']);
  $newnode->setAttribute("lat", $row['lat']);  
  $newnode->setAttribute("lng", $row['lon']);
  $newnode->setAttribute("category", $row['category']);
} 

echo $dom->saveXML();

?>
