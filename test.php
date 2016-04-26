<script type="text/javascript">
function newwin()
{
var params = "left=100px, top=300px, width=800px, height=500px";
newWin = window.open("http://ots.kh.ua/bbs1000/add_to_map.html", "_blank", params)
newWin.focus();
}
</script>

<input type=text name=lat id=lat><br>
<input type=text name=lon id=lon><br>
<a href="javascript:newwin()">MAP</a>
<script>

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
 if ($result === true){

        send_command($socket, '  show interface epon-olt  mac-address-table');
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
		echo "'".$str1."'";
		if ($i+1 < $count){ print ", "; } else {print '];'; }
		$i++;
	}
}

?>

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
alert(mac_array.length);
var count = mac_array.length;
var r=mac_array;
find_mac=0;
var find=['90:2b:34:e7:ee:00','Bc:5f:f4:84:ea:03'];
var countf = find.length;
alert (countf);
while (find_mac<countf){
	i=0;
	alert(find[find_mac]+" num");
	while (i<count){
		ii=false;
		ii  = CompStr(mac_array[i],find[find_mac]);
		if (ii==true) { alert("nashel: "+ mac_array[i]+ii+"\n iskal: " + find[find_mac] + "\nnum findmac"+find_mac); ii=false;}
		i++;
	}
	find_mac++;
}
</script>
