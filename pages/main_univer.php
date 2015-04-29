<?php
	if($_POST['action'] == 'add')
	{
		$cmd ="INSERT INTO feedback (feedback_university, feedback_detail) VALUES ('".$_POST['feedback_university']."','".$_POST['feedback_detail']."')";
        $result= $database->query($cmd);					        
	echo('<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            ยื่นความจำนงเรียบร้อยเเล้ว
        </div>');	
	}
?>
 <!-- CONTENT -->
    <div id="content"><div class="map-wrapper">
    <div class="map">
       <div style="background-color:#999;" class="map-inner"><img style="width:100%; height:auto;background-size:cover;background-position:center;"  src="assets/img/header_univer.png"/></div><!-- /.map-inner -->


        <div class="container">
            <div class="row">
                <div class="span3">
                    <div class="property-filter pull-right">
                        <div class="content">
                            <form method="POST" action="index.php?page=main_univer">
	                            <div class="type control-group">
	                            	<label class="control-label" style="font-size:24px;" for="inputLocation">
                                        ยื่นความจำนง
                                    </label>
                                    
                                    <label class="control-label" style="margin-top:10px; margin-bottom:20px; border-bottom: 1px solid white;" for="inputLocation">
                                       
                                    </label>

	                            </div>
                                <div class="location control-group">
                                    <label class="control-label"  style="margin-top:20px;" for="inputLocation"  >
                                        สถานศึกษา
                                    </label>
                                    <div class="controls">
                                        <input type="text" placeHolder="" name="feedback_university" required/>                                    									</div><!-- /.controls -->
                                </div><!-- /.control-group -->

                                <div class="type control-group">
                                    <label class="control-label" for="inputType"  style="margin-top:20px;">
                                        รายละเอียด
                                    </label>
                                    <div class="controls">
                                    	<div class="controls">
                                        	<input type="text" placeHolder="" name="feedback_detail" required/>                                    										</div><!-- /.controls -->
                                    	
                                    	
                                        <!--<select id="inputType">
                                            <option id="apartment">Apartment</option>
                                            <option id="condo">Condo</option>
                                        </select>-->
                                    </div><!-- /.controls -->
                                </div><!-- /.control-group -->

                               
                                <div class="form-actions">
                                    <input type="submit" value="ยื่นความจำนง" style="margin-top:20px;" class="btn btn-primary btn-large">
                                </div><!-- /.form-actions -->
                                <input type="hidden" name="action" id="action" value="add" />
                            </form>
                        </div><!-- /.content -->
                    </div><!-- /.property-filter -->
                </div><!-- /.span3 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.map -->
</div><!-- /.map-wrapper -->

 <div class="section1" style="width:100%;padding-bottom: 32%;background-image:url(assets/img/section_univer1.png);background-size:cover;background-position:center;" >
 	<div class="boxText5" style="margin-left:47%;" >
 		<h2 style="color:#009cde !important;">จัดการข้อมูลของคุณได้รวดเร็วทันใจ</h2>
 		<div class="sub-text-box">
	 		<div class="text1">เข้าถึงข้อมูลของคุญได้อย่างรวดเร็ว</div>
	 	</div>
	</div>
 </div>

 <div class="section2" style="width:100%;padding-bottom: 32%;background-image:url(assets/img/section_univer2.png);background-size:cover;background-position:center;" >
 	<div class="boxText0">
 		<h2 style="color:#009cde !important;">ชำระเงินค่าเทอมทันที</h2>
 		<div class="sub-text-box">
	 		<div class="text1">ชำระเงินได้อย่างรวดเร็ว</div>
	 		<div class="text2" style="color: #FFFFFF;">ชำระเงินได้ง่ายๆ และปลอดภัยกว่าในการชำระค่าใช้จ่ายของสถาบันการศึกษาชั้นนำหลายพันแห่ง<br/>
	โดยใช้เพียงที่อยู่อีเมลและรหัสผ่านเท่านั้น คุณไม่จำเป็นต้องป้อนข้อมูลบัตรเครดิตทุกครั้งที่ชำระเงิน</div>
		</div>
 	</div>
 </div>

  <div class="section3" style="width:100%; height:298px; background-color:rgb(0,156,222);" >
  	<div class="boxText3"  >
 		<h2 style="color: #FFF; font-size:36px !important;">ไม่ว่าอยู่ที่ไหนของโลก ก็สามารถใช้งานได้</h2>
 		<span style="font-size:22px;">สามารถจัดการข้อมูลของคุณได้ทุกที่ ทุกเวลา ไม่คุณจะอยู่มุมไหนของโลก</span>
 		
 	</div>
 	<div class="boxText4"  >
 		<h2 style="color: #FFF; font-size:36px !important;">ปลอดภัย และ รวดเร็ว</h2>
 		<span style="font-size:22px;">โดยใช้รหัสชองคุณก็สามารถเข้าถึงขอ้มูลได้ ปลอดภัย และ รวดเร็ว</span>
 	</div>

 </div>
 
  <div class="section_univer4" style="width:100%;padding-bottom: 32%;background-image:url(assets/img/section4.png);background-size:cover;background-position:center;" >
 	<div class="boxText5" style="margin-left:47%;" >
 		<h2 style="color:#009cde !important;">ชำระค่าเทอมได้ทั่วทุกมุมโลก</h2>
 		<div class="sub-text-box">
	 		<div class="text1">ไม่ว่าจะอยู่ที่ไหนก็สามารถชำระเงินได้ทันที</div>
	 	</div>
	</div>
 </div>

<!--  <div style="height:10px; background-color:#FFF;">

 </div> -->
 
<!--  <div class="partners">
					    
					    <div class="content">
					        <div class="partner">
					            <a href="http://logopond.com/gallery/detail/192115">
					                <img src="assets/img/1.png" alt="Logo">
					            </a>
					        </div>
					
					        <div class="partner">
					            <a href="http://logopond.com/gallery/detail/191954">
					                <img src="assets/img/2.png" alt="Logo">
					            </a>
					        </div>
					
					        <div class="partner">
					            <a href="http://logopond.com/gallery/detail/192592">
					                <img src="assets/img/3.png" alt="Logo">
					            </a>
					        </div>
					
					        <div class="partner">
					            <a href="http://logopond.com/gallery/detail/192905">
					                <img src="assets/img/4.png" alt="Logo">
					            </a>
					        </div>
					
					        <div class="partner">
					            <a href="http://logopond.com/gallery/detail/192394">
					                <img src="assets/img/5.png" alt="Logo">
					            </a>
					        </div>
					        
					         <div class="partner">
					            <a href="http://logopond.com/gallery/detail/192115">
					                <img src="assets/img/6.png" alt="Logo">
					            </a>
					        </div>
					
					        <div class="partner">
					            <a href="http://logopond.com/gallery/detail/191954">
					                <img src="assets/img/7.png" alt="Logo">
					            </a>
					        </div>
					
					        <div class="partner">
					            <a href="http://logopond.com/gallery/detail/192592">
					                <img src="assets/img/8.png" alt="Logo">
					            </a>
					        </div>
					
					        <div class="partner">
					            <a href="http://logopond.com/gallery/detail/192905">
					                <img src="assets/img/9.png" alt="Logo">
					            </a>
					        </div>
					
					        <div class="partner">
					            <a href="http://logopond.com/gallery/detail/192394">
					                <img src="assets/img/10.png" alt="Logo">
					            </a>
					        </div>

					    </div>
					</div> -->

</div><!-- /#content -->
</div><!-- /#wrapper-inner -->
<?php
	$_SESSION['currentPage'] = 'main_univer';
?>