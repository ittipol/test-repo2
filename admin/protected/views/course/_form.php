<?php
/* @var $this CourseController */
/* @var $model Course */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'course-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'course_name'); ?>
		<?php echo $form->textField($model,'course_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'course_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'course_detail'); ?>
		<?php echo $form->textField($model,'course_detail',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'course_detail'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'course_price'); ?>
		<?php echo $form->textField($model,'course_price',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'course_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'course_type'); ?>
		<?php echo $form->dropDownList($model,'course_type',array('educational'=>'educational','tutor'=>'tutor')); ?>
		<?php echo $form->error($model,'course_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'grade'); ?>
		<?php echo $form->dropDownList($model,'grade',$grades,
			array(
				'id'=>'select-box-grade-value',
				'onchange'=>'gradeChange(this)'
				)
			); ?>
		<?php echo $form->error($model,'grade'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'class'); ?>
		<?php echo $form->dropDownList($model,'class',array(''=>'ปีที่'),array('id'=>'select-box-class-value')); ?>
		<?php echo $form->error($model,'class'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subject_id'); ?>
		<?php echo $form->dropDownList($model,'subject_id',$subjects); ?>
		<?php echo $form->error($model,'subject_id'); ?>
	</div>

	<?php if($university_id == 0){ ?>

	<div class="row">
		<?php echo $form->labelEx($model,'university_id'); ?>
		<?php echo $form->dropDownList($model,'university_id',$schools); ?>
		<?php echo $form->error($model,'university_id'); ?>
	</div>

	<?php } ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript">

	$(document).ready(function(){
		gradeChange2("select-box-grade-value")
	});

	function gradeChange(e){

		// var newSelect=document.createElement('select');
		var newSelect=document.getElementById('select-box-class-value');
		newSelect.innerHTML = "";
		// var index=0;
		var opt = document.createElement("option");

		opt.value= '';
		opt.innerHTML = "ปีที่"; // whatever property it has
		newSelect.appendChild(opt);

		var grade = e.options[e.selectedIndex].value;
	
		switch(grade){

			case '0':

			break;

			case '':

			break;
			
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

	function gradeChange2(id){

		var e = document.getElementById(id);

		// var newSelect=document.createElement('select');
		var newSelect=document.getElementById('select-box-class-value');
		newSelect.innerHTML = "";
		// var index=0;
		var opt = document.createElement("option");

		opt.value= '';
		opt.innerHTML = "ปีที่"; // whatever property it has
		newSelect.appendChild(opt);

		var grade = e.options[e.selectedIndex].value;

		switch(grade){

			case '0':

			break;

			case '':

			break;
			
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