<?php $this->widget('bootstrap.widgets.TbNavbar', array(
	'type'=>'inverse',
    // 'brand'=> (Yii::app()->user->isGuest || !Yii::app()->user->getState('is_top_admin'))? 'Administrator' :'<img style="height:44px; padding:0; margin:0;" src="'.Yii::app()->user->getState('school_logo').'" />',
    'brand'=>'Administrator',
    'brandUrl'=>'index.php?r=collection/index',
    'collapse'=>true,
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'encodeLabel'=>false,
            'items'=>array(
                array('label'=>'Dashboard','icon'=>'home gray', 'url'=>array('/site/index')),
                array('label'=>'Educational institution','icon'=>'info-sign gray', 'url'=>array('/university/admin')
                    ,'visible'=>Yii::app()->user->checkAccess('administrator')),
                array('label'=>'Course','icon'=>'info-sign gray', 'url'=>array('/course/admin')
                    ,'visible'=>Yii::app()->user->checkAccess('teacher')),
                // array('label'=>'Subject','icon'=>'info-sign gray', 'url'=>array('/subject/admin')
                //     ,'visible'=>Yii::app()->user->checkAccess('teacher')),
                array('label'=>'Invoice','icon'=>'info-sign gray', 'url'=>array('/invoice/admin')
                    ,'visible'=>Yii::app()->user->checkAccess('teacher')),
                array('label'=>'User','icon'=>'info-sign gray', 'url'=>array('/user/admin')
                    ,'visible'=>Yii::app()->user->checkAccess('staff')),
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