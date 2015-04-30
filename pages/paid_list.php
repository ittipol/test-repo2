<?php

	// var_dump($_SESSION);

	if(isset($_POST['action']) && ($_POST['action'] == 'select')){
		$_SESSION['ID'] = $_POST['invoice_id'];
    	redirect("index.php?page=invoiceinfo");
	}

	// get all invoice don't pay
	$cmd ="SELECT * FROM invoice 
			INNER JOIN university 
			ON invoice.university_id = university.university_id 
			WHERE invoice.member_id = '".$_SESSION['member_id']."'
			AND invoice.invoice_info_status = 'รอชำระเงิน'";

    $result= $database->query($cmd);
    $nums=mysql_num_rows($result);
   
   	$hasData = true;

    if($nums > 1){

    }elseif ($nums == 1){

    	// get invoice data
    	$row = mysql_fetch_array($result);
    	$_SESSION['ID'] = $row['invoice_id'];

    	redirect("index.php?page=invoiceinfo");
    }else{
    	$hasData = false;
    }

?>

<!-- CONTENT -->
<div id="content">
		<div class="container">
        	<div>
	        	<div id="main">
	            	<div class="partners">

            			<div class="content" style="margin-top:40px;">
			            	
				    		<?php if($nums > 0){ ?>

					    		<form id="frm" action="index.php?page=paid_list" method="POST">

					    			<table class="table">

					    				<thead>
					    					<tr>
					    						<td>รหัส</td>
						    					<td>จำนวนเงิน</td>
						    					<td>สถานะ</td>
						    					<td width="60"></td>
					    					</tr>
					    				</thead>

						    			<?php while ($row = mysql_fetch_array($result)) { ?>

						    				<tr>
						    					<td><?php echo $row['invoice_info_id']; ?></td>
						    					<td><?php echo $row['invoice_info_amount']; ?></td>
						    					<td><?php echo $row['invoice_info_status']; ?></td>
						    					<td style="background-color:#009cde; color:#FFFFFF; text-align: center">
						    						<a style="color:#FFFFFF;" href="javascript:void(0);" onclick="setData(<?php echo $row['invoice_id']; ?>);">ชำระเงิน</a>
						    					</td>
						    				</tr>

						    			<?php } ?>

					    			</table>

					    			<input type="hidden" name="invoice_id" value="select" id="hidden-id" />
					    			<input type="hidden" name="action" value="select" />

					    		</form>

				    		<?php }else{ ?>

				    			<h2>ยังไม่มีรายการชำระเงินของคุณ</h2>
				    			<a style="font-size:22px;" href="index.php?page=course">กลับ</a>

				    		<?php } ?>

					    </div>
			        
				    </div><!-- /.partners-->    
				    
				    
				</div>
			</div>
		</div>
    </div><!-- /#content -->

    <script type="text/javascript">
    	function setData(id){
    		document.getElementById("hidden-id").value = id;
    		document.getElementById("frm").submit();
    	}
    </script>