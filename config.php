<?php

	ini_set("display_errors", 0);
	error_reporting(E_ALL);
	include("inc/session.php");
	include("inc/function.php");
	include("inc/ApiCaller.php");
	include("inc/logo_switcher.php");

	$language = 'english';

	if(isset($_COOKIE['language'])){ // cookie wasn't exist
	    $language = $_COOKIE['language'];
	}

	include('language/'.$language.'/index.php');
	if(file_exists('language/'.$language.'/'.$_GET['page'].'.php')){
	    include('language/'.$language.'/'.$_GET['page'].'.php');
	}

?>