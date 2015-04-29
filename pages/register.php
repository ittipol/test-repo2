<?php
	if($_POST['action'] == 'register')
	{
	
		if($_POST['member_password'] == $_POST['member_password_confirm'])
		{
			$cmd ="INSERT INTO member (member_firstname, member_lastname, member_tel, member_birthdate, member_address, member_email, member_password) VALUES ('".$_POST['member_firstname']."','".$_POST['member_lastname']."','".$_POST['member_tel']."','".$_POST['member_birthdate']."','".$_POST['member_address']."','".$_POST['member_email']."','".md5($_POST['member_password'])."')";
	        $result = $database->query($cmd);
	       
	        if($result)
	        {
		        
		        redirect("index.php?page=login&status=success");
	        }

		}
        else
        {
	        ?>
	        <div class="alert alert-error">
	            <button type="button" class="close" data-dismiss="alert">×</button>
	            รหัสผ่านไม่ตรงกัน.
	        </div>
	        <?php
        }
        
        
		
	}
?>
<!-- CONTENT -->
<div id="content">
		<div class="container">
        	<div>
	        	<div id="main">
	            	<div class="partners">
				    	<h2 class="page-header">สมัครสมาชิก</h2>
				    	<div class="content">
			            	<div class="row">
			            		<form method="POST" action="index.php?page=register">
			                	<div class="span11">
			                		 <div class="control-group">
			                		 	<label class="control-label" style="font-size:20px; text-align: left; margin-left:14%;margin-bottom:20px;" for="inputLocation">
                                        ข้อมูลส่วนตัว
                                    </label>
				                         <div class="controls">
				                            <input type="text" id="inputPropertyFirstName" name="member_firstname" style="width:70%;" placeholder="ชื่อ" required="">
				                        </div><!-- /.controls -->
				                    </div><!-- /.control-group -->
				                    
				                     <div class="control-group">
				                         <div class="controls">
				                            <input type="text" id="inputPropertyFirstName" name="member_lastname" style="width:70%;" placeholder="นามสกุล" required="">
				                        </div><!-- /.controls -->
				                    </div><!-- /.control-group -->
				                    
				                     <div class="control-group">
				                         <div class="controls">
				                            <input type="text" id="inputPropertyFirstName" name="member_tel" style="width:70%;" placeholder="เบอร์โทรศัพท์" required="">
				                        </div><!-- /.controls -->
				                    </div><!-- /.control-group -->
				                    
				                     <div class="control-group">
				                         <div class="controls">
				                            <input type="text" id="inputPropertyFirstName" name="member_birthdate" style="width:70%;" placeholder="วันเกิด" required="">
				                        </div><!-- /.controls -->
				                    </div><!-- /.control-group -->
				                    
				                     <div class="control-group">
				                         <div class="controls">
				                            <input type="text" id="inputPropertyFirstName" name="member_address" style="width:70%;  height: 60px;padding: auto 10px; line-height: 28px;" placeholder="ที่อยู่ของคุณ" required=""  >
				                        </div><!-- /.controls -->
				                    </div><!-- /.control-group -->
				                    
				                     <div class="control-group">
				                     <label class="control-label" style="font-size:20px; text-align: left; margin-left:14%;margin-bottom:20px;margin-top:20px;" for="inputLocation">
                                        ข้อมูลสำหรับสร้างบัญชี
                                    </label>
                                    
				                         <div class="controls">
				                            <input type="text" id="inputPropertyFirstName" name="member_email" style="width:70%;" placeholder="อีเมล์" required="">
				                        </div><!-- /.controls -->
				                    </div><!-- /.control-group -->
				                    
				                     <div class="control-group">
				                         <div class="controls">
				                            <input type="password" id="inputPropertyFirstName" name="member_password" style="width:70%;" placeholder="รหัสผ่าน" required="">
				                        </div><!-- /.controls -->
				                    </div><!-- /.control-group -->
				                    
				                     <div class="control-group">
				                         <div class="controls">
				                            <input type="password" id="inputPropertyFirstName" name="member_password_confirm" style="width:70%;" placeholder="ยืนยันรหัสผ่าน" required="">
				                        </div><!-- /.controls -->
				                    </div><!-- /.control-group -->
				                    
				                    <input type="submit" class="btn btn-primary btn-large list-your-property " value="ลงทะเบียน" />             
			                    </div><!-- /.span4 -->
			                    	<input type="hidden" name="action" id="action" value="register" />
			                    	
			            		</form>
			                </div><!-- /.row -->
			                
			                			                
			                 
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
