<?php
// header('Location: www.gconhub.com');
	// var_dump($_POST);
	// reveive data from 
	// parameter
	// HOSTRESP : 00 = accept, 01 not accept
	// RETURNINV : invoice number
	// AMOUNT : product or service amount 
	// CURISO : currency
	// 764 THB
	// 840 USD
	// 036 AUD
	// 978 EUR
	// 392 JPY
	// 826 GBP
	// 554 NZD
	// 344 HKD
	// 702 SGD
	// 756 CHF
	// FILLSPACE : card type
// $_POST['HOSTRESP']= "00";
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		redirect("/index.php?page=main");
	}else{

		if($_POST['HOSTRESP'] == "00"){ // accept

			require_once('inc/mail.php');
			sendEmail($database);

			$_SESSION['ID'] = '';

			$message = "การชำระเงินเสร็จสิ้น<br/><br/>ใบเสร็จรับเงินจะถูกส่งไปยังอีเมลที่คุณได้ระบุไว้";
			$message_btn = "ดำเนินการต่อ";
	 		$return_rul = "/index.php?page=paid";
		}elseif($_POST['HOSTRESP'] == "50"){ // return to previous page

			$_SESSION['ID'] = '';

			$message = "invoice นี้ถูกใช้งานแล้ว";
			$message_btn = "กลับ";
			$return_rul = "/index.php?page=main";
		}else{
			$message = "เกิดข้อผิดพลาด ไม่สามารถชำระเงินได้";
			$message_btn = "กลับ";
			$return_rul = "/index.php?page=billing";
		}

	}

	function sendEmail($database){

		$cmd ="SELECT * FROM invoice INNER JOIN university ON invoice.university_id = university.university_id WHERE invoice.invoice_id = '".$_SESSION['ID']."' LIMIT 1";
	    $result= $database->query($cmd);
	    $nums=mysql_num_rows($result);
	    $row = mysql_fetch_array($result);

		$cmdUpdate ="UPDATE invoice SET member_id = ".$_SESSION['member_id'].", invoice_info_payed_date = NOW(), invoice_info_status = 'ชำระเงินเรียบร้อยเเล้ว' WHERE invoice_id = ".$row['invoice_id'];
	    $resultUpdate = $database->query($cmdUpdate);

		if(!$row['mail_sended']){

			$to = array('ittipol@khroton.com','ittipol_master@hotmail.com');
			//$to = array('ittipol@khroton.com','khunphiphat@zhake.com');
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
					// $row['invoice_info_id'],
					$_POST['RETURNINV'],
					$row['invoice_info_detail'],
				);

			$message = str_replace($search, $replace, $message);

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

	}

?>

<div id="content">
	<div class="container">
		<div>
	        <div id="main">
				<div id="page-message" style="font-size:40px; text-align:center;">
					<div id="message-group">
						<?php echo $message; ?><br/><br/>
						<!-- <a style="font-size:22px;" href="index.php?page=booking">เพิ่มเติม</a> -->
						<a href="<?php echo $return_rul; ?>" class="btn btn-primary list-your-property custom-btn-2"><?php echo $message_btn; ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	
	window.onload = function(){

		var wH = window.innerHeight;
		var h = 90 + 130;
		var hh = wH - h;
	
		var elem = document.getElementById("page-message");
		var elem2 = document.getElementById("message-group");

		var messageTop = (hh - elem2.clientHeight)/2;
		
		elem.style.height = hh+"px";
		elem2.style.paddingTop = messageTop+"px"; 

		// elem.style.lineHeight = hh+"px";

	}

</script>