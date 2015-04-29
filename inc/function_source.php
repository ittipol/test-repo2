<?php
require_once("/opt/lampp/htdocs/aim/admin/adodbconnect.php");
function generateCode($length=6) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;  //a variable with the fixed length of chars correct for the fence post issue
        while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];  //mt_rand's range is inclusive - this is why we need 0 to n-1
        }
        return $code;
    }

function Get_IP(){
	if (getenv(HTTP_X_FORWARDED_FOR)) {							
    $ip = getenv(HTTP_X_FORWARDED_FOR); 
} else { 
    $ip = getenv(REMOTE_ADDR);
}
return  $ip;

}
function make_seed()
{
  list($usec, $sec) = explode(' ', microtime());
  return (float) $sec + ((float) $usec * 100000);
}
function powerby(){
echo "Power By <a href=".API_Ncm_Dev_Url." target=_blank>".API_Ncm_DEV."</a>";
}
function Licensed_by($path){
global $CFG_Language,$Licensed,$Dir_Path;
echo "<font color=\"#003300\">".$CFG_Language["_Status_"]["_Licensed_"]["_LABEL02_"]." : ".$Licensed["_Key_"].". By ".$Licensed["_Company_"]."</a></font>";
if(!is_readable($path."tmp/aim.tmp")){echo "<br><font color=red >".$CFG_Language["_Error_"]["_ALERT21_"]."<a href=".API_Ncm_CopyRight_Url." target=_blank>".API_Ncm_CopyRight."</a>";
echo "<br>Version ".API_Ncm_Version."</font>";}
}
function random_card($len) { 
srand(make_seed()); 
$chars = "ABCDEFGHIJKLMNPQRSTUVWXYZ"; 
$chars.= "123456789"; 
$ret_str = ""; 
$num = strlen($chars); 
for($i=0; $i < $len; $i++) { 
$ret_str.= $chars[rand()%$num];
} 
return $ret_str; 
} 
function convert_serial($card,$Split_Length,$Split_Str){
$card1=str_split($card, $Split_Length);
$convert='';
$count=count($card1);
for($i=0;$i<$count;$i++){
if($i<($count-1)){
$convert=$convert.$card1[$i].$Split_Str;
}else{
$convert=$convert.$card1[$i];
}
}
return $convert;
}
function convert_txt($code){
$codes = explode("-",$code);
$explode="";
for($i=0;$i<count($codes);$i++){
$explode=$explode.$codes[$i];
}
return $explode;
}
function encoded($ses) 
{    
  $sesencoded = $ses; 
  $num = mt_rand(3,9); 
  for($i=1;$i<=$num;$i++) 
  { 
     $sesencoded = 
     base64_encode($sesencoded); 
  } 
  $alpha_array = 
  array('Y','D','U','R','P', 
  'S','B','M','A','T','H'); 
  $sesencoded = 
  $sesencoded."+".$alpha_array[$num]; 
  $sesencoded = 
  base64_encode($sesencoded); 
  return $sesencoded; 
}//end of encoded function 

function decoded($str) 
{ 
   $alpha_array =    array('Y','D','U','R','P', 'S','B','M','A','T','H'); 
   $decoded =    base64_decode($str); 
   list($decoded,$letter) =  split("\+",$decoded); 
   for($i=0;$i<count($alpha_array);$i++) 
   { 
   if($alpha_array[$i] == $letter) 
   break; 
   } 
   for($j=1;$j<=$i;$j++) 
   { 
     $decoded =    base64_decode($decoded); 
   } 
   return $decoded; 
   }


function adminlogout(){
global $dbname,$_SESSION;
$account_id=$_SESSION['admin_id'];
mysql_db_query($dbname,"update manage_account SET online=false where  manage_account_id='$account_id'") ;
unset($_SESSION['admin_id']);
Setcookie("last_id");

redirect(" login.php");


}

function getcookie($key){
if (isset($_COOKIE[$key])) {
    return $_COOKIE[$key];
}else if (isset($HTTP_COOKIE_VARS[$key])) {
 return $HTTP_COOKIE_VARS[$key];
}
return false;

}
function set_cookie($key,$value,$expire){
Setcookie($key,$value,$expire); 
setrawcookie($key,$value,$expire); 
}
function client_online(){
global $dbname;
$row=mysql_fetch_array(mysql_db_query($dbname,"select count(*) as count from client where online=true")) ;

return $row['count'];
}
function admin_online(){
global $dbname;
$row=mysql_fetch_array(mysql_db_query($dbname,"select count(*) as count from manage_account where online=true")) ;

return $row['count'];
}
function total_pin_group(){
global $dbname;
$row=mysql_fetch_array(mysql_db_query($dbname,"select count(*) as count from pin_group")) ;

return $row['count'];
}
function total_pin_account(){
global $dbname;
$row=mysql_fetch_array(mysql_db_query($dbname,"select count(*) as count from pin_account")) ;

return $row['count'];
}
function get_admin_history_id($uid){
global $dbname;
$result=mysql_db_query($dbname,"select manage_history_id as history_id from manage_history where manage_account_id='$uid' order by time_login desc limit 0,1");
$row=mysql_fetch_array($result);
return $row[history_id];
mysql_free_result($result);
}

function FormatTime($time){

$tms=sprintf("%d", $time*60*60); 
$mf=sprintf("%.4f", $tms/60); 
$md=sprintf("%d", $tms/60); 
$s=sprintf("%d",($mf-$md)*60);
$ht=sprintf("%.4f",$mf/60);
$hs=sprintf("%d",$mf/60);
$m=sprintf("%d",($ht-$hs)*60);
$d=sprintf("%d",$hs/24);
$ds=sprintf("%.4f",$hs/24);
$h=sprintf("%d",($ds-$d)*24);
return $d."d ".$h."h  ".$m."m ".$s."s";

}

function FormatTimeOnline($time){
$td=$time[0];
$th=$time[2].$time[3];
$tm=$time[5].$time[6];
$ts=$time[8].$time[9];
return $td."d ".$th."h  ".$tm."m ".$ts."s";
}
function date_convert($date,$type){
  $date_year=substr($date,0,4);
  $date_month=substr($date,5,2);
  $date_day=substr($date,8,2);
  if($type == 1):
  	// Returns the year Ex: 2003
  	$date=date("Y", mktime(0,0,0,$date_month,$date_day,$date_year));
  elseif($type == 2):
  	// Returns the month Ex: January
  	$date=date("F", mktime(0,0,0,$date_month,$date_day,$date_year));
  elseif($type == 3):
  	// Returns the short form of month Ex: Jan
  	$date=date("M", mktime(0,0,0,$date_month,$date_day,$date_year));
  elseif($type == 4):
  	// Returns numerical representation of month with leading zero Ex: Jan = 01, Feb = 02
  	$date=date("m", mktime(0,0,0,$date_month,$date_day,$date_year));
  elseif($type == 5):
  	// Returns numerical representation of month without leading zero Ex: Jan = 1, Feb = 2
  	$date=date("n", mktime(0,0,0,$date_month,$date_day,$date_year));
  elseif($type == 6):
  	// Returns the day of the week Ex: Monday
  	$date=date("l", mktime(0,0,0,$date_month,$date_day,$date_year));
  elseif($type == 7):
  	// Returns the day of the week in short form Ex: Mon, Tue
  	$date=date("D", mktime(0,0,0,$date_month,$date_day,$date_year));
  elseif($type == 8):
  	// Returns a combo ExL Wed,Nov 12th,2003
  	$date=date("D, M jS, Y", mktime(0,0,0,$date_month,$date_day,$date_year));
  elseif($type == 9):
  	// Returns a combo Ex: November 12th,2003
  	$date=date("F jS, Y", mktime(0,0,0,$date_month,$date_day,$date_year));
	elseif($type == 10):
	// Returns a combo Ex: November 12th,2003
  	$date=date("d/m/Y", mktime(0,0,0,$date_month,$date_day,$date_year));
  endif;
  return $date;
}
function getcomname($ip){

return exec("/sbin/sudo -u root  /opt/lampp/htdocs/aim/tmp/shellfnc.sh getcomname ".$ip);
}
function getonline($ip,$id){
global $dbname;
$status=false;
if($ip){
if(file_exists("/var/ipcop/whoisonline/arpscan")){
$cmd="/var/ipcop/whoisonline/arpscan -a -s eth0 ".$ip;
exec($cmd,$on);
if(sizeof($on)){
$status=true;
$command="update client set arp=true,lastinterval=NOW()";
$command.=" where client_id='".$id."' ";
mysql_db_query($dbname,$command);

}else{
$status=false;
}
}else if(file_exists("/var/ipcop/wio/arpscan")){
$cmd="/var/ipcop/wio/arpscan -a -s eth0 ".$ip;
exec($cmd,$on);
if(sizeof($on)){
$status=true;
$command="update client set arp=true,lastinterval=NOW()";
$command.=" where client_id='".$id."' ";
mysql_db_query($dbname,$command);
}else{
$status=false;
}

}else  if(file_exists("/usr/sbin/arpscan")){
$cmd="/usr/sbin/arpscan -a -s eth0 ".$ip;
exec($cmd,$on);
if(sizeof($on)){
$status=true;
$command="update client set arp=true,lastinterval=NOW()";
$command.=" where client_id='".$id."' ";
mysql_db_query($dbname,$command);
}else{
$status=false;
}
}
}
return $status;
}
function getonlineinfile($mac){

$status=false;

$cmd="/sbin/sudo -u root grep ".$mac." /opt/lampp/htdocs/aim/tmp/arpscan.aim";
exec($cmd,$on);
if(sizeof($on)){
$status=true;
}
return $status;
}
function array_search_value($needle,$haystack) {
    foreach($haystack as $key=>$value) {
        $current_key=$key;
    
            if($needle == trim($value)){			
        return $current_key;
		
            }
             
    }
    return false;
}
function checkmac($ip,$mac){
$spoof=0;
$found=0;
$mac=trim($mac);
if(preg_match("/[0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f]/i",$mac)){
$arpfile="/opt/lampp/htdocs/aim/tmp/arpspoof.aim";
if(file_exists($arpfile)){
$spoof1=file($arpfile);
for($i=0;$i<sizeof($spoof1);$i++){
if(strtoupper($mac)==trim($spoof1[$i])){
$spoof=1;
break;
}

}
}
}
if(preg_match("/[0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f]/i",$mac) && !$spoof ){
$found=1;
}

if($spoof  || preg_match("/[0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f]/i",$mac)==false){

$filename="/var/ipcop/dhcp/fixleases";

if(file_exists($filename)){
$arp=file($filename);
for($c=0;$c<sizeof($arp );$c++){
 $fix=explode(",",trim($arp[$c]));
if(trim($fix[1])==$ip && trim($fix[2])=="on"){

$mac=trim($fix[0]);
$found=1;
break;
}
}
}


}

if(!$found && $spoof){

$filename="/opt/lampp/htdocs/aim/tmp/arpscan.aim";
$filename1="/opt/lampp/htdocs/aim/tmp/arpip.aim";
if(file_exists($filename)){
$arp=file($filename);
$arpip=file($filename1);

$key = array_search_value($ip,$arpip); 
if($key>0){

$mac=$arp[$key-1];
$found=1;

}
}


}

if(!$found && $spoof){
 $expire_time=2;
  if(file_exists("/opt/lampp/htdocs/aim/tmp/dhcp.aim")){
 $Filetmp="/opt/lampp/htdocs/aim/tmp/dhcp.aim";
$FileCreationTime = filectime($Filetmp);
$FileAge = time() - $FileCreationTime;
 if ($FileAge > ($expire_time * 60) || filesize($Filetmp)==0 ){
 shell_exec("sudo -u root  /usr/local/bin/getdhcplist.pl");
 }
}
$dhcp=file("/opt/lampp/htdocs/aim/tmp/dhcp.aim");
$dhcp1=array();
for($b=0;$b<sizeof($dhcp);$b++){
 $dhcp1=explode(";",trim($dhcp[$b]));
 if(trim($dhcp1[0])==$ip){
$mac=($dhcp1[1]);
 $found=1;
 break;
 }
 
}

}
 

if(($spoof && !$found ) || trim($mac)=="--"){
return "";
}else{
return strtoupper(trim($mac));
}
}
function getmac($ip){
$found=0;
$spoof=0;

$mac=exec("/sbin/sudo -u root  /opt/lampp/htdocs/aim/tmp/shellfnc.sh getmac ".$ip);
 $mac1=checkmac($ip,$mac);

if(!trim($mac1)){
return "";
}else{
return strtoupper(trim($mac1));
}



}
function findmactoip($mac){
$arp="arp -a |grep ".$mac;
$remoteip=exec($arp.' | /usr/bin/awk "/^$ip_address/ {print \$2}"');
$remoteip = str_replace("(", "", $remoteip);
$remoteip = str_replace(")", "", $remoteip);
if($remoteip){
return strtoupper($remoteip);
}
return "";

}
function gethostname ($ip) {
if(trim($ip)){
$pcname = gethostbyaddr(trim($ip));
 //$host = `host $ip`;
 if($pcname!=$ip){
  $host=explode(".", $pcname);
 $pcname=trim(($host[0] ? end ( explode (' ', $host[0])) : $ip));


  if($pcname=="3(NXDOMAIN)" || $pcname=="reache" || $pcname=="5(refused"){
 
 $pcname=$ip;
 }
}else{ $pcname="";}
 }else{
 $pcname="";
 }
 return  $pcname;
}
function Total_Client(){
global $dbname;
$Client_Total=0;
$resultc=mysql_db_query($dbname,"SELECT   count(*) as total FROM client");
  if(mysql_num_rows($resultc)){
$rowc=mysql_fetch_array($resultc);
$Client_Total=$rowc[total];
}
mysql_free_result($resultc);
return $Client_Total;
}
function reset_stat($mac){
global $dbname,$Licensed;
if($Licensed["_Card_"][11]==1){
mysql_db_query($dbname,"update macpassthrough  set allow='0' ,e_start=NULL ,e_stop=NULL  where mac_address='$mac' ") or die(mysql_error());

}else{
mysql_db_query($dbname,"update macpassthrough  set allow='2' ,e_start=NULL ,e_stop=NULL  where mac_address='$mac' ") or die(mysql_error());
}
 $pid=str_replace(":","",$mac);
   unlink("/opt/lampp/htdocs/aim/tmp/vip/".$pid.".pid");
   if(file_exists("/opt/lampp/htdocs/aim/tmp/vip/".$pid.".pid")){
 shell_exec("/sbin/sudo -u root rm /opt/lampp/htdocs/aim/tmp/vip/".$pid.".pid");
 }
mysql_db_query($dbname,"update client set online=false where mac_address='$mac' ");
}
function block_stat($mac){
global $dbname,$Licensed;
mysql_db_query($dbname,"update macpassthrough  set allow='2' ,e_start=NULL ,e_stop=NULL  where mac_address='$mac' ") or die(mysql_error());
mysql_db_query($dbname,"update client set online=false where mac_address='$mac' ");
}
function retrun_stat($mac,$value){
global $dbname;
for($i=0;$i<count($mac);$i++){

mysql_db_query($dbname,"update macpassthrough  set allow='".$value."'  where mac_address='".$mac[$i]."' ") or die(mysql_error());
}
}
function copydirr($fromDir,$toDir,$chmod=0757,$verbose=false)
/*
    copies everything from directory $fromDir to directory $toDir
    and sets up files mode $chmod
*/
{
//* Check for some errors
$errors=array();
$messages=array();
if (!is_writable($toDir))
    $errors[]='target '.$toDir.' is not writable';
if (!is_dir($toDir))
    $errors[]='target '.$toDir.' is not a directory';
if (!is_dir($fromDir))
    $errors[]='source '.$fromDir.' is not a directory';
if (!empty($errors))
    {
    if ($verbose)
        foreach($errors as $err)
            echo '<strong>Error</strong>: '.$err.'<br />';
    return false;
    }
//*/
$exceptions=array('.','..');
//* Processing
$handle=opendir($fromDir);
while (false!==($item=readdir($handle)))
    if (!in_array($item,$exceptions))
        {
        //* cleanup for trailing slashes in directories destinations
        $from=str_replace('//','/',$fromDir.'/'.$item);
        $to=str_replace('//','/',$toDir.'/'.$item);
        //*/
        if (is_file($from))
            {
            if (@copy($from,$to))
                {
                chmod($to,$chmod);
                touch($to,filemtime($from)); // to track last modified time
                $messages[]='File copied from '.$from.' to '.$to;
                }
            else
                $errors[]='cannot copy file from '.$from.' to '.$to;
            }
        if (is_dir($from))
            {
            if (@mkdir($to))
                {
                chmod($to,$chmod);
                $messages[]='Directory created: '.$to;
                }
            else
                $errors[]='cannot create directory '.$to;
            copydirr($from,$to,$chmod,$verbose);
            }
        }
closedir($handle);
//*/
//* Output
if ($verbose)
    {
    foreach($errors as $err)
        echo '<strong>Error</strong>: '.$err.'<br />';
    foreach($messages as $msg)
        echo $msg.'<br />';
    }
//*/
return true;
}

function load_xml_licensed($path1,$path2){
global $Cfg_Variable,$D_Licensed;
$filename = $path1."tmp/aim.tmp";
$filename2 = $path2."data/licensed.aim";

if(is_readable($filename2 )){

// local 
	$lines1=file($filename2);
	$permit=explode(",",decoded($lines1[6]));
$xml	=	array(
				"Company"=> decoded($lines1[0]),
				"Key"=> decoded($lines1[1]),
				"Date"=> decoded($lines1[2]),
				"DDNS"=> decoded($lines1[3]),
				"Limit"=> decoded($lines1[4]),
				"Package"=> decoded($lines1[5]),
				"Card"=> $permit,
				"Connection"=> decoded($lines1[7]),
			);
if(file_exists($filename)){	

$this_time=date("d-m-Y H:i:s",strtotime('-1 day') );
$today=date("d-m-Y H:i:s");

	$lines = file($filename);
	
	$last_update= trim($lines[8]);

	if($this_time< $last_update && $last_update <$today && $xml[Key]== decoded($lines[1]) &&  $xml[DDNS]== decoded($lines[3])){
	$permit=explode(",",decoded($lines[6]));
			$Licensed	=	array(
				"_Company_"=> decoded($lines[0]),
				"_Key_"=> decoded($lines[1]),
				"_Register_Date_"=> decoded($lines[2]),
				"_DDNS_"=> decoded($lines[3]),
				"_Client_Limit_"=> decoded($lines[4]),
				"_Package_"=> decoded($lines[5]),
				"_Card_"=> $permit,
				"_Connection_"=> decoded($lines1[7]),
			);

	}else{
	$Licensed=get_xml_licensed($path1,$path2,$xml,$filename);
		}
	}else{
		$Licensed=get_xml_licensed($path1,$path2,$xml,$filename);
	}
}else{
		$Licensed=$D_Licensed;
	}

return $Licensed;

}
function get_xml_licensed($path1,$path2,$xml,$filename){
global $Cfg_Variable,$D_Licensed;
include($path2."inc/xml_parser.php");
include($path2."inc/getserver.php");
	
	$this_time=date("d-m-Y H:i:s",strtotime('-3 day') );
	$today=date("d-m-Y H:i:s");
	$get=true;
	if(decoded($xml_url[Key])==""){
	if(file_exists($filename)){	
$lines = file($filename);
$last_update=trim($lines[8]);
}

if($this_time>= $last_update  && $last_update <=$today){
if(file_exists($filename)){			unlink($filename );}
	$get=true;
print_debug("delete Lisensed :Succeed\n");
}else{
$Licensed=get_local_licensed($path1,$path2);
$get=false;
print_debug("Load local Lisensed :Succeed\n");
}

}
	if($xml[Company]== decoded($xml_url[Company]) &&  $xml[Key]== decoded($xml_url[Key]) && $get){
//if($xml[Key]== decoded($xml_url[Key]) && $get){
		$ip = gethostbyname("".decoded($xml_url[DDNS])."");
			if(($Cfg_Variable[API_NCM]["ppp0"]!=$ip || $Cfg_Variable[API_NCM]["ppp0"]=="" ) and (decoded($xml_url[Connection])<2)){		
			if(file_exists($filename)){			unlink($filename );}
				$Licensed=$D_Licensed;
			
			}else{
			//create new licensed
			
			$this_update=date("d-m-Y H:i:s");
			$tmp1.=$xml_url[Company]."\n";
			$tmp1.=$xml_url[Key]."\n";
			$tmp1.=$xml_url[Date]."\n";
			$tmp1.=$xml_url[DDNS]."\n";
			$tmp1.=$xml_url[Limit]."\n";
			$tmp1.=$xml_url[Package]."\n";
			$tmp1.=$xml_url[Card]."\n";
			$tmp1.=$xml_url[Connection]."\n";
			$tmp1.=$this_update."\n";
			
			if(file_exists($filename)){			unlink($filename );}
		if (!$filename = fopen($filename, "w")) {
		exit;}
		if (!fwrite($filename, $tmp1)) {
		exit;}
		fclose($filename); 
			print_debug("Check Lisensed :Succeed\n");
			$permit=explode(",",decoded($xml_url[Card]));
			$Licensed	=	array(
				"_Company_"=> decoded($xml_url[Company]),
				"_Key_"=> decoded($xml_url[Key]),
				"_Register_Date_"=> decoded($xml_url[Date]),
				"_DDNS_"=> decoded($xml_url[DDNS]),
				"_Client_Limit_"=> decoded($xml_url[Limit]),
				"_Package_"=> decoded($xml_url[Package]),
				"_Card_"=>$permit,
				"_Connection_"=> decoded($xml_url[Connection]),
			);
		}	
}else{
$Licensed=$D_Licensed;		
}
return $Licensed;
}

if (!isset($_SESSION['aim_lang'])){
$Lang="en";
}else{
$Lang=$_SESSION['aim_lang'];
}
function get_local_licensed($path1,$path2){
global $Cfg_Variable,$D_Licensed;

$filename = $path1."tmp/aim.tmp";
$filename2 = $path2."data/licensed.aim";

if(is_readable($filename2 ) && is_readable($filename)){


// local 
	$lines1=file($filename);
	$permit=explode(",",decoded($lines1[6]));
		$Licensed	=	array(
				"_Company_"=> decoded($lines1[0]),
				"_Key_"=> decoded($lines1[1]),
				"_Register_Date_"=> decoded($lines1[2]),
				"_DDNS_"=> decoded($lines1[3]),
				"_Client_Limit_"=> decoded($lines1[4]),
				"_Package_"=> decoded($lines1[5]),
				"_Card_"=> $permit,
				"_Connection_"=> decoded($lines1[7]),
				"_Error_"=> "0",
			);
	}else if(is_readable($filename2 ) && !is_readable($filename)){
		$lines1=file($filename2);
		$permit=explode(",",decoded($lines1[6]));
		$Licensed	=	array(
				"_Company_"=> decoded($lines1[0]),
				"_Key_"=> decoded($lines1[1]),
				"_Register_Date_"=> decoded($lines1[2]),
				"_DDNS_"=> decoded($lines1[3]),
				"_Client_Limit_"=> decoded($lines1[4]),
				"_Package_"=> decoded($lines1[5]),
				"_Card_"=> $permit,
				"_Connection_"=> decoded($lines1[7]),
				"_Error_"=> "1",
			);	
	}else{
	$Licensed=$D_Licensed;
	}
	return $Licensed;
}
function check_exp($mac){
global $dbname;
$result=mysql_db_query($dbname,"SELECT DISTINCT 
  history_list.pin_account_serial,
  history_list.history_id,
  history_list.time_start,
  history_list.time_end,
  history_list.ip_address,
  history_list.pc_name,
  pin_account.pin_account_date_expiration
FROM
  pin_account
  INNER JOIN history_list ON (pin_account.pin_account_serial = history_list.pin_account_serial)
WHERE
  history_list.mac_address = '$mac'
ORDER BY
  history_id DESC
LIMIT 1") or die(mysql_error());
  $num_row=mysql_num_rows($result);
if($num_row){
   $time=date("Y-m-d H:i:s");

$row=mysql_fetch_array($result);

if($row[pin_account_date_expiration]> $time){
return $row[pin_account_serial];
}else if($row[pin_account_date_expiration]<= $time && ($row[time_end]==NULL || $row[time_end]=="0000-00-00")){
mysql_db_query($dbname,"update client_history set time_end='$time' where  history_id='$row[history_id]' ");
}
mysql_free_result($result);
}

return false;
}
function blockallmac(){
global $dbname;
$ip=Get_IP();
$mac=getmac($ip);
 $result_offline=mysql_db_query($dbname,"SELECT DISTINCT 
  client.client_id,
  client.mac_address,
  macpassthrough.allow,
  client_history.history_id
FROM
  macpassthrough
  RIGHT OUTER JOIN client ON (macpassthrough.mac_address = client.mac_address)
  LEFT OUTER JOIN client_history ON (client.client_id = client_history.client_id)
WHERE
  client.arp = 0") or die(mysql_error());
$num_row_offline=mysql_num_rows($result_offline);
if($num_row_offline){
/*
 if( !file_exists("/opt/lampp/htdocs/aim/tmp/sys_mac_block.ncm")){
  $FILE =fopen("/opt/lampp/htdocs/aim/tmp/sys_mac_block.ncm","w");
  fputs( $FILE,"\n");
   fclose($FILE);
 }
*/
  
 //$FILE =fopen("/opt/lampp/htdocs/aim/tmp/sys_mac_block.ncm","a"); 
 $mac_list=array();
  $mac_value=array();
	 $IFACE1=file("/var/ipcop/red/iface");	 
	 $IFACE=trim($IFACE[0]);
for($i=0;$i<$num_row_offline;$i++){
$row_offline=mysql_fetch_array($result_offline);
if($mac!=$row_offline[mac_address]){
  // fputs( $FILE, $row_offline[mac_address]."\n");
  if(preg_match("/[0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f]/i",$row_offline[mac_address])){
	
 iptables_inputdrop($row_offline[last_ip],$row_offline[mac_address],$IFACE);
    $mac_list[$i]=$row_offline[mac_address];
	 $mac_value[$i]=$row_offline[allow];
  $time=date("Y-m-d H:i:s");
	mysql_db_query($dbname,"update client set arp=0,online=0 where client_id='$row_offline[client_id]' ");
	if($row_offline[history_id]){
	mysql_db_query($dbname,"update client_history set time_end='$time' where history_id='$row_offline[history_id]'");
	}
}
   }

 }
 //fclose($FILE);


}

mysql_free_result($result_offline);
return array("mac_list"=>$mac_list,"mac_value"=>$mac_value);
}
function check_macblock(){
global $dbname,$DB;
$recordSet =GetRowAll("SELECT  DISTINCT
  client.mac_address,
  client.last_ip,
  client.client_id
FROM
  macpassthrough
  INNER JOIN client ON (macpassthrough.mac_address = client.mac_address)
WHERE
  macpassthrough.allow = 2 ") ;

 if( !file_exists("/opt/lampp/htdocs/aim/tmp/sys_mac_block.ncm")){
 shell_exec("/sbin/sudo -u root /bin/touch  /opt/lampp/htdocs/aim/tmp/sys_mac_block.ncm");
 }
 shell_exec("/sbin/sudo -u root chmod 777 /opt/lampp/htdocs/aim/tmp/sys_mac_block.ncm");
  if( !file_exists("/opt/lampp/htdocs/aim/tmp/ip_mac_block.ncm")){
 shell_exec("/sbin/sudo -u root /bin/touch  /opt/lampp/htdocs/aim/tmp/ip_mac_block.ncm");

 }
    shell_exec("/sbin/sudo -u root chmod 777 /opt/lampp/htdocs/aim/tmp/ip_mac_block.ncm");

   $list="";
   $ip="";
  

//$num_row_offline1=$recordSet->RecordCount();
while (!$recordSet->EOF) { 

 $list.=$recordSet->fields[mac_address]."\n";
 if($recordSet->fields[last_ip]){
$datarow1=GetRow1("SELECT * FROM  client WHERE last_ip='".$recordSet->fields[last_ip]."' and online=1");
if(!$datarow1[numrow]){
$ip.=$recordSet->fields[last_ip].";".$recordSet->fields[mac_address]."\n";
}
}
  $time=date("Y-m-d H:i:s");
UpdateInsert("update client set arp=false,online=false where client_id='".$recordSet->fields[client_id]."' ");
	$cfg_var[sql]="update login_remember SET login_remember.use=false where mac_address='".$recordSet->fields[mac_address]."'";
mysql_db_query($dbname,$cfg_var[sql]);
 
  $pid=str_replace(":","",$recordSet->fields[mac_address]);
   unlink("/opt/lampp/htdocs/aim/tmp/pid/".$pid.".pid");
  if(file_exists("/opt/lampp/htdocs/aim/tmp/pid/".$pid.".pid")) {
shell_exec("/sbin/sudo -u root rm /opt/lampp/htdocs/aim/tmp/pid/".$pid.".pid");
 }
  // $FILE =fopen("/opt/lampp/htdocs/aim/tmp/pid/".$pid.".pid","w");
  //  shell_exec("/sbin/sudo -u root chmod 777 /opt/lampp/htdocs/aim/tmp/pid/".$pid.".pid");
   $FILE =fopen("/opt/lampp/htdocs/aim/tmp/pid/".$pid.".pid","w"); 
$text=$recordSet->fields[last_ip]."\n";
$text.=$recordSet->fields[client_id]."\n";
$text.="0\n";
$text.="0\n";
$text.=$recordSet->fields[join]."\n";
$text.="\n";
$text.="\n";
    fputs( $FILE, $text);
fclose($FILE);

$recordSet->MoveNext(); 
}
  $recordSet->Close(); 

if(!file_exists("/opt/lampp/htdocs/aim/tmp/modelogserver")){
$recordSet =GetRowAll("SELECT DISTINCT 
  client.mac_address,
  client.last_ip,
  client.arp,
  client.online,
  (SELECT COUNT(*) AS FIELD_1 FROM webpassthrough WHERE webpassthrough.url = client.mac_address  or webpassthrough.url = client.last_ip ) AS control,
  macpassthrough.allow
FROM
  macpassthrough
  INNER JOIN client ON (macpassthrough.mac_address = client.mac_address)
WHERE
  client.arp = 1 AND 
  client.online = 0 and 
    (`macpassthrough`.allow IS NULL or macpassthrough.allow=0) or
  client.lastinterval >= (SELECT (now() - interval 45 minute) AS FIELD_1) AND 
  client.online = 0");
while (!$recordSet->EOF) { 

if(!$recordSet->fields[control]){
$list.=$recordSet->fields[mac_address]."\n";
if($recordSet->fields[last_ip]){

$datarow1=GetRow1("SELECT * FROM  client WHERE last_ip='".$recordSet->fields[last_ip]."'  and online=1");
if($datarow1[numrow]==0){
$ip.=$recordSet->fields[last_ip].";".$recordSet->fields[mac_address]."\n";
}
}
}
  $pid=str_replace(":","",$recordSet->fields[mac_address]);
    unlink("/opt/lampp/htdocs/aim/tmp/pid/".$pid.".pid");
  if(file_exists("/opt/lampp/htdocs/aim/tmp/pid/".$pid.".pid")) {
shell_exec("/sbin/sudo -u root rm /opt/lampp/htdocs/aim/tmp/pid/".$pid.".pid");
 }
  // $FILE =fopen("/opt/lampp/htdocs/aim/tmp/pid/".$pid.".pid","w");
  //  shell_exec("/sbin/sudo -u root chmod 777 /opt/lampp/htdocs/aim/tmp/pid/".$pid.".pid");
   $FILE =fopen("/opt/lampp/htdocs/aim/tmp/pid/".$pid.".pid","w"); 
$text=$recordSet->fields[last_ip]."\n";
$text.=$recordSet->fields[client_id]."\n";
$text.="0\n";
$text.="0\n";
$text.=$recordSet->fields[join]."\n";
$text.="\n";
$text.="\n";
    fputs( $FILE, $text);
fclose($FILE);
$recordSet->MoveNext(); 
}
  $recordSet->Close(); 

}
  $FILE =fopen("/opt/lampp/htdocs/aim/tmp/sys_mac_block.ncm","w"); 
  $FILE1 =fopen("/opt/lampp/htdocs/aim/tmp/ip_mac_block.ncm","w"); 
 fputs( $FILE, $list);
 fclose($FILE);
   fputs( $FILE1, $ip);
 fclose($FILE1);
 if($ip){
return true;
}else{
return false;
}
}
function setofflineblock($mac){
  
 $FILE =fopen("/opt/lampp/htdocs/aim/tmp/sys_mac_block.ncm","w"); 
 $list="";
for($i=0;$i<count($mac);$i++){
   $list.=$mac[$i]."\n";

}
 fputs( $FILE,  $list);
 fclose($FILE);
}
function cmp_mac($mac,$old_mac){
for($i=0;$i<count($old_mac);$i++){
if(	preg_match("/[0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f]/i",$mac) &&  preg_match("/[0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f]/i",$old_mac[$i])){
 if(strcmp($mac,trim($old_mac[$i]))==0){
return true;
break;
 }
 }
}
return false;
}
function check_maconline(){
global $dbname;
$Licensed=get_local_licensed("/opt/lampp/htdocs/aim/","/opt/lampp/htdocs/aim/admin/");
 $old_mac=file("/opt/lampp/htdocs/aim/tmp/sys_mac.ncm");
 $update=false;
  $time=date("Y-m-d H:i:s");

$results=mysql_db_query($dbname,"SELECT * from client_online_list");
$num_rows=mysql_num_rows($results);

$loop=1;
 if($num_rows){

  if($FILE =fopen("/opt/lampp/htdocs/aim/tmp/sys_mac.ncm","w")){
 $FILE =fopen("/opt/lampp/htdocs/aim/tmp/sys_mac.ncm","a"); 
/*  $FILE_RULES =fopen("/etc/ipac-ng/rules.conf","w");
  $RULES="incoming GREEN (eth0)|ipac~o|eth0|all|||\n";
 $RULES.="outgoing GREEN (eth0)|ipac~i|eth0|all|||\n";
 $RULES.="forwarded incoming GREEN (eth0)|ipac~fi|eth0|all|||\n";
 $RULES.="forwarded outgoing GREEN (eth0)|ipac~fo|eth0|all|||\n";
 $RULES.="incoming RED (ppp0)|ipac~o|ppp0|all|||\n";
 $RULES.="outgoing RED (ppp0)|ipac~i|ppp0|all|||\n";
 $RULES.="forwarded incoming RED (ppp0)|ipac~fi|ppp0|all|||\n";
 $RULES.="forwarded outgoing RED (ppp0)|ipac~fo|ppp0|all|||\n";
 fputs($FILE_RULES,$RULES);
*/
 $oldid="";
 $line="";
for($i=0;$i<$num_rows;$i++){
$rows=mysql_fetch_array($results);
if($oldid!=$rows[client_id]){
$oldid=$rows[client_id];
$expir=false;
if($rows[pin_account_serial]){
$result=mysql_db_query($dbname,"SELECT   * FROM  pin_account WHERE  pin_account_serial = '".$rows[pin_account_serial]."' AND 
  pin_account.pin_account_date_expiration <= now()");
  $num_row=mysql_num_rows($result);
if($num_row){
$expir=true;
 
}
mysql_free_result($result);
}
if(!$expir && $Licensed["_Client_Limit_"]>=$loop){

fputs( $FILE,$rows[mac_address]."\n");
//tc limit
 if(file_exists("/opt/lampp/htdocs/aim/tmp/tc_enable")){
$cmd="SELECT DISTINCT 
  client.online,
  client.last_ip,
  client_history.card_mode,
  client_history.member_id,
  client_history.time_start,
  client_history.time_end,
  client.mac_address,
  client_history.pin_account_serial,
  macpassthrough.limit_speed,
  macpassthrough.class_id,
  macpassthrough.allow,
  client.client_id,
  bandwidth_class.speed
FROM
  client_history
  INNER JOIN client ON (client_history.client_id = client.client_id)
  LEFT OUTER JOIN macpassthrough ON (client.mac_address = macpassthrough.mac_address)
  LEFT OUTER JOIN bandwidth_class ON (macpassthrough.class_id = bandwidth_class.class_id)
WHERE
  client_history.time_end IS NULL AND 
  client.client_id ='".$rows[client_id]."' order by time_start limit 0,1";
$result1=mysql_db_query($dbname,$cmd);
if(mysql_num_rows($result1)){
  $row1=mysql_fetch_array($result1);
  if($row1[card_mode]==99 && $row1[limit_speed] && $row1[class_id]>0){
 $line.=$rows[last_ip].";".$row1[class_id]."\n";
 }else  if($row1[card_mode]==0 && $row1[pin_account_serial]){
 $result2=mysql_db_query($dbname,"SELECT   * FROM  pin_account WHERE  pin_account_serial = '".$row1[pin_account_serial]."' ");
if(mysql_num_rows($result2)){

  $row2=mysql_fetch_array($result2);
    if($row2[class_id]>0){
 $line.=$rows[last_ip].";".$row2[class_id]."\n";
 }}
 }else  if($row1[card_mode]==1 && $row1[pin_account_serial]){
 $result3=mysql_db_query($dbname,"SELECT   * FROM  time_account WHERE  time_account_serial = '".$row1[pin_account_serial]."' ");
if(mysql_num_rows($result3)){
  $row3=mysql_fetch_array($result3);
  if($row3[class_id]>0){
 $line.=$rows[last_ip].";".$row3[class_id]."\n";
 }}
 }else  if($row1[card_mode]==2 && $row1[member_id]){
 $result4=mysql_db_query($dbname,"SELECT   * FROM  member_account WHERE  member_id = '".$row1[member_id]."' ");
if(mysql_num_rows($result4)){
  $row4=mysql_fetch_array($result4);
  if($row4[class_id]>0 && $row4[limit_speed]){
 $line.=$rows[last_ip].";".$row4[class_id]."\n";
 }}
 }
 }
 }

$loop++;
if(!$update){
 if(cmp_mac($rows[mac_address],$old_mac)==false){
  $update=true;
 }
 }
 
}else{
  mysql_db_query($dbname,"update client set online=false where client_id='".$rows[client_id]."' ");

	 
	  if($expir){
  $text_debug= $time." ".$rows[pin_account_serial]." expire by ".$rows[ip_address]."\n";
  print_debug($text_debug);
  }
  
}


 }else{
 $text_debug= $time." ".$rows[client_id]." expire by ".$rows[ip_address]."\n";
  print_debug($text_debug);
 }

 }
 }
fclose($FILE);

 if(file_exists("/opt/lampp/htdocs/aim/tmp/tc_enable")){
$filename1="/opt/lampp/htdocs/aim/tmp/limit_bandwidth";
shell_exec('/sbin/sudo -u root echo "'.$line.'" > '.$filename1.'');
}
}else{
 $FILE =fopen("/opt/lampp/htdocs/aim/tmp/sys_mac.ncm","w");
 fputs( $FILE, "\n");
fclose($FILE);

 
}
mysql_free_result($results);

return  $update;

}

function save_oldtraffic($client_id,$ip,$add_after){
global $dbname;



  $Cfg_Variable["Command"]="SELECT DISTINCT    * FROM  check_client WHERE  check_client.client_id= '".$client_id."' and (time_end is NULL or time_end='0000-00-00') order by time_start DESC limit 0,1";
	$Cfg_Variable["Result"]=mysql_db_query($dbname,$Cfg_Variable["Command"]) or die (mysql_error());
	$Cfg_Variable["TRecord"]=mysql_num_rows($Cfg_Variable["Result"]);
	if($Cfg_Variable["TRecord"]){
	$row=mysql_fetch_array($Cfg_Variable["Result"]);
  update_client_traffic_month($client_id,$row[traffic_down],$row[traffic_up]);
  mysql_db_query($dbname,"update client SET traffic_down='0' ,traffic_up='0'  where client_id='".$client_id."' ")or die(mysql_error()); 
if($row[member_id]){
mysql_db_query($dbname,"update member_account SET traffic_down='0' ,traffic_up='0'  where  member_id = '".$row[member_id]."'")or die(mysql_error()); 
update_member_traffic_month($row[member_id],$row[traffic_down],$row[traffic_up]);
}
 mysql_db_query($dbname,"update client_history SET traffic_down='".$row[traffic_down]."' ,traffic_up='".$row[traffic_up]."' ,time_end=NOW()   where client_id='".$client_id."' and (time_end is NULL or time_end='0000-00-00')")or die(mysql_error()); 
 if($add_after){
 mysql_db_query($dbname,"INSERT INTO client_history (client_id,pin_account_serial,card_mode,pc_name,ip_address,member_id,time_start,time_end) VALUES('".$client_id."','".$row[pin_account_serial]."','".$row[card_mode]."','".$row[pc_name]."','".$row[ip_address]."','".$row[member_id]."',NOW(),NULL)")or die(mysql_error()); 
	
 
 }
}

 
}

function clear_myblock(){
global $dbname,$reload_config_enable,$debug,$pc_name,$mac,$Licensed,$pc_name,$ip,$Cfg_Variable;

}
function clear_mynat(){
global $dbname,$reload_config_enable,$mac,$Licensed,$pc_name,$ip,$Cfg_Variable,$server_ip,$IFACE;

$line=shell_exec('/sbin/sudo -u root /sbin/iptables -t nat -L CUSTOMPREROUTING -nvx |grep  eth0');
$line1=split("\n",$line);
$row=sizeof($line1)/3;

for($i=0;$i<$row;$i++){
 shell_exec("/sbin/sudo -u root  /sbin/iptables -D AIM_FORWARD -o ".$IFACE."  -s ".$ip." -j DROP");
 shell_exec("/sbin/sudo -u root /sbin/iptables -D AIM_FORWARD -i ".$IFACE."  -d  ".$ip." -j DROP");	
  shell_exec("/sbin/sudo -u root  /sbin/iptables -D AIM_FORWARD -o ".$IFACE." -m mac --mac-source ".$mac." -j DROP");
shell_exec("/sbin/sudo -u root  /sbin/iptables -t nat -D CUSTOMPREROUTING -m mac --mac-source ".$mac." -j RETURN");

  shell_exec("/sbin/sudo -u root   /sbin/iptables -t nat -D CUSTOMPREROUTING -p tcp -i eth0 --dport 80 -j DNAT --to-destination ".$server_ip.":80");
}
}
function reload_online(){
global $dbname,$reload_config_enable,$clientout,$debug,$pc_name,$mac,$Licensed,$pc_name,$ip,$server_ip,$Cfg_Variable,$aim_serial,$mode;
	 $IFACE1=file("/var/ipcop/red/iface");	 
	 $IFACE=trim($IFACE[0]);
$old_mac=file("/opt/lampp/htdocs/aim/tmp/sys_mac.ncm");
$update=cmp_mac($mac,$old_mac);

if(!$update && !$clientout){
   $FILE =fopen("/opt/lampp/htdocs/aim/tmp/sys_mac.ncm","a"); 
  fputs( $FILE,$mac."\n");
fclose($FILE);
$update=true;
}else{
$reset_mac=check_statall();


}

if($clientout && !$Cfg_Variable[API_NCM]["NewCmd"]){
unlink("/opt/lampp/htdocs/aim/tmp/sys_mac_block.ncm");
 $FILE =fopen("/opt/lampp/htdocs/aim/tmp/sys_mac_block.ncm","w"); 
  fputs( $FILE,$mac."\n");
fclose($FILE);
$update=true;
}

$this_time=date("d-m-Y H:i:s");
if($aim_serial){
$pc_name="User : ".$aim_serial." mode : ". $mode;
}
$pc_name.=" ".$ip."  ".$mac;

if($clientout){
  $cc=$pc_name." Logout\n";
}else{
  $cc=$pc_name." Login\n";
  }
  $text_debug.= $this_time." ".$cc;
  print_debug($text_debug);
  
  if($clientout ){
//  if(preg_match("/[0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f]/i",$mac)){

iptables_inputdrop($ip,$mac,$IFACE);



if(!file_exists("/opt/lampp/htdocs/aim/tmp/closbeep.aim")){
 shell_exec("/sbin/sudo -u root  /usr/bin/beep -l 30 -f 850 ");
 }
}
//}
if($Cfg_Variable[API_NCM]["NewCmd"] && !$clientout){
//my_ClearDroprule($mac,$ip);


 // if(preg_match("/[0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f]/i",$mac)){
/*
$cmd='/sbin/sudo -u root /sbin/iptables -L CUSTOMPREROUTING -t nat -v -n | grep '.$mac.' | /usr/bin/awk "{print \$11}"';
exec($cmd,$rules);
$cmd1="";
for($i=0;$i<sizeof($rules);$i++){
$cmd1.="/sbin/sudo -u root  /sbin/iptables -t nat -D CUSTOMPREROUTING -m mac --mac-source ".$mac." -j RETURN >/dev/null\n";
		}
 shell_exec($cmd1);
  iptables_clearinputdrop($ip,$mac,$IFACE);

  shell_exec("/sbin/sudo -u root  /sbin/iptables -t nat -I CUSTOMPREROUTING -m mac --mac-source ".$mac." -j RETURN");
  */
$mac=exec("/sbin/sudo -u root  /opt/lampp/htdocs/aim/tmp/shellfnc.sh createlogin ".$ip." ".$mac);
if(!file_exists("/opt/lampp/htdocs/aim/tmp/closbeep.aim")){
  shell_exec("/sbin/sudo -u root  /usr/bin/beep -l 30 -f 850 -r 2");
  }
  //}
  }elseif(!$clientout){
  sleep(1);
cmd_aim(true);
}
if(count($reset_mac)){
 if($Licensed["_Card_"][11]==1){
 $my_allow=0;
 }else{
  $my_allow=2;
 }
retrun_stat($reset_mac,$my_allow);
}
return true;
}
function getlisthostname(){
global $cfg_host;
shell_exec('/sbin/sudo -u root arp -a -i eth0 | /usr/bin/awk "{print \$4 \"=\" \$1}" >/opt/lampp/htdocs/aim/tmp/hostname');
 $cfgfile="/opt/lampp/htdocs/aim/tmp/hostname";
 $lines = file($cfgfile);



	foreach ($lines as  $line) {
		
		if (preg_match("/(.*?)[\=](.*?)\n/i",$line,$matches)){
			if(trim($matches[2])!="?"){
			$host=explode(".",trim($matches[2]));
			$cfg_host[$matches[1]]=$host[0];
			}else{
			$cfg_host[$matches[1]]="";
			}
			
		 }

	}
}
function getlisthostname2(){
global $cfg_host2;
shell_exec('/sbin/sudo -u root arp -a -i eth0 | /usr/bin/awk "{print \$4 \"=\" \$1}" >/opt/lampp/htdocs/aim/tmp/hostname2');
 $cfgfile="/opt/lampp/htdocs/aim/tmp/hostname2";
 $lines = file($cfgfile);



	foreach ($lines as  $line) {
		
		if (preg_match("/(.*?)[\=](.*?)\n/i",$line,$matches)){
			if(trim($matches[2])!="?"){
			$host=explode(".",trim($matches[2]));
			$cfg_host2[$matches[1]]=$host[0];
			}else{
			$cfg_host2[$matches[1]]="";
			}
			
		 }

	}
}
function update_arp(){
global $dbname,$cfg_host2;
getlisthostname2();
$filename1="/opt/lampp/htdocs/aim/tmp/arpscan2.aim";
$filename2="/opt/lampp/htdocs/aim/tmp/arpip2.aim";
if(file_exists($filename1)){

//end list old online
	$arp=file($filename1);
	$arpip=file($filename2);
	
	  $LOOP=0;
	  $new_list=array();
	 foreach($arp as $line)
{
$mac=trim($line);
$ip=trim($arpip[$LOOP+1]);
	
	//	$text_debug.= $mac."  get config  by server \n";
	if(preg_match("/[0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f]/i",$mac) && $mac !="00:00:00:00:00:00" ){
	$new_list[$LOOP]=$mac;
	$LOOP++;

$result =GetRow1("SELECT 
 
  client.remark,
  client.mac_address,
  client.client_id
FROM
 client 
  WHERE
  client.mac_address ='$mac'  limit 1");

$pc=$cfg_host2[strtoupper($mac)];

if($result[numrow]<=0){
	UpdateInsert("INSERT INTO client (mac_address,arp,online,client.join,remark,last_ip,lastinterval) VALUES ('".strtoupper($mac)."',true,false,false,'','".$ip."',NOW()) ");
	$text_debug.= $mac."  add  by server \n";
	
}else{
$row=$result[data];

$command="update client set arp=true,lastinterval=NOW()";


if($pc){
$command.=",remark='".$pc."'";
}
if($ip){
$command.=",last_ip='".$ip."'";
}
//$text_debug.= $mac." ".$pc." update by server \n";
$command.=" where mac_address='".$mac."' ";
UpdateInsert($command);

}
}

}
}
}
function get_arpscan(){
global $dbname,$debug,$Cfg_Variable,$DB,$cfg_host;
$offlinemac=array();
 $old_mac=file("/opt/lampp/htdocs/aim/tmp/sys_mac.ncm");
  $update=false;
$f=0;

	shell_exec('/sbin/sudo -u root /usr/local/bin/scanip');
getlisthostname();
	 check_history_bug();
$filename="/opt/lampp/htdocs/aim/tmp/arpscan.tmp";
$filename1="/opt/lampp/htdocs/aim/tmp/arpscan.aim";
$filename2="/opt/lampp/htdocs/aim/tmp/arpip.aim";
//old function

if(file_exists($filename)){

//end list old online
	$arp=file($filename);
	$arpip=file($filename2);
	  mysql_db_query($dbname,"update client set arp=false");
	  $LOOP=0;
	  $new_list=array();
	 foreach($arp as $line)
{
$mac=trim($line);
$ip=trim($arpip[$LOOP+1]);
	
	//	$text_debug.= $mac."  get config  by server \n";
	if(preg_match("/[0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f]/i",$mac) && $mac !="00:00:00:00:00:00" ){
	$new_list[$LOOP]=$mac;
	$LOOP++;

$result =GetRow1("SELECT 
  macpassthrough.allow,
  client.remark,
  client.mac_address,
  client.client_id
FROM
  macpassthrough
  RIGHT OUTER JOIN client ON (macpassthrough.mac_address = client.mac_address)
  WHERE
  client.mac_address ='$mac'  limit 1");
//if($ip){
$pc=$cfg_host[strtoupper($mac)];
//$pc=gethostname($ip);
/*if($pc=="reache"){
$pc="";
}
$pc=strtolower($pc); 
*/
//}
if($result[numrow]<=0){
	UpdateInsert("INSERT INTO client (mac_address,arp,online,client.join,remark,last_ip,lastinterval) VALUES ('".strtoupper($mac)."',true,false,false,'','".$ip."',NOW()) ");
	$text_debug.= $mac."  add  by server \n";
	
}else{
$row=$result[data];

$command="update client set arp=true,lastinterval=NOW()";

if($row[allow]==1){
$command.=",online=true";
}
if($pc){
$command.=",remark='".$pc."'";
}
if($ip){
$command.=",last_ip='".$ip."'";
}
//$text_debug.= $mac." ".$pc." update by server \n";
$command.=" where mac_address='".$mac."' ";
UpdateInsert($command);
if($row[allow]==1){
$datarow=GetRow1("SELECT  client_id  FROM client_history where client_id='".$row[client_id]."' and time_end is NULL LIMIT 1");
if(!$datarow[numrow]){
$rowm=$datarow1[data];
UpdateInsert("INSERT INTO client_history (client_id,pin_account_serial,card_mode,pc_name,ip_address,time_start,time_end) VALUES('".$row[client_id]."','','99','".$pc."','".$ip."',NOW(),NULL)"); 
}
}
}
}

}
}

//recheckonline();


if(!$Cfg_Variable[API_NCM]["remember"]){
//reset online when remember 
$recordSet =GetRowAll("SELECT DISTINCT 
  login_remember.expire,
  login_remember.mac_address,
  client.arp,
  client.online,
  client.client_id,
  client.last_ip,
  login_remember.`use`,
  macpassthrough.allow
FROM
  login_remember
  INNER JOIN client ON (login_remember.mac_address = client.mac_address)
  INNER JOIN macpassthrough ON (client.mac_address = macpassthrough.mac_address)
WHERE
  login_remember.`use` = 1 AND 
  (client.arp =0 or client.arp IS NULL ) and
  macpassthrough.allow < 2 AND 
  login_remember.expire > NOW()");

while (!$recordSet->EOF) { 
$up=0;
if($recordSet->fields[allow]==0){
$datarow=GetRow1("SELECT  client_id  FROM client_history where client_id='".$recordSet->fields[client_id] ."' and time_end is NULL");
if(!$datarow[numrow]){
$datarow1=GetRow1("SELECT  pin_account_serial,card_mode,pc_name FROM client_history where client_id='".$recordSet->fields[client_id] ."'  order by history_id DESC limit 0,1");
if($datarow1[numrow]){
$rowm=$datarow1[data];
UpdateInsert("INSERT INTO client_history (client_id,pin_account_serial,card_mode,pc_name,ip_address,time_start,time_end) VALUES('".$recordSet->fields[client_id]."','".$rowm[pin_account_serial]."',".$rowm[card_mode].",'".$rowm[pc_name]."','".$recordSet->fields[last_ip]."',NOW(),NULL)"); 
$up=1;
}else{$up=0;}
}//else{$up=1;}
}
if($up){
UpdateInsert("update client set online=true,arp=true,lastinterval=NOW()  where mac_address='".$recordSet->fields[mac_address]."' ");
 $text_debug.="reset online when remember  : ".$recordSet->fields[mac_address]."\n";

 if(cmp_mac($recordSet->fields[mac_address],$old_mac)==false){
  $update=true;
 
 }
 }
 
 $recordSet->MoveNext(); 
}
  $recordSet->Close(); 
//reset online when member remember 

$recordSet =GetRowAll("SELECT DISTINCT 
  client.client_id,
  client.mac_address,
  client.arp,
  client.online,
  client.last_ip,
  client.lastinterval,
  login_remember.expire
FROM
  client_history
  RIGHT OUTER JOIN client ON (client_history.client_id = client.client_id)
  LEFT OUTER JOIN login_remember ON (client.mac_address = login_remember.mac_address)
  LEFT OUTER JOIN member_account ON (client_history.member_id = member_account.member_id)
WHERE
  client_history.card_mode = 2 AND 
  login_remember.`use` = true AND 
  (client.arp = 0 OR 
  client.arp IS NULL) AND 
  login_remember.expire > NOW() AND 
  client_history.time_end IS NULL AND 
  member_account.expire_unlimit_time > NOW()");

while (!$recordSet->EOF) { 
$up=0;
$datarow=GetRow1("SELECT  client_id  FROM client_history where client_id='".$recordSet->fields[client_id] ."' and time_end is NULL");
if(!$datarow[numrow]){
$datarow1=GetRow1("SELECT  pin_account_serial,card_mode,pc_name FROM client_history where client_id='".$recordSet->fields[client_id] ."'  order by history_id DESC limit 0,1");
if($datarow1[numrow]){
$rowm=$datarow1[data];
UpdateInsert("INSERT INTO client_history (client_id,pin_account_serial,card_mode,pc_name,ip_address,time_start,time_end) VALUES('".$recordSet->fields[client_id]."','".$rowm[pin_account_serial]."',".$rowm[card_mode].",'".$rowm[pc_name]."','".$recordSet->fields[last_ip]."',NOW(),NULL)"); 
$up=1;
}else{$up=0;}
} //else{$up=1;}
if($up){
UpdateInsert("update client set online=true,arp=true,lastinterval=NOW()  where mac_address='".$recordSet->fields[mac_address]."' ");

   $text_debug.="reset online when member remember  : ".$recordSet->fields[mac_address]."\n";
 
   if(cmp_mac($recordSet->fields[mac_address],$old_mac)==false){
  $update=true;
  

 }
}
 $recordSet->MoveNext(); 
}
  $recordSet->Close(); 

  //reset offline when vip  expire
$recordSet =GetRowAll("SELECT DISTINCT 
  client.client_id,
  client.mac_address
FROM
  client_history
  INNER JOIN client ON (client_history.client_id = client.client_id)
  INNER JOIN login_remember ON (client.mac_address = login_remember.mac_address)
WHERE
  client_history.card_mode = 99 AND 
    client.lastinterval <= (SELECT (now() - interval 60 minute) AS FIELD_1) AND 
    client.arp = false AND client.online= true AND
((login_remember.expire <= NOW()  AND login_remember.`use` = true ) or  login_remember.`use` = false )");
while (!$recordSet->EOF) { 


UpdateInsert("update client set online=false,arp=false where mac_address='".$recordSet->fields[mac_address]."' ");
UpdateInsert("update login_remember SET login_remember.use=false where mac_address='".$recordSet->fields[mac_address]."' ");

$text_debug.= $recordSet->fields[mac_address]."  set offline  VIP by server \n";

   if(cmp_mac($recordSet->fields[mac_address],$old_mac)==false){
  $update=true;
 }
 $recordSet->MoveNext(); 
}
  $recordSet->Close();
  
//reset offline when member  expire
$recordSet =GetRowAll("SELECT DISTINCT 
  client.client_id,
  client.mac_address,
  client.arp,
  client.online,
  client.lastinterval,
  login_remember.expire
FROM
  client_history
  INNER JOIN client ON (client_history.client_id = client.client_id)
  INNER JOIN login_remember ON (client.mac_address = login_remember.mac_address)
WHERE
  (client_history.card_mode = 0 OR 
  client_history.card_mode = 2) AND 
  login_remember.expire <= NOW() AND 
  client_history.time_end IS NULL AND 
  client.lastinterval <= (SELECT (now() - interval 30 minute) AS FIELD_1) AND 
  client.arp = 0");
while (!$recordSet->EOF) { 


UpdateInsert("update client set online=false,arp=false where mac_address='".$recordSet->fields[mac_address]."' ");
UpdateInsert("update login_remember SET login_remember.use=false where mac_address='".$recordSet->fields[mac_address]."' ");

$text_debug.= $recordSet->fields[mac_address]."  set offline by server \n";

   if(cmp_mac($recordSet->fields[mac_address],$old_mac)==false){
  $update=true;
 }
 $recordSet->MoveNext(); 
}
  $recordSet->Close();
  /*
//reset offline when member remember expire
$recordSet =GetRowAll("SELECT DISTINCT 
  client.client_id,
  client.mac_address,
  client.arp,
  client.online,
  client.lastinterval,
  login_remember.expire
FROM
  client_history
  INNER JOIN client ON (client_history.client_id = client.client_id)
  INNER JOIN login_remember ON (client.mac_address = login_remember.mac_address)
  INNER JOIN member_account ON (client_history.member_id = member_account.member_id)
WHERE
 client_history.card_mode = 2 AND 
 login_remember.use =true AND 
  login_remember.expire <= NOW() AND 
  client_history.time_end IS NULL AND 
  member_account.expire_unlimit_time > NOW() ");
while (!$recordSet->EOF) { 

UpdateInsert("update client set online=false,arp=false where mac_address='".$recordSet->fields[mac_address]."' ");
UpdateInsert("update login_remember SET login_remember.use=false where mac_address='".$recordSet->fields[mac_address]."' ");


$text_debug.= $recordSet->fields[mac_address]."  set offline by server \n";

  if(cmp_mac($recordSet->fields[mac_address],$old_mac)==false){
  $update=true;
 }
 $recordSet->MoveNext(); 
}
  $recordSet->Close();
*/
}
//default internet time out
 $result_tmpl=mysql_db_query($dbname,"SELECT * from card where templates='default_idle'") or die(mysql_error());
$num_row_tmpl=mysql_num_rows($result_tmpl);
if($num_row_tmpl){
$row_tmpl=mysql_fetch_array($result_tmpl);
$default_idle=$row_tmpl[data];
}else{
$default_idle=3;
}
 //reset online when member remember 

$recordSet =GetRowAll("SELECT DISTINCT 
  client.client_id,
  client.mac_address,
  client.arp,
  client.online,
  client.last_ip,
  client.lastinterval
FROM
  client_history
  RIGHT OUTER JOIN client ON (client_history.client_id = client.client_id)
  LEFT OUTER JOIN member_account ON (client_history.member_id = member_account.member_id)
WHERE
  client_history.card_mode = 2 AND 
  (client.arp = 0 OR 
  client.arp IS NULL) AND 
  client.online = 1 AND
  client_history.time_end IS NULL AND 
  member_account.expire_unlimit_time > NOW() and
  client.lastinterval >= (SELECT (now() - interval ".$default_idle." hour) AS FIELD_1) ");
 
while (!$recordSet->EOF) { 
$up=0;
$datarow=GetRow1("SELECT  client_id  FROM client_history where client_id='".$recordSet->fields[client_id] ."' and time_end is NULL");
if(!$datarow[numrow]){
$datarow1=GetRow1("SELECT  pin_account_serial,card_mode,pc_name FROM client_history where client_id='".$recordSet->fields[client_id] ."'  order by history_id DESC limit 0,1");
if($datarow1[numrow]){
$rowm=$datarow1[data];
$datarow2=GetRow1("select * from member_account where member_user='".$rowm[pin_account_serial]."'");
$rows=$datarow1[data];
$this_time=date("Y-m-d H:i:s");
 if(strtotime($rows[expire_unlimit_time])>strtotime($this_time)){
UpdateInsert("INSERT INTO client_history (client_id,pin_account_serial,card_mode,pc_name,ip_address,time_start,time_end) VALUES('".$recordSet->fields[client_id]."','".$rowm[pin_account_serial]."',".$rowm[card_mode].",'".$rowm[pc_name]."','".$recordSet->fields[last_ip]."',NOW(),NULL)"); 
$up=1;
}else{$up=0;}
}else{$up=0;}
}else{
$up=1;
}
if($up){
UpdateInsert("update client set online=true,arp=true  where mac_address='".$recordSet->fields[mac_address]."' ");
  $text_debug.="reset online  default  member remember   : ".$recordSet->fields[mac_address]."\n";
 
 
   if(cmp_mac($recordSet->fields[mac_address],$old_mac)==false){
  $update=true;
  

 }
}
 $recordSet->MoveNext(); 
}
  $recordSet->Close(); 
 
//reset online when default time out 
$recordSet =GetRowAll("SELECT DISTINCT 
  client.arp,
  client.online,
    client.mac_address,
  client.client_id,
  client.last_ip,
  macpassthrough.allow
FROM
  client
  INNER JOIN macpassthrough ON (client.mac_address = macpassthrough.mac_address)
WHERE
  (client.arp = 0 OR 
  client.arp IS NULL) AND 
  client.online = 1 AND
  macpassthrough.allow < 2 and
  client.lastinterval >= (SELECT (now() - interval ".$default_idle." hour) AS FIELD_1) ");

while (!$recordSet->EOF) { 
$up=0;
if($recordSet->fields[allow]==0){
$datarow=GetRow1("SELECT  client_id  FROM client_history where client_id='".$recordSet->fields[client_id] ."' and time_end is NULL");
if(!$datarow[numrow]){
$datarow1=GetRow1("SELECT  pin_account_serial,card_mode,pc_name FROM client_history where client_id='".$recordSet->fields[client_id] ."'  order by history_id DESC limit 0,1");
if($datarow1[numrow]){
$rowm=$datarow1[data];
if($rowm[card_mode]==99){
UpdateInsert("INSERT INTO client_history (client_id,pin_account_serial,card_mode,pc_name,ip_address,time_start,time_end) VALUES('".$recordSet->fields[client_id]."','".$rowm[pin_account_serial]."',".$rowm[card_mode].",'".$rowm[pc_name]."','".$recordSet->fields[last_ip]."',NOW(),NULL)"); 
$up=1;
}elseif($rowm[card_mode]==0){
$datarow2=GetRow1("SELECT   * FROM pin_account where  pin_account_serial='".$rowm[pin_account_serial]."' ");
	$rows=$datarow1[data];
	$this_time=date("Y-m-d H:i:s");
if($rows[pin_account_date_expiration]>$this_time){
UpdateInsert("INSERT INTO client_history (client_id,pin_account_serial,card_mode,pc_name,ip_address,time_start,time_end) VALUES('".$recordSet->fields[client_id]."','".$rowm[pin_account_serial]."',".$rowm[card_mode].",'".$rowm[pc_name]."','".$recordSet->fields[last_ip]."',NOW(),NULL)"); 
$up=1;
}else{$up=0;}
	}else{$up=0;}
}else{$up=0;}
}else{
$up=1;
}
}
if($up){
UpdateInsert("update client set online=true,arp=true where mac_address='".$recordSet->fields[mac_address]."' ");
  $text_debug.="reset online default remember  : ".$recordSet->fields[mac_address]."\n";

 if(cmp_mac($recordSet->fields[mac_address],$old_mac)==false){
  $update=true;

 }
 }
 
 $recordSet->MoveNext(); 
}
  $recordSet->Close(); 

 


  
  //------------------------------------------
$this_time=date("Y-m-d H:i:s");


$data[0]=0;
$data[1]=0;
/*
//reset online when auto not arp
$result1=mysql_db_query($dbname,"SELECT *from   auto_group_reset_online")or die(mysql_error());
$num_row1=mysql_num_rows($result1);

for($i=0;$i<$num_row1;$i++){
$row1=mysql_fetch_array($result1);
if($row1[allow]==1){
mysql_db_query($dbname,"update client set arp=true,online=true,lastinterval=NOW() where client_id='$row1[client_id]'");
}else{
mysql_db_query($dbname,"update client set arp=true,lastinterval=NOW() where client_id='$row1[client_id]'");
}
//$text_debug.= $row1[remark]."  set arp and online auto by server \n";
}
mysql_free_result($result1);
*/
//reset offline when group auto  time out
$cmd1="SELECT 
  auto_group_reset_timeout.client_id,
  auto_group_reset_timeout.remark,
  auto_group_reset_timeout.last_ip,
  auto_group_reset_timeout.online,
  auto_group_reset_timeout.lastinterval,
  auto_group_reset_timeout.mac_address
FROM ";
if(!$Cfg_Variable[API_NCM]["remember"]){
$cmd1.=" login_remember
  RIGHT OUTER JOIN auto_group_reset_timeout ON (login_remember.mac_address = auto_group_reset_timeout.mac_address) WHERE   ( login_remember.expire <= NOW() and login_remember.use=1) or login_remember.expire IS NULL";
}else{
$cmd1.="auto_group_reset_timeout  where lastinterval <= (select (now() - interval ".$default_idle." hour) AS FIELD_1)";
}
$recordSet =GetRowAll($cmd1);
while (!$recordSet->EOF) { 


$text_debug.=  $recordSet->fields[mac_address]."  from VIP group set offline auto group by server \n";

UpdateInsert("update client set online=false,arp=false,traffic_down='".$data[0]."',traffic_up='".$data[1]."' where client_id='".$recordSet->fields[client_id]."' ");

 if(cmp_mac($recordSet->fields[mac_address],$old_mac)==false){
  $update=true;

 }
 
 $recordSet->MoveNext(); 
}
  $recordSet->Close();
  //reset offline when off free mode vip
$recordSet =GetRowAll("SELECT DISTINCT 
  client.client_id,
  client.arp,
  client.online,
  client.`join`,
  client.last_ip,
  client.lastinterval,
  macpassthrough.allow,
  client.mac_address,
  (select client_history.card_mode from client_history where client_history.client_id=client.client_id order by client_history.history_id DESC limit 1) as card_mode
FROM
  macpassthrough
  INNER JOIN client ON (macpassthrough.mac_address = client.mac_address)
WHERE
  (macpassthrough.allow IS NULL OR 
  macpassthrough.allow = 0) AND 
  client.online = 1");
while (!$recordSet->EOF) { 

if($recordSet->fields[card_mode]==99){
UpdateInsert("update client set online=false,arp=false where mac_address='".$recordSet->fields[mac_address]."' ");
UpdateInsert("update login_remember SET login_remember.use=false where mac_address='".$recordSet->fields[mac_address]."' ");

$text_debug.= $recordSet->fields[mac_address]."  set offline  bug Free Mode by server \n";

   if(cmp_mac($recordSet->fields[mac_address],$old_mac)==false){
  $update=true;
 }
 }
 $recordSet->MoveNext(); 
}
  $recordSet->Close();
//create histor when auto not have history
$result1=mysql_db_query($dbname,"SELECT 
  macpassthrough.allow,
  client.remark,
  client.client_id,
  client.mac_address,
  client.last_ip
FROM
  macpassthrough
  INNER JOIN client ON (macpassthrough.mac_address = client.mac_address)
  LEFT OUTER JOIN client_history ON (client.client_id = client_history.client_id and `client_history`.`time_end` IS NULL)
WHERE
  client.online = 1 AND 
  macpassthrough.allow = 1 AND 
  client_history.history_id IS  NULL")or die(mysql_error());
$num_row1=mysql_num_rows($result1);

for($i=0;$i<$num_row1;$i++){
$row1=mysql_fetch_array($result1);
UpdateInsert("INSERT INTO client_history (client_id,pin_account_serial,card_mode,pc_name,ip_address,time_start,time_end) VALUES('".$row1[client_id]."','',99,'".$row1[remark]."','".$row1[last_ip]."',NOW(),NULL)"); 
	$text_debug.= $row1[mac_address]."  create history by server \n";

}
mysql_free_result($result1);
//reset offline when group auth  time out
$cmd="SELECT 
  auth_group_reset_timeout.remark,
  auth_group_reset_timeout.mac_address,
  auth_group_reset_timeout.last_ip,
  auth_group_reset_timeout.client_id
FROM ";
 
if(!$Cfg_Variable[API_NCM]["remember"]){
$cmd.=" login_remember
  RIGHT OUTER JOIN auth_group_reset_timeout ON (login_remember.mac_address = auth_group_reset_timeout.mac_address) WHERE  ( login_remember.expire <= NOW() and login_remember.use=1) or login_remember.expire IS NULL ";
}else{

$cmd.=" auth_group_reset_timeout";
}
$recordSet =GetRowAll($cmd);

while (!$recordSet->EOF) { 


/*
$data=get_my_traffic($row1[last_ip]);
if(API_NCM_TRAFFIC_SHIP>=abs(($data[0])-$row1[traffic_down]) && find_my_rule($row1[last_ip])){
$offlinemac[$f++]=$row1[mac_address];
$down=$data[0]+$row1[traffic_down];
$up=$data[1]+$row1[traffic_up];
*/
$text_debug.=  $recordSet->fields[mac_address]."  from authen group set offline by server \n";

UpdateInsert("update client set online=false,arp=false,traffic_down='".$data[0]."',traffic_up='".$data[1]."' where client_id='".$recordSet->fields[client_id]."'");

  if(cmp_mac($recordSet->fields[mac_address],$old_mac)==false){
  $update=true;
 }

 $recordSet->MoveNext(); 
}
  $recordSet->Close();
//reset offline when hour group   time out
$recordSet =GetRowAll("SELECT * from time_group_reset_timeout ");


while (!$recordSet->EOF) { 
$time_online=time();
$remain=$recordSet->fields[time_account_date_expiration]-($time_online-strtotime($recordSet->fields[time_account_update]));
$time_out=$time_online-strtotime($recordSet->fields[time_account_update]);



if($time_out<=7200 && $remain>0){

		UpdateInsert("update time_account SET time_account_date_expiration='$remain' ,time_account_update=NOW() where time_account_serial='".$recordSet->fields[pin_account_serial]."'"); 

		}


if($remain<=0 || $time_out>7200){
$offlinemac[$f++]=$recordSet->fields[mac_address];
UpdateInsert("update time_account SET time_account_date_expiration='0' ,time_account_update=NOW() where time_account_serial='".$recordSet->fields[pin_account_serial]."'"); 

UpdateInsert("update client set online=false,arp=false where client_id='".$recordSet->fields[client_id]."'");
UpdateInsert("update client_history set time_end=NOW() where  history_id='".$recordSet->fields[history_id]."'");
$text_debug.=  $recordSet->fields[mac_address]."  from hour group set offline by server \n";

  if(cmp_mac($recordSet->fields[mac_address],$old_mac)==false){
  $update=true;
 }
}

 $recordSet->MoveNext(); 
}
  $recordSet->Close();
//reset offline when member group   time out
$cmd2="SELECT 
  member_group_reset_timeout.mac_address,
  member_group_reset_timeout.client_id,
  member_group_reset_timeout.ip_address,
  member_group_reset_timeout.remark
FROM ";
if(!$Cfg_Variable[API_NCM]["remember"]){
$cmd2.="   login_remember
  RIGHT OUTER JOIN member_group_reset_timeout ON (login_remember.mac_address = member_group_reset_timeout.mac_address)
WHERE  (( login_remember.expire <= NOW() and login_remember.use=1) or login_remember.expire IS NULL)AND  ";
}else{
$cmd2.="  member_group_reset_timeout  WHERE";
}
 
  $cmd2.=" member_group_reset_timeout.expire_unlimit_time > NOW()  and lastinterval <= (select (now() - interval 30 minute) AS `FIELD_1`)";
//print_debug($cmd2."\n");
$recordSet =GetRowAll($cmd2);
while (!$recordSet->EOF) { 

$text_debug.=  $recordSet->fields[mac_address]." from member group set offline by server \n";
  if(cmp_mac($recordSet->fields[mac_address],$old_mac)==false){
  $update=true;
 }
UpdateInsert("update client set online=false,arp=false,traffic_down='".$data[0]."',traffic_up='".$data[1]."' where client_id='".$recordSet->fields[client_id]."'");

 $recordSet->MoveNext(); 
}
  $recordSet->Close();
//reset offline when member time group   time out
$recordSet =GetRowAll("SELECT * from member_group_reset_timeout  where expire_unlimit_time<=NOW() and total_time>0");
while (!$recordSet->EOF) { 
$time_online=time();
$remain=$recordSet->fields[total_time]-($time_online-strtotime($recordSet->fields[member_rdate]));
$remain1=$time_online-strtotime($recordSet->fields[member_rdate]);
$time_out=$time_online-strtotime($recordSet->fields[lastinterval]);



if($time_out<=35){
if($remain>0){
		UpdateInsert("update member_account SET total_time='$remain' ,member_rdate=NOW() where member_id='".$recordSet->fields[member_id]."'");

}else{
			UpdateInsert("update member_account SET total_time=0 ,member_rdate=NOW() where member_id='".$recordSet->fields[member_id]."'");
}

}
if($remain<=0 || $time_out>=35 || $remain1>40){
$offlinemac[$f++]=$recordSet->fields[mac_address];
UpdateInsert("update client set online=false,arp=false where client_id='".$recordSet->fields[client_id]."'");
UpdateInsert("update client_history set time_end=NOW() where  history_id='".$recordSet->fields[client_id]."'");
$text_debug.=  $recordSet->fields[mac_address]." from member group set offline by server \n";
  if(cmp_mac($recordSet->fields[mac_address],$old_mac)==false){
  $update=true;
 }
}
 $recordSet->MoveNext(); 
}
  $recordSet->Close();


print_debug($text_debug);
 clear_card_bug();

return array($update,$offlinemac);
}
function clear_card_bug(){
global $dbname,$DB;

//reset card when client offline
$recordSet =GetRowAll("SELECT * from reset_card_bug");
while (!$recordSet->EOF) { 

if($recordSet->fields[online]==1){
UpdateInsert("update client set online=false where client_id='".$recordSet->fields[client_id]."'");

$text_debug.=  $recordSet->fields[mac_address]."  set offline by Card Bug \n";
}
mysql_db_query($dbname,"update client_history set time_end=NOW() where  history_id='".$recordSet->fields[history_id]."'");

 $recordSet->MoveNext(); 
}
  $recordSet->Close();
  
  $recordSet =GetRowAll("SELECT 
  client.mac_address,
    client.online
  
FROM
  client_history
  RIGHT OUTER JOIN client ON (client_history.client_id = client.client_id)
  LEFT OUTER JOIN macpassthrough ON (client.mac_address = macpassthrough.mac_address)
WHERE
  client_history.history_id IS NULL AND 
  client.online = 1 AND 
  (macpassthrough.allow IS NULL OR 
  macpassthrough.allow = 0)");
while (!$recordSet->EOF) { 


UpdateInsert("update client set online=0 where mac_address='".$recordSet->fields[mac_address]."'");
UpdateInsert("update login_remember SET login_remember.use=false where mac_address='".$recordSet->fields[mac_address]."' ");
$text_debug.=  $recordSet->fields[mac_address]."  set offline by Online Bug \n";

 $recordSet->MoveNext(); 
}
  $recordSet->Close();
  
print_debug($text_debug);

UpdateInsert("delete from client_history WHERE  client_history.client_id =0 ");
}
function check_card_activeNull(){
global $dbname;
$Cfg_Variable["Command"]="SELECT  * from pin_account where pin_account_active=true and (pin_account_date_expiration is NULL or pin_account_date_expiration='0000-00-00')";
	$Cfg_Variable["Result"]=mysql_db_query($dbname,$Cfg_Variable["Command"]) or die (mysql_error());
	$Cfg_Variable["TRecord"]=mysql_num_rows($Cfg_Variable["Result"]);
	while($row=mysql_fetch_array($Cfg_Variable["Result"])){
	if($row[pin_account_time]=="Unlimited"){
				$day_expir=1000;
			}else{
				$day_expir=$row[pin_account_time];
			}
			$expiration="+".$day_expir." day";
			$expir=date('Y-m-d H:i:s', strtotime($expiration));
			mysql_db_query($dbname,"update pin_account SET pin_account_date_expiration='$expir' where pin_account_id='".$row[pin_account_id]."' ") or die(mysql_error());
	}
	mysql_free_result($Cfg_Variable["Result"]);
}

function redirect($filename) {
    if (!headers_sent())
        header('Location: '.$filename);
    else {
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$filename.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$filename.'" />';
        echo '</noscript>';
    }
}
function redirect_dely($filename,$dely) {
   // echo "<html><head>";
        /*echo '<script type="text/javascript">';
        echo 'window.location.href="'.$filename.'";';
        echo '</script>';*/

        echo '<meta http-equiv="refresh" content="'.$dely.';url='.$filename.'" />';
    
       //  echo "</head></html>";
      
        
    
}
function print_debug($text_debug){
global $debug;
 if($debug){

  if(!file_exists("/opt/lampp/htdocs/aim/tmp/debug.aim")){
  $FILE =fopen("/opt/lampp/htdocs/aim/tmp/debug.aim","w");
  
  }
  shell_exec("/sbin/sudo -u root chmod 777 /opt/lampp/htdocs/aim/tmp/debug.aim");
   $FILE =fopen("/opt/lampp/htdocs/aim/tmp/debug.aim","a"); 

    fputs( $FILE, $text_debug);
fclose($FILE);
   
  }
  }
  function cmd_aim($update){
global $reload_config_enable;

  if($reload_config_enable  && $update ){
   
 //system('/usr/local/bin/restartp2pblock start');
 //system('/usr/local/bin/setBanish start');
 shell_exec("/sbin/sudo -u root /opt/lampp/bin/php /opt/lampp/htdocs/aim/tmp/banish_start.php");
 //shell_exec("/sbin/sudo -u root /usr/local/bin/aim_new start");
 if(!file_exists("/opt/lampp/htdocs/aim/tmp/closbeep.aim")){
 shell_exec("/sbin/sudo -u root  /usr/bin/beep -l 30 -f 850 ");
 }
  }
  
  }
  
  function check_mypc($mac){
global $dbname,$Licensed,$DB;
if(preg_match("/[0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f]/i",$mac) && $mac !="00:00:00:00:00:00" ){
	$ip=Get_IP();
	$pc_name=gethostname($ip);
	 $pid=str_replace(":","",$mac);
		if($pc_name=="?" || $pc=="reache"){$pc_name="";}
	//if($Licensed["_Card_"][10]){
	// clear_card_bug();
//$Cfg_Variable["Command1"]="SELECT * from reset_card_bug where mac_address='".$mac."'  and online=0";
/*$recordSet =GetRowAll("SELECT * from reset_card_bug where mac_address='".$mac."'  and online=0");
while (!$recordSet->EOF) { 

mysql_db_query($dbname,"update client_history set time_end=NOW() where  history_id='".$recordSet->fields[history_id]."'");
 shell_exec("/sbin/sudo -u root rm /opt/lampp/htdocs/aim/tmp/pid/".$pid.".pid");
 $recordSet->MoveNext(); 
}
  $recordSet->Close();
*/
	  if( !file_exists("/opt/lampp/htdocs/aim/tmp/pid")){
 shell_exec("sudo -u root mkdir /opt/lampp/htdocs/aim/tmp/pid");
    shell_exec("/sbin/sudo -u root chmod 777 /opt/lampp/htdocs/aim/tmp/pid");
 }

 $expire_time=30;
  if(file_exists("/opt/lampp/htdocs/aim/tmp/pid/".$pid.".pid")){
 $Filetmp="/opt/lampp/htdocs/aim/tmp/pid/".$pid.".pid";
$FileCreationTime = filectime($Filetmp);
$FileAge = time() - $FileCreationTime;
 if ($FileAge > ($expire_time * 60) || filesize($Filetmp)==0 ){
 //shell_exec("/sbin/sudo -u root rm /opt/lampp/htdocs/aim/tmp/pid/".$pid.".pid");
 unlink("/opt/lampp/htdocs/aim/tmp/pid/".$pid.".pid");
 }
}
 $myvip=0;
 if(file_exists("/opt/lampp/htdocs/aim/tmp/vip/".$pid.".pid")){
 $vip=file("/opt/lampp/htdocs/aim/tmp/vip/".$pid.".pid");
 $myvip=1;
 }
  if(!file_exists("/opt/lampp/htdocs/aim/tmp/pid/".$pid.".pid") &&  !$myvip){
  
$Cfg_Variable["Command"]="SELECT  distinct
  client.client_id,
  client.mac_address,
  client.last_ip,
  client.arp,
  client.online,
  client.lastinterval,
  macpassthrough.allow,
  macpassthrough.e_start,
  macpassthrough.e_stop,
  client.`join`
FROM
  client
  LEFT OUTER JOIN macpassthrough ON (client.mac_address = macpassthrough.mac_address)
WHERE
  client.mac_address ='".$mac."' LIMIT 1";
$datarow=GetRow1($Cfg_Variable["Command"]);
	$Cfg_Variable["TRecord"]=$datarow[numrow];
	if($Cfg_Variable["TRecord"]){
$rows=$datarow[data];

	if(!$rows[arp]){
UpdateInsert("update client SET arp=true ,remark='$pc_name',last_ip='$ip', lastinterval=NOW() where mac_address='$mac'"); 
    }else{
	UpdateInsert("update client SET  lastinterval=NOW() where mac_address='$mac'"); 
	}
	$login_db=$rows[online];
	$id=$rows[client_id];
	$join=$rows[join];
	 $my_allow=check_mystat($rows[allow],$rows[e_start],$rows[e_stop],$mac);
	if($login_db){
	$datarow3=GetRow1("SELECT DISTINCT 
  client_history.member_id,
  client_history.card_mode
FROM
  client_history
  INNER JOIN client ON (client_history.client_id = client.client_id)
WHERE
  client.mac_address ='$mac' AND 
  client.online = 1 AND 
  client_history.time_end IS NULL
ORDER BY
  client_history.traffic_down DESC");

	if($datarow3[numrow]) {
	$rowm=$datarow3[data];
	$card_mode=$rowm[card_mode];
	$member_id=$rowm['member_id'];
	}
	}

	}else{
$Cfg_Variable["Command1"]="SELECT client_id,online,client.join FROM client where mac_address='$mac' ";
$datarow=GetRow1($Cfg_Variable["Command1"]);
	if(!$datarow[numrow]){
	mysql_db_query($dbname,"INSERT INTO client (mac_address,arp,online,client.join,remark,last_ip,lastinterval) VALUES ('$mac',true,0,false,'$pc_name','$ip',NOW()) ") or die(mysql_error());
	$id=mysql_insert_id();
	$login_db=false;
	
	}else{
	$rows=$datarow[data];
	$id=$rows[client_id];
	$login_db=$rows[online];
	$join=$rows[join];
	UpdateInsert("update client SET  lastinterval=NOW() where mac_address='$mac'"); 
	
	}
	
	$my_allow=0;
	}

 // $FILE =fopen("/opt/lampp/htdocs/aim/tmp/pid/".$pid.".pid","w");
    //shell_exec("/sbin/sudo -u root chmod 777 /opt/lampp/htdocs/aim/tmp/pid/".$pid.".pid");
   $FILE =fopen("/opt/lampp/htdocs/aim/tmp/pid/".$pid.".pid","w"); 
$text=$ip."\n";
$text.=$id."\n";
$text.=$login_db."\n";
$text.=$my_allow."\n";
$text.=$join."\n";
$text.=$card_mode."\n";
$text.=$member_id."\n";
    fputs( $FILE, $text);
fclose($FILE);
$readfile="DB";
} else   if(!file_exists("/opt/lampp/htdocs/aim/tmp/pid/".$pid.".pid") &&  $myvip){
  
$Cfg_Variable["Command"]="SELECT  distinct
  client.client_id,
  client.mac_address,
  client.last_ip,
  client.arp,
  client.online,
   client.`join`
FROM
  client
  WHERE
  client.mac_address ='".$mac."' LIMIT 1";
$datarow=GetRow1($Cfg_Variable["Command"]);
	$Cfg_Variable["TRecord"]=$datarow[numrow];
	if($Cfg_Variable["TRecord"]){
$rows=$datarow[data];

	if(!$rows[arp]){
UpdateInsert("update client SET arp=true ,remark='$pc_name',last_ip='$ip', lastinterval=NOW() where mac_address='$mac'"); 
    }else{
	UpdateInsert("update client SET  lastinterval=NOW() where mac_address='$mac'"); 
	}
	$login_db=$rows[online];
	
	}
	$join=1;
		$id=trim($vip[0]);
		 $my_allow=check_mystat(1,trim($vip[1]),trim($vip[2]),$mac);
	$card_mode=99;




 // $FILE =fopen("/opt/lampp/htdocs/aim/tmp/pid/".$pid.".pid","w");
   /// shell_exec("/sbin/sudo -u root chmod 777 /opt/lampp/htdocs/aim/tmp/pid/".$pid.".pid");
   $FILE =fopen("/opt/lampp/htdocs/aim/tmp/pid/".$pid.".pid","w"); 
$text=$ip."\n";
$text.=$id."\n";
$text.=$login_db."\n";
$text.=$my_allow."\n";
$text.=$join."\n";
$text.=$card_mode."\n";
$text.=$member_id."\n";
    fputs( $FILE, $text);
fclose($FILE);
$readfile="DB";

}else{
$data=file("/opt/lampp/htdocs/aim/tmp/pid/".$pid.".pid");
$id=$data[1];
$login_db=$data[2];
$my_allow=$data[3];
$join=$data[4];
$card_mode=$data[5];
$member_id=$data[6];
$readfile="file";
 }   
  
return array("ID"=>$id,"online"=>$login_db,"allow"=> $my_allow,"Join"=>$join,"card_mode"=>$card_mode,"member_id"=>$member_id,"readfile"=>$readfile);
}else{
redirect("error.php?ac=drop&Rand=".$rand);
return false;
}

}
function check_mystat($allow,$e_start,$e_stop,$mac){
global $dbname,$Licensed;
$time=time();
 if($e_start=="0000-00-00 00:00:00" || $e_start=="0000-00-00" || $e_start==NULL){
 $e_start=NULL;
 }
  if($e_stop=="0000-00-00 00:00:00" || $e_stop=="0000-00-00" || $e_stop==NULL){
 $e_stop=NULL;
 }
 if($Licensed["_Card_"][11]==1){
 $my_allow=0;
 }else{
  $my_allow=2;
 }
  if($e_start!=NULL  &&  strtotime($e_start) > $time && strtotime($e_stop) > $time ){
$my_return = $my_allow;
}elseif($e_start!=NULL  &&  strtotime($e_start) <= $time && strtotime($e_stop) <= $time ){
reset_stat($mac);
$my_return =  $my_allow;

}else{
$my_return = $allow;
}

return $my_return;
}
function check_statall(){
global $dbname,$Licensed;
$result=mysql_db_query($dbname,"SELECT *
FROM
  macpassthrough
WHERE
  e_start IS NOT NULL AND 
  e_start > '0000-00-00' AND
  e_start<=NOW() and  
  e_stop <=NOW()");
$num_row=mysql_num_rows($result);
$reset_mac=array();

if($num_row){
$b=0;
for($i=0;$i<$num_row;$i++){
$row=mysql_fetch_array($result);
block_stat($row[mac_address]);
$reset_mac[$b]=$row[mac_address];
$b++;
}
}
mysql_free_result($result);
return $reset_mac;
}

function StringReplace($String)
{
	$String=str_replace("\"","",$String);
	$String=str_replace("'","",$String);
		$String=str_replace("("," ",$String);
	$String=str_replace(")"," ",$String);
	$String=str_replace("<","(",$String);
	$String=str_replace(">",")",$String);
	
	return trim($String);
}
function StringEnCode($String)
{
	$String=str_replace("\"","{_1_}",$String);
	$String=str_replace("'","{_2_}",$String);
	$String=str_replace(",","{_4_}",$String);
	$String=str_replace("\n","<br>",$String);
	$String=str_replace("\n","{_5_}",$String);
	$String=str_replace("<br>","{_6_}",$String);
	return trim($String);
}
function StringDeCode($String)
{
	$String=str_replace("{_1_}","&quot;",$String);
	$String=str_replace("{_2_}","&acute;",$String);
	$String=str_replace("{_3_}","",$String);
	return trim($String);
}
function StringDeCode1($String)
{
	$String=str_replace("{_1_}","'",$String);
	$String=str_replace("{_3_}","&",$String);
	$String=str_replace("{_2_}","'",$String);
	$String=str_replace("{_4_}",",",$String);
	$String=str_replace("{_5_}","\n",$String);
	$String=str_replace("{_6_}","<br>",$String);
	return trim($String);
}
function send_mail($to, $body, $subject, $fromaddress, $fromname, $attachments=false)
{
  $eol="\r\n";
  $mime_boundary=md5(time());

  # Common Headers
  $headers .= "From: ".$fromname."<".$fromaddress.">".$eol;
  $headers .= "Reply-To: ".$fromname."<".$fromaddress.">".$eol;
  $headers .= "Return-Path: ".$fromname."<".$fromaddress.">".$eol;    // these two to set reply address
  $headers .= "Message-ID: <".time()."-".$fromaddress.">".$eol;
  $headers .= "X-Mailer: PHP v".phpversion().$eol;          // These two to help avoid spam-filters

  # Boundry for marking the split & Multitype Headers
  $headers .= 'MIME-Version: 1.0'.$eol.$eol;
  $headers .= "Content-Type: multipart/mixed; boundary=\"".$mime_boundary."\"".$eol.$eol;

  # Open the first part of the mail
  $msg = "--".$mime_boundary.$eol;
  
  $htmlalt_mime_boundary = $mime_boundary."_htmlalt"; //we must define a different MIME boundary for this section
  # Setup for text OR html -
  $msg .= "Content-Type: multipart/alternative; boundary=\"".$htmlalt_mime_boundary."\"".$eol.$eol;

  # Text Version
  $msg .= "--".$htmlalt_mime_boundary.$eol;
  $msg .= "Content-Type: text/plain; charset=utf-8".$eol;
  $msg .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
  $msg .= strip_tags(str_replace("<br>", "\n", substr($body, (strpos($body, "<body>")+6)))).$eol.$eol;

  # HTML Version
  $msg .= "--".$htmlalt_mime_boundary.$eol;
  $msg .= "Content-Type: text/html; charset=utf-8".$eol;
  $msg .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
  $msg .= $body.$eol.$eol;

  //close the html/plain text alternate portion
  $msg .= "--".$htmlalt_mime_boundary."--".$eol.$eol;

  if ($attachments !== false)
  {
    for($i=0; $i < count($attachments); $i++)
    {
      if (is_file($attachments[$i]["file"]))
      {   
        # File for Attachment
        $file_name = substr($attachments[$i]["file"], (strrpos($attachments[$i]["file"], "/")+1));
        
        $handle=fopen($attachments[$i]["file"], 'rb');
        $f_contents=fread($handle, filesize($attachments[$i]["file"]));
        $f_contents=chunk_split(base64_encode($f_contents));    //Encode The Data For Transition using base64_encode();
        $f_type=filetype($attachments[$i]["file"]);
        fclose($handle);
        
        # Attachment
        $msg .= "--".$mime_boundary.$eol;
        $msg .= "Content-Type: ".$attachments[$i]["content_type"]."; name=\"".$file_name."\"".$eol;  // sometimes i have to send MS Word, use 'msword' instead of 'pdf'
        $msg .= "Content-Transfer-Encoding: base64".$eol;
        $msg .= "Content-Description: ".$file_name.$eol;
        $msg .= "Content-Disposition: attachment; filename=\"".$file_name."\"".$eol.$eol; // !! This line needs TWO end of lines !! IMPORTANT !!
        $msg .= $f_contents.$eol.$eol;
      }
    }
  }

  # Finished
  $msg .= "--".$mime_boundary."--".$eol.$eol;  // finish with two eol's for better security. see Injection.
  
  # SEND THE EMAIL
  ini_set(sendmail_from,$fromaddress);  // the INI lines are to force the From Address to be used !
  $mail_sent = mail($to, $subject, $msg, $headers);
  
  ini_restore(sendmail_from);
  
  return $mail_sent;
}

	function cmp_data($data,$value){
	if($data[0]!="a"){
for($i=0;$i<count($data);$i++){
 if(strcmp($value,trim($data[$i]))==false){
return true;
break;
 }
}
return false;
}else{
return true;
}}

function write_log(){
global $dbname;
if(!is_dir("/var/log/aim")){

Mkdir("/var/log/aim",0777);
Chmod("/var/log/aim",0777);
}
$results=mysql_db_query($dbname,"SELECT 
  client_history.history_id,
  client_history.client_id,
  client_history.pin_account_serial,
  client_history.member_id,
  client_history.card_mode,
  client_history.pc_name,
  client_history.ip_address,
  client_history.time_start,
  client_history.time_end,
   client_history.traffic_down,
      client_history.traffic_up
FROM
  client_history
WHERE
  client_history.time_end  <=(SELECT DATE_SUB(NOW(), INTERVAL 1 DAY ))
  order by history_id ASC")or die(mysql_error());
$num_rows=mysql_num_rows($results);
  if(!file_exists("/var/log/aim/aim_history.log")){
  $FILE =fopen("/var/log/aim/aim_history.log","w");
  }

for($i=0;$i<$num_rows;$i++){
	$rows=mysql_fetch_array($results);

   $FILE =fopen("/var/log/aim/aim_history.log","a"); 
$text_log=$rows[history_id]."#".$rows[client_id]."#".$rows[pin_account_serial]."#".$rows[member_id]."#".$rows[card_mode]."#".$rows[pc_name]."#".$rows[ip_address]."#".$rows[time_start]."#".$rows[time_end]."#".$rows[traffic_down]."#".$rows[traffic_up]."#\n";
fputs( $FILE, $text_log);
fclose($FILE);

}
mysql_free_result($results);

mysql_db_query($dbname,"delete from client_history
WHERE
  client_history.time_end  <=(SELECT DATE_SUB(NOW(), INTERVAL 1 DAY ))
  order by history_id ASC")or die(mysql_error());
  if(Filesize("/var/log/aim/aim_history.log") >=2097152){
    $time=date("Y-m-d");
  Rename("/var/log/aim/aim_history.log","/var/log/aim/aim_history".$time.".log");
  }
}
function log_slippage($id,$file){
global $Cfg_Variable;
$row=0;
	$lines=file($file);
	for($i=0;$i<count($lines);$i++){
	$log=explode("#",$lines[$i]);
	if($log[1]==$id || $id=="all"){
		if(($log[1]==$Cfg_Variable[API_NCM]["Client"]["PageSearch"] || $Cfg_Variable[API_NCM]["Client"]["PageSearch"] =="all") && $Cfg_Variable[API_NCM]["Client"]["PageSearch"]  && $log[1] ){
		if(strtotime($log[5]) >=strtotime($Cfg_Variable[API_NCM]["Client"]["timestart"]) && strtotime($log[5])<=strtotime($Cfg_Variable[API_NCM]["Client"]["timestop"] ) || $Cfg_Variable[API_NCM]["Client"]["timestart"]==""){
	if( $Loop >=$Cfg_Vaiable[API_NCM]["Client"]["Record"]["Start"] && $Loop<=$Cfg_Vaiable[API_NCM]["Client"]["Record"]["Finish"]  ){
	$row++;
	}
	}}}
		}
return $row;
}

function FormatPrice($price) {
   $price = preg_replace("/[^0-9\.]/", "", str_replace(',','.',$price));
    if (substr($price,-3,1)=='.') {
        $sents = '.'.substr($price,-2);
        $price = substr($price,0,strlen($price)-3);
    } elseif (substr($price,-2,1)=='.') {
        $sents = '.'.substr($price,-1);
        $price = substr($price,0,strlen($price)-2);
    } else {
        $sents = '.00';
    }

    $price = preg_replace("/[^0-9]/", "",$price);
    return number_format($price,'','.',',');
}
function FormatHour($time){
$h=sprintf("%d",$time/60/60);
$sub=sprintf("%d",$time-($h*60*60));
$m=sprintf("%d",$sub/60);
$s=sprintf("%d",$time-($h*60*60)-($m*60));
if($h){
$result.=$h."&nbsp;H&nbsp;";
}
if($m){
$result.=$m."&nbsp;m&nbsp;";
}
if($s){
$result.=$s."&nbsp;s";
}
return $result;

}
function FormatHourFull($time){
global $text;
$result="";
$h=sprintf("%d",$time/60/60);
$sub=sprintf("%d",$time-($h*60*60));
$m=sprintf("%d",$sub/60);
$s=sprintf("%d",$time-($h*60*60)-($m*60));
if($h){
$result.=$h."&nbsp;".$text['hours']."  ";
}
if($m){
$result.=$m."&nbsp;".$text['minutes']."  ";
}
if($s){
$result.=$s."&nbsp;".$text['second'];
}
return $result;

}
function get_iptables_traffic(){
exec('/sbin/sudo -u root  /sbin/iptables  -L ipac~fo  -v -x -n $data | /usr/bin/awk "/^$data/ {print \$2}"', $bytes_down);
exec('/sbin/sudo -u root  /sbin/iptables  -L ipac~fo  -v -x -n $data | /usr/bin/awk "/^$data/ {print \$8}"', $ip_down);
exec('/sbin/sudo -u root  /sbin/iptables  -L ipac~fi  -v -x -n $data | /usr/bin/awk "/^$data/ {print \$2}"', $bytes_up);
exec('/sbin/sudo -u root  /sbin/iptables  -L ipac~fi  -v -x -n $data | /usr/bin/awk "/^$data/ {print \$7}"', $ip_up);
$traffic=array();
$loop=0;
 for($i=0;$i<count($bytes_down);$i++){
 
 if($i>1 && $ip_down[$i]!="0.0.0.0/0"){
 $traffic[$loop][0]=$ip_down[$i];
// echo $bytes_down[$i]."/".$ip_down[$i]."<br>";
 $traffic[$loop][1]=$bytes_down[$i];
 $traffic[$loop][2]=$bytes_up[$i];
 $loop++;
 }
 
 }
return $traffic;
}
function get_my_traffic($ip){
$traffic=get_iptables_traffic();
for($i=0;$i<count($traffic);$i++){
if($traffic[$i][0]==$ip){
return array($traffic[$i][1],$traffic[$i][2]);

}

}

return array(0,0);
}
function find_my_rule($ip){
$traffic=get_iptables_traffic();
for($i=0;$i<count($traffic);$i++){
if($traffic[$i][0]==$ip){
return true;

}

}

return false;
}
function update_traffic_all(){
global $dbname;
$traffic=get_iptables_traffic();
for($i=0;$i<count($traffic);$i++){
$Cfg_Variable["Command"]="SELECT DISTINCT   check_client.client_id,  check_client.member_id FROM  check_client WHERE  check_client.ip_address = '".$traffic[$i][0]."' ";
	$Cfg_Variable["Result"]=mysql_db_query($dbname,$Cfg_Variable["Command"]) or die (mysql_error());
	$Cfg_Variable["TRecord"]=mysql_num_rows($Cfg_Variable["Result"]);
	if($Cfg_Variable["TRecord"]){
	$row=mysql_fetch_array($Cfg_Variable["Result"]);
mysql_db_query($dbname,"update client SET traffic_down='".$traffic[$i][1]."' ,traffic_up='".$traffic[$i][2]."'  where client_id='".$row[client_id]."' ")or die(mysql_error()); 
if($row[member_id]){
mysql_db_query($dbname,"update member_account SET traffic_down='".$traffic[$i][1]."' ,traffic_up='".$traffic[$i][2]."'  where  member_id = '".$row[member_id]."'")or die(mysql_error()); 

}
}
}

}
function update_client_traffic_month($client_id,$down,$up){
global $dbname;
$m=date("m");
$y=date("Y");
$Cfg_Variable["Command"]="SELECT   client_traffic.traffic_down,  client_traffic.traffic_up FROM  client_traffic WHERE  client_traffic.client_id = '".$client_id."' and month_no='".$m."' and year_no='".$y."'";
	$Cfg_Variable["Result"]=mysql_db_query($dbname,$Cfg_Variable["Command"]) or die (mysql_error());
	$Cfg_Variable["TRecord"]=mysql_num_rows($Cfg_Variable["Result"]);
	if($Cfg_Variable["TRecord"]){
	$row=mysql_fetch_array($Cfg_Variable["Result"]);
	$dn=$down+$row[traffic_down];
	$u=$up+$row[traffic_up];
	mysql_db_query($dbname,"update client_traffic SET traffic_down='".$dn."' ,traffic_up='".$u."'  where  client_traffic.client_id = '".$client_id."' and month_no='".$m."' and year_no='".$y."'")or die(mysql_error()); 

	}else{
	mysql_db_query($dbname,"insert INTO client_traffic (client_id,month_no,year_no,traffic_down,traffic_up)  values( '".$client_id."','".$m."','".$y."','".$down."','".$up."') ")or die(mysql_error()); 

	}
}
function update_member_traffic_month($mem_id,$down,$up){
global $dbname;
$m=date("m");
$y=date("Y");
$Cfg_Variable["Command"]="SELECT   member_traffic.traffic_down,  member_traffic.traffic_up FROM  member_traffic where  member_traffic.member_id = '".$mem_id."' and month_no='".$m."' and year_no='".$y."'";
	$Cfg_Variable["Result"]=mysql_db_query($dbname,$Cfg_Variable["Command"]) or die (mysql_error());
	$Cfg_Variable["TRecord"]=mysql_num_rows($Cfg_Variable["Result"]);
	if($Cfg_Variable["TRecord"]){
	$row=mysql_fetch_array($Cfg_Variable["Result"]);
	$dn=$down+$row[traffic_down];
	$u=$up+$row[traffic_up];
	mysql_db_query($dbname,"update member_traffic SET traffic_down='".$dn."' ,traffic_up='".$u."'  where  member_traffic.member_id = '".$mem_id."' and month_no='".$m."' and year_no='".$y."'")or die(mysql_error()); 

	}else{
	mysql_db_query($dbname,"insert INTO member_traffic (member_id,month_no,year_no,traffic_down,traffic_up)  values( '".$mem_id."','".$m."','".$y."','".$down."','".$up."') ")or die(mysql_error()); 

	}
}
function del_rules_traffic($ip){
shell_exec("/sbin/sudo -u root  /sbin/iptables -D ipac~fo -p all -o eth0 -d  ".$ip." ");
shell_exec("/sbin/sudo -u root  /sbin/iptables -D ipac~fi -p all -i eth0 -s  ".$ip." ");

}
function add_rules_traffic($ip){
shell_exec("/sbin/sudo -u root  /sbin/iptables -A ipac~fo -p all -o eth0 -d  ".$ip." ");
shell_exec("/sbin/sudo -u root  /sbin/iptables -A ipac~fi -p all -i eth0 -s  ".$ip." ");

}
function ByteSize($bytes)  
    { 
    $size = abs($bytes) / pow(1024,1); 
    if($size < 1024) 
        { 
        $size = number_format($size, 2); 
        $size .= ' KB'; 
        }  
    else  
        { 
        if($size / pow(1024,1)< 1024)  
            { 
            $size = number_format($size / 1024, 2); 
            $size .= ' MB'; 
            }  
        else if ($size / pow(1024,2) < 1024)   
            { 
            $size = number_format($size / 1024 / 1024, 2); 
            $size .= ' GB'; 
            } else  if ($size / pow(10243)< 1024)   {
			 $size = number_format($size /pow(1024,3), 2); 
            $size .= ' TB'; 
			
			
			} else  if ($size / pow(1024,4)< 1024)   {
			 $size = number_format($size / pow(1024,4), 2); 
            $size .= ' PB'; 
			} else  if ($size / pow(1024,5)< 1024)   {
			 $size = number_format($size / pow(1024,5), 2); 
            $size .= ' EB'; 
			} else  if ($size / pow(1024,6)< 1024)   {
			 $size = number_format($size / pow(1024,6), 2); 
            $size .= ' ZB'; 
			} else  if ($size / pow(1024,7) < 1024)   {
			 $size = number_format($size / pow(1024,7), 2); 
            $size .= ' YB'; 
			}
        } 
    return $size; 
    } 
	
function get_iptables_DropRule(){
exec('/sbin/sudo -u root  /sbin/iptables  -L AIM_FORWARD   -v -x -n $data | /usr/bin/awk "/^$data/ {print \$11}"', $drop0);
exec('/sbin/sudo -u root  /sbin/iptables  -L AIM_FORWARD   -v -x -n $data | /usr/bin/awk "/^$data/ {print \$9}"', $drop1);

$drop=array();
$loop=0;
 for($i=0;$i<count($drop0);$i++){
 

 $drop[$loop][0]=$drop0[$i];
 $drop[$loop][1]=$drop1[$i];
 $loop++;

 
 }
return $drop;
}

function my_ClearDroprule($mac,$ip){

$rule=get_iptables_DropRule();
for($i=0;$i<count($rule);$i++){
if($rule[$i][0]==$mac && $mac){
 shell_exec("/sbin/sudo -u root  /sbin/iptables -D AIM_FORWARD -m mac --mac-source ".$mac." -j DROP	");
 shell_exec("/sbin/sudo -u root  /sbin/iptables -D AIM_INPUT -m mac --mac-source ".$mac." -j DROP");


}
if($rule[$i][1]==$ip && $ip){

 shell_exec("/sbin/sudo -u root  /sbin/iptables -D AIM_FORWARD -d ".$ip." -j DROP");
 shell_exec("/sbin/sudo -u root  /sbin/iptables -D AIM_INPUT -d ".$ip." -j  DROP");

}
}


}

function get_freearpscan(){
global $dbname,$debug,$Cfg_Variable,$DB;
$offlinemac=array();
$f=0;
//list old online
/*
$results=mysql_db_query($dbname,"SELECT  mac_address,remark  FROM client where online=true")or die(mysql_error());
$num_rows=mysql_num_rows($results);

for($i=0;$i<$num_rows;$i++){
$rows=mysql_fetch_array($results);
$old_list[$i]=$rows[mac_address];
$remark_list[$i]=$rows[remark];

}
if($num_rows<=50){
$dely=4;
}else{
$dely=6;
}
mysql_free_result($results);
if(file_exists("/var/ipcop/whoisonline/arpscan")){
$cmd="/var/ipcop/whoisonline/arpscan -a ".$Cfg_Variable[API_NCM]["dhcp"][0]."-".$Cfg_Variable[API_NCM]["dhcp"][1]." > /opt/lampp/htdocs/aim/tmp/arpscan.tmp";
system($cmd);
sleep($dely);
}else if(file_exists("/var/ipcop/wio/arpscan")){
$cmd="/var/ipcop/wio/arpscan -a ".$Cfg_Variable[API_NCM]["dhcp"][0]."-".$Cfg_Variable[API_NCM]["dhcp"][1]." > /opt/lampp/htdocs/aim/tmp/arpscan.tmp";
system($cmd);
sleep($dely);
}else  if(file_exists("/usr/sbin/arpscan")){
$cmd="/usr/sbin/arpscan -a ".$Cfg_Variable[API_NCM]["dhcp"][0]."-".$Cfg_Variable[API_NCM]["dhcp"][1]." > /opt/lampp/htdocs/aim/tmp/arpscan.tmp";
system($cmd);
sleep($dely);
}else{
$debug="Not fund arpscan in /whoisonline and  /wio and /sbin\n";
print_debug($debug);
}

*/
/*
$captchaFolder  = '/tmp/arpscan.aim';
$expire_time    = 10; 
     $FileCreationTime = filectime($captchaFolder);
    $FileAge = time() - $FileCreationTime; 
    if ($FileAge > ($expire_time * 60)){
shell_exec('/sbin/sudo -u root /usr/local/bin/scanip');
sleep(30);
    }
*/
shell_exec('/sbin/sudo -u root /usr/local/bin/scanip');
getlisthostname();
 check_history_bug();
//sleep(30);
$filename="/opt/lampp/htdocs/aim/tmp/arpscan.tmp";
$filename1="/opt/lampp/htdocs/aim/tmp/arpscan.aim";
$filename2="/opt/lampp/htdocs/aim/tmp/arpip.aim";
if(file_exists($filename)){
//unlink($filename1);
//copy($filename, $filename1);

//end list old online
	$arp=file($filename);
	$arpip=file($filename2);
	 UpdateInsert("update client set arp=false");
	  $LOOP=0;
	  $new_list=array();
	 foreach($arp as $line)
{
	$mac=trim($line);
	
	$ip=trim($arpip[$LOOP+1]);
	
	//	$text_debug.= $mac."  get config  by server \n";
	if(preg_match("/[0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-][0-9a-f][0-9a-f]/i",$mac) && $mac !="00:00:00:00:00:00" ){
	$new_list[$LOOP]=$mac;
	$LOOP++;
$datarow1=GetRow1("SELECT  *  FROM client where mac_address='$mac' ");
$pc=$cfg_host[strtoupper($mac)];
//$pc=gethostname($ip);
$pc=strtolower($pc); 
if(!$datarow1[numrow]){
	UpdateInsert("INSERT INTO client (mac_address,arp,online,client.join,remark,last_ip,lastinterval) VALUES ('".$mac."',true,false,false,'$pc','".$ip."',NOW()) ");
	$text_debug.= $mac."  add  by server \n";
	
}else{
$row=$datarow1[data];
if($row[remark]==""){
$command="update client set arp=true,remark='$pc',lastinterval=NOW()";
}else{
$command="update client set arp=true,lastinterval=NOW()";
}
if($row[allow]==1){
$command.=",online=true";
}

$command.=",last_ip='".$ip."'";

//$text_debug.= $mac."  update by server \n";
$command.=" where mac_address='".$mac."' ";
UpdateInsert($command);

$datarow2=GetRow1("SELECT  *  FROM client_history where client_id='".$row[client_id] ."' and ( time_end is NULL or time_end='0000-00-00')");

if(!$datarow2[numrow] && $row[online] && $row[allow]==1){
if($row[client_id]){
	UpdateInsert("INSERT INTO client_history (client_id,pin_account_serial,card_mode,pc_name,ip_address,time_start,time_end) VALUES('".$row[client_id]."','$serial',99,'$pc','$ip',NOW(),NULL)"); 
	$text_debug.= $mac."  create history by server \n";
	}
}

}

}

}
}


//recheckonline();
//reset offline when free mode   time out

$cmd="SELECT 
  client.client_id,
  client.mac_address,
  client.remark
FROM
  login_remember
  RIGHT OUTER JOIN client ON (login_remember.mac_address = client.mac_address)
WHERE
  client.lastinterval <= (SELECT (now() - interval 18 minute) AS FIELD_1) AND 
  client.online = 1 ";
  if(!$Cfg_Variable[API_NCM]["remember"]){
  $cmd.="and login_remember.expire <= NOW()";
}

$recordSet =GetRowAll($cmd);
while (!$recordSet->EOF) {


mysql_db_query($dbname,"update client set online=false,arp=false,traffic_down='".$data[0]."',traffic_up='".$data[1]."' where client_id='".$recordSet->fields[client_id]."' ");
$recordSet->MoveNext(); 
}
  $recordSet->Close(); 
print_debug($text_debug);
 clear_card_bug();

return array($update,$offlinemac);
}

function concurrent(){

return exec("/sbin/sudo -u root  /opt/lampp/htdocs/aim/tmp/shellfnc.sh concurrent");

//return exec('/sbin/sudo -u root cat /proc/net/ip_conntrack | wc -l');

}
function maxconcurrent(){

return exec("/sbin/sudo -u root  /opt/lampp/htdocs/aim/tmp/shellfnc.sh maxconcurrent");
//return exec('/sbin/sudo -u root  cat /proc/sys/net/ipv4/ip_conntrack_max');

}
function check_history_bug(){
global $dbname;

$result1=mysql_db_query($dbname,"SELECT DISTINCT 
  client_history.client_id
  
FROM
  client_history
WHERE
  client_history.time_end IS NULL
  and `client_history`.`card_mode`=99")or die(mysql_error());
$num_row1=mysql_num_rows($result1);

for($i=0;$i<$num_row1;$i++){
$row1=mysql_fetch_array($result1);

$result2=mysql_db_query($dbname,"SELECT 
  client_history.history_id
FROM
  client_history
WHERE
  client_history.client_id = '".$row1[client_id]."'
  and client_history.time_end IS NULL
ORDER BY
  client_history.history_id DESC")or die(mysql_error());
  $num_row2=mysql_num_rows($result2);

  if( $num_row2>1){

$row2=mysql_fetch_array($result2);

 $delcmd="DELETE FROM client_history WHERE
  client_history.history_id < '".$row2[history_id]."' AND 
  client_history.client_id  ='".$row1[client_id]."' AND 
  client_history.time_end IS NULL";
mysql_db_query($dbname,$delcmd) ;


}
}

}
function backup_history(){
global $dbname;
$pid="/var/run/backupdb.pid";
 if(!file_exists($pid)){
shell_exec("sudo -u root /bin/touch ".$pid);


$SQLLOG="INSERT INTO `client_history_temp` (`history_id`, `client_id`, `pin_account_serial`, `member_id`, `card_mode`, `pc_name`, `ip_address`, `time_start`, `time_end`, `traffic_down`, `traffic_up`) VALUES ";
$result1=mysql_db_query($dbname,"SELECT  *    FROM        client_history   WHERE     client_history.time_end IS NOT NULL AND 
  client_history.time_end     <=(SELECT (now() - interval 6 hour) AS FIELD_1)")or die(mysql_error());
$num_row1=mysql_num_rows($result1);

for($i=0;$i<$num_row1;$i++){
$row1=mysql_fetch_array($result1);
if($i<($num_row1-1)){
$SQLLOG.="  ('".$row1[history_id]."','".$row1[client_id]."', '".$row1[pin_account_serial]."', '".$row1[member_id]."','".$row1[card_mode]."','".$row1[pc_name]."', '".$row1[ip_address]."', '".$row1[time_start]."', '".$row1[time_end]."','".$row1[traffic_down]."', '".$row1[traffic_up]."'),";
}else{
$SQLLOG.="  ('".$row1[history_id]."','".$row1[client_id]."', '".$row1[pin_account_serial]."',' ".$row1[member_id]."','".$row1[card_mode]."','".$row1[pc_name]."', '".$row1[ip_address]."', '".$row1[time_start]."', '".$row1[time_end]."','".$row1[traffic_down]."', '".$row1[traffic_up]."');";
}
mysql_db_query($dbname,"DELETE FROM client_history where history_id =".$row1[history_id]) ;
}
$result1=mysql_db_query($dbname,$SQLLOG)or die(mysql_error());

	shell_exec("sudo -u root rm  ".$pid);
mysql_db_query($dbname,"DELETE FROM client_history_temp where client_history_temp.time_end  <= (  select     (now() - interval 12 month) AS `FIELD_1`)") ;
$debug=date("d-m-Y H:i:s")." Backup Login Log Total : ".$num_row1." record\n";
print_debug($debug);
}
}
function createWebPass(){
global $dbname,$web_allow,$web_block,$port_allow,$port_block;
$results=mysql_db_query($dbname,"SELECT * FROM  webpassthrough");
$num_rows=mysql_num_rows($results);
 if(file_exists($web_allow)){
		// unlink($web_allow);
		 shell_exec("/sbin/sudo -u root rm ".$web_allow);
		 }
  if(file_exists($web_block)){
		// unlink($web_block);
		  shell_exec("/sbin/sudo -u root rm ".$web_block);
		 }
		   if(file_exists($port_allow)){
		shell_exec("/sbin/sudo -u root rm ".$port_allow);
		 }
  if(file_exists($port_block)){
		shell_exec("/sbin/sudo -u root rm ".$port_block);
		 }
  if($FILE =fopen($web_allow,"w") && $FILE1 =fopen($web_block,"w") && $FILE2 =fopen($port_allow,"w") && $FILE3 =fopen($port_block,"w") ){
  $FILE =fopen($web_allow,"a"); 
  $FILE1 =fopen($web_block,"a"); 
 $FILE2 =fopen($port_allow,"a"); 
$FILE3 =fopen($port_block,"a"); 

 if($num_rows){
 

for($i=0;$i<$num_rows;$i++){
$rows=mysql_fetch_array($results);
if($rows[allow] && $rows[action]!=3){
fputs( $FILE,$rows[url]."\n");
}elseif(!$rows[allow] && $rows[action]!=3){
fputs( $FILE1,$rows[url]."\n");
}elseif($rows[allow] && $rows[action]==3){
fputs( $FILE2,$rows[url]."\n");
}else{
fputs( $FILE3,$rows[url]."\n");
}
}
 
 }
else{
  fputs( $FILE,"");
   fputs( $FILE1,"");
    fputs( $FILE2,"");
 fputs( $FILE3,"");
 }
fclose($FILE);	
fclose($FILE1);	
fclose($FILE2);	
fclose($FILE3);	
}
}
function tis2utf8($tis) {
   for( $i=0 ; $i< strlen($tis) ; $i++ ){
      $s = substr($tis, $i, 1);
      $val = ord($s);
      if( $val < 0x80 ){
         $utf8 .= $s;
      } elseif ( ( 0xA1 <= $val and $val <= 0xDA ) or ( 0xDF <= $val and $val <= 0xFB ) ){
         $unicode = 0x0E00 + $val - 0xA0;
         $utf8 .= chr( 0xE0 | ($unicode >> 12) );
         $utf8 .= chr( 0x80 | (($unicode >> 6) & 0x3F) );
         $utf8 .= chr( 0x80 | ($unicode & 0x3F) );
      }
   }
   return $utf8;
}
function StringRepare($String)
{
	$String=str_replace("<p>","",$String);
	$String=str_replace("</p>","",$String);
	$String=str_replace("<br>"," ",$String);
	
	return trim($String);
}
function formatint($int){
if($int<10){
$value="0".$int;
}else{
$value=$int;
}
return $value;
}
function tcw_update($ip,$class){
$true=0;

exec('/sbin/sudo -u root grep "'.$ip.'" /opt/lampp/htdocs/aim/tmp/limit_bandwidth',$old);
if(sizeof($old)){
 shell_exec("/sbin/sudo -u root sed -i -e 's/".$old[0]."/".$ip.";".$class."/g'  /opt/lampp/htdocs/aim/tmp/limit_bandwidth");
}
$filename1="/opt/lampp/htdocs/aim/tmp/limit_bandwidth";
$line=$ip.";".$class."\n";
shell_exec('/sbin/sudo -u root echo "'.$line.'" >> '.$filename1.'');
shell_exec("/sbin/sudo -u root  /opt/lampp/bin/php /opt/lampp/htdocs/aim/tmp/tc_limit.php");
}
function iptables_clearinputdrop($ip,$mac,$IFACE){
$mac=exec("/sbin/sudo -u root  /opt/lampp/htdocs/aim/tmp/shellfnc.sh cleardrop ".$ip);
$text_debug="";
/*
$cmd='/sbin/sudo -u root /sbin/iptables -L AIM_FORWARD -v -n | grep '.$ip.' | /usr/bin/awk "{print \$9}"';
exec($cmd,$rules);
$cmd1="";
for($i=0;$i<sizeof($rules);$i++){
$cmd1.="/sbin/sudo -u root /sbin/iptables -D AIM_FORWARD  -i ".$IFACE."  -d  ".$ip." -j AIM_FORWARD_DROP >/dev/null\n";	

		}
$text_debug="";
$cmd='/sbin/sudo -u root /sbin/iptables -L AIM_INPUT -v -n | grep '.$ip.' | /usr/bin/awk "{print \$9}"';
exec($cmd,$rules);
$cmd1="";
for($i=0;$i<sizeof($rules);$i++){
$cmd1.="/sbin/sudo -u root /sbin/iptables -D AIM_INPUT  -s  ".$ip."   -j AIM_INPUT_DROP >/dev/null\n";
		$text_debug.=$ip." clear rules\n";
		}
shell_exec($cmd1);
*/
		 print_debug($text_debug);
}
function iptables_inputdrop($ip,$mac,$IFACE){
 if( !file_exists("/opt/lampp/htdocs/aim/tmp/noauthen.aim")){
shell_exec("/sbin/sudo -u root /opt/lampp/htdocs/aim/tmp/shellfnc.sh createdrop ".$ip." ".$mac);
 /*
$cmd1="";
$cmd1.="/sbin/sudo -u root /sbin/iptables -A AIM_FORWARD  -i ".$IFACE."  -d  ".$ip." -j AIM_FORWARD_DROP >/dev/null\n";	
$cmd1.="/sbin/sudo -u root /sbin/iptables -A AIM_INPUT  -s  ".$ip."   -j AIM_INPUT_DROP >/dev/null\n";	
	}
$cmd='/sbin/sudo -u root /sbin/iptables -L CUSTOMPREROUTING -t nat -v -n | grep '.$mac.' | /usr/bin/awk "{print \$11}"';
exec($cmd,$rules);
for($i=0;$i<sizeof($rules);$i++){
$cmd1.="/sbin/sudo -u root  /sbin/iptables -t nat -D CUSTOMPREROUTING -m mac --mac-source ".$mac." -j RETURN >/dev/null\n";	
}
shell_exec($cmd1);
*/
}
}
function recheckonline(){
global $dbname,$debug,$Cfg_Variable;
$newline="";


$result=mysql_db_query($dbname,"SELECT 
  client.mac_address,
  client.last_ip
FROM
  client
WHERE
  client.lastinterval >= (SELECT (now() - interval 45 minute) AS FIELD_1) ") or die(mysql_error());
 $num_row=mysql_num_rows($result);
 $text_debug=$num_row." client update\n";
for($i=0;$i<$num_row;$i++){
$row=mysql_fetch_array($result);
$arp=array();
if(file_exists("/var/ipcop/whoisonline/arpscan")){
$cmd="/var/ipcop/whoisonline/arpscan ".$row[last_ip];
exec($cmd,$arp);

}else if(file_exists("/var/ipcop/wio/arpscan")){
$cmd="/var/ipcop/wio/arpscan ".$row[last_ip];
exec($cmd,$arp);

}else  if(file_exists("/usr/sbin/arpscan")){
 $cmd="/usr/sbin/arpscan ".$row[last_ip];
exec($cmd,$arp);
}

if(sizeof($arp)){
$newline.=trim($arp[0])."\n";;
$ips=explode(",",$arp[0]);
$pc=gethostname(trim($ips[1]));
if($pc=="reache" || $pc==$row[last_ip]){
$pc="";
}
$pc=strtolower($pc); 
//$text_debug.=$arp[0].""."<br>";
if(strtoupper($ips[0])==strtoupper($row[mac_address])){
//echo $row[mac_address]."/".$row[last_ip]."<br>";

//$text_debug.=$row[mac_address]." update\n";
$command="update client set arp=true,remark='".$pc."',lastinterval=NOW()";
$command.=" where mac_address='".$row[mac_address]."' ";

mysql_db_query($dbname,$command);
}else{

$command="update client set arp=true,remark='".$pc."',lastinterval=NOW()";
$command.=" where mac_address='".strtoupper($ips[0])."' ";
mysql_db_query($dbname,$command);
//$text_debug.=strtoupper($ips[0])." update\n";
//check new ip
$newip=findmactoip($row[mac_address]);
if($newip){
$pc1=gethostname($newip);
if($pc1=="reache" || $pc1==$newip){
$pc1="";
}
//$text_debug.=$row[mac_address]." update\n";
$command="update client set arp=true,remark='".$pc1."',last_ip='".$newip."',lastinterval=NOW()";
$command.=" where mac_address='".$row[mac_address]."' ";
mysql_db_query($dbname,$command);
}


}
}
}
 print_debug($text_debug);
$filename="/opt/lampp/htdocs/aim/tmp/arpscan.tmp";
$filename1="/opt/lampp/htdocs/aim/tmp/arpscan.aim";

shell_exec('/sbin/sudo -u root echo "'.$newline.'" >  '.$filename);
shell_exec('/sbin/sudo -u root echo "'.$newline.'" >  '.$filename1);
 mysql_db_query($dbname,"update client set arp=false WHERE  lastinterval < (SELECT (now() - interval 30 minute) AS FIELD_1)");
}
// load config
if($_SESSION['admin_id']){
$result_tmp1=mysql_db_query($dbname,"SELECT * from card where templates='advmenu' order by row limit 0,1") or die(mysql_error());
$num_row_tmp1=mysql_num_rows($result_tmp1);
if($num_row_tmp1){
$row_tmp=mysql_fetch_array($result_tmp1);
$Cfg_Variable[API_NCM]["Adv_Menu"]=$row_tmp[data];
}else{
$Cfg_Variable[API_NCM]["Adv_Menu"]=0;
}
mysql_free_result($result_tmp1);

//get menu permition

$results=mysql_db_query($dbname,"SELECT * FROM   manage_account WHERE   manage_account_id ='".$_SESSION['admin_id']."'") or die(mysql_error());
if(mysql_num_rows($results)){
$rowi=mysql_fetch_array($results);
$group=$rowi[manage_account_group_id];
}
mysql_free_result($results);
if($_SESSION['admin_id']==1 || $_SESSION['admin_id']==2){
$command="SELECT   manage_account_menu.menu_id, (select menu_mode from `manage_account_permition` where `manage_account_permition`.`menu_id`=`manage_account_menu`.`menu_id` and `manage_account_permition`.`manage_account_group_id`='".$group."' order by menu_id limit 0,1 ) as menu_mode FROM  manage_account_menu order by menu_id";
					}else {
 $command="SELECT 
  manage_account_menu.menu_id,
  (select menu_mode from `manage_account_permition` where `manage_account_permition`.`menu_id`=`manage_account_menu`.`menu_id` and `manage_account_permition`.`manage_account_group_id`='".$group."' order by menu_id limit 0,1 ) as menu_mode
FROM
  manage_account_menu order by menu_id";
						}
						$result_menu=mysql_db_query($dbname,$command) or die (mysql_error());
$num_row_menu=mysql_num_rows($result_menu);
for($i=0;$i<$num_row_menu;$i++){
$row_menu=mysql_fetch_array($result_menu);
if($_SESSION['admin_id']==1 || $_SESSION['admin_id']==2){
$Cfg_Variable[API_NCM]["Permittion Menu"][$row_menu[menu_id]]=2;
}else if($group==1){
$Cfg_Variable[API_NCM]["Permittion Menu"][$row_menu[menu_id]]=2;
}else if($group==2){
$Cfg_Variable[API_NCM]["Permittion Menu"][$row_menu[menu_id]]=1;
}else{
$Cfg_Variable[API_NCM]["Permittion Menu"][$row_menu[menu_id]]=$row_menu[menu_mode];
}

}
mysql_free_result($result_menu);
}

function sendemail($tomail,$subject,$message){
global $dbname;
$sendOK=0;
	$domain = explode("www.", API_Ncm_CopyRight_Url);
$from = "postmaster@".trim($domain[1]);
$result_tmp1=mysql_db_query($dbname,"SELECT * from card where templates='smtp' order by row limit 0,1") or die(mysql_error());
$num_row_tmp1=mysql_num_rows($result_tmp1);
if($num_row_tmp1){
$row_tmp=mysql_fetch_array($result_tmp1);
$Cfg_Variable[API_NCM]["smtp"]=$row_tmp[data];
}
if(!trim($Cfg_Variable[API_NCM]["smtp"])){
$Cfg_Variable[API_NCM]["smtp"]="relay.cat.net.th";
}
if(trim($Cfg_Variable[API_NCM]["smtp"])){
$server = explode(",",trim($Cfg_Variable[API_NCM]["smtp"]));
for($i=0;$i<sizeof($server);$i++){
mysql_free_result($result_tmp1);
$replay=exec('sudo -u root /usr/local/bin/sendEmail_nettraffic -f '.$from.' -t '.$tomail.' -u "'.$subject.'" -m "'.$message.'" -s '.$server[$i].'');
$replay1 = explode("]:", $replay);
if(trim($replay1[1])=="Email was sent successfully!"){
$sendOK=1;
return $replay1[1];
break;
}


}
}
if(!$sendOK){
return "Email was sent Unsuccessful!";
}
}
function gen_card($card,$id_no_encode,$expir_time,$expir,$price,$GroupID){
		$Cfg_Variable["Command1"]="SELECT 	*		FROM		pin_account where pin_account.pin_account_serial='".$card."'";
$datarow=GetRow1($Cfg_Variable["Command1"]);
$num_rows=$datarow[numrow];
if(!$num_rows){
UpdateInsert("INSERT INTO pin_account (pin_account_serial,pin_account_code,pin_account_time,pin_account_expiration,pin_account_price,pin_group_id) VALUES ('".$card."','".$id_no_encode."','".$expir_time."','".$expir."','".$price."','".$GroupID."')");
 return true;
 }else{
  return false;
 }
}
function gen_card_time($card,$id_no_encode,$expir_time,$expir,$price,$GroupID){
		$Cfg_Variable["Command1"]="SELECT 	*		FROM		time_account where time_account.time_account_serial='".$card."'";
$datarow=GetRow1($Cfg_Variable["Command1"]);
$num_rows=$datarow[numrow];
if(!$num_rows){
UpdateInsert("INSERT INTO time_account (time_account_serial,time_account_code,time_account_time,time_account_expiration,time_account_price,time_group_id,time_account_date_expiration) VALUES ('".$card."','".$id_no_encode."','".$expir_time."','".$expir."','".$price."','".$GroupID."','".$expir_time."')");
 return true;
 }else{
  return false;
 }
}
?>