<?php

	if($_POST['action'] == 'search')
	{ 
		// $cmd ="SELECT * FROM invoice WHERE invoice_info_id = '".$_POST['invoice_info_id']."' AND university_id = '".$_POST['university_id']."' LIMIT 1";
        

        $cmd ="SELECT * FROM invoice i
        		LEFT JOIN university u
        		ON (i.university_id = u.university_id)
        		WHERE invoice_info_id = '".$_POST['invoice_info_id']."' 
        		LIMIT 1";

        $result= $database->query($cmd);
        $nums=mysql_num_rows($result);
        $row = mysql_fetch_array($result);

        unset($_SESSION['COURSE']);

        if($nums > 0)
        {
	        $_SESSION['ID'] = $row['invoice_id'];
	        
	        if($row['invoice_info_status'] == 'รอชำระเงิน')
	        {
		        redirect("index.php?page=invoiceinfo");
	        }
	        else
	        {
		        redirect("index.php?page=paid_exist");
	        }
	        
        }
        else
        {
	         $_SESSION['ID'] = '';
	         
	         echo('<div class="alert alert-error">
	            <button type="button" class="close" data-dismiss="alert">×</button>
	            ไม่พบรหัสการชำระเงินที่เลือก.
	        </div>');
        }										        
			
	}

?>

 <!-- CONTENT -->
    <div id="main-content"><div class="map-wrapper">
    <div class="map">
        <div style="background-color:#999;" class="map-inner">

    <?php if($_SESSION['isLogin'] == ""){ ?>

	    <div id="signup-section" class="section1" style="width:100%;background-image:url(assets/img/landing_page/guest.jpg);background-size:cover;background-position:center center;" >
		    <div id="signup-box" class="disktop-box" style="text-align:center;">
		    	<div class="first-quote"><?php echo $_language['section1_quote_first']; ?></div>
		    	<div class="second-quote"><?php echo $_language['section1_quote_second']; ?></div>
			    <!-- <div style="font-size:50px; color:#FFF; padding:0 0 30px 0;">สมัครสมาชิก</div> -->
			    <div class="partners">
		            <a href="index.php?page=register" class="btn btn-primary btn-large list-your-property custom-btn-1"><?php echo $_language['text_register']; ?></a>
				</div>
			</div>
		</div>
	
 	<?php }else{ // logged in ?>

	 	<div id="signup-section" class="section1" style="width:100%;background-image:url(assets/img/landing_page/logged_in.jpg);background-size:cover; background-position:top center;" >
		    <div id="signup-box" class="disktop-box" style="text-align:center;">
			    <div class="display-name"><?php echo sprintf($_language['text_welcome'],$_SESSION['fullname']); ?></div>
			    <div class="partners">
		            <a href="index.php?page=paid_list" class="btn btn-primary list-your-property custom-btn-1"><?php echo $_language['text_pay']; ?></a>
				</div>
			</div>
		</div>
		
 	<?php } ?>

 	<div class="landing-page-nav show-desktop">
		<div class="row-fluid">
			<div class="span4 cell">
				<div class="cell-header clearfix">
					<img class="cell-img" src="assets/img/icon/icon-payment.png" />
					<div class="cell-text">
						<a href="javascript:void(0);" onclick="slideTo('payment-section');"><?php echo $_language['text_pay_portal']; ?></a>
					</div>
				</div>
				<div class="cell-footer">
					<div class="cell-message">
						<?php echo $_language['text_quote_payportal']; ?>
					</div>
				</div>
			</div>
			<div class="span4 cell">
				<div class="cell-header clearfix">
					<img class="cell-img" src="assets/img/icon/icon-book.png" />
					<div class="cell-text">
						<a href="javascript:void(0);" onclick="slideTo('e-lib-section');"><?php echo $_language['text_e_library']; ?></a>
					</div>
				</div>
				<div class="cell-footer">
					<div class="cell-message">
						<?php echo $_language['text_quote_e_library']; ?>
					</div>
				</div>
			</div>
			<div class="span4 cell">
				<div class="cell-header clearfix">
					<img class="cell-img" src="assets/img/icon/notification.multiple.png" />
					<div class="cell-text">
						<a href="javascript:void(0);" onclick="slideTo('booking-section');"><?php echo $_language['text_booking_portal']; ?></a>
					</div>
				</div>
				<div class="cell-footer">
					<div class="cell-message">
						<?php echo $_language['text_quote_booking_portal']; ?>
					</div>
				</div>
			</div>
		</div>
 	</div>

    </div><!-- /.map -->
</div><!-- /.map-wrapper -->

<div class="hidden-desktop span12" style="background-color:#FFF;">
 	<div class="hidden-box">
	 	<div class="primary-quote" style="color:#06a7ea;"><img class="cell-img" src="assets/img/icon/icon-payment.png" /><?php echo $_language['text_pay_portal']; ?></div>
	 	<div class="third-quote"><?php echo $_language['text_quote_payportal']; ?></div>
 	</div>
 </div>

 <div class="hidden-desktop span12"style="background-color:#FFF;">
 	<div class="hidden-box">
	 	<div class="primary-quote" style="color:#06a7ea;"><img class="cell-img" src="assets/img/icon/icon-book.png" /><?php echo $_language['text_e_library']; ?></div>
	 	<div class="third-quote"><?php echo $_language['text_quote_e_library']; ?></div>
 	</div>
 </div>

 <div class="hidden-desktop span12" style="background-color:#FFF;">
 	<div class="hidden-box">
	 	<div class="primary-quote" style="color:#06a7ea;"><img class="cell-img" src="assets/img/icon/notification.multiple.png" /><?php echo $_language['text_booking_portal']; ?></div>
	 	<div class="third-quote"><?php echo $_language['text_quote_booking_portal']; ?></div>
 	</div>
 </div>

<!-- Payportal Main Service -->
<!-- <div id="payment-section" class="section4" style="width:100%;padding-bottom: 32%;background-image:url(assets/img/landing_page/payment.jpg);background-size:cover;background-position:center;" >
	<div class="boxText5" style="margin-left:47%;" >
 		<h2>ชำระเงินได้ทันที</h2>
 		<div class="sub-text-box">
	 		<div class="text1">ปลอดภัยและรวดเร็ว</div>
	 		<div class="text2">ชำระเงินได้ง่ายๆ และปลอดภัยกว่าในการชำระค่าใช้จ่ายของสถาบันการศึกษาชั้นนำหลายพันแห่ง</div>
	 	</div>
	 	<a href="index.php?page=paid_list" class="btn btn-primary list-your-property custom-btn-2" style="float:left;">ชำระค่าเทอมทันที</a>
 	</div>
 </div> -->

<div class="row" style="height:10px; background-color:#06a7ea;">
	<div style="text-align: center;">
		<!-- <a href="javascript:void(0);" onclick="slideTo('payment-section');" class="nav-btn large" style="background-image:url(assets/img/arrow-bottom-black@2x.png);"></a> -->
	</div>
</div>

 <div id="e-lib-section" class="banner-container section1" style="background-image:url(assets/img/landing_page/library.jpg);background-size:cover;background-position:center;" >
    <div class="boxText0 show-desktop">
 		<h2 style="display:block;"><?php echo $_language['section2_quote_first']; ?></h2>
 		<div class="sub-text-box">
	 		<div class="text1"><?php echo $_language['section2_quote_second']; ?></div>
	 		<div class="text2" style="color: #FFFFFF;"><?php echo $_language['section2_quote_third']; ?></div>
		</div>
		<a href="http://thaidemo.ebook.hyread.com.tw/" class="btn btn-primary list-your-property custom-btn-2"><?php echo $_language['text_more']; ?></a>
 	</div>
 </div>

 <div class="hidden-desktop span12" style="background-color:#FFF;">
 	<div class="hidden-box">
	 	<div class="primary-quote"><?php echo $_language['section2_quote_first']; ?></div>
	 	<div class="second-quote"><?php echo $_language['section2_quote_second']; ?></div>
	 	<div class="third-quote"><?php echo $_language['section2_quote_third']; ?></div>
	 	<a href="http://thaidemo.ebook.hyread.com.tw/" class="btn btn-primary list-your-property custom-btn-2" style="margin-top:20px;"><?php echo $_language['text_more']; ?></a>
 	</div>
 </div>

<div class="row" style="height:10px; background-color:#06a7ea;">
	<div style="text-align: center;">
		<!-- <a href="javascript:void(0);" onclick="slideTo('payment-section');" class="nav-btn large" style="background-image:url(assets/img/arrow-bottom-black@2x.png);"></a> -->
	</div>
</div>

<div id="booking-section" class="banner-container section4" style="background-image:url(assets/img/landing_page/booking.jpg);background-size:cover;background-position:center;" >
	<div class="boxText5 show-desktop" style="margin-left:47%;" >
 		<h2><?php echo $_language['section3_quote_first']; ?></h2>
 		<div class="sub-text-box">
	 		<div class="text1"><?php echo $_language['section3_quote_second']; ?></div>
	 		<div class="text2"><?php echo $_language['section3_quote_third']; ?></div>
	 	</div>
	 	<a href="index.php?page=booking" class="btn btn-primary list-your-property custom-btn-2" style="float:left;"><?php echo $_language['text_more']; ?></a>
 	</div>
 </div>

 <div class="hidden-desktop span12" style="background-color:#FFF;">
 	<div class="hidden-box">
	 	<div class="primary-quote"><?php echo $_language['section3_quote_first']; ?></div>
	 	<div class="second-quote"><?php echo $_language['section3_quote_second']; ?></div>
	 	<div class="third-quote"><?php echo $_language['section3_quote_third']; ?></div>
	 	<a href="index.php?page=booking" class="btn btn-primary list-your-property custom-btn-2" style="margin-top:20px;"><?php echo $_language['text_more']; ?></a>
 	</div>
 </div>

 <div class="row" style="height:10px; background-color:#06a7ea;">
	<div style="text-align: center;">
		<!-- <a href="javascript:void(0);" onclick="slideTo('payment-section');" class="nav-btn large" style="background-image:url(assets/img/arrow-bottom-black@2x.png);"></a> -->
	</div>
</div>

<div class="panel">
	<div style="text-align:center;">
		<div class="partners">
			<div style="font-size:40px; color:#000; padding:0 0 30px 0;"><?php echo $_language['text_register']; ?></div>
		    <a href="index.php?page=register" class="btn btn-primary btn-large list-your-property custom-btn-1"><?php echo $_language['text_register']; ?></a>
		</div>
	</div>
</div>

 <div class="partners" style="background-color:#FFF;">

 	<div style="font-size:40px; text-align:center; padding:40px 0;"><?php echo $_language['text_join_us']; ?></div>

						<div class="content">
					        
					         <div class="partner">
					            <a href="http://logopond.com/gallery/detail/192115">
					                <img src="assets/img/school_logo/harrow-logo.jpg" alt="Logo">
					            </a>
					        </div><!-- /.partner -->
					
					        <div class="partner">
					            <a href="http://logopond.com/gallery/detail/191954">
					                <img src="assets/img/school_logo/british_council-logo.jpg" alt="Logo">
					            </a>
					        </div><!-- /.partner -->
					
					        <div class="partner">
					            <a href="http://logopond.com/gallery/detail/192592">
					                <img src="assets/img/school_logo/isb-logo.jpg" alt="Logo">
					            </a>
					        </div><!-- /.partner -->
					
					        <div class="partner">
					            <a href="http://logopond.com/gallery/detail/192905">
					                <img src="assets/img/school_logo/ruamrudee-logo.jpg" alt="Logo">
					            </a>
					        </div><!-- /.partner -->

					    </div><!-- /.content -->
					</div><!-- /.partners-->    

					<div>

			<div class="section3" style="width:100%; background-color:rgb(245,245,245);" >
			  	<div class="boxText3" style="color:#000;">
			 		<h2 style="font-size:36px !important;"><?php echo $_language['text_how_to_pay']; ?></h2>
			 		<span style="font-size:22px;">
			 			<?php echo $_language['text_how_to_pay_detail']; ?>
			 		</span>
			 		
			 	</div>

 			</div>

   </div><!-- /#content -->
</div><!-- /#wrapper-inner -->
<?php
	$_SESSION['currentPage'] = 'main';
?>

<script type="text/javascript">

	// First Banner handle displaying full screen on any resolution
	var h = window.innerHeight;
	var btmh = 90 + 180 + 40; // header bar + below first banner
	var v = h-btmh;
	var e = document.getElementById("signup-section");
	e.style.height = v+"px";
	var e2 = document.getElementById("signup-box");
	e2.style.paddingTop = ((v-e2.clientHeight)/2) + "px";

	

	// function gradeChange(e){

	// 	// var newSelect=document.createElement('select');
	// 	var newSelect=document.getElementById('select-box-class-value');
	// 	newSelect.innerHTML = "";
		
	// 	var opt = document.createElement("option");

	// 	opt.value= 0;
	// 	opt.innerHTML = "ปีที่"; // whatever property it has
	// 	newSelect.appendChild(opt);

	// 	var grade = e.options[e.selectedIndex].value;

	// 	switch(grade){

	// 		case '0':

	// 		break;
			
	// 		case 'k':
	// 			for (i = 1; i <= 3; i++) 
	// 			{
	// 			   var opt = document.createElement("option");
	// 			   opt.value= i;
	// 			   opt.innerHTML = i; // whatever property it has

	// 			   // then append it to the select element
	// 			   newSelect.appendChild(opt);
	// 			   // index++;
	// 			}
	// 		break;

	// 		default: // p,s
	// 			for (i = 1; i <= 6; i++) 
	// 			{
	// 			   var opt = document.createElement("option");
	// 			   opt.value= i;
	// 			   opt.innerHTML = i; // whatever property it has

	// 			   // then append it to the select element
	// 			   newSelect.appendChild(opt);
	// 			   // index++;
	// 			}

	// 	}

	// 	// $("#select-box-class-value").html("").append(newSelect);
				
	// }

	function slideTo(id){
		var t = $("#"+id).offset().top;
		$("body").animate({scrollTop:t},400);
	}

</script>