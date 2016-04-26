<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
<?php 
$out['data_test2']=$data2;
$DB_name="ots";
$DB_user="root";
$DB_password="SQLr00T";
$DB_server="localhost";
$dbh=mysql_connect($DB_server,$DB_user,$DB_password);
mysql_select_db($DB_name);

$SQL = " select * from `ots`.`gps_android`  ";
$res=mysql_query($SQL,$dbh);
print mysql_error();
$count=0;
while ($pl=mysql_fetch_array($res)){
	$id=$pl[id];
	$datetime=$pl[datetime];
	$type=$pl[type];
	$speed=$pl[speed];
	$lat=$pl[lat];
	$lon=$pl[lon];
	$acc=$pl[acc];
	$wc['lon'][$count]=$lon;
	$wc['lat'][$count]=$lat;
	$wc['speed'][$count]=$speed;
	$wc['datetime'][$count]=$datetime;
	$wc['type'][$count]=$type;
	$wc['acc'][$count]=$acc;
	$wc['id'][$count]=$id;
	$count++;
}
?>
var map;
function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 50.15, lng: 36.25},
    zoom:14
  }); 

 var flightPlanCoordinates = [ 
	<?php
	for ($i=0; $i<$count; $i++ ){
		if ($i != $count-1 )
		echo "{lat: ".$wc['lat'][$i].", lng: ".$wc['lon'][$i]."},\n";
		else
		echo "{lat: ".$wc['lat'][$i].", lng: ".$wc['lon'][$i]."}\n";

	}
	?>	
  ];

 var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
var labelIndex = 0;
// var bangalore = { lat: 50.15, lng: 36.25};
// var bangalore1 = {lat: 50.13, lng: 36.26};
// addMarker(bangalore, map);
// addMarker(bangalore1, map);
 for (var i = 0; i < flightPlanCoordinates.length; i++) {
    //addMarker(flightPlanCoordinates[i], map);
    addMarkerWithTimeout(flightPlanCoordinates[i], i * 200);
  }
 function addMarker(location, map) {
	labelIndex++;
  // Add the marker at the clicked location, and add the next-available label
  // from the array of alphabetical characters.
  var marker = new google.maps.Marker({
    position: location,
    label: labelIndex+"",
    map: map
  });
}

 var markers = [];
function addMarkerWithTimeout(position, timeout) {
  window.setTimeout(function() {
	labelIndex++;
    markers.push(new google.maps.Marker({
      position: position,
      map: map,
      animation: google.maps.Animation.DROP,
      label: labelIndex+"",
	title: "test"

    }));
  }, timeout);
}


  var flightPath = new google.maps.Polyline({
    path: flightPlanCoordinates,
    geodesic: true,
    strokeColor: '#FF0000',
    strokeOpacity: 1.0,
    strokeWeight: 2
  });

  flightPath.setMap(map);
}

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6CAoio6YeLkuTTNjOSv3yp8BRvYcuG5Q&callback=initMap"
        async defer></script>
  </body>
</html>
