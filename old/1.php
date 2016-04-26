<META http-equiv="content-type" content="text/html; charset=windows-1251">
<?php
 //error_reporting(E_ALL);
 set_time_limit(5);
 ob_implicit_flush();
 $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
 socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array("sec" => 30, "usec" => 0));
 $result = socket_connect($socket, '10.232.100.3', '23');
 read_welcome_message($socket);
 $result = send_login($socket, 'admin');
 $result = send_passw($socket, '46_27972');
 $read_continiue="";




	$DB_name1="abills_russkaya";
	$DB_user1="kolesnik";
	$DB_password1="48wqlf23nA";
	$DB_server1="localhost";

	$dbh1=mysql_connect($DB_server1,$DB_user1,$DB_password1);
	mysql_select_db($DB_name1);
	mysql_query("SET character_set_connection=utf8",$dbh1);
	mysql_query("SET character_set_client=utf8",$dbh1);
	mysql_query("SET character_set_results=utf8",$dbh1);

	$array_onu=@array();

	$sql= "SELECT users_pi.uid, users_pi.fio, users_pi.comments, users.id FROM  `users_pi` ,  `users` WHERE comments !=  '' AND  `users_pi`.`uid` =  `users`.`uid` ";
	$res1=mysql_query($sql,$dbh1);
	print mysql_error();
	while ($pl=mysql_fetch_array($res1)){

		$comments= $pl[comments];
		$comments1=$comments;
		//echo $uid."<br>";
		preg_match("/ONU:\"([^\"]+)}*/i", $comments, $mac);
		//var_dump($mac);
		$mac_f=$mac[1];
		if ($mac) {
			//echo "<B>".$comments." MAC ONU:" .$mac_f.$pl[id].$pl[fio]." </b><br><br>";
			$array_onu[$mac_f]["fio"]=$pl[fio];
			$array_onu[$mac_f]["uid"]=$pl[uid];
			$array_onu[$mac_f]["id"]=$pl[id];

		}//else
		//echo "-c-: ".$comments1." <br><br>";
	}





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


	 echo "<tr><td>все маки которые есть на BBS 1000</td></tr><tr>";
	 $read_continiue="";
	 send_command($socket, ' show interface epon-olt   onu brief');
	 global $read_continiue;
 	 //echo "<td>"; echo $read_continiue; echo "</td></table>";
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
	preg_match_all('#(\r\n)(.*?)(00.00.00.00)#isu', $str, $arr);

		//var_dump($str);
		//var_dump($arr);
		$onunum_last=1;
		$onunum=0;
		$i=1;
		$olt="";
		$olt1="";$olt2="";$olt3="";$olt4="";$olt5="";$olt6="";$olt7="";$olt8="";
		$count = count($arr[0]);
		//echo "-".$arr[0]."-<br>";


		echo "count: $count <br>";
		while ($i < $count)	{
			$s="";
			$s=$arr[0][$i];
			//var_dump($s);
			$onunum_last = $onunum_last1;

			preg_match_all('/[^ ]+/',$s,$arr1);
			//var_dump($arr1);
			$onunum = preg_replace("/[ \"\r\n]+/i", "", $arr1[0][1]);
			//$onunum= $onunum -1;
			 $mac= preg_replace("/[ \"\r\n]+/i", "",$arr1[0][5]);
			$olt = preg_replace("/[ \"\r\n]+/i", "",$arr1[0][0]);
			$record= preg_replace("/[ \"\r\n]+/i", "",$arr1[0][1]);
			 $mac_arr = explode(":", $mac);
			 print $mac;
			 if (!$mac_arr[1]) { print "нет мака<br>";
			 	$mac= preg_replace("/[ \"\r\n]+/i", "",$arr1[0][6]);
			 	print "<br>новый мака:".$mac."<br>";
			 }
			$onunum_last1 = $onunum_last;
			//if ($olt == "1/2") echo "$onunum. $s- \$onunum_last1($onunum_last1) == \$onunum($onunum)<Br>";

			if ($onunum_last1 === $onunum ) {
				$add ='<span style="background: ' . random_html_color() . '">'.$mac;
				$add2="</span><br>";
			}else {
				global $array_onu;
				$nick=$array_onu[$mac]["id"];
				if (!$nick) {
					$nick = "not found";
					}
				/* find onu utstarcom */
				$mac_arr = explode(":", $mac);
				$mac_arr= $mac_arr[0].":".$mac_arr[1].":".$mac_arr[2];
				if ($mac_arr == "00:07:ba") { $type_onu="ut";	} else { $type_onu="";}
				/* end utstarcom */

				$add ='<br><span style="background: #ffffff">ONU:<a href="stats.php?olt='.$olt.'&onu='.$onunum.'">('.$nick.'}detali</a><br>	 '.$mac. " ". $type_onu."<br>"."\$array_onu[$mac][\"id\"];";
				$add2="<br>";
			}

			if ($olt == "1/1") {  $olt1 .=  $add."".$add2; }
			if ($olt == "1/2") {  $olt2 .=  $add."".$add2; }
			if ($olt == "1/3") {  $olt3 .=  $add."".$add2; }
			if ($olt == "1/4") {  $olt4 .=  $add."".$add2; }
			if ($olt == "2/1") {  $olt5 .=  $add."".$add2; }
			if ($olt == "2/2") {  $olt6 .=  $add."".$add2; }
			if ($olt == "2/3") {  $olt7 .=  $add."".$add2; }
			if ($olt == "2/4") {  $olt8 .=  $add."".$add2; }
			$i++;

			//if ($type_onu == "ut") {
				$onunum_last1=$onunum;
			//}

		}
		$i=1;
		$out .="<br>free onu:<br>";
		echo "<table border=1><tr><td>1/1</td><td>1/2</td><td>1/3</td><td>1/4</td><td>2/1</td><td>2/2</td><td>2/3</td><td>2/4</td></tr>
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
	 	if(preg_match('/Username:/i',$out)){
	 	//echo $out;
		return (true);
		}
	 }
	 echo "end<br>";
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
