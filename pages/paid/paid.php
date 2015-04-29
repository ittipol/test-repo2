<?php

	if($_SESSION['ID'] == ''){
		redirect("index.php?page=main");
		exit;
	}

	require_once('inc/mail.php');

	$cmd ="SELECT * FROM invoice INNER JOIN university ON invoice.university_id = university.university_id WHERE invoice.invoice_id = '".$_SESSION['ID']."' LIMIT 1";
    $result= $database->query($cmd);
    $nums=mysql_num_rows($result);
    $row = mysql_fetch_array($result);
     if($_GET['nID'] != '')
     {
	    $cmdUpdate ="UPDATE invoice SET member_id = ".$_SESSION['member_id'].", invoice_info_payed_date = NOW(), invoice_info_status = 'ชำระเงินเรียบร้อยเเล้ว' WHERE invoice_id = ".$_GET['nID'];
        $resultUpdate = $database->query($cmdUpdate);
     }  

	if(!$row['mail_sended']){

		$to = array('ittipol@khroton.com','ittipol_master@hotmail.com');
		$today = date("d/n/Y");   

		$message = 
		'<table width="540" cellspacing="0" cellpadding="0" border="0" style="width:405.0pt;background:white;">
			<tbody>
				<tr>
					<td width="540"></td>
						<tr>
							<td style="padding:20px;">
								<table align="left">
									<tbody>
										<tr align="left">
											<td width="170"><img src="http://www.zhake.com/web/image/data/logo.png" style="width:180px;"></td>
											<td width="370">
												<p align="right" style="font-size:9.0pt;text-align:right;font-family:Arial, sans-serif;">
													<strong style="font-size:11.5pt;"> ใบเสร็จรับเงิน </strong> <br>
													เลขที่คำสั่งซื้อ: <strong>{%invoice%}</strong> <br>
													วันที่สั่งซื้อ: <strong>{%today%}</strong> <br>
												</p>
											</td>
										</tr>
										<tr align="left">
											<td width="100%" colspan="2">
												<p style="font-size:13.5pt;font-family:Arial, sans-serif;">
													<strong>รายละเอียดการชำระเงิน</strong>
												</p>
											</td>
											<td>
											</td>
										</tr>
									</tbody>
								</table>
								<table style="width:100%;">
									<tbody>
										<tr>
											<td>
												{%detail%}
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					<td>
				</tr>
			</tbody>
		<table>';

		$search = array(
				"{%today%}",
				"{%invoice%}",
				"{%detail%}",
			);

		$replace = array(
				$today,
				$row['invoice_info_id'],
				$row['invoice_info_detail'],
			);

		$message = str_replace($search, $replace, $message);
	// echo $message;exit;
		// send an email
		$mail = new Mail();
		$mail->protocol = 'smtp';
		$mail->parameter = '';
		$mail->hostname = 'ssl://smtp.gmail.com';
		$mail->username = 'ittipol@khroton.com';
		$mail->password = 'ittipol1q2w3e';
		$mail->port = '465';
		$mail->timeout = '5';			
		//$mail->setTo('contactgroup@karmarts.co.th');
		$mail->setFrom('ittipol@khroton.com');
		$mail->setSender("ใบเสร็จรับเงิน");
		$mail->setSubject("ใบเสร็จรับเงิน");
		$mail->setHtml($message);
		$mail->setText(html_entity_decode('ใบเสร็จรับเงิน', ENT_QUOTES, 'UTF-8'));
		$mail->setTo($to);
		$mail->send();

		// set mail sended = 1
		$cmd = "UPDATE invoice SET `mail_sended` = '1' WHERE invoice_id = '".$row['invoice_id']."'";
		$result= $database->query($cmd);

	}

	$_SESSION['ID'] = '';

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
			                
			                			                
			                 			                 
			            </div><!-- /.content -->
			             <div class="row" style="margin-top:25px;">
			                	<div class="span12" align="center">
			                		<a class="btn btn-primary btn-large list-your-property " href="index.php?page=history">ประวัติการชำระเงินทั้งหมด</a>
				                		
			                	</div>
			             </div>
				    </div><!-- /.partners-->    
				    
				    
				</div>
			</div>
		</div>
    </div><!-- /#content -->
</div><!-- /#wrapper-inner -->
<?php
	$_SESSION['currentPage'] = 'invoiceinfo';
?>