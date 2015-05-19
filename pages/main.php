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
		    <div id="signup-box" style="text-align:center;">
		    	<div style="font-size:50px; color:#FFF; padding:0 0 30px 0;">ชำระเงินได้ทันที</div>
		    	<div style="font-size:30px; color:#FFF; padding:0 0 30px 0;">ชำระเงินได้ง่ายๆ และปลอดภัยกว่าในการชำระค่าใช้จ่ายของสถาบันการศึกษาชั้นนำหลายพันแห่ง</div>
			    <!-- <div style="font-size:50px; color:#FFF; padding:0 0 30px 0;">สมัครสมาชิก</div> -->
			    <div class="partners">
		            <a href="index.php?page=register" class="btn btn-primary btn-large list-your-property custom-btn-1">ลงทะเบียน</a>
				</div>
			</div>
		</div>
	
 	<?php }else{ // logged in ?>

	 	<div id="signup-section" class="section1" style="width:100%;background-image:url(assets/img/landing_page/logged_in.jpg);background-size:cover; background-position:top center;" >
		    <div id="signup-box" style="text-align:center;">
			    <div style="font-size:50px; color:#FFF; padding:0 0 30px 0;">ยินดีต้อนรับคุณ <?php echo $_SESSION['fullname']?></div>
			    <div class="partners">
		            <a href="index.php?page=paid_list" class="btn btn-primary btn-large list-your-property custom-btn-1">ชำระค่าเทอมทันที</a>
				</div>
			</div>
		</div>
		
 	<?php } ?>

 	<div class="landing-page-nav">
		<div class="row-fluid">
			<div class="span4 cell">
				<div class="cell-header clearfix">
					<img class="cell-img" src="assets/img/icon/icon-payment.png" />
					<div class="cell-text">
						<a href="javascript:void(0);" onclick="slideTo('payment-section');">Payportal</a>
					</div>
				</div>
				<div class="cell-footer">
					<div class="cell-message">
						ชำระเงินง่ายๆ และปลอดภัยด้วยระบบการชำระงเินของเรา
					</div>
				</div>
			</div>
			<div class="span4 cell">
				<div class="cell-header clearfix">
					<img class="cell-img" src="assets/img/icon/icon-book.png" />
					<div class="cell-text">
						<a href="javascript:void(0);" onclick="slideTo('e-lib-section');">E-Library</a>
					</div>
				</div>
				<div class="cell-footer">
					<div class="cell-message">
						มีหนังสือมากมายให้เลือกอ่านและสามารถอ่านได้ทุกที่ทุกเวลา
					</div>
				</div>
			</div>
			<div class="span4 cell">
				<div class="cell-header clearfix">
					<img class="cell-img" src="assets/img/icon/notification.multiple.png" />
					<div class="cell-text">
						<a href="javascript:void(0);" onclick="slideTo('booking-section');">Booking Portal</a>
					</div>
				</div>
				<div class="cell-footer">
					<div class="cell-message">
						คอร์สเรียนจากโรงเรียนชื่อดังที่มีให้เลือกมากมายและสามารถชำระเงินไดทันที
					</div>
				</div>
			</div>
		</div>
 	</div>

    </div><!-- /.map -->
</div><!-- /.map-wrapper -->

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

 <div id="e-lib-section" class="section1" style="width:100%;padding-bottom: 32%;background-image:url(assets/img/landing_page/library.jpg);background-size:cover;background-position:center;" >
    <div class="boxText0">
 		<h2 style="display:block;">ห้องสมุดอิเล็กทรอนิกส์</h2>
 		<div class="sub-text-box">
	 		<div class="text1">ห้องสมุดของคุณ</div>
	 		<div class="text2" style="color: #FFFFFF;">มีหนังสือมากมายให้เลือกอ่านและสามารถอ่านได้ทุกที่ทุกเวลา</div>
		</div>
		<a href="http://thaidemo.ebook.hyread.com.tw/" class="btn btn-primary list-your-property custom-btn-2">เพิ่มเติม</a>
 	</div>
 </div>

<div class="row" style="height:10px; background-color:#06a7ea;">
	<div style="text-align: center;">
		<!-- <a href="javascript:void(0);" onclick="slideTo('payment-section');" class="nav-btn large" style="background-image:url(assets/img/arrow-bottom-black@2x.png);"></a> -->
	</div>
</div>

<div id="booking-section" class="section4" style="width:100%;padding-bottom: 32%;background-image:url(assets/img/landing_page/booking.jpg);background-size:cover;background-position:center;" >
	<div class="boxText5" style="margin-left:47%;" >
 		<h2>เข้าถึงการเรียนรู้ที่คุณต้องการ</h2>
 		<div class="sub-text-box">
	 		<div class="text1">เลือกคอร์สเรียนสำหรับคุณ</div>
	 		<div class="text2">คอร์สเรียนจากโรงเรียนชื่อดังที่มีให้เลือกมากมายและสามารถชำระเงินไดทันที</div>
	 	</div>
	 	<a href="index.php?page=booking" class="btn btn-primary list-your-property custom-btn-2" style="float:left;">เพิ่มเติม</a>
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
			<div style="font-size:40px; color:#000; padding:0 0 30px 0;">ลงทะเบียน</div>
		    <a href="index.php?page=register" class="btn btn-primary btn-large list-your-property custom-btn-1">ลงทะเบียน</a>
		</div>
	</div>
</div>

 <div class="partners" style="background-color:#FFF;">

 	<div style="font-size:40px; text-align:center; padding:40px 0;">สถาบันที่เข้าร่วมโครงการ</div>

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

			<div class="section3" style="width:100%; height:298px; background-color:rgb(245,245,245);" >
			  	<div class="boxText3" style="color:#000;">
			 		<h2 style="font-size:36px !important;">วิธีการชำระเงิน</h2>
			 		<span style="font-size:22px;">
			 			1.กรอกรหัสขำระเงิน<br/>
			 			2.เลือกธนาคารที่ต้องการชำระเงิน<br/>
			 			3.กดยืนยันการชำระเงิน<br/>
			 			4.จากนั้นระบบจะทำการชำระเงิน<br/>
			 			5.เมื่อระบบมำการชำระเงินเสร็จสิ้นจะส่งใบเสร็จรับเงินไปยังอีเมลของคุณ
			 		</span>
			 		
			 	</div>
			 	<div class="boxText4" style="color:#000;">
			 		<h2 style="font-size:36px !important;"></h2>
			 		<span style="font-size:22px;"></span>
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
	var btmh = 90 + 180; // header bar + below first banner
	var v = h-btmh;
	var e = document.getElementById("signup-section");
	e.style.height = v+"px";
	var e2 = document.getElementById("signup-box");
	e2.style.paddingTop = ((v-e2.clientHeight)/2) + "px";

	function gradeChange(e){

		// var newSelect=document.createElement('select');
		var newSelect=document.getElementById('select-box-class-value');
		newSelect.innerHTML = "";
		// var index=0;
		var opt = document.createElement("option");

		opt.value= 0;
		opt.innerHTML = "ปีที่"; // whatever property it has
		newSelect.appendChild(opt);

		var grade = e.options[e.selectedIndex].value;

		switch(grade){

			case '0':

			break;
			
			case 'k':
				for (i = 1; i <= 3; i++) 
				{
				   var opt = document.createElement("option");
				   opt.value= i;
				   opt.innerHTML = i; // whatever property it has

				   // then append it to the select element
				   newSelect.appendChild(opt);
				   // index++;
				}
			break;

			default: // p,s
				for (i = 1; i <= 6; i++) 
				{
				   var opt = document.createElement("option");
				   opt.value= i;
				   opt.innerHTML = i; // whatever property it has

				   // then append it to the select element
				   newSelect.appendChild(opt);
				   // index++;
				}

		}

		// $("#select-box-class-value").html("").append(newSelect);
				
	}

	function slideTo(id){
		var t = $("#"+id).offset().top;
		$("body").animate({scrollTop:t},400);
	}

</script>