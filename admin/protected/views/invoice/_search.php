<?php
/* @var $this InvoiceController */
/* @var $model Invoice */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'invoice_id'); ?>
		<?php echo $form->textField($model,'invoice_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'invoice_info_id'); ?>
		<?php echo $form->textField($model,'invoice_info_id',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'invoice_info_referance_code'); ?>
		<?php echo $form->textField($model,'invoice_info_referance_code',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'invoice_info_amount'); ?>
		<?php echo $form->textField($model,'invoice_info_amount',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'invoice_info_detail'); ?>
		<?php echo $form->textArea($model,'invoice_info_detail',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'invoice_info_status'); ?>
		<?php echo $form->textField($model,'invoice_info_status',array('size'=>60,'maxlength'=>66)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'member_id'); ?>
		<?php echo $form->textField($model,'member_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'invoice_info_payed_date'); ?>
		<?php echo $form->textField($model,'invoice_info_payed_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'invoice_student_name'); ?>
		<?php echo $form->textField($model,'invoice_student_name',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'invoice_student_major'); ?>
		<?php echo $form->textField($model,'invoice_student_major',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'invoice_student_faculty'); ?>
		<?php echo $form->textField($model,'invoice_student_faculty',array('size'=>60,'maxlength'=>150)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'university_id'); ?>
		<?php echo $form->textField($model,'university_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'university_id'); ?>
		<?php echo $form->textField($model,'university_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'course_id'); ?>
		<?php echo $form->textField($model,'course_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->