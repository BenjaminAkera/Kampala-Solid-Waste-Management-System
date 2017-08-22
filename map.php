<?php
	require_once('auth.php');
function getlatlngstring($coordsArray, $splitonnewline)
{
    $latlng = "";
    $k = count($coordsArray);
    for ($i = 0; $i < $k; $i++) {
        $latlngArray = explode(",", $coordsArray[$i]);
        		if (count($latlngArray) == 2) {
$lat = $latlngArray[1];
$lng = $latlngArray[0];
$latlng = $latlng . "new google.maps.LatLng(" . $lat . "," . $lng . ")";
if ($splitonnewline == 1)
{
if ($i != $k - 2) $latlng = $latlng . ", ";
}
else
{
if ($i != $k - 1) $latlng = $latlng . ", ";
}
}
    }
    $latlng = "[".$latlng."]";
    return $latlng;
}
//33.63906465,2.02242818 31.74899649,2.02612319
$mine = array( array("kml/KAMPALA.kml|2.255052,33.090913|10" => "KAMPALA")
);
$address = "http://localhost/wastemgt/kml/KAMPALA.kml";
$center = "0.300154, 32.56903";
$zoom = 13;
$inner = "";
$code = "";
$splitonnewline = 0;
/*if (isset($_REQUEST['imported']))
{
	$address = $_REQUEST['imported'];
    $center = "new GLatLng(33.137551,-17.929688),2";
}*/
if (isset($_REQUEST['mine'])) // find file to present on map
{
	$code = $_REQUEST['mine'];
    foreach ($mine as $a => $b)
    {
        foreach ($b as $key => $value)
        {
            if ($code == $value)
            {
                $split = explode("|",$key);
                $address = "http://localhost/wastemgt/".$split[0];
                $center = $split[1];
                $zoom = $split[2];
                continue;
            }
        }
    }
}

// Load kml-file and get coordinates
// From Google maps api blog, Pamela Fox http://googlemapsapi.blogspot.com/2007/10/clickable-polys-old-school-image-maps.html
$kmlfile = $address;
$l = 0;
$coordstring = "";
$found = 0;
$xml = simplexml_load_file($kmlfile) or die("url not loading, may have nodes that this tool do not decode");
$documentname = $xml->Document->name;
$docdescription = $xml->Document->description;
/*$documentname = str_replace(" ","","$documentname");
$documentname = str_replace(" ","","$documentname");
$documentname = str_replace("-","","$documentname");*/
foreach($xml->Document->Placemark as $placemark) {
    $placemarkname = $placemark->subcountyname;
    $description = $placemark->description;
    if ($coords = $placemark->Polygon->outerBoundaryIs->LinearRing->coordinates)
    {
        $linetype = "Polygon";
        $found = 1;
        if (count($coordsArray = explode("\n", $coords)) > 1)
        {
            $splitonnewline = 1;
        }
        else
        {
            $coordsArray = explode(" ", $coords); // split on space
        }
        $latlng = getlatlngstring($coordsArray, $splitonnewline); // function above
    }
    if ($found == 0) {
        if ($coords = $placemark->LineString->coordinates)
        {
            $linetype = "LineString";
            $found = 1;
            if (count($coordsArray = explode("\n", $coords)) > 1)
            {
                $splitonnewline = 1;
            }
            else
            {
                $coordsArray = explode(" ", $coords); // split on space
            }
            $latlng = getlatlngstring($coordsArray, $splitonnewline); // function above
        }
    }
    if ($found == 0) {
        if ($coords = $placemark->Point->coordinates)
        {
            $linetype = "Point";
            $pointArray = explode(",", $coords);
            if (count($pointArray) == 2 || count($pointArray) == 3) {
                $latlng = "new google.maps.LatLng(" . $pointArray[1] . "," . $pointArray[0] . ")";
            }
        }
    }
    if ($l > 0) $coordstring = $coordstring.","; // if more than 1 shape
	$coordstring = $coordstring.$latlng; // to be used in js below
    $overlayname[$l] = $placemarkname;
    $descriptions[$l] = $description;
    $overlayshape[$l] = $linetype;
    $found = 0;
    $latlng = "";
    $splitonnewline = 0;
    $l++; // to be used in js below
}

unset($coordsArray);
unset($latlngArray);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="Your description goes here" />
	<meta name="keywords" content="your,keywords,goes,here" />
	<meta name="author" content="Your Name" />
	<link rel="stylesheet" type="text/css" href="css/styler.css" title="m4" media="screen,projection" />

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyADTt58QupDxcbKm_fwnldr_c_9aL1rqr4&callback=initMap"
  type="text/javascript"></script>
</head>
<body onLoad="initialize()">
<div id="container" >
	<div id="header">
		<h1>SOLID WASTE MANAGEMENT SYSTEM</h1>
		<h2>A system intended to improve solid waste management activities</h2>
	</div>

	<div id="navigation">
		<ul>
			<li><a href="member-index.php">HOME</a></li>
			<li class="selected"><a href="map.php">MAPS</a></li>
			<li><a href="cost_waste_prediction.php">waste-cost</a></li>
            <li><a href="waste_population_prediction.php">Waste-population</a></li>
			<li><a href="logout.php">LOGOUT</a></li>
		</ul>
	</div>

	<div id="content">
<div id="map"><p class="block">Google maps loading...............</p></div>
	</div>
	<div id="subcontent">
	  			<div id="sidebar">
<div style="background:#ffff; width:55%; height:100%; float:left; border:1px">
			  <ul class="sidelink">
			<li><a href="#">Filters</a></li>
	          </ul>
			  <!--#80b0da;-->
<div style="background:#ffff;width:90%;height:100%;float:left;border:1px">
<table width="91" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
  <td width = "10"><img src="img/dots/small_red.png" style="border:0px;"></td>
   <td width = "20"><input name="checkbox" type="checkbox" id="residential" onClick="boxclick(this,'residential')" /></td>
  <th width = "69">residential
  <th width="1">  </tr>
  <tr>
    <td width = "10"><img src="img/dots/small_blue.png"style="border:0px;"></td>
   <td width = "20"><input name="checkbox2" type="checkbox" id="nonresidential" onClick="boxclick(this,'nonresidential')" /></td>
     <th width = "69"> Nonresidential</th>
</tr>
</table>
</div>
	<?php
echo "select Division";
?>
<div style="background:#EEEEEE;width:90%;height:500px;border:1px;font-size:0.9em;overflow:auto;">
<form name="shapes" action="#">
<?php
for ($i = 0; $i < $l; $i++) {
    echo "<input  type=\"radio\" name=\"poly\" value=".$i." onclick=\"selectedradiobutton(".$i.");\"/>\n";
    echo " ".$overlayname[$i]."<br />\n";
    if ($i == 24){
        echo "</td><td id=\"extra\" valign=\"top\">\n";
    }
}
echo "<br />\n<input type=\"radio\" name=\"poly\" value=\"hide\" onclick=\"hideall();\"/> Hide all<br />\n";
echo "<input type=\"radio\" name=\"poly\" value=\"show\" onclick=\"showall();\"/> Show all\n";
?>
</form>
	</div>

</div>
		<div style="background:#fff; width:40%; height:500px; float:right; border:1px">
		   <ul class="sidelink">
			<li><a href="#">Sites</a></li>
	      </ul>
		  <div id="sidebari" style="background:#EEEEEE;width:100%;height:500px;border:1px;overflow:scroll;font-size:0.9em;"></div>
	   </div>
			</div>

  </div>
<div id="footer">
<div id="copyright">
<p>&copy; 2017 | Resilient African Network Hackathon</p>
</div><!--end copyright-->
</div>
</div>
<script type="text/javascript">
    //<![CDATA[
var map, actual, iw;
var gmarkers = [];
var overlayname = new Array();
var description = new Array();
var curShape = -1;
var shapenumbers;
var Shape = new Array();
var cardinalmarker = new Array();
var owlmarker = new Array();
var secondchoice;
var thisshape = new Array();
var polygonlineColor = "#646464"; // red line, default colour
var polygonLineWeight = 0.8;
var lineopacity = .8;
var fillcolor = "#FFD514"; // red fill, default colour
var fillopacity = .8;
var lineColor = "#FF0000"; // red line, default colour
var opacity = .8;
var lineWeight = 2;
var newfillColor = "#DCDCDC"; // green fill, highlight colour
var newlineColor = "#00FF00"; // green line, highlight colour

var jsfromphp;

var mulago = {lat: 0.337641, lng: 32.576981};
/**
colors
(28647878)kml=(#787864)html


**/

// converting from php to javascript
shapenumbers = <?php echo $l; ?>;
// converting php arrays to javascript arrays
<?php
foreach ($overlayname as $key => $value) {
    echo "overlayname.push(\"$value\");\n";
}
foreach ($overlayshape as $key => $value) {
    echo "thisshape.push(\"$value\");\n";
}
foreach ($descriptions as $key => $value) {
    echo "description.push(\"$value\");\n";
}
/*foreach ($points as $key => $value) {
    echo "jsfromphp.push(\"$value\");\n";
}*/
?>

jsfromphp = [<?php echo $coordstring; ?>]; // php string is pasted here and becomes javascript array
 var icons = { img: "img/sites_dots.png",
  residential: [50, 0], // red
  nonresidential: [10, 0],// salmon
  white: [30, 0] // white
 };


// Shifts background position of the sprite image
function shifter(arr) {

 var g = google.maps;
 var image = new g.MarkerImage(icons.img,
  new g.Size(10, 10),
  new g.Point(arr[0], arr[1]),
  new g.Point(5, 10)
  );
 return image;
}


function createMarker(point, CollectionSiteName, category, id, DumpSiteName, Vehicle, Mileage, Volume, Fuel, CollectionTime) {

  var g = google.maps;
  var image = shifter(icons[category]);
  var shadow = new g.MarkerImage(icons.img,
    new g.Size(10, 10),
    new g.Point(10, 10),
    new g.Point(5, 10)
	);

  var marker = new g.Marker({ position: point, map: map,
    title: name, clickable: true, draggable: false,
    icon: image//, shadow: shadow
  });

  // Store category, name, and id as marker properties
  marker.category = category;
  marker.CollectionSiteName = CollectionSiteName;
  marker.id = id;
  marker.DumpSiteName = DumpSiteName;
  marker.Vehicle = Vehicle;
  marker.Mileage = Mileage;
  marker.Volume = Volume;
  marker.Fuel = Fuel;
  marker.CollectionTime = CollectionTime;
  gmarkers.push(marker);

var html = "<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'>" +
                 "<tr bgcolor='#f0f0f0'><td style='font-weight:400; bold;text-align:left;font-size:1.0em;'>CollectionSite Information</td></tr>" +
                 "<tr bgcolor='#e0e0e0'><td style='font-weight:300; bold;text-align: left;font-size:0.7em;'><b>CollectionSiteName:<\/b></td> <td style='font-weight:300; bold;text-align: left;font-size:0.7em;'>"+ CollectionSiteName +"</td> </tr>" +
				 "<tr bgcolor='#f0f0f0'><td style='font-weight:300; bold;text-align: left;font-size:0.7em;'><b>DumpSiteName:<\/b></td> <td style='font-weight:300; bold;text-align: left;font-size:0.7em;'>"+ DumpSiteName +"</td> </tr>" +
                 "<tr bgcolor='#e0e0e0'><td style='font-weight:300; bold;text-align: left;font-size:0.7em;'><b>Vehicle:<\/b></td> <td style='font-weight:300; bold;text-align: left;font-size:0.7em;'>"+ Vehicle +"</td> </tr>" +
                 "<tr bgcolor='#f0f0f0'><td style='font-weight:300; bold;text-align: left;font-size:0.7em;'><b>Mileage:<\/b></td> <td style='font-weight:300; bold;text-align: left;font-size:0.7em;'>"+ Mileage +"</td> </tr>" +
				 "<tr bgcolor='#e0e0e0'><td style='font-weight:300; bold;text-align: left;font-size:0.7em;'><b>Volume:<\/b></td> <td style='font-weight:300; bold;text-align: left;font-size:0.7em;'> "+ Volume +"</td> </tr>" +
				 "<tr bgcolor='#f0f0f0'><td style='font-weight:300; bold;text-align: left;font-size:0.7em;'><b>Fuel:<\/b></td> <td style='font-weight:300; bold;text-align: left;font-size:0.7em;'>"+ Fuel +"</td> </tr>" +
				 "<tr bgcolor='#e0e0e0'><td style='font-weight:300; bold;text-align: left;font-size:0.7em;'><b>CollectionTime:<\/b></td> <td style='font-weight:300; bold;text-align: left;font-size:0.7em;'>"+ CollectionTime +"</td> </tr>" +
				 "<tr bgcolor='#f0f0f0'><td style='font-weight:300; bold;text-align: left;font-size:0.7em;'><b>Category:<\/b></td> <td style='font-weight:300; bold;text-align: left;font-size:0.7em;'>"+ category +"</td> </tr>" +
			"<\/table>";

  g.event.addListener(marker, "click", function() {
   iw.setContent(html);
   iw.open(map, this);
  });

  // Hovering over the markers
  g.event.addListener(marker, "mouseover", function() {
   marker.setIcon(shifter(icons.white));
   var hovered = document.getElementById(id);
   if (hovered) {
    hovered.className = "focus";
    actual = hovered; // Store this element
   }
  });

  g.event.addListener(marker, "mouseout", function() {
   marker.setIcon(shifter(icons[category]));
   if (actual) { actual.className= "normal"; }
  });
}


var hover = { // Hovering over the links
 over: function(i) {
  var marker = gmarkers[i];
  // Set another background color for the link
  var hovered = document.getElementById(marker.id);
  hovered.className = "focus";

  // Set another marker icon
  marker.setIcon(shifter(icons.white));
 },

 out: function(i) {
  var marker = gmarkers[i];
  // Set the default link background
  var hovered = document.getElementById(marker.id);
  hovered.className = "normal";

  // Set the default marker icon
  marker.setIcon(shifter(icons[marker.category]));
 }
};

var visible= { // Make a category (un)visible
 show: function(category) {
  // Show all markers of one category
  for(var i= 0, m; m = gmarkers[i]; i++) {
   if (m.category == category) {
    m.setVisible(true);
   }
  }
   // Set the checkbox to true
   document.getElementById(category).checked = true;
 },

 hide: function(category) {
  // Hide all markers of one category
  for(var i= 0, m; m = gmarkers[i]; i++) {
   if (m.category == category) {
    m.setVisible(false);
   }
  }
  // Clear the checkbox of a hidden category
  document.getElementById(category).checked = false;
  iw.close();
 }
};

 function boxclick(box, category) {

  // Hide or show the category of the clicked checkbox
  if (box.checked) { visible.show(category); }
  else { visible.hide(category); }

  // Rebuild the sidebar
  makeSidebar();
 }

 // Trigger the clicks from the sidebar to open the appropriate infowindow
 function triggerClick(i) {
  google.maps.event.trigger(gmarkers[i],"click");
 }


 // Rebuild the sidebar to match currently displayed markers
 function makeSidebar() {

  var oldheader;
  var html = "";
  for (var i= 0, m; m = gmarkers[i]; i++) {
   if (m.getVisible()) {

   var header = gmarkers[i].category;
   header = header.replace(/^./, header.charAt(0).toUpperCase());
    if (oldheader != header) html += "<b>"+ header+"s<\/b><br \/>";
    html += '<a id="'+ gmarkers[i].id+'" href="javascript:triggerClick('+i+')" onmouseover="hover.over('+i+')" onmouseout="hover.out('+i+')">' + gmarkers[i].CollectionSiteName + '<\/a><br \/>';
    oldheader = header;
   }
  }
  document.getElementById("sidebari").innerHTML = html;
 }


 function initialize(){  // Create the map
  var g = google.maps;
  var myLatlng = new g.LatLng(<?php echo $center; ?>); // value comes from php script
  var opts_map = {
    center: myLatlng,
    zoom: <?php echo $zoom; ?>,
	mapTypeControl: true,
	navigationControl: true,
    mapTypeId: g.MapTypeId.ROADMAP,

  mapTypeControlOptions: {
    mapTypeIds: [ g.MapTypeId.SATELLITE, g.MapTypeId.ROADMAP, g.MapTypeId.HYBRID],
	style: [google.maps.MapTypeControlStyle.DROPDOWN_MENU]
  },
  navigationControlOptions: {
     style: g.NavigationControlStyle.ZOOM_PAN
  }};

  map = new g.Map(document.getElementById("map"), opts_map);
  iw = new g.InfoWindow();

  g.event.addListener(map, "click", function() {
   if (iw) iw.close();
  });
  readData();
   addOverlayFromKML();
 }

 function addOverlayFromKML() {
    var samename;
    for (var i = 0; i<shapenumbers; i++) {
        if (thisshape[i] == "Polygon"){
            Shape[i] = new google.maps.Polygon({
                paths: jsfromphp[i],
                strokeColor: polygonlineColor,
                strokeOpacity: lineopacity,
                strokeWeight: polygonLineWeight,
                fillColor: fillcolor,
                fillOpacity: fillopacity
            });
            Shape[i].setMap(map);
        }
        if (thisshape[i] == "LineString"){
            Shape[i] = new google.maps.Polyline({
                path: jsfromphp[i],
                strokeColor: lineColor,
                strokeOpacity: opacity,
                strokeWeight: lineWeight
            });
            Shape[i].setMap(map);
        }
        if (thisshape[i] == "Point"){
            Shape[i] = new google.maps.Marker({
                position: jsfromphp[i],
                map: map,
                title: overlayname[i]
            });
        }
        addShapelistener(i);
    }
}
/*function createmarker (point,name,content) {
    var newmarker = new GMarker(point);
    GEvent.addListener(newmarker, "click", function() {
        newmarker.openInfoWindowHtml(name+'<br />'+content);
        });
    return newmarker;
}*/
function addShapelistener(i) {
    var shape = Shape[i];
    var infowindow = new google.maps.InfoWindow();
    google.maps.event.addListener(shape,'click',function(event){
        var html = '<b>' + overlayname[i] + '<br />' + description[i] + '</b>';
        infowindow.setContent(html);
        infowindow.setPosition(event.latLng);
        infowindow.open(map);
    });
}

function selectedradiobutton(i){
    if (thisshape[i] == "Point"){
        var infowindow = new google.maps.InfoWindow({
            content: '<b>' + overlayname[i] + '<br />' + description[i] + '</b>',
            position: jsfromphp[i]
        });
        infowindow.open(map);
    }else{
        repaint(); // if there is a shape with highlight colour, its colour will be shifted back to default colour
        Shape[i].setMap(null);
        Shape[i] = new google.maps.Polygon({
            paths: jsfromphp[i],
            strokeColor: polygonlineColor,
            strokeOpacity: lineopacity,
            strokeWeight: polygonLineWeight,
            fillColor: newfillColor,
            fillOpacity: fillopacity
        });
        Shape[i].setMap(map);
        curShape = i; // remember which number this shape has
    }
}
function repaint() {
    if (curShape > -1){
        Shape[curShape].setMap(null);
        Shape[curShape] = new google.maps.Polygon({
            paths: jsfromphp[curShape],
            strokeColor: polygonlineColor,
            strokeOpacity: lineopacity,
            strokeWeight: polygonLineWeight,
            fillColor: fillcolor,
            fillOpacity: fillopacity
        });
        Shape[curShape].setMap(map);
    }
}
function hideall() {
    //repaint(); // make sure all shapes have default colour before they are hidden
    for (var i=0; i<shapenumbers; i++){
        Shape[i].setMap(null);
    }
    curShape = -1; // no repaint neccessary on next click
}
function showall() {
    hideall();
    addOverlayFromKML();
}


function readData() { // Create Ajax request for XML

 var request;
 try {
   if (typeof ActiveXObject != "undefined") {
     request = new ActiveXObject("Microsoft.XMLHTTP");
   } else if (window["XMLHttpRequest"]) {
     request = new XMLHttpRequest();
   }
 } catch (e) {}

  request.open("GET", "site_map.php", true);
  request.onreadystatechange = function() {
  if (request.readyState == 4) {

   var xml = request.responseXML;
   var markers = xml.documentElement.getElementsByTagName("marker");
   for(var i = 0, m; m = markers[i]; i++) {
    // Obtain the attribues of each marker
    var lat = parseFloat(m.getAttribute("lat"));
    var lng = parseFloat(m.getAttribute("lng"));
    var point = new google.maps.LatLng(lat,lng);
    var DumpSiteName = m.getAttribute("DumpSiteName");
	var Vehicle = m.getAttribute("Vehicle");
	var Mileage = m.getAttribute("Mileage");
	var Volume = m.getAttribute("Volume");
	var Fuel = m.getAttribute("Fuel");
	var CollectionTime = m.getAttribute("CollectionTime");
    var id = m.getAttribute("nr");
    var CollectionSiteName = m.getAttribute("CollectionSiteName");
    var category = m.getAttribute("category");
    // Create the markers
    createMarker(point, CollectionSiteName,category, id, DumpSiteName, Vehicle, Mileage, Volume, Fuel, CollectionTime);
   }

  if(gmarkers) {

   // Sort categories and names to display
   // both in alphabetic order
   gmarkers.sort(compareCats);
  }
   // Show or hide a category initially
   visible.show("residential");
   visible.show("nonresidential");
   makeSidebar();
  }
 }; request.send(null);
}


var compareCats = function(a, b) {

 var n1 = a.name;
 // Treat German umlauts like non-umlauts
 n1 = n1.toLowerCase();
 n1 = n1.replace(/�/g,"a");
 n1 = n1.replace(/�/g,"o");
 n1 = n1.replace(/�/g,"u");
 n1 = n1.replace(/�/g,"s");

 var n2 = b.name;

 n2 = n2.toLowerCase();
 n2 = n2.replace(/�/g,"a");
 n2 = n2.replace(/�/g,"o");
 n2 = n2.replace(/�/g,"u");
 n2 = n2.replace(/�/g,"s");

 var c1 = a.category;
 var c2 = b.category;

 // Sort categories and names
 if(a.category == b.category){
  if(a.name == b.name){
   return 0;
  }
   return (a.name < b.name) ? -1 : 1;
 }

 return (a.category < b.category) ? -1 : 1;
}

    //]]>
    </script>
</body>
</html>
