<?php

    include("config.php");

//-----------------------------------------------------------------------------

// HTTP POST
if(isset($_POST['language'])){
    // thai
    // english
    $_COOKIE['language'] = $_POST['language'];
}

if(isset($_GET['action']) && ($_GET['action'] == 'logout'))
{
	$_SESSION['currentPage'] = 'main';
	$_SESSION['isLogin'] = '';
	$_SESSION['member_id'] = '';
	$_SESSION['fullname'] = '';
	$_SESSION['ID'] = '';
    $_SESSION['school_logo'] = '';
}

?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Aviators - byaviators.com">

    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/png">
    <link rel="stylesheet" href="assets/css/custom.css" type="text/css">
    <link rel="stylesheet" href="assets/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="assets/css/bootstrap-responsive.css" type="text/css">
    <!-- <link rel="stylesheet" href="assets/libraries/chosen/chosen.css" type="text/css"> -->
    <link rel="stylesheet" href="assets/libraries/bootstrap-fileupload/bootstrap-fileupload.css" type="text/css">
    <link rel="stylesheet" href="assets/libraries/jquery-ui-1.10.2.custom/css/ui-lightness/jquery-ui-1.10.2.custom.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/realia-blue.css" type="text/css" id="color-variant-default">
    <!-- <link rel="stylesheet" href="#" type="text/css" id="color-variant"> -->

    <title><?php echo titleSwitcher($_GET['page']); ?></title>
</head>
<body>
<div id="wrapper-outer" >
    <div id="wrapper">
        <div id="wrapper-inner">
           
            <!-- HEADER -->
            <div id="header-wrapper">
                <div id="header">
                    <div id="header-inner" style="background-color:#009cde;">
                        <div class="container">
                            <div class="navbar">
                                <div class="navbar-inner">
                                    <div class="row" style="height:100%;">
                                        <div class="logo-wrapper span3" style="position:relative;">
                                            <a href="#nav" class="hidden-desktop" id="btn-nav">Toggle navigation</a>

                                            <div class="logo">
                                                <a href="index.php" >
                                                    <!-- <img src="assets/img/logo.png" alt="Home"> -->
                                                    <!-- <img src="assets/img/logo.png" alt="Home"> -->
                                                    <img src="<?php echo logoSwitcher($_GET['page']); ?>" alt="Home">
                                                </a>
                                            </div><!-- /.logo -->

                                        </div><!-- /.logo-wrapper -->

                                        <div class="header-nav span-9 clearfix">
                                            <ul class="header-nav-list">
                                                <li>
                                                    <a href="index.php?page=main"><?php echo $_language['text_student']; ?></a>
                                                </li>
                                            </ul>
                                            <ul class="header-nav-list">
                                                <li>
                                                    <a href="index.php?page=main_univer"><?php echo $_language['text_educational_institution']; ?></a>
                                                </li>
                                            </ul>
                                        </div>

                                        <?php
	                                        if($_SESSION['isLogin'] == 'Yes')
	                                        {
		                                        ?>
		                                        <a class="list-your-property logout-image wrapper" style="margin-left:10px; padding:20px; float:right; margin-bottom:10px;" href="index.php?action=logout">
	                                              <div class="tooltip-lower"><?php echo $_language['text_logout']; ?></div>
	                                            </a>
	                                            <a class="list-your-property history-image wrapper" style="margin-left:10px; padding:20px; float:right;" href="index.php?page=history">
	                                              <div class="tooltip-lower">ประวัติการชำระเงิน</div>
	                                            </a>
	                                            <span class="btn btn-primary btn-large list-your-property "><?php echo $_SESSION['fullname']?></span> 
		                                        <?php
	                                        }
	                                        else
	                                        {
		                                        
	                                       
                                        ?>
                                        <a class="btn btn-primary btn-large list-your-property header-btn" style="margin-left:10px;" href="index.php?page=register"><?php echo $_language['text_register']; ?></a>
                                        <a class="btn btn-primary btn-large list-your-property header-btn" href="index.php?page=login"><?php echo $_language['text_login']; ?></a>
                                         <?php
                                         	 }
                                         ?>

                                        
                                    </div><!-- /.row -->
                                </div><!-- /.navbar-inner -->
                            </div><!-- /.navbar -->
                        </div><!-- /.container -->
                    </div><!-- /#header-inner -->
                </div><!-- /#header -->
            </div><!-- /#header-wrapper -->
            
<?php
if(is_null($_GET['page']))
{
	
	redirect("index.php?page=main");
		//require_once("pages/dashboard.php");
}
else if(!file_exists("pages/".$_GET['page'].".php"))
{
	redirect("index.php?page=main");
}
else if(file_exists("pages/".$_GET['page'].".php") && $_GET['page'])
{
	// file_put_contents('test.txt', "CREATE".PHP_EOL , FILE_APPEND);
	require_once("pages/".$_GET['page'].".php");
}
?>
    
<div id="footer-wrapper" style="display:block; height:auto;">
    <div id="footer">
        <div class="row-fluid">

            <div class="span6">
                <div class="footer-inner">
                    <img style="width:40px;" src="assets/img/social_icon/fb_icon.png">
                    <img style="width:40px;" src="assets/img/social_icon/twitter_icon.png">
                </div>
            </div>

            <div class="span6">
                <div class="footer-inner">
                    <div class="footer-nav">
                        <a href="#"><?php echo $_language['text_term_of_service']; ?></a>
                        <a href="#"><?php echo $_language['text_polity_n_safety']; ?></a>
                        <a href="#"><?php echo $_language['text_platform_policy']; ?></a>
                        <a href="#"><?php echo $_language['text_about_us']; ?></a>
                        <a href="#"><?php echo $_language['text_contact_us']; ?></a>
                    </div>
                </div>
            </div>

            <!-- <div style="width:40%; margin:0 auto;">
                <div class=" footer-nav">
                    <a href="#">ความช่วยเหลือ</a>
                    <a href="#">ข้อมูลความปลอดภัย</a>
                    <a href="#">เกียวกับเรา</a>
                    <a href="#">ติดต่อเรา</a>
                </div>
                <div class=" copyright">
                    © Copyright 2014 by Payportal. All rights reserved.
                </div>
            </div> -->
           
        </div>
    </div>
</div><!-- /#footer-wrapper -->
</div><!-- /#wrapper -->
</div><!-- /#wrapper-outer -->

<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/js/jquery.ezmark.js"></script>
<script type="text/javascript" src="assets/js/jquery.currency.js"></script>
<script type="text/javascript" src="assets/js/jquery.cookie.js"></script>
<script type="text/javascript" src="assets/js/retina.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/carousel.js"></script>
<script type="text/javascript" src="assets/libraries/jquery-ui-1.10.2.custom/js/jquery-ui-1.10.2.custom.min.js"></script>
<!-- <script type="text/javascript" src="assets/libraries/chosen/chosen.jquery.min.js"></script> -->
<script type="text/javascript" src="assets/libraries/iosslider/_src/jquery.iosslider.min.js"></script>
<script type="text/javascript" src="assets/libraries/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<script type="text/javascript" src="assets/js/realia.js"></script>

<script type="text/javascript">

	// var w,w2;
	// var wh = 0, wh2 = 0;

	// window.onload = function(){

	// // 	$('#inputLocation').change(function(){
	// // 	    setSearchBoxWidth();
	// // 	 });

	// // 	window.wh = $(window).width();
	// // 	window.w2 = calInti(window.wh); 
	// // 	setSearchBoxWidth();
	// // }	

	// // $( window ).bind("resize", function(){
	// // 	window.wh = $(window).width();
	// // 	window.w2 = calInti(window.wh);
	// // 	// var t = (window.wh*100)/1600; // percent

	// //     $("#inputInvoice").css("width",window.w2-window.w);
	// //     setSearchBoxWidth();
	// };

	// function setSearchBoxWidth(){
	// 	$("#width_tmp").html($('#inputLocation option:selected').text());
	// 	w = $("#width_tmp").width()+30;// 30 : the size of the down arrow of the select box 
	// 	$('#inputLocation').width(w);
	// 	$("#inputInvoice").css("width",window.w2-window.w);
	// }

	// function calInti(w){
	// 	return (w * 550)/1600;
	// }

</script>

</body>
</html>