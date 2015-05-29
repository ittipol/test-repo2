<?php
/* @var $this Educational institutionController */
/* @var $model Educational institution */

$this->breadcrumbs=array(
	'Educational institution'=>array('index'),
	$model->university_id,
);

$this->menu=array(
	// array('label'=>'List Educational institution', 'url'=>array('index')),
	array('label'=>'Create Educational institution', 'url'=>array('create')),
	array('label'=>'Update Educational institution', 'url'=>array('update', 'id'=>$model->university_id)),
	array('label'=>'Delete Educational institution', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->university_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Educational institution', 'url'=>array('admin')),
);
?>

<h1>View Educational institution #<?php echo $model->university_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'university_id',
		'university_name',
	),
)); ?>
