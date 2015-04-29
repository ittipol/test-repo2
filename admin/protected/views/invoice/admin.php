<?php
/* @var $this InvoiceController */
/* @var $model Invoice */

$this->breadcrumbs=array(
	'Invoices'=>array('index'),
	'Manage',
);

if(Yii::app()->user->checkAccess("administrator")){
	$this->menu=array(
		// array('label'=>'List Invoice', 'url'=>array('index')),
		array('label'=>'Manage Invoice', 'url'=>array('admin')),
		array('label'=>'Create Invoice', 'url'=>array('create')),
	);
}else{
	$this->menu=array(
		array('label'=>'Manage Invoice', 'url'=>array('admin')),
	);
}

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#invoice-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Invoices</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'invoice-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'invoice_id',
		'invoice_info_id',
		'invoice_info_referance_code',
		'invoice_info_amount',
		array(            // display 'create_time' using an expression
            'name'=>'invoice_info_detail',
            'type'=>'raw',
            'value'=>'$data->invoice_info_detail',
        ),
		'invoice_info_status',
		/*
		'member_id',
		'invoice_info_payed_date',
		'invoice_student_name',
		'invoice_student_major',
		'invoice_student_faculty',
		'university_id',
		'university_id',
		'course_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
