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

var map;
function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 50.15, lng: 36.25},
mapTypeId: google.maps.MapTypeId.SATELLITE,
    //scrollwheel: false,
    zoom:14,
  }); 
var beaches1=[

<?php

$DB_name="abills_russkaya";
$DB_user="root";
$DB_password="SQLr00T";
$DB_server="localhost";
$dbh=mysql_connect($DB_server,$DB_user,$DB_password);
mysql_select_db($DB_name);

$SQL = "
select  users.id,users.credit,users.disable,users.bill_id,users_pi.uid,users.deleted, bills.deposit,users_pi.fio,users_pi._lon , users_pi._lat, dhcphosts_hosts.mac, users_pi.comments               from                         users, bills, users_pi,dhcphosts_hosts     where LENGTH(users_pi._lat) >3 and
                        bills.id = users.bill_id and users_pi.uid = users.uid and dhcphosts_hosts.uid= users.uid";
mysql_query ('SET NAMES Utf8',$dbh);
$i=0;
$res=mysql_query($SQL,$dbh);
print mysql_error();
while ($pl=mysql_fetch_array($res)){
	$i++;
	if ($i==1) { $add=""; }
	else {$add =","; }
	print $add."\n";
        $id=$pl[id];
        $credit=$pl[credit];
        $bill_id=$pl[uid];
        $disable=$pl[disable];
        $deleted=$pl[deleted];
        $deposit=$pl[deposit];
        $fio=$pl[fio];
	$lat=$pl[_lat];
	$lon=$pl[_lon];
	$comments=$pl[comments];
	$macc_ip=$pl[mac];
	preg_match("/ONU:\"([^\"]+)}*/i", $comments, $mac);
	if (strlen($mac[1])>3 && strlen($macc_ip)>3) { $mac_user="'".$mac[1].",".$macc_ip."'"; }
	if (strlen($mac[1])>3 && strlen($macc_ip)<3) { $mac_user="'".$mac[1]."'"; }
	if (strlen($mac[1])<2 && strlen($macc_ip)>2)  { $mac_user="'".$macc_ip."'"; }
	if (strlen($mac[1])<2  && strlen($macc_ip)<2) { $mac_user="'"."'"; }

	#print "['".$id."<br>".$deposit."', ".$lat.", ".$lon.",".$mac_user.",". "0, '1/1', '0']";
	print "['".$id."<br>".$deposit."', ".$lat.", ".$lon.",".$mac_user.",". "0]";
	#print "['".$id."', ".$lat.", ".$lon.",".$mac_user.",". "0]";
}
?>

];




//zagruzka dannih mac s bbs1000
<?php
include "libbary.php";
 error_reporting(E_ALL);
 set_time_limit(5);
 ob_implicit_flush();
 $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
 socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array("sec" => 30, "usec" => 0));
 $result = socket_connect($socket, '10.232.100.3', '23');
 read_welcome_message($socket);
 $result = send_login($socket, 'admin');
 $result = send_passw($socket, '4627972');
 $read_continiue="";
  session_start();
 $_SESSION['nick']="";
global $onustat;
$sfp = array();
$num_onu_sfp= array();
 if ($result === true){

        send_command($socket, '  show int epon mac-address-table');
        global $read_continiue;
        $read_continiue=str_replace('Press any key to continue (Q to quit)',"",$read_continiue);
        $read_continiue=str_replace("\r\n","<br>",$read_continiue);
        preg_match_all('#(<br> )(.*?)(Dynamic)#isu', $read_continiue, $arr);
        $i=0;
        $count = count($arr[0]);
        echo "var mac_array=[";
        while ($i < $count)    {
                #$onunum = preg_replace("/\"\r\n]+/i", "", $arr2[4]);
                $str=$arr[0][$i];
                #$del_prob=str_replace("  ","",$str);
                $del_prob = explode("  ", $str);
                $str1=substr($str,59-14,17);
		
		$sfp[]=substr($str,12,3);
		$num_onu_sfp[]=str_replace(' ',"",substr($str,18,2));

                echo "'".$str1."'";
                if ($i+1 < $count){ print ", "; } else {print '];'; }
                $i++;
        }
}
$i=0;
echo "
var sfp_array=[";
while ($i<count($sfp)){
	echo "'".$sfp[$i]."'";
                if ($i+1 < count($sfp)){ print ", "; } else {print '];'; }
                $i++;
        }

$i=0;
echo "
var num_onu_sfp_array=[";
while ($i<count($num_onu_sfp)){
        echo "'".$num_onu_sfp[$i]."'";
                if ($i+1 < count($num_onu_sfp)){ print ", "; } else {print '];'; }
                $i++;
        }

?>

//dlya sravneniya mac-adress

function fUpperCase(Str)
{
var Buf = '';
for(var i=0; i<Str.length; i++)
        if(Str.charAt(i)>='a' && Str.charAt(i)<='z' || Str.charAt(i)>='A' && Str.charAt(i)<='Z')
                Buf = Buf + Str.charAt(i).toUpperCase();
        else
                Buf = Buf + Str.charAt(i);
return(Buf);
}
function CompStr(Str, Str2)
{
        return fUpperCase(Str.toString())==fUpperCase(Str2.toString());

}




// rabotaem s masivom vibranim s billnig i s bbs1000
var count = mac_array.length;
find_mac=0;
i=0;
count_user=beaches1.length;
while ( i < count_user ){
	var work_user=beaches1[i];
	//alert( work_user[0] );
	if (work_user[3].length> 20) {
		var arr_mac = work_user[3].split(',');
	}
	else { 
		var arr_mac=[];
		arr_mac[0]=work_user[3]; 
	}
	test_num_user_mac=0;
	while (test_num_user_mac < arr_mac.length) {
		ii=0;
		while (ii<count){
			iii=false;
			//alert(mac_array[ii]+" "+arr_mac[test_num_user_mac]);
			iii =  CompStr(mac_array[ii],arr_mac[test_num_user_mac]);
			if (iii==true){ 
				//alert("nashel: "+ mac_array[ii]+iii+"\n iskal: " + arr_mac[test_num_user_mac] + "\nnum findmac"+ii+"\nuser: "+work_user[0]); 
				
				//work_user[4]=1;
				//alert(beaches1[i][0] + " " + beaches1[i][4]);
				beaches1[i][4]=1;
				//beaches1[i][5] = sfp_array[ii];
				//beaches1[i][6] = num_onu_sfp_array[ii];
				beaches1[i][0] = beaches1[i][0] + "<br>Num onu vetke:<b>"+num_onu_sfp_array[ii]+"</b><br>sfp:<b>"+sfp_array[ii]+"</b>";
				//alert(beaches1[i][0] + " " + beaches1[i][4]);
				iii=false; 
				ii=count+1; 
				test_num_user_mac=arr_mac.length+1;
			}
			else { 
				//if ( work_user[0] == "pustovoitov" ){  alert("NO "+ mac_array[ii]+iii+"\n iskal: " + arr_mac[test_num_user_mac] + "\nnum findmac"+ii+"\nuser: "+work_user[0]); }
			}
                	ii++;
        	}
		test_num_user_mac++;
	
	}

	i++;

}

 var flightPlanCoordinates = [
	{lat: 50.254, lng: 36},
	{lat: 50.25, lng: 36},
	{lat: 50.256046295166016, lng: 35.22},
	{lat: 50.257304644304, lng: 35.21}
  ]




setMarkers(map);

function setMarkers(map) {
  var shape = {
    coords: [1, 1, 1, 20, 18, 20, 18, 1],
    type: 'poly'
  };
  for (var i = 0; i < beaches1.length; i++) {
    var beach = beaches1[i];
        if (beach[4] == 1) {
                var image = {
                url: 'images/on.png',
                size: new google.maps.Size(20, 32),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(0, 32)
                };
             }
        else {
                var image = {
                url: 'images/off.png',
                size: new google.maps.Size(20, 32),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(0, 32)
                };
             }
    var marker = new google.maps.Marker({
      position: {lat: beach[1], lng: beach[2]},
      map: map,
      icon: image,
      shape: shape,
      title: beach[0]
    });
	attachSecretMessage(marker,beach[0]);

  }
}
function attachSecretMessage(marker, secretMessage) {
  var infowindow = new google.maps.InfoWindow({
    content: secretMessage
  });

  marker.addListener('click', function() {
    infowindow.open(marker.get('map'), marker);
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
      label: labelIndex+""

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
