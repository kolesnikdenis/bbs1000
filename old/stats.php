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
 //$read_continiue="";
 if ($result === true) {
 	echo ("auth success<br>");

	$olt=$_REQUEST["olt"];
	$onu=$_REQUEST["onu"];

	if ( ($olt) && ($olt) && ($onu)  ) {
	 $read_continiue="";
	 $cmd="show interface epon-olt $olt onu $onu brief";
	 echo "".$cmd."<br>";
	 send_command($socket, $cmd );
	 global $read_continiue;
	 $arr=array();
	 $arr1=array();
	 //$read_continiue = preg_replace("/[\r\n]+/i", "<br>", $read_continiue);
	 $vir="#($olt )(.*?)(\r\n)#isu";
	 preg_match_all($vir, $read_continiue, $arr);
	 //var_dump($arr);
	 $s=$arr[0][1];
	 preg_match_all('/[^ ]+/',$s, $arr1);
	 //var_dump($arr1);

	 if ($arr1[0][4] == "Registered") {
	 	echo "<table border=1> <tr><td>клиентское оборудование c физическим адресом</td><td>"." <b>".$arr1[0][5] ."</b></td></tr>
		 <tr><td>состояние:</td><td> <font color=green>включено</font> <b></td></tr>".
		 "<tr><td>время online:</td><td>".$arr1[0][9]."</b> дней и <b>".$arr1[0][11] ."</b> часов </td></tr>".
		"</table>";

		 $read_continiue="";
		 $cmd=" show interface epon-olt $olt  onu $onu mac-address-table";
		 echo "show comand:".$cmd."<br>";
		 send_command($socket, $cmd );
		 global $read_continiue;
		 $vir="#(----\r\n)(.*?)(telnet)#isu";
		 preg_match_all($vir, $read_continiue, $arr);
		 $s=$arr[2][0];
		 preg_match_all('/[^\r\n]+/',$s, $arr);
		 //var_dump($arr);
		 $num=count($arr[0]);
		 $i=0;
		 echo "мак адреса на этом ону устройстве:";
		 echo "<table border=1><tr><td>фсп модуль(olt)</td><td>onu</td><td>num</td><td>mac</td></tr>";
		 while($num > $i ){
		 	$s=$arr[0][$i];
		 	preg_match_all('/[^ ]+/',$s, $arr1);
		 	echo "<tr><td> ".$arr1[0][1]."</td><td>".$arr1[0][2]."</td><td>".$arr1[0][0]."</td><td>".$arr1[0][6]."</td></tr>";
			$i++;
		 } // while
		 echo "</table>";

	 	 $read_continiue="";
		 $cmd=" show interface epon-olt $olt onu $onu  summary";
		 echo "show comand:".$cmd."<br>";
		 send_command($socket, $cmd );
		 global $read_continiue;
		 $vir="#(----\r\n)(.*?)(telnet)#isu";
		 preg_match_all($vir, $read_continiue, $arr);
		 $s=$arr[2][0];
		 preg_match_all('/[^\r\n]+/',$s, $arr);
		 $num=count($arr[0]);
		 $i=0;
		 echo "данные по зарегистрированной ONU <br>";
		 //var_dump($arr);
		 echo "<table border=1><tr><td>перемененная</td><td>значение</td></tr>";
		 while($num > $i ){
		 	$s=$arr[0][$i];
		 	preg_match_all('/[^=]+/',$s, $arr1);
		 	//var_dump($arr1);
		 	if ( $i < 6) {
		 		if ( ($i <= 2) || ($i == 6) ) {
		 			echo "<tr><td>".$arr1[0][0]."</td><td><font color=gneen><b>".$arr1[0][1]."</b></font></td></tr>";
		 		}else {
		 			echo "<tr><td>".$arr1[0][0]."</td><td>".$arr1[0][1]."</td></tr>";
		 		}
		 	}
			$i++;
		}
		echo "</table>";
		 //$read_continiue = preg_replace("/[\r\n]+/i", "<br>", $read_continiue);
		 //echo "ответ от головы:<br>\n"; print_r($read_continiue); echo "\n<br><center><hr width=50%></center><br>";



		 $read_continiue="";
		 $cmd=" show interface epon-olt $olt  onu $onu statistics";
		 echo "show comand:".$cmd."<br>";
		 send_command($socket, $cmd );
		 global $read_continiue;
		 $vir="#(\r\n\r\n)(.*?)(telnet)#isu";
		 preg_match_all($vir, $read_continiue, $arr);
		 //var_dump($arr);
		 $s=$arr[0][0];
		 preg_match_all('/[^\r\n]+/',$s, $arr);
		 $num=count($arr[0]);
		 $i=0;
		 echo "данные статистики абонента ONU <br>";
		 echo "<table border=1><tr><td>перемененная</td><td>значение</td></tr>";
		 while($num > $i ){
		 	$s=$arr[0][$i];
		 	preg_match_all('/[^=]+/',$s, $arr1);
		 	if ($i == 0) { echo "<tr><td><b>Системные пакеты</b></td><td>-</td></tr>"; }
		 	if ($i == 14) { echo "<tr><td><b>пакеты Pon</b></td><td>-</td></tr>"; }
		 	if ( ( $i > 0 ) && ( $i <  5)  ||  ($i > 14) && ( $i < 19 )) {
		 		$s=$arr1[0][0];
		 		$res=$arr1[0][1];
		 		$s=preg_replace("/[.]+/i", "", $s);
		 		if(preg_match('/Err/i',$s)){ $s="<font color=red>".$s."</font>"; $res="<font color=red>".$res."</font>";}
		 		if(preg_match('/OK/i',$s)){ $s="<font color=green>".$s."</font>"; $res="<font color=green>".$res."</font>";}
		 		echo "<tr><td>".$s."</td><td>".$res."</td></tr>";
		 	}
			$i++;
		}
		echo "</table>";

	}
	else {
		echo "ONU клиента <font color=red>выключено</font> или <font color=red>нет связи!!</font>";
	}


	 }
	}
 else
	 echo ("auth failed");





 function read_olt($str,$olt)
{
	 $arr = array();
	 $arr1 = array();
	 //$arr_free=array();
	 $out="";
	 $i=0;

		preg_match_all('#(onu )(.*?)(  exit)#isu', $str, $arr);
		$count = count($arr[0]);
		while ($i < $count)	{
			$s=$arr[0][$i];
			//$out.=$s."<br>";
			preg_match_all('/[^ ]+/',$s,$arr1);
			$onunum = preg_replace("/[ \"\r\n]+/i", "", $arr1[0][1]);
			$description= preg_replace("/[ \"\r\n]/i", "",$arr1[0][4]);
			$mac= preg_replace("/[ \"\r\n]+/i", "",$arr1[0][8]);

			$arr_free[$onunum]=$description;
			$out.= "onu #\"<b><font color=red>".$onunum."</font></b>\"<Br>";
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
 	//echo "start<br>";
	 while ($out = socket_read($socket, 2048))
	 {
	 	if(preg_match('/Username:/i',$out)){
	 	//echo $out;
		return (true);
		}
	 }
	 //echo "end<br>";
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
