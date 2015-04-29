<?php
/* @var $this InvoiceController */
/* @var $data Invoice */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->invoice_id), array('view', 'id'=>$data->invoice_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_info_id')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_info_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_info_referance_code')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_info_referance_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_info_amount')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_info_amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_info_detail')); ?>:</b>
	<?php echo $data->invoice_info_detail; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_info_status')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_info_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_id')); ?>:</b>
	<?php echo CHtml::encode($data->member_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_info_payed_date')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_info_payed_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_student_name')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_student_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_student_major')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_student_major); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_student_faculty')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_student_faculty); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('university_id')); ?>:</b>
	<?php echo CHtml::encode($data->university_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('university_id')); ?>:</b>
	<?php echo CHtml::encode($data->university_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('course_id')); ?>:</b>
	<?php echo CHtml::encode($data->course_id); ?>
	<br />

	*/ ?>

</div>