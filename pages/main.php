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

	$service_url = "http://www.zhake.com/web/index.php?route=api/apipp/getBestSeller";

	$api = new ApiCaller();
	//$api->setServiceUrl($service_url);
	//$response = $api->post($post_data);
	//$response = json_decode($response,true);

	$response = array();

?>

 <!-- CONTENT -->
    <div id="main-content"><div class="map-wrapper">
    <div class="map">
        <div style="background-color:#999;" class="map-inner">

    <?php if($_SESSION['isLogin'] == ""){ ?>
    <div id="signup-section" class="section1" style="width:100%;background-image:url(assets/img/sign-up.jpg);background-size:cover;background-position:center;" >
	    <div id="signup-box" style="text-align:center;">
		    <div style="font-size:50px; color:#FFF; padding:0 0 30px 0;">สมัครสมาชิก</div>
		    <div class="partners">
	            <a href="index.php?page=register" class="btn btn-primary btn-large list-your-property custom-btn-1">สมัครสมาชิก</a>
			</div>
		</div>
	</div>
	
	<!-- <div class="landing-page-nav">
		<div class="landing-page-nav-inner">
			<a href="javascript:void(0);" onclick="slideTo('payment-section');" class="nav-btn large" style="background-image:url(assets/img/arrow-bottom-black@2x.png);"></a>
		</div>
 	</div> -->

 	<div class="landing-page-nav">
		<div class="row-fluid">
			<div class="span4 cell">
				<div class="cell-header clearfix">
					<img class="cell-img" src="assets/img/icon/icon-payment.png" />
					<div class="cell-text">Payportal</div>
				</div>
			</div>
			<div class="span4 cell">
				<div class="cell-header clearfix">
					<img class="cell-img" src="assets/img/icon/icon-course.png" />
					<div class="cell-text">Booking Portal</div>
				</div>
			</div>
			<div class="span4 cell">
				<div class="cell-header clearfix">
					<img class="cell-img" src="assets/img/icon/icon-book.png" />
					<div class="cell-text">E-Library</div>
				</div>
			</div>
		</div>
 	</div>

 	<?php }else{ // logged in ?>

 	<div class="landing-page-nav nav-left">
		<div class="landing-page-nav-inner">

			<a href="javascript:void(0);" onclick="slideTo('payment-section');" class="nav-label">ชำระเงิน</a>
			<!-- <a href="javascript:void(0);" onclick="slideTo('course-section');" class="nav-label">คอร์ส</a> -->
			<a href="javascript:void(0);" onclick="slideTo('e-library-section');" class="nav-label">E-library</a>

			<!-- <a href="javascript:void(0);" onclick="slideTo('payment-section');" title="PayPortal" class="nav-btn large icon wrapper" style="background-image:url(assets/img/icon-payment.png);">
				<div class="tooltip">ชำระเงิน</div>
			</a>
			<a href="javascript:void(0);" onclick="slideTo('course-section');" title="Course" class="nav-btn large icon wrapper" style="background-image:url(assets/img/icon-course.png);">
				<div class="tooltip">คอร์สเรียนพิเศษ</div>
			</a>
			<a href="javascript:void(0);" onclick="slideTo('e-library-section');" title="E-library" class="nav-btn large icon wrapper" style="background-image:url(assets/img/icon-book.png);">
				<div class="tooltip">E-Library</div>
			</a> -->
		</div>
 	</div>

 	<div id="signup-section" class="section1" style="width:100%;background-image:url(assets/img/logged-in.jpg);background-size:cover;background-position:center;" >
	    <div id="signup-box" style="text-align:center;">
		    <div style="font-size:50px; color:#FFF; padding:0 0 30px 0;">ยินดีต้อนรับคุณ <?php echo $_SESSION['fullname']?></div>
		</div>
	</div>

	<!-- <div class="landing-page-nav">
		<div class="landing-page-nav-inner">
			<a href="javascript:void(0);" onclick="slideTo('payment-section');" class="nav-btn large" style="background-image:url(assets/img/arrow-bottom-black@2x.png);"></a>
		</div>
 	</div> -->
		
 	<?php } ?>
 	
 	<div id="payment-section" class="section1" style="width:100%;padding-bottom: 32%;background-image:url(assets/img/header.png);background-size:cover;background-position:center;" >
	    <div class="boxText0">
	 		<h2 style="display:block;">ชำระเงินค่าเทอมทันที</h2>
	 		<div class="sub-text-box">
		 		<div class="text1">ชำระเงินได้อย่างรวดเร็ว</div>
		 		<div class="text2" style="color: #FFFFFF;">ชำระเงินได้ง่ายๆ และปลอดภัยกว่าในการชำระค่าใช้จ่ายของสถาบันการศึกษาชั้นนำหลายพันแห่ง<br/>
		โดยใช้เพียงที่อยู่อีเมลและรหัสผ่านเท่านั้น คุณไม่จำเป็นต้องป้อนข้อมูลบัตรเครดิตทุกครั้งที่ชำระเงิน</div>
			</div>
	 	</div>
	 </div>

	 <!-- <img style="width:100%; height:auto;background-size:cover;background-position:center;"  src="assets/img/header.png"/></div> -->

        <div class="container" >
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
                                        <!-- <select id="inputLocation3" name="university_id">
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
                                        </select> -->
                                    </div><!-- /.controls -->
                                </div><!-- /.control-group -->

                                <div class="type control-group">
                                    <label class="control-label" for="inputType"  style="margin-top:20px;">
                                        รหัสการชำระเงิน (Invoice ID)
                                    </label>
                                    <div class="controls">
                                    	<input type="text" placeHolder="Invoice ID" name="invoice_info_id" />
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
    </div><!-- /.map -->
</div><!-- /.map-wrapper -->

 	<div id="course-section" class="section4" style="width:100%;padding-bottom: 32%;background-image:url(assets/img/study_course.jpg);background-size:cover;background-position:center;" >
		<div class="boxText5" style="margin-left:47%;" >
	 		<h2>เข้าถึงการเรียนรู้ที่คุณต้องการ</h2>
	 		<div class="sub-text-box">
		 		<div class="text1">เลือกคอร์สเรียนสำหรับคุณ</div>
		 		<div class="text2">คอร์สเรียนจากโรงเรียนชื่อดังที่มีให้เลือกมากมายและสามารถชำระเงินไดทันที</div>
		 	</div>
	 	</div>
	 </div>


<div class="section-control-1" >

	<div style="text-align:center; font-size:2rem; color:#444; padding-top:60px;">
		เลือกระดับชั้น
	</div>

	<div class="partners">
		<div class="content">
			<form method="GET" action="index.php" onsubmit="return frmValidate();">
				<input type="hidden" name="page" value="course" />
				<div class="control-group">
	                 <div class="controls">

	                 	<div>
		                	<select style="width:400px; height:50px; line-height:50px; border: 1px solid #009cde;" name="type">
	                     		<option value="educational">คอร์สเรียนทั่วไป</option>
	                     		<option value="tutor">คอร์สเรียนพิเศษ</option>
	                     	</select>
						</div>

		                <div>
		                	<select style="width:400px; height:50px; line-height:50px; border: 1px solid #009cde;" name="grade" id="grade" onchange="gradeChange(this);">
	                     		<option value="0">ระดับชั้น</option>
	                     		<option value="k">อนุบาล</option>
	                     		<option value="p">ประถมศึกษา</option>
	                     		<option value="s">มัธยมศึกษา</option>
	                     	</select>
						</div>

						<div>
		                 	<select id="select-box-class-value" style="width:400px; height:50px; line-height:50px; border: 1px solid #009cde;" name="class" id="class">
		                 		<option value="0">ปีที่</option>
		                 	</select>
		                </div>

	                </div><!-- /.controls -->
	            </div>

	            <input type="submit" class="btn btn-primary btn-large list-your-property custom-btn-1" value="ค้นหา" />
        	</form>
		</div>
	</div>

</div>

 	<div id="e-library-section" class="section4" style="width:100%;background-color:#009cde;" >

 		<h1 style="padding:20px; color:#FFFFFF; margin:0; text-align:center; font-family:ThaiSansNeue_Exlight;">e-Library</h1>
 		<div class="row clearfix" style="padding:20px; width:62%; margin:0 auto;">
 		<?php foreach ($response as $value) { //echo"<pre>";var_dump($value['thumb']);echo"</pre>";exit;?>
 			<a href="<?php echo $value['href']; ?>">
				<div class="span3" style="width:162px; float:left;">
					<div>
						<img src="<?php echo $value['thumb']; ?>" style="width:162px; height:202px;" />
					</div>
					<div style="font-size:18px; padding:5px; color:#FFFFFF; text-align:center;">
						<?php echo $value['name']; ?>
					</div>
				</div>
			</a>
		<?php } ?>
 		</div>
 	</div>



 <div class="partners" style="background-color:#FFF;">

 	<div style="font-size:40px; text-align:center; padding:40px 0;">สถาบันเข้าร่วมโครงการ</div>

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

	var h = window.innerHeight;
	var btmh = 90 + 180;
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