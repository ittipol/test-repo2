<?php
/* @var $this SchoolControllerController */
/* @var $model School */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'school-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'school_name'); ?>
		<?php echo $form->textField($model,'school_name',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'school_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'school_invoice_prefix'); ?>
		<?php echo $form->textField($model,'school_invoice_prefix',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'school_invoice_prefix'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'school_invoice_format'); ?>
		<?php echo $form->textField($model,'school_invoice_format',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'school_invoice_format'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->