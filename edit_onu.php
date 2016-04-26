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

 if ($task=="select_edit") {
 	 send_command($socket, 'en');

	 if ( ($olt) && ($onu)  ) {
		$read_continiue="";
		$cmd="show configuration interface epon-olt $olt onu $onu";
		send_command($socket, $cmd);
		global $read_continiue;
		preg_match_all('/[^\r\n]+/',$read_continiue, $arr);
		$description = preg_replace("/[\"]+/i", "", $arr[0][3] );
		preg_match_all('/[^ ]+/',$description,$arr1);
		$description = $arr1[0][1];
		$mac_onu = $arr[0][4];
		preg_match_all('/[^ ]+/',$mac_onu,$arr1);
		$mac_onu = $arr1[0][2];
		echo "<form action=\"add_olt.php\" method=post>
			description: <input type=text value=\"$description\" name=\"description\"><br>
			mac_onu: <input type=text value=\"$mac_onu\" name=\"mac_onu\"><br>
			olt: <input type=text value=\"$olt\" name=\"olt\"><br>
			onu#: <input type=text value=\"$onu\" name=\"onu\"><br>
			<input type=hidden value=\"setsave\" name=\"task\" >
			<input type=submit value=\"set edit olt\">
			</form>";

	 }

 }

 if ($task=="set_edit") {

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
/*
 function send_command($socket, $command)
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
