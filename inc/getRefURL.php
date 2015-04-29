<?php
	ob_start();
session_start();
	if(!$protocol && !getcookie('refurl')){
$url=explode('/',$_ENV["HTTP_REFERER"]);
$protocol=trim($url[0]);
$refurl=trim($url[2]);
$ss=1;
}else if(getcookie('refurl')){
$url=explode('/',$_ENV["HTTP_REFERER"]);
$protocol1=trim($url[0]);
$refurl1=trim($url[2]);

if(getcookie('refurl') ==$refurl1 || getcookie('refurl')  == $_SERVER['HTTP_HOST']){
$url=explode('/',$_ENV["HTTP_REFERER"]);
$protocol=trim($url[0]);
$refurl=trim($url[2]);

}else{
$protocol=getcookie('protocol');
$refurl=getcookie('refurl');

}
}
if($refurl){
$protocol1=str_replace(":","",$protocol);
$site=mysql_query("SELECT * FROM site_referrent WHERE site_url='$refurl' and site_protocol='$protocol1'");
if(!mysql_num_rows($site)){
$ins1=mysql_query("INSERT INTO site_referrent SET site_url='$refurl',site_group_id='1', site_protocol='$protocol1'")or die(mysql_error());
}
$siteid=mysql_query("SELECT * FROM site_referrent WHERE site_url='$refurl' and site_protocol='$protocol1'");
$nowsite=mysql_fetch_array($siteid);
$site_id=$nowsite[site_id];
}
echo $ss;
?>
<script type="text/javascript">
if(!Get_Cookie('refurl')){
var protocol= '<?php echo $protocol;?>';
var refurl= '<?php echo $refurl;?>';
var site_id= '<?php echo $site_id;?>';
if(!Get_Cookie('refurl') && site_id!=''){
Set_Cookie('protocol', protocol, '', '/', '', '' );
Set_Cookie('refurl', refurl, '', '/', '', '' );
Set_Cookie('site_id', site_id, '', '/', '', '' );
}

}
</script>