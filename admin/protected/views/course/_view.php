<?php
/* @var $this CourseController */
/* @var $data Course */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('course_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->course_id), array('view', 'id'=>$data->course_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('course_name')); ?>:</b>
	<?php echo CHtml::encode($data->course_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('course_detail')); ?>:</b>
	<?php echo CHtml::encode($data->course_detail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('course_price')); ?>:</b>
	<?php echo CHtml::encode($data->course_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('course_type')); ?>:</b>
	<?php echo CHtml::encode($data->course_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subject_id')); ?>:</b>
	<?php echo CHtml::encode($data->subject_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('university_id')); ?>:</b>
	<?php echo CHtml::encode($data->university_id); ?>
	<br />


</div>