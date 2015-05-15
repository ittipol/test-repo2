<?php
ini_set("display_errors", 0);
error_reporting(E_ALL);
include("inc/session.php");
include("inc/function.php");
include("inc/ApiCaller.php");

if(isset($_GET['action']) && ($_GET['action'] == 'logout'))
{
	$_SESSION['currentPage'] = 'main';
	$_SESSION['isLogin'] = '';
	$_SESSION['member_id'] = '';
	$_SESSION['fullname'] = '';
	$_SESSION['ID'] = '';
    $_SESSION['school_logo'] = '';
}

// $class = array(
//         "k" => array(
//                 1,2,3
//             ),
//         "p" => array(
//                 1,2,3,4,5,6
//             ),
//         "s" => array(
//                 1,2,3,4,5,6
//             ),
//     );

// $i = 31;

// foreach ($class as $key => $v) {
//     foreach ($v as  $value) {
    
//     $cmd = "INSERT INTO  `payportal_db`.`join_grade_class_course` (
//             `grade` ,
//             `class` ,
//             `course_id`
//             )
//             VALUES (
//             '".$key."',  '".$value."',  '".$i++."'
//             )";
// $database->query($cmd);
//     $cmd = "INSERT INTO  `payportal_db`.`join_grade_class_course` (
//             `grade` ,
//             `class` ,
//             `course_id`
//             )
//             VALUES (
//             '".$key."',  '".$value."',  '".$i++."'
//             )";
// $database->query($cmd);
// }
// }
// for ($i=1; $i < 31; $i++) { 

//     $name = "คอร์สเรียนพิเศษ#".$i;
//     $cmd  = "INSERT INTO  `payportal_db`.`course` (
//                 `course_id` ,
//                 `course_name` ,
//                 `course_detail` ,
//                 `course_price` ,
//                 `course_type` ,
//                 `subject_id` ,
//                 `school_id`
//                 )
//                 VALUES (
//                 NULL ,  '".$name."',  '".$name."',  '4000',  'tutor',  '1',  '1'
//                 )";
// $database->query($cmd);
// }
// exit;
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

    <title>Pay Portal</title>
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
                                                    <img src="assets/img/logo.png" alt="Home">
                                                </a>
                                            </div><!-- /.logo -->

                                        </div><!-- /.logo-wrapper -->

                                        <div class="header-nav span-9 clearfix">
                                            <ul class="header-nav-list">
                                                <li>
                                                    <a href="index.php?page=main">นักเรียน</a>
                                                </li>
                                            </ul>
                                            <ul class="header-nav-list">
                                                <li>
                                                    <a href="index.php?page=main_univer">สถาบันการศึกษา</a>
                                                </li>
                                            </ul>
                                        </div>

                                        <?php
	                                        if($_SESSION['isLogin'] == 'Yes')
	                                        {
		                                        ?>
		                                        <a class="list-your-property logout-image wrapper" style="margin-left:10px; padding:20px; float:right; margin-bottom:10px;" href="index.php?action=logout">
	                                              <div class="tooltip-lower">ออกจากระบบ</div>
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
                                        <a class="btn btn-primary btn-large list-your-property header-btn" style="margin-left:10px;" href="index.php?page=register">ลงทะเบียน</a>
                                        <a class="btn btn-primary btn-large list-your-property header-btn" href="index.php?page=login">เข้าสู่ระบบ</a>
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

        <div class="container" id="searchbar2">
            <div class="row" >
                <div class="span3" >
                    <div class="property-filter pull-right" style="display:none;">
                        <div class="content">
                            <form method="POST" action="index.php?page=main">
	                            <div class="type control-group">
	                            	<label class="control-label" style="font-size:24px;" for="inputLocation">
                                        ชำระเงิน
                                    </label>
                                    
                                    <label class="control-label" style="margin-top:10px; margin-bottom:20px; border-bottom: 1px solid white;" for="inputLocation">
                                       
                                    </label>

	                            </div>
                                <div class="location control-group">
                                    <label class="control-label"  style="margin-top:20px;" for="inputLocation">
                                        สถานศึกษา
                                    </label>
                                    <div class="controls">
                                        <select id="inputLocation3" name="university_id" style="height: 40px; line-height: 40px;">
                                        	<?php
				                        		$cmd ="SELECT * FROM university ORDER BY university_name ASC";
									            $result= $database->query($cmd);
									            $nums=mysql_num_rows($result);
									            for($i=0;$i<$nums;$i++){
										        	$row = mysql_fetch_array($result);
										        	?>
										        		<option value="<?php echo $row["university_id"]?>"><?php echo $row["university_name"]?></option>
										        	<?php
										        }
		
			                        		?>
                                        </select>
                                    </div><!-- /.controls -->
                                </div><!-- /.control-group -->

                                <div class="type control-group">
                                    <label class="control-label" for="inputType"  style="margin-top:20px;">
                                        รหัสการชำระเงิน (Invoice ID)
                                    </label>
                                    <div class="controls">
                                    	<input type="text" placeHolder="Invoice ID" name="invoice_info_id" />
                                        <!--<select id="inputType">
                                            <option id="apartment">Apartment</option>
                                            <option id="condo">Condo</option>
                                        </select>-->
                                    </div><!-- /.controls -->
                                </div><!-- /.control-group -->

                               
                                <div class="form-actions">
                                    <input type="submit" value="ค้นหารายการ" style="margin-top:20px;" class="btn btn-primary btn-large">
                                </div><!-- /.form-actions -->
                                <input type="hidden" name="action" id="action" value="search" />
                            </form>
                        </div><!-- /.content -->
                    </div><!-- /.property-filter -->
                </div><!-- /.span3 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
            
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
                        <a href="#">เงื่อนไขการให้บริการ</a>
                        <a href="#">ความช่วยเหลือ</a>
                        <a href="#">ข้อมูลความปลอดภัย</a>
                        <a href="#">เกียวกับเรา</a>
                        <a href="#">ติดต่อเรา</a>
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