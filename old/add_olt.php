<?php
$task=$_REQUEST["task"];
if ($task == "setsave") {

 error_reporting(E_ALL);
 set_time_limit(15);
 ob_implicit_flush();
 $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
 socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array("sec" => 30, "usec" => 0));
 $result = socket_connect($socket, '10.232.0.20', '23');
 read_welcome_message($socket);
 $result = send_login($socket, 'admin');
 $result = send_passw($socket, '4627972');
 $read_continiue="";
 if ($result === true) {
 	echo ("auth success");

	$olt=$_REQUEST["olt"];
	$onu=$_REQUEST["onu"];
	$mac_onu=$_REQUEST["mac_onu"];
	$description=$_REQUEST["description"];

	if ( ($olt) && ($olt) && ($onu) && ($description)&& ($mac_onu) ) {
	 echo "enable<br>";
	 send_command($socket, 'en');
	 echo "config terminal<br>";
	 send_command($socket, 'configure terminal');
	 $select_olt = "interface epon-olt ".$olt;
	 echo "выбор олт<br>";
	 send_command($socket, $select_olt);
	 $select_onu = "onu ".$onu;
	 echo "выбор ону <br>";
	 send_command($socket, $select_onu);
	 $set_description = "description ".$description;
	 echo "назначения опимания<br>";
	 send_command($socket, $set_description);
	 $set_mac_onu = "dba-sla mac ".$mac_onu;
	 echo "назначение мак-а ону<br>";
	 send_command($socket, $set_mac_onu);

	 echo "выход с настроек ону<br>";
	 send_command($socket, 'exit'); #exit from onu
	 echo "выход с настроек олт<br>";
	 send_command($socket, 'exit'); #exit from olt

	 $select_onu="show configuration interface epon-olt ".$olt." onu ".$onu;
	 echo "показать настройки епон-олт<br>";
	 send_command($socket, $select_onu); #exit from olt
	 global $read_continiue;
	 //$read_continiue="";
	 echo "проверка применении настроек нового абонента  <br>\"<b>".$read_continiue."</b>\"  <br><br>";


	 echo "выход с конфиг терминал<br>";
	 send_command($socket, 'exit'); #exit from config terminal

	 echo "вход в конфиг менеджер<br>";
	 send_command($socket, ' configure management');
	 echo "сохраним настройки<br>";
	 send_command($socket, 'save');
	 global $read_continiue;
	 //$read_continiue="";
	 echo "ответ процесса сохранения конфигурации  <br>\"<b>".$read_continiue."</b>\"  <br><br>";
	 echo "выход с конфик менеджер<br>";
	 send_command($socket, 'exit'); #exit configure management

	 echo "выход с енабле<br>";
	 send_command($socket, 'exit'); #exit enable
	 echo "выход с ббс<br>";
	 send_command($socket, 'exit'); #exit bbs1000

	 $command="enable
	 configure terminal
	 interface epon-olt $olt
	 onu $onu
	 description $description
	 dba-sla mac  $mac_onu
	 exit #выход с управления ону
	 exit #выход с управления олт
	 $select_onu
	 exit #выход с управленя терминала
	 configure management
	 save
	 exit #выход с управленя management
	 exit #выход с режима enable
	 exit #выход с bbs1000
	 ";
	 echo "<textarea>$command</textarea>";
	 }
	}
 else
	 echo ("auth failed");




}else {
	$olt=$_REQUEST["olt"];
	$onu=$_REQUEST["onu"];
	$mac=$_REQUEST["mac"];
	echo "<form action=\"add_olt.php\" method=post>
	description: <input type=text value=\"\" name=\"description\"><br>
	mac_onu: <input type=text value=\"$mac\" name=\"mac_onu\"><br>
	olt: <input type=text value=\"$olt\" name=\"olt\"><br>
	onu#: <input type=text value=\"$onu\" name=\"onu\"><br>
	<input type=hidden value=\"setsave\" name=\"task\" >
	<input type=submit value=\"save olt\">
	</form>";
}
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
 	echo "start<br>";
	 while ($out = socket_read($socket, 2048))
	 {
	 	if(preg_match('/Username:/i',$out)){
	 	echo $out;
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
	 	echo $out;
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
	 	echo $out;
		return (true);
		}
 	if(preg_match('/sername:/i',$out))
 		return(false);
 	}
 }
/*
  function send_command($socket, $command)
 {
socket_write($socket, $command . "\r\n", strlen($command) + 2);
sleep(3);
while ($out = socket_read($socket, 2048))
 	{
 	if(preg_match('/\+# /i',$out)){
	 	global $read_continiue;
		$read_continiue .=$out;
	 	return (true);
		}
	if(preg_match('/Press any key to continue/i',$out)){
	    global $read_continiue;
	 	$read_continiue .= $out;
	 	send_command($socket, ' ');
		return (true);
		}
    }
}
*/
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
