<?php

	$cmd ="SELECT * FROM invoice INNER JOIN university ON invoice.university_id = university.university_id WHERE invoice.invoice_id = '".$_GET['ID']."' LIMIT 1";
    $result= $database->query($cmd);
    $nums=mysql_num_rows($result);
    $row = mysql_fetch_array($result);

?>

!-- CONTENT -->
<div id="content">
		<div class="container">
        	<div>
	        	<div id="main">
	        	
	        		
	            	<div class="partners">
				    	<h2 class="page-header">ได้ถูกชำระเงินไปแล้ว</h2>
				    	

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
			                             ชำระเงินสำเร็จ
			                            
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
				                        <label class="control-label"  style="text-align: left;" >
			                            <b>สาขาวิชา</b> : <?php echo $row['invoice_student_major']?>
			                            
				                        </label>
				                    </div><!-- /.control-group -->	
				                    
				                     <div class="control-group">
				                        <label class="control-label" style="text-align: left;">
			                            <b>สถานศึกษา</b> : <?php echo $row['university_name']?>
			                            
				                        </label>
				                    </div><!-- /.control-group -->				                
			                    </div><!-- /.span4 -->
			
				                <div class="span5" style="margin-top: 25px;">
				                	<div class="control-group" >
			                        	 <label class="control-label"   >
			                             <b>คณะ</b> : <?php echo $row['invoice_student_faculty']?>
			                            
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
			                
			                			                
			                 			                 
			            </div><!-- /.content -->
			             				    </div><!-- /.partners-->    
				    
				    				</div>
			</div>
		</div>
    </div><!-- /#content -->
</div><!-- /#wrapper-inner -->
<?php
	$_SESSION['currentPage'] = 'main';
?>