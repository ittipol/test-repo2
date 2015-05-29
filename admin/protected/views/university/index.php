<?php
/* @var $this Educational institutionController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Educational institution',
);

$this->menu=array(
	array('label'=>'Create Educational institution', 'url'=>array('create')),
	array('label'=>'Manage Educational institution', 'url'=>array('admin')),
);
?>

<h1>Educational institution</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
