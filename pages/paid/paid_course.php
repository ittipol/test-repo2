<?php

	if($_SESSION['ID'] == '')
		redirect("index.php?page=main");

	// get user info
    $cmd = "SELECT * FROM member WHERE member_id = '".$_SESSION['member_id']."'";
    $result= $database->query($cmd);
    // $nums = mysql_num_rows($result);
    $user_info = mysql_fetch_array($result);

    // get course info
    $id = $_SESSION['ID'];

	$cmd = "SELECT * FROM course c
			LEFT JOIN subject sj
			ON (c.subject_id = sj.subject_id)
			LEFT JOIN school sc
			ON (c.school_id = sc.school_id)
			WHERE c.course_id = ".$id;

	$result= $database->query($cmd);
    // $nums = mysql_num_rows($result);
    $course_info = mysql_fetch_array($result);

	// get latest invoice
	$cmd = "SELECT * FROM invoice
			WHERE school_id = '".$course_info['school_id']."'
			ORDER BY invoice_id DESC
			LIMIT 0,1";
	$result= $database->query($cmd);
    $invoice_numrows = mysql_num_rows($result);
    $latest_invoice = mysql_fetch_array($result);

    if($invoice_numrows > 0){ // 

    	$invoice_info_id = $latest_invoice['invoice_info_id'];

    	// substr frist 3 character (PREFIX)
    	$prefix = substr($invoice_info_id, 0,3);
    	// (INVOICE NO.)
    	$invoice_number = substr($invoice_info_id, 3);

    	$invoice_info_id = $prefix.($invoice_number+1);

    	$invoice_code = $invoice_info_id;
		$reference_code = $invoice_info_id;


    }else{ // create new one

    	// get invoice format
    	// [Now, not use]
    	// invoice sample 1000001

    	// create invoice number
    	$prefix = $course_info['school_invoice_prefix']; 

    	$invoice_code = $prefix."1000001";
		$reference_code = $prefix."1000001";

    }

    // insert invoice
    $cmd = "INSERT INTO invoice (
		`invoice_id`, 
		`invoice_info_id`, 
		`invoice_info_referance_code`, 
		`invoice_info_amount`, 
		`invoice_info_detail`, 
		`invoice_info_status`, 
		`member_id`, 
		`invoice_info_payed_date`, 
		`invoice_student_name`, 
		`invoice_student_major`, 
		`invoice_student_faculty`, 
		`university_id`,
		`school_id`,
		`course_id`
		) VALUES (
		NULL, 
		'".$invoice_code."', 
		'".$reference_code."', 
		'".number_format($course_info['course_price'])."', 
		'', 
		'ชำระเงินเรียบร้อยเเล้ว', 
		'".$_SESSION['member_id']."', 
		NOW(), 
		'".$user_info['member_firstname']." ".$user_info['member_lastname']."', 
		'', 
		'', 
		'0',
		'".$course_info['school_id']."',
		'".$course_info['course_id']."'
		)";

	$database->query($cmd);

	// insert course to student
	$cmd = "INSERT INTO join_course_student 
			(
			id,
			course_id, 
			member_id, 
			date_added,
			due_date
			) VALUES (
			NULL,
			'".$_SESSION['ID']."', 
			'".$_SESSION['member_id']."', 
			NOW(),
			NOW()+INTERVAL 1 DAY
			)";

	$database->query($cmd);

	unset($_SESSION['ID']);
	unset($_SESSION['COURSE']);

?>
<!-- CONTENT -->
<div id="content">
		<div class="container">
        	<div>
	        	<div id="main">
	        	
	        		
	            	<div class="partners">
				    	<h2 class="page-header">ผลการชำระเงิน</h2>
				    	<div class="row" style="margin-top:15px;margin-bottom:15px;">
			                	<div class="span12" align="center">
			                		<input type="button" class="btn btn-primary btn-large list-your-property " value="ชำระเงินสำเร็จ" />
				                		
			                	</div>
			             </div>

				    	<div class="content">
			            	<div class="row">
			                	<div class="span5">
				                    <div class="control-group">
				                        <label class="control-label"  style="text-align: left;">
				                            Invoice ID :
				                            
				                        </label>
				                        <label class="control-label"  style="color:#009cde;text-align: left;">
				                            <?php echo $invoice_code?>
				                            
				                        </label>
				                    </div><!-- /.control-group -->
			
				                    <div class="control-group">
				                        <label class="control-label"  style="text-align: left;">
			                            Reference Code :
			                            
				                        </label>
				                        <label class="control-label"  style="color:#009cde;text-align: left;">
			                            <?php echo $invoice_code?>
			                            
				                        </label>

				                    </div><!-- /.control-group -->			                
			                    </div><!-- /.span4 -->
			
				                <div class="span5" style="margin-top: 25px;">
				                	<div class="control-group" >
			                        	 <label class="control-label"  style="font-size:24px; " >
			                             ชำระเงินสำเร็จ
			                            
			                             </label>
			                        	 <label class="control-label"  style="color:#009cde;">
			                           	 <?php echo number_format($course_info['course_price']); ?> บาท
			                            
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
				                            <b>ชื่อ</b>  : <?php echo $user_info['member_firstname']." ".$user_info['member_lastname']?>
				                            
				                        </label>
				                        
				                    </div><!-- /.control-group -->
			
				                    <div class="control-group">
				                        <label class="control-label"  style="text-align: left;" >
			                            <b>ชื่อหลักสูตร </b> : <?php echo $course_info['course_name']?>
			                            
				                        </label>
				                    </div><!-- /.control-group -->	
				                    
			                    </div><!-- /.span4 -->
			                </div><!-- /.row -->		                
			                 			                 
			            </div><!-- /.content -->
			             <div class="row" style="margin-top:25px;">
			                	<div class="span12" align="center">
			                		<a class="btn btn-primary btn-large list-your-property " href="index.php?page=history">ประวัติการชำระเงินทั้งหมด</a>
				                		
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