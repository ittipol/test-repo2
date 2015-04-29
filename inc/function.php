<?php

 //require_once($_SERVER["DOCUMENT_ROOT"]."inc/adodbconnect.php");
function generateCode($length=6) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;  //a variable with the fixed length of chars correct for the fence post issue
        while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];  //mt_rand's range is inclusive - this is why we need 0 to n-1
        }
        return $code;
    }
function getExtension($str) {

         $i = strrpos($str,".");
         if (!$i) { return ""; } 

         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
 function utf8totis620($string) {
  $str = $string;
  $res = "";
  for ($i = 0; $i < strlen($str); $i++) {
    if (ord($str[$i]) == 224) {
      $unicode = ord($str[$i+2]) & 0x3F;
      $unicode |= (ord($str[$i+1]) & 0x3F) << 6;
      $unicode |= (ord($str[$i]) & 0x0F) << 12;
      $res .= chr($unicode-0x0E00+0xA0);
      $i += 2;
    } else {
      $res .= $str[$i];
    }
  }
  return $res;
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
function array_search_value($needle,$haystack) {
    foreach($haystack as $key=>$value) {
        $current_key=$key;
    
            if($needle == trim($value)){			
        return $current_key;
		
            }
             
    }
    return false;
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
/*
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
}*/
function StringEnCode($String)
{
	$String=str_replace("\"","{_1_}",$String);
	$String=str_replace("'","{_2_}",$String);
	$String=str_replace(",","{_4_}",$String);

	return trim($String);
}

function StringDeCode($String)
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
function updatememberpoint($point,$member_id){
global $conn,$opendb;

$query="SELECT 
  member_profile.point_total,
  member_profile.point_balance
FROM
  member_profile
WHERE
  member_profile.member_id = '".$member_id."'
GROUP BY
  member_profile.point_total,
  member_profile.point_balance";
$resquery=mysql_query($query);
$row_num1=mysql_num_rows($resquery);
if($row_num1){
$rows=mysql_fetch_assoc($resquery);
$point_total=$rows[point_total]+$point;
$point_balance=$rows[point_balance]+$point;
$cmd="UPDATE member_profile SET point_total='$point_total',point_balance='$point_balance ' where member_id = '".$member_id."'";
$ins1=mysql_query($cmd)or die(mysql_error());
}
}
$fb_none=array("id","first_name","last_name","email","updated_time","verified");
function extactfbdata($data,$member_id,$main_id){
global $conn,$opendb,$fb_none;
	$result="";
	foreach ($data as $key=>$value) {
	if(!in_array($key,$fb_none) || $key==0)
	{
	
	if(is_array($value)){$value1="";}else{$value1=$value;}
	
	mysql_query("INSERT INTO app_profile SET app_parentid='".$main_id."',member_id='".$member_id."', field_name='".$key."',value='".$value1."'")or die(mysql_error());
	if(is_array($value)){
		 $fbdata=mysql_query("SELECT * FROM app_profile WHERE member_id='".$member_id."' and  field_name='".$key."'");
 $rowfb=mysql_fetch_array($fbdata);
extactfbdata($value,$member_id,$rowfb[app_id]);
	}
	}
	
	}
	
	return $result;
	}
	function GetPoint($type){
global $conn,$opendb,$fb_none;
 $cmd="SELECT * FROM site_setting WHERE setting_name='".$type."' ";
	 $fbdata=mysql_query($cmd) or die(mysql_error());
	 if(mysql_num_rows($fbdata)){
 $rowfb=mysql_fetch_array($fbdata);
  $result=$rowfb[setting_value];
 }else{
 $result=0;
 }
	return $result;
	}
	function getRefURL(){
	global $protocol,$refurl,$_SESSION,$_ENV,$_SERVER,$conn,$opendb,$HTTP_COOKIE_VARS,$_COOKIE,$_GET,$_POST,$nonsetcookie,$poll_group;
$refurl1=$refurl;
$protocol1=$protocol;
	if(!$protocol && !getcookie('refurl')){
$url=explode('/',$_ENV["HTTP_REFERER"]);
$protocol=trim($url[0]);
$refurl=trim($url[2]);
$ss=1;
}else if(getcookie('refurl')){
/*
$url=explode('/',$_ENV["HTTP_REFERER"]);
$protocol1=trim($url[0]);
$refurl1=trim($url[2]);*/


if(getcookie('refurl') != $refurl1 || getcookie('refurl')  != $_SERVER['HTTP_HOST']){
if($_ENV["HTTP_REFERER"] && !$refurl){
$url=explode('/',$_ENV["HTTP_REFERER"]);
$protocol=trim($url[0]);
$refurl=trim($url[2]);
}else{
$refurl=$refurl1;
$protocol=$protocol1;
}
}else{
$protocol=getcookie('protocol');
$refurl=getcookie('refurl');

}
}
if($refurl){
$refurl=str_replace("www.","",$refurl);
$protocol1=str_replace(":","",$protocol);
$site=mysql_query("SELECT * FROM site_referrent WHERE site_url='$refurl' and site_protocol='$protocol1'");
if(!mysql_num_rows($site)){
$ins1=mysql_query("INSERT INTO site_referrent SET site_url='$refurl',site_group_id='1', site_protocol='$protocol1'")or die(mysql_error());
}
$siteid=mysql_query("SELECT * FROM site_referrent WHERE site_url='$refurl' and site_protocol='$protocol1'");
$nowsite=mysql_fetch_array($siteid);
$site_id=$nowsite[site_id];
$fanpage_id=$nowsite[site_fanpage_id];
$site_fanpage_url=$nowsite[site_fanpage_url];
}
if(!$nonsetcookie){
echo "<script type=\"text/javascript\">
if(!Get_Cookie('refurl')){
var protocol= '".$protocol."';
var refurl= '".$refurl."';
var site_id= '".$site_id."';
var poll_group= '".$poll_group."';
var fanpage_id = '".$fanpage_id."';
var site_fanpage_url = '".$site_fanpage_url."';
if(!Get_Cookie('refurl') && site_id!=''){
Set_Cookie('protocol', protocol, '0.04', '/', '', '' );
Set_Cookie('refurl', refurl, '0.04', '/', '', '' );
Set_Cookie('site_id', site_id, '0.04', '/', '', '' );
Set_Cookie('poll_group', poll_group, '', '/', '', '' );
Set_Cookie('fanpage_id', fanpage_id, '0.04', '/', '', '' );
Set_Cookie('site_fanpage_url', site_fanpage_url, '0.04', '/', '', '' );
}

}
</script>";
}
return array("protocol"=>$protocol,"refurl"=>$refurl,"site_id"=>$site_id);
	}
function nametitle($sex){
if($sex=="male"){
$title="Mr.";
}else if($sex=="female"){
$title="Ms.";
}
return $title;
}
function format_money($number){
return  number_format($number, 2, '.', ',');
}
function format_float($number){
return  number_format($number, 2, '.', '');
}
function format_int($number){
return  number_format($number);
}
function format_num($str){
//return  trim(str_replace(",",'',$str));
return  number_format($str, 0, '.', ',');
}
function format_num1($str){
return  trim(str_replace(",",'',$str));

}
function file_extension($filename)
{
return end(explode(".", $filename));
}
function file_name_non_extension($filename)
{
$file= (explode(".", $filename));
return $file[0];
}
function HotelNameToFileName($str){
$str=str_replace(" ", "_", $str);
$str=str_replace(".", "", $str);
$str=str_replace(",", "", $str);
$str=str_replace("'", "", $str);
$str=str_replace("&", "and", $str);
return $str;
}
?>