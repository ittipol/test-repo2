<?php
/* @var $this SchoolControllerController */
/* @var $model School */

$this->breadcrumbs=array(
	'Schools'=>array('index'),
	$model->university_id=>array('view','id'=>$model->university_id),
	'Update',
);

$this->menu=array(
	// array('label'=>'List School', 'url'=>array('index')),
	array('label'=>'Create School', 'url'=>array('create')),
	array('label'=>'View School', 'url'=>array('view', 'id'=>$model->university_id)),
	array('label'=>'Manage School', 'url'=>array('admin')),
);
?>

<h1>Update School <?php echo $model->university_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>