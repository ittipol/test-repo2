<?php $this->widget('bootstrap.widgets.TbNavbar', array(
	'type'=>'inverse',
    'brand'=> CHtml::encode(Yii::app()->name),
    'brandUrl'=>'index.php?r=collection/index',
    'collapse'=>true,
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'encodeLabel'=>false,
            'items'=>array(
                array('label'=>'Dashboard','icon'=>'home gray', 'url'=>array('/site/index')),
                array('label'=>'School','icon'=>'info-sign gray', 'url'=>array('/school/index')
                    ,'visible'=>Yii::app()->user->checkAccess('administrator')),
                 array('label'=>'University','icon'=>'info-sign gray', 'url'=>array('/university/index')
                    ,'visible'=>Yii::app()->user->checkAccess('administrator')),
                // array('label'=>'School', 'icon'=>'folder-open gray', 'url'=>'#', 'items'=>array(
                //     array('label'=>'course', 'url'=>array('school/index')),
                //     '---',
                // ),'visible'=>Yii::app()->user->checkAccess('administrator')),
            ),
        ),
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array(
                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Logout','icon'=>'off gray', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
            ),
        ),
    ),
)); ?>