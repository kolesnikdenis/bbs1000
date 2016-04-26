<?php

 function read_welcome_message($socket)
 {
         while ($out = socket_read($socket, 2048))
         {
                $ii=strpos($out, "rname:");
                #print $out.$ii;
                if ($ii>0) {
                        return (true);
                }

         }
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
//sleep(1);
 //$out = socket_read($socket, 2048);
 $out="";
$result=0;
$i=0;
 while ($result != 1 )
 {
        $i++;
        ///$read_continiue .="äî<br>";
        $out .= socket_read($socket, 2048);
        //$read_continiue .="çàïðîñ íîìåð ($i)<br>";
         //if(preg_match('/\+# /i',$out)){
         if(preg_match('/BBS1000/i',$out)){
                //echo "out:".$out."<br>";
                global $read_continiue;
                $read_continiue .=$out;
                //$read_continiue .="îêîí÷àíèÿ çàïðîñà";
                 //$read_continiue="";
                 $result=1;
                return (true);
                }
        if(preg_match('/Press any key to continue/i',$out)){
            global $read_continiue;
                $read_continiue .= $out;
                //$read_continiue .="áûëî ïðîäîëæåíèå!!";
                //      $result=1;
                send_command($socket, ' ');
                return (true);
                }
 }
}
 ?>

