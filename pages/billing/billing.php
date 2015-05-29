<?php

	if($_SESSION['ID'] == '')
		redirect("index.php?page=main");
		
	$cmd ="SELECT * FROM invoice INNER JOIN university ON invoice.university_id = university.university_id WHERE invoice.invoice_id = '".$_SESSION['ID']."' LIMIT 1";
    $result= $database->query($cmd);
    $nums=mysql_num_rows($result);
    $row = mysql_fetch_array($result);

    // ============================================

    $invoice_length = 10;
	$cmd ="SELECT * FROM ref_code
			WHERE id = 1";
    $result= $database->query($cmd);

    $cmd = "UPDATE ref_code
    		SET code = code - 1
    		WHERE id = 1";
    $database->query($cmd);

    $row2 = mysql_fetch_array($result);

    // invoice code for test
    $code = strval($row2['code']);

    // ============================================

    $allow_payment = 1;

    // ahoose a payment gateway
    // see in bank table on payportal_db
    $paymeny_gateway = 2;   

    // delete temp invoice with invoice_temp_id
    // $cmd = "DELETE FROM invoice_temp_payment WHERE invoice_temp_id = '".$code."'";
    // $database->query($cmd);

    $cmd = "SELECT * FROM invoice_temp_payment WHERE referance_code = '".$code."'";
    $result = $database->query($cmd);

    $nums=mysql_num_rows($result);
    $row = mysql_fetch_array($result);
  
    if($nums == 0){ // create new one

    	// create temp invoice
	    $cmd = "INSERT INTO invoice_temp_payment 
	    		(invoice_temp_id, referance_code, date_added, bank_id, payment_processing) 
	    		VALUES 
	    		(NULL, '".$code."', NOW(), '".$paymeny_gateway."', 0)";
	    $database->query($cmd);

    }else{

    	if($row['payment_processing'] == 1){ // this transaction is processing at this moment
    		$allow_payment = 0;
    	}

    }

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
			                            <?php //echo $row['invoice_info_referance_code']
			                            	echo $row2['code'];
			                            ?>
			                            
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
			                        	<img src="assets/img/bank/thanachat_logo.jpg"  />
			                        	
				                     </div><!-- /.control-group -->		                
			                    </div><!-- /.span4 -->
			
   			                </div><!-- /.row -->		                 
			            </div><!-- /.content -->

			            	<?php if($allow_payment){ ?>
                            <div class="row" style="margin-top:25px;">
				                <div class="span12" align="center">
					                <!-- <a class="btn btn-primary btn-large list-your-property " href="index.php?page=paid&nID=<?php echo $row['invoice_id']?>">ยืนยันการชำระเงิน</a> -->
					                <!-- <a class="btn btn-primary btn-large list-your-property " href="gateway.php?nID=<?php echo $row['invoice_id']?>">ยืนยันการชำระเงิน</a> -->
					                <a class="btn btn-primary btn-large list-your-property " href="javascript:void(0);" onclick="sendData('<?php echo $code; ?>');">ยืนยันการชำระเงิน</a>
				                </div>
				            </div>
				            <?php }else{ ?>
				            <div class="row" style="margin-top:25px;">
				                <div class="span12" align="center">
				                	<h2 style="color:red; font-weight:bold;">This transaction is processing at this moment. Please wait.</h2>
				                </div>
				            </div>
				            <?php } ?>
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

	// amount format [0-9]{10} is interger and [0-9]{2} is point
	$amount = $row['invoice_info_amount'];

	$search = array(
			".",
			",",
		);

	$replace = array(
			"",
			"",
		);
	$amount = str_replace($search, $replace, $amount);

	// check has point in amount
	if(!strpos($row['invoice_info_amount'],".")){
		$amount .= "00";
	}

	switch ($paymeny_gateway) {
		case 1: // k-bank
			
			$gateway = "https://uatkpgw.kasikornbank.com/pgpayment/payment.aspx"; // url gateway

		    $data = array(
		                "MERCHANT2" => "451001605682521",
		                "TERM2" => "70352168",
		                "AMOUNT2" => $amount, // price of product, accept only 12 character
		                "URL2" => "http://pp/index.php?page=paid_successful", // go back to page
		                "RESPURL" => "https://pp/", // this url is require SSL certification at least 128 bit
		                "IPCUST2" => "128.199.64.178", // server ip address of merchant website
		                "DETAIL2" => "Payment Test", // detail of product or service
		                // "INVMERCHANT" => "150429174536", // invoice number, only digit
		                "INVMERCHANT" => $code, // invoice number, only digit
		                "FILLSPACE" => "", // want to know card type, input only Y or N
		                "SHOPID" => "",
		                "PAYTERM2" => "", // month
		                "md5_secret" => "SzabTAGU5fQYgHkVGU5f4re8pLw5423Q",
		            );

		    $str = "";
		    foreach ($data as $key => $value) {
		        $str .= $value;
		    }

		    $checksum = md5($str);

		    ?>

			    <form name="sendform" id="sendform" method="post" action="<?php echo $gateway; ?>"> 
				    <input type="hidden" id="MERCHANT2" name="MERCHANT2" value="<?php echo $data['MERCHANT2']; ?>">
				    <input type="hidden" id="TERM2" name="TERM2" value="<?php echo $data['TERM2']; ?>">
				    <input type="hidden" id="AMOUNT2" name="AMOUNT2" value="<?php echo $data['AMOUNT2']; ?>">
				    <input type="hidden" id="URL2" name="URL2" value="<?php echo $data['URL2']; ?>">
				    <input type="hidden" id="RESPURL" name="RESPURL" value="<?php echo $data['RESPURL']; ?>">
				    <input type="hidden" id="IPCUST2" name="IPCUST2" value="<?php echo $data['IPCUST2']; ?>"> 
				    <input type="hidden" id="DETAIL2" name="DETAIL2" value="<?php echo $data['DETAIL2']; ?>">
				    <input type="hidden" id="INVMERCHANT" name="INVMERCHANT" value="<?php echo $data['INVMERCHANT']; ?>">
				    <input type="hidden" id="FILLSPACE" name="FILLSPACE" value="">  <!--Option-->
				    <input type="hidden" name="SHOPID" id="SHOPID" value="">  <!--Option-->
				    <input type="hidden" id="PAYTERM2" name="PAYTERM2" value="">  <!--Option-->
				    <input type="hidden" id="CHECKSUM" name="checksum" value="<?php echo $checksum; ?>">
				</form>

		    <?php

			break;
		
		case 2: // t-bank
			
			$gateway = "https://ipay.thanachartbank.co.th/3dsecure/dccpayment/payment.aspx"; // url gateway

			$data = array(
		                "MERID" => "21211800825",
		                "TERMINALID" => "18000149",
		                "PAYMENTFOR" => "https://ipay.thanachartbank.co.th/3dsecure/pgmerchant/default.aspx  ",
		                "INVOICENO" => substr($code,2,10),
		                "AMOUNT" => $amount,
		                "POSTURL" => "http://pp/index.php?page=paid_successful",
		                "POSTURL2" => "https://pp/",
		                "AUTOREDIRECT" => "",

		            );

			?>

				<form name="sendform" id="sendform" method="post" action="<?php echo $gateway; ?>"> 
					<input Type="hidden" Name="MERID" value="<?php echo $data['MERID']; ?>">
					<input Type="hidden" Name="TERMINALID" value="<?php echo $data['TERMINALID']; ?>">
					<input Type="hidden" Name="INVOICENO" value="<?php echo $data['INVOICENO']; ?>"> 
					<input Type="hidden" Name="AMOUNT" value="<?php echo $data['AMOUNT']; ?>"> 
					<input Type="hidden" Name="POSTURL" value="<?php echo $data['POSTURL']; ?>">
					<input Type="hidden" Name="POSTURL2" value="<?php echo $data['POSTURL2']; ?>">
					<input Type="hidden" Name="AUTOREDIRECT" value="N">
					<input type="hidden" name="PAYMENTFOR" value="MIC12372384">
				</form>

			<?php

			break;
	}


	$_SESSION['currentPage'] = 'billing';
?>

<script type="text/javascript">
	function sendData(code){

		$.ajax({
	        url: "async/transaction_processing.php",
	        type: "post",
	        data: {code:code},
	        dataType: "json",
	        success: function(){
	            // alert("success");
	            // $("#result").html('Submitted successfully');
	            document.getElementById("sendform").submit();
	        },
	        error:function(){
	            alert("failure");
	            // $("#result").html('There is error while submit');
	        }
	    });

		
	}
</script>