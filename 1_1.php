<META http-equiv="content-type" content="text/html; charset=windows-1251">
	<head>
		<style type="text/css">
			td {
				color: green;
			}
		</style>
<script type="text/javascript">
  function a() {
    c();
    b();
}

  function b() {
    //show_save_max_1();
  }
  function c() {
     show_bbsclinent();

  }
</script>
</head>
<body onload="a()">
</body>

<link href="bbs.css" type="text/css" rel="stylesheet">
<META http-equiv=Content-Type content="text/html; charset=windows-1251">
<script language=JavaScript src=lib/JsHttpRequest/JsHttpRequest.js></script>
<script language=JavaScript src=comm.js></script>

<A href=onu-unbaund.php>onu-unbaunt</a><br>
<A href=show_config.php>show config</a><br>
<?php
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
 	echo ("auth success");
	 send_command($socket, 'en');


	 echo "<table border=1 width=100%>";
	 echo "<tr><td>все ИПы и маки что видит голова</td></tr>";

	 echo "<tr><td>";
	 send_command($socket, ' show host-route');
	 global $read_continiue;
	 $read_continiue=str_replace('Press any key to continue (Q to quit)',"",$read_continiue);
	 $read_continiue=str_replace("\r\n","<br>",$read_continiue);
	 echo $read_continiue;

	 echo "</td></tr>";
 $read_continiue="";


	 send_command($socket, 'show interface epon-olt 1/1 statistics');
     readstatolt($read_continiue,"1/1");
     	 $read_continiue="";
	 send_command($socket, 'show interface epon-olt 1/2 statistics');
     readstatolt($read_continiue,"1/2");
     	 $read_continiue="";
	 send_command($socket, 'show interface epon-olt 1/3 statistics');
     readstatolt($read_continiue,"1/3");
     	 $read_continiue="";
	 send_command($socket, 'show interface epon-olt 1/4 statistics');
     readstatolt($read_continiue,"1/4");
     	 $read_continiue="";
	 send_command($socket, 'show interface epon-olt 2/1 statistics');
     readstatolt($read_continiue,"2/1");
     	 $read_continiue="";
	 send_command($socket, 'show interface epon-olt 2/2 statistics');
     readstatolt($read_continiue,"2/2");
     	 $read_continiue="";
	 send_command($socket, 'show interface epon-olt 2/3 statistics');
     readstatolt($read_continiue,"2/3");
     	 $read_continiue="";
	 send_command($socket, 'show interface epon-olt 2/4 statistics');
     readstatolt($read_continiue,"2/4");
     	 $read_continiue="";


	 echo "<tr><td>все маки которые есть на BBS 1000</td></tr><tr>";
	 $read_continiue="";
	 send_command($socket, 'show interface epon-olt mac-address-table');


	 echo "<td>"; echo read_all_mac($read_continiue,""); echo "</td>";
	 $read_continiue="";

	 //echo "<table border=1 width=100%><tr><td>неавторизированные ону</td></tr><tr>";
	 //$read_continiue="";
	 //send_command($socket, 'show interface epon-olt onu-unbound');
	 //global $read_continiue;
 	 //echo "<td>"; echo $read_continiue; echo "</td></table>";

	/*echo "<table width=100% border=1><tr><td>olt1/1</td><td>olt1/2</td><td>olt1/3</td><td>olt1/4</td></tr><tr>";
 	$read_continiue="";
	 send_command($socket, 'show configuration interface epon-olt 1/1 onu');
	 global $read_continiue;
 	 //var_dump($read_continiue);
	 echo "<td>"; echo read_olt($read_continiue,"1/1"); echo "</td>";
	 global $read_continiue;
	 $read_continiue="";
	 send_command($socket, 'show configuration interface epon-olt 1/2 onu');
	 global $read_continiue;
 	 echo "<td>"; echo read_olt($read_continiue,"1/2"); echo "</td>";
	 $read_continiue="";
	 send_command($socket, 'show configuration interface epon-olt 1/3 onu');
	 global $read_continiue;
 	 echo "<td>"; echo read_olt($read_continiue,"1/3"); echo "</td>";
	 $read_continiue="";
	 send_command($socket, 'show configuration interface epon-olt 1/4 onu');
	 global $read_continiue;
	 echo "<td>";  echo read_olt($read_continiue,"1/4"); echo "</td>";	 //send_command($socket, 'shut');


	echo "</tr><tr><td>olt2/1</td><td>olt2/2</td><td>olt2/3</td><td>olt2/4</td></tr><tr>";
	 $read_continiue="";
	 send_command($socket, 'show configuration interface epon-olt 2/1 onu');
	 global $read_continiue;
 	 //var_dump($read_continiue);
	 echo "<td>"; echo read_olt($read_continiue,"2/1"); echo "</td>";
	 global $read_continiue;
	 $read_continiue="";
	 send_command($socket, 'show configuration interface epon-olt 2/2 onu');
	 global $read_continiue;
 	 echo "<td>"; echo read_olt($read_continiue,"2/2"); echo "</td>";
	 $read_continiue="";
	 send_command($socket, 'show configuration interface epon-olt 2/3 onu');
	 global $read_continiue;
 	 echo "<td>"; echo read_olt($read_continiue,"2/3"); echo "</td>";
	 $read_continiue="";
	 send_command($socket, 'show configuration interface epon-olt 2/4 onu');
	 global $read_continiue;
	 echo "<td>";  echo read_olt($read_continiue,"2/4"); echo "</td>";	 //send_command($socket, 'shut');

	echo "</tr><table>";
	 */socket_close($socket);
}
 else

	 echo ("auth failed");



function random_html_color()
{
    return sprintf( '#%02X%02X%02X', rand(0, 255), rand(0, 255), rand(0, 255) );
}
function str2bin($str)
{
    $out=false;
    for($a=0; $a < strlen($str); $a++)
    {
        $dec = ord(substr($str,$a,1)); //determine symbol ASCII-code
        $bin = sprintf('%08d', base_convert($dec, 10, 2)); //convert to binary representation and add leading zeros
        $out .= $bin;
    }
    return $out;
}

function readstatolt($str,$stat_olt){
	global $onustat;
	$out="";
	//var_dump($str);
	$str=str_replace('Press any key to continue (Q to quit)',"",$str);
	$str=str_replace("Record  OLT   LPort  ONU id  LLID  VID   Mac_Address        Type","",$str);

	$str=str_replace('-------------------------------------------------------------------',"\r\n",$str);
	$str= str_replace(" ", "" ,$str );
	$arry = explode("\r\n",$str);
	$i=0;
	$count = count($arry);
	$onustat[$stat_olt] = "<table width=100%>";
	while ($i <= $count)	{
		$s=$arry[$i]."-";
		//print $s."$i<br>";
		preg_match_all('#(=)(.*?)(-)#isu', $s, $arr);
		//print_r($arr);
		//print $arr[2][0]." - $i<br>";
		if ($i == 19) { $onustat[$stat_olt] .= "<tr><td>TX OK:</td><td>".$arr[2][0]."</td></tr>"; }
		if ($i == 20) { $onustat[$stat_olt] .= "<tr><td>RX OK:</td><td>".$arr[2][0]."</td></tr>"; }
		if ($i == 21) { $onustat[$stat_olt] .= "<tr><td class=red>TX Err:</td><td class=red>".$arr[2][0]."</td></tr>"; }
		if ($i == 22) { $onustat[$stat_olt] .= "<tr><td class=red>RX Err:</td><td class=red>".$arr[2][0]."</td></tr>"; }

		$i++;
	} // while
	$onustat[$stat_olt].= "</tr><td></td><td><A href=\"find_free_onu.php?epon_num=$stat_olt\">find free</a></td></tr></table>";
	//var_dump($onustat);
	//return $out;

}



 function read_all_mac($str,$olt)
{

	$arr = array();
	$arr1 = array();
	//$arr_free=array();
	$out="";
	$str=str_replace('Press any key to continue (Q to quit)',"",$str);
	$str=str_replace("Record  OLT   LPort  ONU id  LLID  VID   Mac_Address        Type","",$str);

	$str=str_replace('-------------------------------------------------------------------',"\r\n",$str);
	//$str=str_replace('                                       ',"",$str);
	preg_match_all('#(\r\n)(.*?)(Dynamic)#isu', $str, $arr);
		//var_dump($str);
		//var_dump($arr);
		$onunum_last=1;
		$onunum=0;
		$i=0;
		$olt="";
		$olt1="";$olt2="";$olt3="";$olt4="";$olt5="";$olt6="";$olt7="";$olt8="";
		$count = count($arr[0]);
		$div="";
		//echo "-".$arr[0][0]."-<br>";

		echo "count: $count <br>";
		while ($i <= $count)	{
			$s="";
			$s=$arr[0][$i];

			$onunum_last = $onunum_last1;
			$s= str_replace("\r\n", "" , $s );
			$s= str_replace("\r", "" , $s );
			$s= str_replace("\n", "" , $s );
			$s= str_replace("\t", "" , $s );
			$s= str_replace("\0", "" , $s );
			//$s= str_replace("   ", "" , $s );
			//print "\$i $i -- \"$s\"<br>\r\n";
			preg_match_all('/[^ ]+/',$s,$arr1);

			$arr2=$arr1[0];
			$onunum = preg_replace("/[ \"\r\n]+/i", "", $arr2[4]);
			$mac= preg_replace("/[ \"\r\n]+/i", "",$arr2[6]); //тут все проходят
			$olt = preg_replace("/[ \"\r\n]+/i", "",$arr2[1]);
			$record= preg_replace("/[ \"\r\n]+/i", "",$arr2[0]);
			//global $array_onu;
			//print "--onunum".$onunum."-".$olt."-- = ".$array_onu[$mac]["id"]." - ".$mac." - ".$onunum." - ".$olt;
			//if ($array_onu[$mac]["id"] ) {
			//	print "--onunum".$onunum."-".$olt."-- = ".$array_onu[$mac]["id"]." - ".$mac." - ".$onunum." - ".$olt;
			//}
			$onunum_last1 = $onunum_last;


			$div.='<a href=stats.php?olt='.$olt.'&onu='.$onunum.'><div id="'.$mac.'"></div></a> ';

			if ($onunum_last1 === $onunum ) {
				$add ='<span style="background: ' . random_html_color() . '">'.$mac;
				$add2="<br>$div<br></span>";
				$div="";
				//if (strlen($array_onu[$mac]["id"]) >3 ) { $_SESSION['nick']=$array_onu[$mac]["id"]; print "-- назначаю "; if ($olt == "1/1") { $olt1=str_replace("--onunum".$onunum."-".$olt."--",  $_SESSION['nick']."-r" ,$olt1  ); };}

			}
			else {
				/* find onu utstarcom */
				$mac_arr = explode(":", $mac);
				$mac_arr= $mac_arr[0].":".$mac_arr[1].":".$mac_arr[2];
				if ($mac_arr == "00:07:ba") { $type_onu="ut";	} else { $type_onu="";}
				/* end utstarcom */

				$add ='<br><span style="background: #ffffff">ONU: <br>'.$mac. " ". $type_onu;
				$divv="";
				$add2="</span><br>";
				//if (strlen($array_onu[$mac]["id"]) >3 ) { $_SESSION['nick']=$array_onu[$mac]["id"]; print "-- назначаю "; if ($olt == "1/1") { $olt1=str_replace("--onunum".$onunum."-".$olt."--",  $_SESSION['nick']."-r" ,$olt1  ); };}


			}

			//print "<br>";


			if ($olt == "1/1") {  $olt1 .=  $add."-".$add2; }
			if ($olt == "1/2") {  $olt2 .=  $add."-".$add2; }
			if ($olt == "1/3") {  $olt3 .=  $add."-".$add2; }
			if ($olt == "1/4") {  $olt4 .=  $add."-".$add2; }
			if ($olt == "2/1") {  $olt5 .=  $add."-".$add2; }
			if ($olt == "2/2") {  $olt6 .=  $add."-".$add2; }
			if ($olt == "2/3") {  $olt7 .=  $add."-".$add2; }
			if ($olt == "2/4") {  $olt8 .=  $add."-".$add2; }
			$_SESSION['nick']="";
			$i++;

			//if ($type_onu == "ut") {
			$onunum_last1=$onunum;

			//}

		}
		$i=1;
		$out .="<br>free onu:<br>";

		global $onustat;
		echo "<table border=1 width=100%><tr><td>1/1<br>".$onustat["1/1"]."</td><td>1/2<br>".$onustat["1/2"]."</td><td>1/3<br>".$onustat["1/3"]."</td><td>1/4<br>".$onustat["1/4"]."</td><td>2/1<br>".$onustat["2/1"]."</td><td>2/2<br>".$onustat["2/2"]."</td><td>2/3<br>".$onustat["2/3"]."</td><td>2/4<br>".$onustat["2/4"]."</td></tr>
				      <tr><td>$olt1</td><td>$olt2</td><td>$olt3</td><td>$olt4</td><td>$olt5</td><td>$olt6</td><td>$olt7</td><td>$olt8</td></tr></table>";
		//while ($i < 64){ if (@$arr_free[$i] == "") { $out.="<a href=\"add_olt.php?olt=$olt&onu=$i\">$i</a>, "; } $i++;}

		return $out;
}



 function read_olt($str,$olt)
{
	 $arr = array();
	 $arr1 = array();
	 //$arr_free=array();
	 $out="";
	 $i=0;
	$str=str_replace('Press any key to continue (Q to quit)'."","",$str);
	$str=str_replace('                                       ',"",$str);

	preg_match_all('#(onu )(.*?)(  exit)#isu', $str, $arr);

//		var_dump($str);
		$count = count($arr[0]);
		while ($i < $count)	{
			$s=$arr[0][$i];
			//$out.=$s."<br>";
			//var_dump($s);
			preg_match_all('/[^ ]+/',$s,$arr1);
			$onunum = preg_replace("/[ \"\r\n]+/i", "", $arr1[0][1]);
			$description= preg_replace("/[ \"\r\n]/i", "",$arr1[0][4]);
			$mac= preg_replace("/[ \"\r\n]+/i", "",$arr1[0][8]);

			$arr_free[$onunum]=$description;
			$out.= "onu #\"<b><font color=red>".$onunum."</font></b> \ <a href=\"edit_onu.php?olt=$olt&onu=$onunum&task=select_edit\">редактировать</a> \ <a href=\"stats.php?onu=$onunum&olt=$olt\">детали</a> \ <a  onclick=\"return confirm('Удалить клиента??')\"  href=\"del.php?olt=$olt&onu=$onunum&task=del\">удалить</a><Br>";
			$out.= "description:\"<b><font color=red>".$description."</font></b>\"<Br>";
			$out.= "mac:\"<b><font color=red>".$mac."</font></b>\"<Br>";
			$i++;
		}
		$i=1;
		$out .="<br>free onu:<br>";
		while ($i < 64){ if (@$arr_free[$i] == "") { $out.="<a href=\"add_olt.php?olt=$olt&onu=$i\">$i</a>, "; } $i++;}
		return $out;
}

 function read_welcome_message($socket)
 {
 	echo "start<br>";
	 while ($out = socket_read($socket, 2048))
	 {
	 	$ii=strpos($out, "rname:");
	 	//print $ii;
	 	//if(preg_match('/^sername:/',$out)){
	 	//echo "\"".$out."\"";
	 	//return (true);
	 	//}
	 	print $out.$ii;
		if ($ii>0) {
			print "do";
			return (true);
			print "posle";
		}

	 }
	 echo $ii . "end<br>";
 }

 function send_login($socket, $username)
 {
 	socket_write($socket, $username . "\r\n", strlen($username) + 2);

	 while ($out = socket_read($socket, 2048))
	 {
	 	if(preg_match('/Password:/i',$out)){
	 	//echo $out;
		return (true);
		}
	 }
 }

 function send_passw($socket, $password)
 {
	 socket_write($socket, $password . "\r\n", strlen($password) + 2);
 	while ($out = socket_read($socket, 2048))
 	{
 	if(preg_match('/>/i',$out)){
	 	//echo $out;
		return (true);
		}
 	if(preg_match('/sername:/i',$out))
 		return(false);
 	}
 }

function send_command($socket, $command)
 {
 	socket_write($socket, $command . "\r\n", strlen($command) + 2);
 	if ($command == "save") {
 		sleep(5);
 		echo "тут сохранение сэйв-5<br>";
 	}
//sleep(1);
 //$out = socket_read($socket, 2048);
 $out="";
$result=0;
$i=0;
 while ($result != 1 )
 {
 	$i++;
	///$read_continiue .="до<br>";
 	$out .= socket_read($socket, 2048);
 	//$read_continiue .="запрос номер ($i)<br>";
	 //if(preg_match('/\+# /i',$out)){
	 if(preg_match('/BBS1000/i',$out)){
	 	//echo "out:".$out."<br>";
	 	global $read_continiue;
		$read_continiue .=$out;
		//$read_continiue .="окончания запроса";
		 //$read_continiue="";
		 $result=1;
	 	return (true);
		}
	if(preg_match('/Press any key to continue/i',$out)){
	    global $read_continiue;
	 	$read_continiue .= $out;
	 	//$read_continiue .="было продолжение!!";
	 	//	$result=1;
	 	send_command($socket, ' ');
		return (true);
		}
 }
}
 ?>
