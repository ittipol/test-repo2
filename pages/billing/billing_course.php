<?php

	if($_SESSION['ID'] == '')
		redirect("index.php?page=main");

	$id = $_SESSION['ID'];

	$cmd = "SELECT * FROM course c
			LEFT JOIN subject s
			ON (c.subject_id = s.subject_id)
			WHERE c.course_id = ".$id;

	$result= $database->query($cmd);
    $nums = mysql_num_rows($result);
    $row = mysql_fetch_array($result);
    
    // get user info
    // $cmd = "SELECT * FROM member WHERE member_id = '".$_SESSION['member_id']."'";
    // $result= $database->query($cmd);
    // $nums = mysql_num_rows($result);
    // $user_info = mysql_fetch_array($result);
		
?>
<!-- CONTENT -->
<div id="content">
		<div class="container">
        	<div>
	        	<div id="main">
	            	<div class="partners">
				    	<h2 class="page-header">เตรียมการชำระเงิน</h2>

				    	<div class="content">
				    	
					    	<!-- <div class="row" >
			                	<div class="span5">
				                    <div class="control-group">
				                        <label class="control-label"  style="text-align: left; font-size:20px;" >
				                            <b>ชื่อ</b>  : 
				                        </label>			                       				                        
				                    </div>		                    
				                     		                
			                    </div>
			                </div> -->

			                <!-- <div class="row" style="margin-top:15px;">
			                	<div class="span11">
			                		<div style=" height:1px; background-color:#CCC;"></div>
			                	</div>
			                </div> -->

			                <div class="row" style="margin-top:15px;">
			                	<div class="span5">
			                	
				                    <div class="control-group">
				                        <label class="control-label"  style="text-align: left;">
				                            ชื่อหลักสูตร :
				                        </label>
				                        <label class="control-label"  style="color:#009cde;text-align: left;">
				                            <?php echo $row['course_name']?>
				                        </label>
				                    </div><!-- /.control-group -->
			                
			                    </div><!-- /.span4 -->
			
				                <div class="span5" style="margin-top: 25px;">
				                	<div class="control-group" >
			                        	 <label class="control-label"  style="font-size:24px; " >
			                             ชำระค่าเรียน 
			                            
			                             </label>
			                        	 <label class="control-label"  style="color:#009cde;">
			                           	 <?php echo number_format($row['course_price']); ?> บาท
			                            
			                            </label>
				                     </div><!-- /.control-group -->	
			                    </div><!-- /.span4 -->
			                </div><!-- /.row -->	

			            </div>
			           			            
			            <?php
                            if($_SESSION['isLogin'] == 'Yes')
                            {
                                ?>
                                
                                 <div class="partners">
				    	<h2 class="page-header"></h2>
				    	<div class="content">
				    	
				    	
				    	 
				    	
			            	<div class="row" style="margin-top:15px;">
			            	
			            	 <div class="span5">
				                	<div class="control-group" >
			                        	 <label class="control-label"  style="font-size:24px; margin-top:35px;" >
			                             ชำระผ่าน
			                            
			                             </label>
			                        	
				                     </div><!-- /.control-group -->	
			                    </div><!-- /.span4 -->


			                	<div class="span5">
			                	
				                    <div class="control-group" >
			                        	<img src="assets/img/payment.png"  />
			                        	
				                     </div><!-- /.control-group -->		                
			                    </div><!-- /.span4 -->
			
   			                </div><!-- /.row -->		                 
			            </div><!-- /.content -->


                                 <div class="row" style="margin-top:25px;">
				                	<div class="span12" align="center">
					                		<a class="btn btn-primary btn-large list-your-property " href="index.php?page=paid&nID=<?php echo $row['course_id']?>">ยืนยันการชำระเงิน</a>
				                	</div>
				             </div>
				        <?php
                            }
                            else
                            {
                                
                           
                        ?>
                        	 <div class="row" style="margin-top:25px;">
				                	<div class="span12" align="center">
					                		<a class="btn btn-primary btn-large list-your-property " style="background-color:#f46a6a;" href="index.php?page=login">คุณยังไม่ได้ login เข้าสู่ระบบ</a>
				                	</div>
				             </div>
                         <?php
                         	 }
                         ?>

			            </div>
			            				    </div><!-- /.partners-->    
				    
				    <div class="partners">
					    <h2 class="page-header">สถาบันที่เข้าร่วมโครงการ</h2>
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
				</div>
			</div>
		</div>
    </div><!-- /#content -->
</div><!-- /#wrapper-inner -->
<?php
	$_SESSION['currentPage'] = 'billing';
?>