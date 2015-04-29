<?php
/* @var $this UniversityController */
/* @var $data University */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('university_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->university_id), array('view', 'id'=>$data->university_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('university_name')); ?>:</b>
	<?php echo CHtml::encode($data->university_name); ?>
	<br />


</div>