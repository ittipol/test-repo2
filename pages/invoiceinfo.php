<?php

	if($_SESSION['ID'] == '')
		redirect("index.php?page=main");
		
	$cmd ="SELECT * FROM invoice INNER JOIN university ON invoice.university_id = university.university_id WHERE invoice.invoice_id = '".$_SESSION['ID']."' LIMIT 1";
        $result= $database->query($cmd);
        $nums=mysql_num_rows($result);
        $row = mysql_fetch_array($result);

?>
<!-- CONTENT -->
<div id="content">
		<div class="container">
        	<div>
	        	<div id="main">
	            	<div class="partners">
				    	<h2 class="page-header">รายละเอียดการชำระเงิน</h2>
				    	<div class="content">
			            	<div class="row">
			                	<div class="span5">
				                    <div class="control-group">
				                        <label class="control-label"  style="text-align: left;">
				                            Invoice ID :
				                            
				                        </label>
				                        <label class="control-label"  style="color:#009cde;text-align: left;">
				                            <?php echo $row['invoice_info_id']?>
				                            
				                        </label>
				                    </div><!-- /.control-group -->
			
				                    <div class="control-group">
				                        <label class="control-label"  style="text-align: left;">
			                            Reference Code :
			                            
				                        </label>
				                        <label class="control-label"  style="color:#009cde;text-align: left;">
			                            <?php echo $row['invoice_info_referance_code']?>
			                            
				                        </label>

				                    </div><!-- /.control-group -->			                
			                    </div><!-- /.span4 -->
			
				                <div class="span5" style="margin-top: 25px;">
				                	<div class="control-group" >
			                        	 <label class="control-label"  style="font-size:24px; " >
			                             ชำระค่าเรียน 
			                            
			                             </label>
			                        	 <label class="control-label"  style="color:#009cde;">
			                           	 <?php echo $row['invoice_info_amount']?> บาท
			                            
			                            </label>
				                     </div><!-- /.control-group -->	
			                    </div><!-- /.span4 -->
			                </div><!-- /.row -->
			                
			                <div class="row">
			                	<div class="span11">
			                		<div style=" height:1px; background-color:#CCC;"></div>
			                	</div>
			                </div>
			                
			                
			                <div class="row" style="margin-top:15px;">
			                	<div class="span5">
				                    <div class="control-group">
				                        <label class="control-label"  style="text-align: left;" >
				                            <b>ชื่อ</b>  : <?php echo $row['invoice_student_name']?>
				                            
				                        </label>
				                        
				                    </div><!-- /.control-group -->
				                    
				                     <div class="control-group">
				                        <label class="control-label" style="text-align: left;">
			                            <b>สถานศึกษา</b> : <?php echo $row['university_name']?>
			                            
				                        </label>
				                    </div><!-- /.control-group -->				                
			                    </div><!-- /.span4 -->
			                </div><!-- /.row -->
			                
			                 <div class="row" >
			                	<div class="span11">
			                		<div style=" height:1px; background-color:#CCC;"></div>
			                	</div>
			                </div>
			                
			                <div class="row" style="margin-top: 25px;">
			                	<div class="span11">
			                		<?php echo $row['invoice_info_detail']?>
			                	</div>
			                </div>
			                
			                			                
			                 <div class="row">
			                	<div class="span11" style="font-size:22px;">
			                		สถานะการชำระเงิน  <span  class="btn btn-primary btn-large list-your-property " style="background-color:#EEE; color:#AAA; font-size:25px;"><?php echo $row['invoice_info_status']?></span>
			                	</div>
			                </div>
			                
			                 
			            </div><!-- /.content -->
			             <div class="row" style="margin-top:25px;">
			                	<div class="span12" align="center">
			                		<a class="btn btn-primary btn-large list-your-property " href="index.php?page=billing">ชำระเงิน</a>
				                		
			                	</div>
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
	$_SESSION['currentPage'] = 'invoiceinfo';
?>