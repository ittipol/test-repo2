<?php
/* @var $this UniversityController */
/* @var $model University */

$this->breadcrumbs=array(
	'Universities'=>array('index'),
	$model->university_id,
);

$this->menu=array(
	// array('label'=>'List University', 'url'=>array('index')),
	array('label'=>'Create University', 'url'=>array('create')),
	array('label'=>'Update University', 'url'=>array('update', 'id'=>$model->university_id)),
	array('label'=>'Delete University', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->university_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage University', 'url'=>array('admin')),
);
?>

<h1>View University #<?php echo $model->university_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'university_id',
		'university_name',
	),
)); ?>
