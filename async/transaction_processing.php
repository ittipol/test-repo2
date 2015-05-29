<?php

	ini_set("display_errors", 0);
	error_reporting(E_ALL);
	
	include("../inc/database.php");
	global $database;

	if(isset($_POST['code'])){

		$code = $_POST['code'];

		$cmd = "UPDATE invoice_temp_payment 
				SET payment_processing = '1' 
				WHERE referance_code = '".$code."'";
		$database->query($cmd);

		$json['success'] = 1;

	}else{

		$json['success'] = 0;

	}

	echo json_encode($json);

?>