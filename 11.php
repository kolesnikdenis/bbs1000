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

<A href=onu-unbaund.php>onu-unbaunt</a><br>
<A href=show_config.php>show config</a><br>

<div id="test1">test1</div>
<table border=1 width=100%>
<tr>
<td>1/1<br><div id=1>stat</div></td>
<td>1/2<br><div id=2>stat</div></td>
<td>1/3<br><div id=3>stat</div></td>
<td>1/4<br><div id=4>stat</div></td>
<td>2/1<br><div id=5>stat</div></td>
<td>2/2<br><div id=6>stat</div></td>
<td>2/3<br><div id=7>stat</div></td>
<td>2/4<br><div id=8>stat</div></td>
</tr>

<tr>
 <td><div id=11>1/1</div></td>
 <td><div id=12>1/2 olt</div></td>
 <td><div id=13>1/3 olt</div></td>
 <td><div id=14>1/4 olt</div></td>
 <td><div id=21>2/1 olt</div></td>
 <td><div id=22>2/2 olt</div></td>
 <td><div id=23>2/3 olt</div></td>
 <td><div id=24>2/4 olt</div></td>
</tr>
</table>
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

echo "
<script>
var beaches1=[";

$DB_name1="abills_russkaya";
$DB_user1="root";
$DB_password1="SQLr00T";
$DB_server1="localhost";
$dbh1=mysql_connect($DB_server1,$DB_user1,$DB_password1);
mysql_select_db($DB_name1);
mysql_query("SET character_set_connection=utf8",$dbh1);
mysql_query("SET character_set_client=utf8",$dbh1);
mysql_query("SET character_set_results=utf8",$dbh1);
$array_onu=@array();
$sql= "select  users.id,users.credit,users.disable,users.bill_id,users_pi.uid,users.deleted, bills.deposit,users_pi.fio,users_pi._lon , users_pi._lat, dhcphosts_hosts.mac, dhcphosts_hosts.ip, users_pi.comments 
             from                         users, bills, users_pi,dhcphosts_hosts     where LENGTH(users_pi.comments) >3 and
                        bills.id = users.bill_id and users_pi.uid = users.uid and dhcphosts_hosts.uid= users.uid ";
$i=0;
$res=mysql_query($sql,$dbh1);
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
	$ip=long2ip($pl[ip]);
        $comments=$pl[comments];
        $macc_ip=$pl[mac];
        preg_match("/ONU:\"([^\"]+)}*/i", $comments, $mac);
        if (strlen($mac[1])>3 && strlen($macc_ip)>3) { $mac_user="'".$mac[1].",".$macc_ip."'"; }
        if (strlen($mac[1])>3 && strlen($macc_ip)<3) { $mac_user="'".$mac[1]."'"; }
        if (strlen($mac[1])<2 && strlen($macc_ip)>2)  { $mac_user="'".$macc_ip."'"; }
        if (strlen($mac[1])<2  && strlen($macc_ip)<2) { $mac_user="'"."'"; }

        #print "['".$id."<br>".$deposit."', ".$lat.", ".$lon.",".$mac_user.",". "0, '1/1', '0']";
        print "['".$id."<br>".$deposit."', ".$lat.", ".$lon.",".$mac_user.",'". $ip."']";
        #print "['".$id."', ".$lat.", ".$lon.",".$mac_user.",". "0]";
}
echo "];";
?>
alert("load ol");
</script>

<?
 $read_continiue="";
 $_SESSION['nick']="";
 global $onustat;
 if (true === true){
 	echo ("auth success");
	 echo "<table border=1 width=100%>";
	 echo "<tr><td>все ИПы и маки что видит голова</td></tr>";

	$read_continiue="";
	send_command($socket, 'show interface epon-olt mac-address-table');


	#$fp = fopen("counter.txt", "r"); // Открываем файл в режиме записи 
	#$data = fread($fp, filesize("counter.txt"));
	#echo $data;
	echo "<hr>";
	#$read_continiue = $data;
	$read_continiue=str_replace("\r".'Press any key to continue (Q to quit)'.chr(hexdec("00"))."\r","",$read_continiue);
	echo "<hr>";
	$read_continiue=str_replace("                                       \r","",$read_continiue);
	$read_continiue=str_replace("-------------------------------------------------------------------\r\n","",$read_continiue);
	$read_continiue=str_replace("Record  OLT   LPort  ONU id  LLID  VID   Mac_Address        Type   \r\n","",$read_continiue);
	$read_continiue=str_replace("\r\n","-=",$read_continiue);
	echo "test:<br>\r\n";
	echo "end test<br>\r\n";
	preg_match_all('#(-=)(.*?)(Dynamic)#isu', $read_continiue, $arr);
	echo "\r\n-----------------------------------\r\n<br>";
	$i=0;
	$count=count($arr[0]);
	$sfp=array();
	$num_onu_sfp= array();
	echo "<script>";
        echo "var mac_array=[";
        while ($i < $count)    {
                #$onunum = preg_replace("/\"\r\n]+/i", "", $arr2[4]);
                $str=$arr[0][$i];
                #$del_prob=str_replace("  ","",$str);
                $del_prob = explode("  ", $str);
                $str1=substr($str,57-14,17);

                $sfp[]=substr($str,10,3);
                $num_onu_sfp[]=str_replace(' ',"",substr($str,16,2));

                echo "'".$str1."'";
                if ($i+1 < $count){ print ", "; } else {print '];'; }
                $i++;
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
alert("load data bbs OK");

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
as = {
  11: [  ],  12: [  ],  13: [  ],  14: [  ],
  21: [  ],  22: [  ],  23: [  ],  24: [  ]
}

af = {
  11: [  ],  12: [  ],  13: [  ],  14: [  ],
  21: [  ],  22: [  ],  23: [  ],  24: [  ]
}

i=0;
var count = mac_array.length;
//var count=3;
while (i< beaches1.length){
	var sqluser= beaches1[i];
	if (sqluser[3].length> 20) {
                var arr_mac = sqluser[3].split(',');
        }
        else {
                var arr_mac=[];
                arr_mac[0]=sqluser[3];
        }
	test_num_user_mac=0;
	while (test_num_user_mac < arr_mac.length) {
		ii=0;
		while (ii<count){
			iii=false;
			//console.log(sqluser[0] + " " + mac_array[ii]+" <>  "+arr_mac[test_num_user_mac] );
			iii =  CompStr(mac_array[ii],arr_mac[test_num_user_mac]);
			if (iii==true){
				//if (arr_mac[test_num_user_mac] == "14:D6:4D:E8:93:89" ) { 
				//	alert("nashel: "+ mac_array[ii]+iii+"\n iskal: " + arr_mac[test_num_user_mac] + "\nnum findmac"+ii+"\nuser: "+sqluser[0]);
				//}
				//beaches1[i][4]=1;
				//beaches1[i][0] = beaches1[i][0] + "<br>Num onu vetke:<b>"+num_onu_sfp_array[ii]+"</b><br>sfp:<b>"+sfp_array[ii]+"</b>";
				//alert("nashel: "+ mac_array[ii]+iii+"\n iskal: " + arr_mac[test_num_user_mac] + "\nnum findmac"+ii+"\nuser: "+sqluser[0]);
				//їїїї їїї їїї їїїїї .. їїїїїї ї їїїїїї їїїїїїїїї їїї ї їїїїїїїї їїї її їїїїїїїїїї
				////delete arr_mac[test_num_user_mac];
				//їїїїїїїї їїїїїї
				////arr_mac.shift();
				//їїїї їїїїїї ї їїїїїї:
				sf=sfp_array[ii];
				tt=sf.replace("/","");
				af[tt].push("<hr>" + sqluser[0] + " mac: " + arr_mac[test_num_user_mac] +" <br>"+ sqluser[4] +"<br><b>mac: "+ mac_array[ii] +"<br> sfp:" + sfp_array[ii] + "<br> onu num:" + num_onu_sfp_array[ii] +"</b>  <br>");

				iii=false; // їїї ї їїїїїї їїї її їїї їїїїї .. її їїїїїїїїї ї ї.ї.
				ii=count+1; //їїї ї їїїїїїїїї їїїї їїїїїї
				test_num_user_mac=arr_mac.length+1;
			}
			ii++;
		
		}
	test_num_user_mac++;
	}
	i++;
}
var count_r11=af['11'].length;
var count_r12=af['12'].length;
var count_r13=af['13'].length;
var count_r14=af['14'].length;
var count_r21=af['21'].length;
var count_r22=af['22'].length;
var count_r23=af['23'].length;
var count_r24=af['24'].length;

//alert("1\\1: "+count_r11 + "\n" + "1\\2: "+count_r12+ "\n" + "1\\3: "+count_r13+"\n" + "1\\4: "+count_r14+"\n2\\1: "+count_r21 + "\n" + "2\\2: "+count_r22+ "\n" + "2\\3: "+count_r23+"\n" + "2\\4: "+count_r24);

var sel = document.getElementById("11");
sel.innerHTML=af['11'];
sel = document.getElementById("12");
sel.innerHTML=af['12'];
sel = document.getElementById("13");
sel.innerHTML=af['13'];
sel = document.getElementById("14");
sel.innerHTML=af['14'];
sel = document.getElementById("21");
sel.innerHTML=af['21'];
sel = document.getElementById("22");
sel.innerHTML=af['22'];
sel = document.getElementById("23");
sel.innerHTML=af['23'];
sel = document.getElementById("24");
sel.innerHTML=af['24'];


</script>

<?php
	echo "<hr>";
	echo "<br>"."\r\ncount: ".count($arr[0]) . "\r\n<br>";
	echo "-----------------------------------\r\n";

	 echo "<td>"; echo read_all_mac($read_continiue,""); echo "</td>";
	 $read_continiue="";

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
	global $read_continiue;
	str_replace('\^M','',$read_continiue);
}
 ?>
