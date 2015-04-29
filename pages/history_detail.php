<?php

	// if($_SESSION['ID'] == '')
	// 	redirect("index.php?page=main");

    $cmd = "SELECT * FROM `invoice` WHERE invoice.invoice_id = '".$_GET['ID']."' LIMIT 1";
    $result= $database->query($cmd);
    $nums=mysql_num_rows($result);
    $row = mysql_fetch_array($result);

	if(!$row)
		redirect("index.php?page=main");

    if($row['school_id'] > 0){ // school invoice
    	require_once("pages/history_detail/history_detail_course.php");
    }else{
    	require_once("pages/history_detail/history_detail.php");
    }


?>