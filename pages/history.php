<?php

	// if($_SESSION['ID'] == '')
	// 	redirect("index.php?page=main");
		


?>
<!-- CONTENT -->
<div id="content">
		<div class="container">
        	<div>
	        	<div id="main">
	            	<div class="partners">
				    	<h2 class="page-header">ประวัติการชำระเงิน</h2>
				    	<div class="content">
				    				    	
				    	<div class="row" >
			                	<div class="span11">
				                    <table class="table table-condensed">
								        <thead>
								        <tr>
								            <th>#</th>
								            <th>Invoice ID</th>
								            <th>วันที่ชำระเงิน</th>
								            <th>รายละเอียด</th>
								        </tr>
								        </thead>
								        <tbody>
								        <?php
								        	$cmd ="SELECT invoice_id, invoice_info_id, DATE(invoice_info_payed_date) AS invoice_info_payed_date FROM invoice WHERE member_id = ".$_SESSION['member_id'];
									        $result = $database->query($cmd);
									        $nums = mysql_num_rows($result);
									        for($i = 0 ; $i < $nums; $i++)
									        {
										        $row = mysql_fetch_array($result);
									        
									        
								        ?>
								        <tr>
								            <td><?php echo ($i+1)?></td>
								            <td><?php echo $row['invoice_info_id']?></td>
								            <td><?php echo $row['invoice_info_payed_date']?></td>
								            <td><a class="btn btn-primary" href="index.php?page=history_detail&ID=<?php echo $row['invoice_id']?>" > รายละเอียด</a></td>
								        </tr>
								        <?php
								        	}
								        ?>
   								        </tbody>
								    </table>
			                    
				                     		                
			                    </div><!-- /.span4 -->
			
			                </div><!-- /.row -->

	                 
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