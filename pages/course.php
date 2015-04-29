<?php

	$nums = 0;
	$filter = false;

	if(isset($_GET['grade']) && isset($_GET['class'])){

		$filter = true;
		
		$grade = $_GET['grade'];
		$class = $_GET['class'];
		$type = $_GET['type'];

		$cmd = "SELECT * FROM join_grade_class_course jgcc
				LEFT JOIN course c
				ON (jgcc.course_id = c.course_id)
				WHERE jgcc.grade = '".$grade."'
				AND jgcc.class = '".$class."'
				AND c.course_type = '".$type."'";

		$result= $database->query($cmd);
        $nums = mysql_num_rows($result);

	}else{
		redirect("index.php?page=main");
	}

?>

<!-- CONTENT -->
<div id="content">
		<div class="container">
        	<div>
	        	<div id="main">
	            	<div class="partners">

	            		<?php if($filter){ ?>

	            			<div class="content" style="margin-top:40px;">
				            	
					    		<?php if($nums > 0){ ?>

					    			<table class="table">

					    				<thead>
					    					<tr>
					    						<td>ชื่อหลักสูตร</td>
						    					<td>รายะละเอียดหลักสูตร</td>
						    					<td>ราคาหลักสูตร</td>
						    					<td width="60"></td>
					    					</tr>
					    				</thead>

						    			<?php while ($row = mysql_fetch_array($result)) { ?>

						    				<tr>
						    					<td><?php echo $row['course_name']; ?></td>
						    					<td><?php echo $row['course_detail']; ?></td>
						    					<td><?php echo $row['course_price']; ?></td>
						    					<td style="background-color:#009cde; color:#FFFFFF; text-align: center">
						    						<a style="color:#FFFFFF;" href="index.php?page=course_detail&id=<?php echo $row['course_id']; ?>">เพิ่มเติม</a>
						    					</td>
						    				</tr>
	
						    			<?php } ?>

					    			</table>

					    		<?php }else{ ?>

					    			<h2>ไม่พบข้อมูลหลักสูตร</h2>
					    			<a href="index.php?page=course">กลับ</a>

					    		<?php } ?>

						    </div>
			            
			            <?php }else{ ?>

				            <h2 class="page-header">หลักสูตร</h2>
					    	<div class="content">
				            	<div class="row">
				            		<form method="GET" action="index.php" onsubmit="return frmValidate();">

				            			<input type="hidden" name="page" value="course" />

					                	<div class="span11">

					                		<h2 style="text-align: left; width: 400px; margin: 0 auto;">เลือกระดับชั้น</h2>

					                		<div class="control-group">
						                         <div class="controls">

						                         	<div>
									                	<select style="width:400px;" name="type">
								                     		<option value="educational">คอร์สเรียนทั่วไป</option>
								                     		<option value="tutor">คอร์สเรียนพิเศษ</option>
								                     	</select>
													</div>

						                        </div><!-- /.controls -->

						                    </div><!-- /.control-group -->

						                    <div class="control-group">
						                         <div class="controls">

						                         	<select style="width:400px;" name="grade" id="grade" onchange="gradeChange(this);">
						                         		<option value="0">ระดับชั้น</option>
						                         		<option value="k">อนุบาล</option>
						                         		<option value="p">ประถมศึกษา</option>
						                         		<option value="s">มัธยมศึกษา</option>
						                         	</select>

						                        </div><!-- /.controls -->

						                    </div><!-- /.control-group -->
					
						                    <div class="control-group">
						                        
						                        <div class="controls">

						                         	<select id="select-box-class-value" style="width:400px;" name="class" id="class">
						                         		<option value="0">ปีที่</option>
						                         		<!-- <option value="1">1</option>
						                         		<option value="2">2</option>
						                         		<option value="3">3</option> -->
						                         		<!-- <option value="4">4</option>
						                         		<option value="5">5</option>
						                         		<option value="6">6</option> -->
						                         	</select>

						                        </div><!-- /.controls -->


						                    </div><!-- /.control-group -->		

						                    <!-- <div class="control-group">
						                        
						                        <div class="controls">

						                         	<select style="width:400px; display:none;" name="class" id="class2">
						                         		<option value="0">ปีที่</option>
						                         		<option value="1">1</option>
						                         		<option value="2">2</option>
						                         		<option value="3">3</option>
						                         		<option value="4">4</option>
						                         		<option value="5">5</option>
						                         		<option value="6">6</option>
						                         	</select>

						                        </div>

						                    </div> -->

						                    <input type="submit" class="btn btn-primary btn-large list-your-property " value="เข้าสู่ระบบ" />             
					                    </div><!-- /.span4 -->

				            		</form>
				                </div><!-- /.row -->
				              			                 
				            </div><!-- /.content -->

			            <?php } ?>

				    </div><!-- /.partners-->    
				    
				    
				</div>
			</div>
		</div>
    </div><!-- /#content -->
</div><!-- /#wrapper-inner -->

<script type="text/javascript">
	
	function frmValidate(){

		var valid = true;

		if($("#grade").val() == 0){
			valid = false;
		}

		if($("#class").val() == 0){
			valid = false;
		}

		return valid;
	}

	function gradeChange(e){

		// var newSelect=document.createElement('select');
		var newSelect=document.getElementById('select-box-class-value');
		newSelect.innerHTML = "";
		// var index=0;
		var opt = document.createElement("option");

		opt.value= 0;
		opt.innerHTML = "ปีที่"; // whatever property it has
		newSelect.appendChild(opt);

		var grade = e.options[e.selectedIndex].value;

		switch(grade){
			case 'k':
				for (i = 1; i <= 3; i++) 
				{
				   var opt = document.createElement("option");
				   opt.value= i;
				   opt.innerHTML = i; // whatever property it has

				   // then append it to the select element
				   newSelect.appendChild(opt);
				   // index++;
				}
			break;

			default: // p,s
				for (i = 1; i <= 6; i++) 
				{
				   var opt = document.createElement("option");
				   opt.value= i;
				   opt.innerHTML = i; // whatever property it has

				   // then append it to the select element
				   newSelect.appendChild(opt);
				   // index++;
				}

		}

		// $("#select-box-class-value").html("").append(newSelect);
				
	}

</script>
