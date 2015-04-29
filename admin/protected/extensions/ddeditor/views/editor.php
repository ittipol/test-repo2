<div class="ddeditor">
<div style="margin-bottom:7px">
<?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
	'buttonType'=>'button',
    'buttons'=>array(
        array('label'=>Yii::t('ddeditor','B'), 'htmlOptions'=>array('id'=>$editorId.'-editor-bold')),
        array('label'=>Yii::t('ddeditor','I'), 'htmlOptions'=>array('id'=>$editorId.'-editor-italic')),
    ),
)); ?>

<?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
	'buttonType'=>'button',
    'buttons'=>array(
        array('label'=>Yii::t('ddeditor','H').'1','url'=>'javascript:void(0);', 'htmlOptions'=>array('id'=>$editorId.'-editor-h1')),
        array('label'=>Yii::t('ddeditor','H').'2','url'=>'javascript:void(0);', 'htmlOptions'=>array('id'=>$editorId.'-editor-h2')),
        array('label'=>Yii::t('ddeditor','H').'3','url'=>'javascript:void(0);', 'htmlOptions'=>array('id'=>$editorId.'-editor-h3')),
    ),
)); ?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
	'buttonType'=>'button',
	'htmlOptions'=> array(
		'id'=>$editorId.'-editor-link',
	),
	'label'=>'URL',
	'icon'=>'globe',
)); ?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
	'buttonType'=>'button',
	'htmlOptions'=> array(
		'id'=>$editorId.'-editor-img',
	),
	'icon'=>'picture',
	'label'=>'Picture',
)); ?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
	'buttonType'=>'button',
	'htmlOptions'=> array(
		'id'=>$editorId.'-editor-li',
	),
	'icon'=>'list',
	'label'=>'List',
)); ?>

<?php $this->widget('bootstrap.widgets.TbButton', array(
	'buttonType'=>'button',
	'htmlOptions'=> array(
		'id'=>$editorId.'-editor-preview',
	),
	'icon'=>'eye-open',
	'label'=>'Preview',
)); ?>
</div>
<?php if(sizeof($additionalSnippets)>0) : ?>
<?php $n=0; foreach($additionalSnippets as $name=>$additionalSnippet) : $additionalSnippet = array_merge(array($name),$additionalSnippet); ?>
<?php echo CHtml::dropDownList($editorId.'-editor-addS-'.$n,'',$additionalSnippet); ?>
<?php $n++; endforeach; ?>
<br/>
<?php endif; ?>
<?php echo CHtml::activeTextArea($model,$attribute,$htmlOptions); ?>
<div id="<?php echo $editorId; ?>-preview" class="preview"><?php echo Yii::t('ddeditor','Loading Preview...'); ?></div>
</div>
