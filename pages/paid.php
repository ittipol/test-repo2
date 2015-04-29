<?php

	if(isset($_SESSION['COURSE']) && $_SESSION['COURSE']){ // course
		require_once("pages/paid/paid_course.php"); 
	}else{
		require_once("pages/paid/paid.php"); 
	}

?>