<?php
$conn= @mysql_connect($db_host,$database_user,$database_pass);
mysql_set_charset('tis620',$conn); 
$opendb = @mysql_select_db($db_name, $conn);
mysql_query("SET character_set_results=tis620");
mysql_query("SET character_set_client=tis620");
mysql_query("SET character_set_connection=tis620");
?>