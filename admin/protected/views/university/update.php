<?php
/* @var $this Educational institutionController */
/* @var $model Educational institution */

$this->breadcrumbs=array(
	'Educational institution'=>array('index'),
	$model->university_id=>array('view','id'=>$model->university_id),
	'Update',
);

$this->menu=array(
	// array('label'=>'List Educational institution', 'url'=>array('index')),
	array('label'=>'Create Educational institution', 'url'=>array('create')),
	array('label'=>'View Educational institution', 'url'=>array('view', 'id'=>$model->university_id)),
	array('label'=>'Manage Educational institution', 'url'=>array('admin')),
);
?>

<h1>Update Educational institution <?php echo $model->university_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>