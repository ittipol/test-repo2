<?php
/* @var $this SchoolControllerController */
/* @var $data School */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('university_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->university_id), array('view', 'id'=>$data->university_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('school_name')); ?>:</b>
	<?php echo CHtml::encode($data->school_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('school_invoice_prefix')); ?>:</b>
	<?php echo CHtml::encode($data->school_invoice_prefix); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('school_invoice_format')); ?>:</b>
	<?php echo CHtml::encode($data->school_invoice_format); ?>
	<br />


</div>