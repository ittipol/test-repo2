<?php

	if(isset($_SESSION['COURSE']) && $_SESSION['COURSE']){ // course
		require_once("pages/billing/billing_course.php");
	}else{
		require_once("pages/billing/billing.php");
	}

?>