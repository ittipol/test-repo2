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
				    	<h2 class="page-header">เตรียมการชำระเงิน</h2>
				    	<div class="content">
				    	
				    	
				    	 <div class="row" >
			                	<div class="span5">
				                    <div class="control-group">
				                        <label class="control-label"  style="text-align: left; font-size:20px;" >
				                            <b>ชื่อ</b>  : <?php echo $row['invoice_student_name']?>
				                            
				                        </label>
				                        
				                       				                        
				                    </div><!-- /.control-group -->				                    
				                     		                
			                    </div><!-- /.span4 -->
			
			                </div><!-- /.row -->


				    	<div class="row" style="margin-top:15px;">
			                	<div class="span11">
			                		<div style=" height:1px; background-color:#CCC;"></div>
			                	</div>
			                </div>


			            	<div class="row" style="margin-top:15px;">
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
			            </div><!-- /.content -->
			            
			           			            
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
					                		<!-- <a class="btn btn-primary btn-large list-your-property " href="index.php?page=paid&nID=<?php echo $row['invoice_id']?>">ยืนยันการชำระเงิน</a> -->
					                		<a class="btn btn-primary btn-large list-your-property " href="gateway.php?nID=<?php echo $row['invoice_id']?>">ยืนยันการชำระเงิน</a>
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
				    
				    
				</div>
			</div>
		</div>
    </div><!-- /#content -->
</div><!-- /#wrapper-inner -->
<?php
	$_SESSION['currentPage'] = 'billing';
?>