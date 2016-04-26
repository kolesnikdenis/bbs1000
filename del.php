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
 if ($result === true){
 	echo ("auth success");
	$olt=$_REQUEST["olt"];
	$onu=$_REQUEST["onu"];
	$task=$_REQUEST["task"];

 if ($task=="del") {
 	 send_command($socket, 'en');

	 if ( ($olt) && ($onu)  ) {
		$read_continiue="";
		$cmd="configure terminal";
		send_command($socket, $cmd);
		global $read_continiue;
		$show_cmd=$cmd."<br>";
		$error=0;
		if(preg_match('/Error/i',$read_continiue)){	$error=1;}else {$error=0;}
		if ($error == 0) {
			$read_continiue="";
			$cmd="interface epon-olt $olt";
			$show_cmd.=$cmd."<br>";
			send_command($socket, $cmd);
			global $read_continiue;
			if(preg_match('/Error/i',$read_continiue)){ $error=1; }else {$error=0;}
		}else{ echo "ошибка команды \"$cmd\""; }

		if ($error == 0) {
			$read_continiue="";
			$cmd="no onu $onu";
			$show_cmd.=$cmd."<br>";
			send_command($socket, $cmd);
			global $read_continiue;
			if(preg_match('/Error/i',$read_continiue)){ $error=1; }else {$error=0;}
		}else{ echo "ошибка команды \"$cmd\""; }

		if ($error == 0) {
			$read_continiue="";
			$cmd="exit";
			$show_cmd.=$cmd."<br>";
			send_command($socket, $cmd);
			global $read_continiue;
			if(preg_match('/Error/i',$read_continiue)){ $error=1; }else {$error=0;}
		}else{ echo "ошибка выхода с interface epon-olg $olt cmd: \"$cmd\""; }

		if ($error == 0) {
			$read_continiue="";
			$cmd="exit";
			$show_cmd.=$cmd."<br>";
			send_command($socket, $cmd);
			global $read_continiue;
			if(preg_match('/Error/i',$read_continiue)){ $error=1; }else {$error=0;}
		}else{ echo "ошибка выхода с \"config terminal\" cmd: \"$cmd\""; }

		/*if ($error == 0) {
			$read_continiue="";
			$cmd="configure management";
			$show_cmd.=$cmd."<br>";
			send_command($socket, $cmd);
			global $read_continiue;
			if(preg_match('/Error/i',$read_continiue)){ $error=1; }else {$error=0;}
		}else{ echo "ошибка cmd: \"$cmd\""; }

		if ($error == 0) {
			$read_continiue="";
			$cmd="save";
			$show_cmd.=$cmd."<br>";
			send_command($socket, $cmd);
			global $read_continiue;
			if(preg_match('/Error/i',$read_continiue)){ $error=1; }else {$error=0;}
			if(preg_match('/ucces/i',$read_continiue)){ echo "успешное сохранение конфигурации<br>"; }
		}else{ echo "ошибка cmd: \"$cmd\""; }

		if ($error == 0) {
			$read_continiue="";
			$cmd="exit";
			$show_cmd.=$cmd."<br>";
			send_command($socket, $cmd);
			global $read_continiue;
			if(preg_match('/Error/i',$read_continiue)){ $error=1; }else {$error=0;}
		}else{ echo "ошибка выхода с configure management \"$cmd\""; }
*/
		if ($error == 0) {
			$read_continiue="";
			$show_cmd.=$cmd."<br>";
			$cmd="exit";
			send_command($socket, $cmd);
			global $read_continiue;
			if(preg_match('/Error/i',$read_continiue)){ $error=1; }else {$error=0;}
		}else{ echo "ошибка выхода с \"bbs1000\" cmd: \"$cmd\""; }

	echo "список команд:<k>$show_cmd</k><br>";


	 }

 }



 }
 else

	 echo ("auth failed");




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

 /*function send_command($socket, $command)
 {
 	socket_write($socket, $command . "\r\n", strlen($command) + 2);
sleep(1);
 $out = socket_read($socket, 2048);
// while ($out = socket_read($socket, 2048))
// {
 	if(preg_match('/\+# /i',$out)){
	 	//echo "out:".$out."<br>";
	 	global $read_continiue;
		$read_continiue .=$out;
		 //$read_continiue="";
	 	return (true);
		}
	if(preg_match('/Press any key to continue/i',$out)){
	    global $read_continiue;
	 	$read_continiue .= $out;
	 	send_command($socket, ' ');
		return (true);
		}
// }
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
