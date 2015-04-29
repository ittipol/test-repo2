<?php

	$nums = 0;
	$filter = false;

	if(isset($_GET['id'])){

		$filter = true;
		
		$id = $_GET['id'];

		$cmd = "SELECT * FROM course c
				LEFT JOIN subject s
				ON (c.subject_id = s.subject_id)
				WHERE c.course_id = ".$id;

		$result= $database->query($cmd);
        $nums = mysql_num_rows($result);
        $row = mysql_fetch_array($result);

        // var_dump($row);exit;

        $_SESSION['ID'] = $id;
        $_SESSION['COURSE'] = 1;

	}

?>

<!-- CONTENT -->
<div id="content">
		<div class="container">
        	<div>
	        	<div id="main">
	            	<div class="partners">
				    	<h2 class="page-header">หลักสูตร</h2>

				    	<div class="content" style="text-align:left;">
			            	
			            	<h2 style="border-bottom:1px solid #000000;"><?php echo $row['course_name']; ?></h2>

			            	<h3>รายละเอียดหลักสูตร</h3>
			            	<ul>
			            		<li><?php echo $row['course_detail']; ?></li>
			            	</ul>

			            	<form method="POST" action="index.php?page=billing">
			            		<input type="submit" class="btn btn-primary btn-large list-your-property" style="float:right;" value="ชำระเงิน" />             
			            	</form>

			            </div><!-- /.content -->
			            
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
