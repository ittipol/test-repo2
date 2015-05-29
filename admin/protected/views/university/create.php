<?php
/* @var $this Educational institutionController */
/* @var $model Educational institution */

$this->breadcrumbs=array(
	'Educational institution'=>array('index'),
	'Create',
);

$this->menu=array(
	// array('label'=>'List Educational institution', 'url'=>array('index')),
	array('label'=>'Manage Educational institution', 'url'=>array('admin')),
);
?>

<h1>Create Educational institution</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>