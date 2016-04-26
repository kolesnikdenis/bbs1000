<?
// podkluchau biblioteky JsHttpRequest
require_once "./lib/JsHttpRequest/JsHttpRequest.php";

$JsHttpRequest =& new JsHttpRequest("windows-1251");

//$patch_dir="/tmp/";

	$DB_name1="abills_russkaya";
	$DB_user1="root";
	$DB_password1="SQLr00T";
	$DB_server1="localhost";

	$dbh1=mysql_connect($DB_server1,$DB_user1,$DB_password1);
//	print "test";
	mysql_select_db($DB_name1);
	mysql_query("SET character_set_connection=utf8",$dbh1);
	mysql_query("SET character_set_client=utf8",$dbh1);
	mysql_query("SET character_set_results=utf8",$dbh1);

	$array_onu=@array();

	$sql= "SELECT users_pi.uid, users_pi.fio, users_pi.comments, users.id FROM  `users_pi` ,  `users` WHERE comments !=  '' AND  `users_pi`.`uid` =  `users`.`uid` ";
	$res1=mysql_query($sql,$dbh1);
	print mysql_error();
	while ($pl=mysql_fetch_array($res1)){

		$comments =$pl[comments];
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
			$array_onu[$mac_f]["url"]="<a href=\"https://stat.ots.kh.ua/admin/index.cgi?index=7&search=1&type=11&LOGIN=".$pl[id]."\">".$pl[id]."</a>";
			$nick .=$pl[id].";";
			$macc  .=$mac[1].";";
			$url  .=" <a href=\"https://stat.ots.kh.ua/admin/index.cgi\?index=7&search=1&type=11&LOGIN=".$pl[id]."\">abills</a>;";
		}
	}

function DB_diskonect($db){
	mysql_close($db);
}
$taskk = $_REQUEST['tas'];
$eierr="no";

print $macc;
if ($taskk=="show_bbsclinent") {
	if($eierr=="no"){

		//$out_text = $nick;
		$_RESULT['out_macc']=$macc;
		$_RESULT['out_nick']=$nick;
		$_RESULT['out_url']=$url;

		return $out_text;

	}
	else
	{
		$_RESULT['err'] = 'yes';
		$log="<center><font color=#cc0000>Ошибка</font></center>".$log;
		$_RESULT['log'] = $log;
	}
}


?>
