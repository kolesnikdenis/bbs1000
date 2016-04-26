<META http-equiv="content-type" content="text/html; charset=windows-1251">
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

<A href=1_1.php>show onu</a>
<?php
 error_reporting(E_ALL);
 set_time_limit(5);
 ob_implicit_flush();
 $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
 echo "1";
 socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array("sec" => 30, "usec" => 0));
 echo "2";
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
	 echo "<tr><td>не зарегестрированные ONU на навсех ветках:</td></tr>";

	 echo "<tr><td>";
	 send_command($socket, 'show configuration running');
	 global $read_continiue;
	 $read_continiue=str_replace('Press any key to continue (Q to quit)',"",$read_continiue);
	 $read_continiue=str_replace("\r\n","<br>",$read_continiue);
	 echo $read_continiue;
	//readstatolt($read_continiue,"1/1");


echo $onustat["1/1"];
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
	 if(preg_match('/telnet/i',$out)){
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
function readstatolt($str,$stat_olt){
	global $onustat;
	$out="";

	$str=str_replace('Press any key to continue (Q to quit)',"",$str);
	$str=str_replace("Record     OLT            Mac_Address           loid / passwd","",$str);

	$str=str_replace('-----------------------------------------------------------------',"\r\n",$str);
	$str= str_replace("  ", "" ,$str );
	$arry = explode("\r\n",$str);

	$i=1;
	$count = count($arry);

	$onustat[$stat_olt] = "<table width=100% border =1 >";
	while ($i <= $count-1)	{
		$s=$arry[$i]."-";
		//print $s."$i<br>";
		 //preg_match_all('#(\t)(.*?)(-)#isu', $s, $arr);

		$arry1 = explode(" ",$s);
		//var_dump($arry1);
		//print $arr[2][0]." - $i<br>";
		$olt=$arry1[1];

		$onustat[$stat_olt] .= "<tr><td>Record</td><td>".$olt[0] ."</td></tr>";
		$onustat[$stat_olt] .= "<tr><td>OLT</td><td>".$olt[1].$olt[2].$olt[3]."</td></tr>";
		$onustat[$stat_olt] .= "<tr><td class=red>Mac_Address</td><td class=red>".$arry1[2]."</td></tr>";

		$i++;
	} // while
	$onustat[$stat_olt].= "</table> ";
	//var_dump($onustat);
	//return $out;

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
 ?>