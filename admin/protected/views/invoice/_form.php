<?php
/* @var $this InvoiceController */
/* @var $model Invoice */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'invoice-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'invoice_info_id'); ?>
		<?php echo $form->textField($model,'invoice_info_id',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'invoice_info_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'invoice_info_referance_code'); ?>
		<?php echo $form->textField($model,'invoice_info_referance_code',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'invoice_info_referance_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'invoice_info_amount'); ?>
		<?php echo $form->textField($model,'invoice_info_amount',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'invoice_info_amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'invoice_info_detail'); ?>
		<?php echo $form->textArea($model,'invoice_info_detail',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'invoice_info_detail'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'invoice_info_status'); ?>
		<?php echo $form->textField($model,'invoice_info_status',array('size'=>60,'maxlength'=>66)); ?>
		<?php echo $form->error($model,'invoice_info_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'member_id'); ?>
		<?php echo $form->textField($model,'member_id'); ?>
		<?php echo $form->error($model,'member_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'invoice_info_payed_date'); ?>
		<?php echo $form->textField($model,'invoice_info_payed_date'); ?>
		<?php echo $form->error($model,'invoice_info_payed_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'invoice_student_name'); ?>
		<?php echo $form->textField($model,'invoice_student_name',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'invoice_student_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'invoice_student_major'); ?>
		<?php echo $form->textField($model,'invoice_student_major',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'invoice_student_major'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'invoice_student_faculty'); ?>
		<?php echo $form->textField($model,'invoice_student_faculty',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'invoice_student_faculty'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'university_id'); ?>
		<?php echo $form->textField($model,'university_id'); ?>
		<?php echo $form->error($model,'university_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'university_id'); ?>
		<?php echo $form->textField($model,'university_id'); ?>
		<?php echo $form->error($model,'university_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'course_id'); ?>
		<?php echo $form->textField($model,'course_id'); ?>
		<?php echo $form->error($model,'course_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
	var editor1 = CKEDITOR.replace('Invoice[invoice_info_detail]',{
	    removePlugins : 'resize',
	    skin : 'office2013'
	});
</script>

</div><!-- form -->