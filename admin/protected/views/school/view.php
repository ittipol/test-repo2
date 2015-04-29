<?php
/* @var $this SchoolControllerController */
/* @var $model School */

$this->breadcrumbs=array(
	'Schools'=>array('index'),
	$model->university_id,
);

$this->menu=array(
	// array('label'=>'List School', 'url'=>array('index')),
	array('label'=>'Create School', 'url'=>array('create')),
	array('label'=>'Update School', 'url'=>array('update', 'id'=>$model->university_id)),
	array('label'=>'Delete School', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->university_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage School', 'url'=>array('admin')),
);
?>

<h1>View School #<?php echo $model->university_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'university_id',
		'school_name',
		'school_invoice_prefix',
		'school_invoice_format',
	),
)); ?>
