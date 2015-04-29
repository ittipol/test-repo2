<?php
/* @var $this UniversityController */
/* @var $model University */

$this->breadcrumbs=array(
	'Universities'=>array('index'),
	$model->university_id=>array('view','id'=>$model->university_id),
	'Update',
);

$this->menu=array(
	// array('label'=>'List University', 'url'=>array('index')),
	array('label'=>'Create University', 'url'=>array('create')),
	array('label'=>'View University', 'url'=>array('view', 'id'=>$model->university_id)),
	array('label'=>'Manage University', 'url'=>array('admin')),
);
?>

<h1>Update University <?php echo $model->university_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>