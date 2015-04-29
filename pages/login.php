<?php
	if($_POST['action'] == 'login')
	{
	
		$cmd ="SELECT * FROM member WHERE member_email = '".$_POST['member_email']."' AND member_password = '".md5($_POST['member_password'])."' LIMIT 1";
        $result = $database->query($cmd);
        $nums = mysql_num_rows($result);
        if($nums > 0)
        {
	        $row = mysql_fetch_array($result);
	        $_SESSION['isLogin'] = 'Yes';
	        $_SESSION['member_id'] = $row['member_id'];
	        $_SESSION['fullname'] = $row['member_firstname'] .' '. $row['member_lastname'];
	        redirect("index.php?page=".$_SESSION['currentPage']);
        }
        else
        {
	        ?>
	        <div class="alert alert-error">
	            <button type="button" class="close" data-dismiss="alert">×</button>
	            อีเมล์หรือรหัสผ่านไม่ถูกต้อง.
	        </div>
	        <?php
        }
        
        
		
	}
	
	if($_GET['status'] == 'success')
	{
		?>
		
		 <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>ลงทะเบียนสำเร็จ</strong> คุณสามารถเข้าสู่ระบบด้านล่างได้เลยนะค่ะ.
        </div>
        
		<?php
	}
?>
<!-- CONTENT -->
<div id="content">
		<div class="container">
        	<div>
	        	<div id="main">
	            	<div class="partners">
				    	<h2 class="page-header">เข้าสู่ระบบ</h2>
				    	<div class="content">
			            	<div class="row">
			            		<form method="POST" action="index.php?page=login">
			                	<div class="span11">
				                    <div class="control-group">
				                         <div class="controls">
				                            <input type="text" id="inputPropertyFirstName" name="member_email" style="width:70%;" placeholder="อีเมล์" required="">
				                        </div><!-- /.controls -->

				                    </div><!-- /.control-group -->
			
				                    <div class="control-group">
				                        
				                       <div class="controls">
				                            <input type="password" id="inputPropertyFirstName" name="member_password"  style="width:70%;"  placeholder="รหัสผ่าน" required="">
				                        </div><!-- /.controls -->


				                    </div><!-- /.control-group -->			  
				                    <input type="submit" class="btn btn-primary btn-large list-your-property " value="เข้าสู่ระบบ" />             
			                    </div><!-- /.span4 -->
			                    	<input type="hidden" name="action" id="action" value="login" />
			                    	
			            		</form>
			                </div><!-- /.row -->
			                
			                			                
			                 
			            </div><!-- /.content -->
			            
				    </div><!-- /.partners-->    
				    
				    
				</div>
			</div>
		</div>
    </div><!-- /#content -->
</div><!-- /#wrapper-inner -->
