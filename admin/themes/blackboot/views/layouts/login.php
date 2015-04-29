<?php

$webBaseUrl = Yii::app()->baseUrl;
$baseUrl = Yii::app()->theme->baseUrl; 
$cs = Yii::app()->getClientScript();
	  
Yii::app()->clientscript->registerCoreScript( 'jquery' );
/*
->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-transition.js', CClientScript::POS_END )
->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-alert.js', CClientScript::POS_END )
->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-modal.js', CClientScript::POS_END )
->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-dropdown.js', CClientScript::POS_END )
->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-scrollspy.js', CClientScript::POS_END )
->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-tab.js', CClientScript::POS_END )
->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-tooltip.js', CClientScript::POS_END )
->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-popover.js', CClientScript::POS_END )
->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-button.js', CClientScript::POS_END )
->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-collapse.js', CClientScript::POS_END )
->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-carousel.js', CClientScript::POS_END )
->registerScriptFile( Yii::app()->theme->baseUrl . '/js/bootstrap-typeahead.js', CClientScript::POS_END );
*/

$cs->registerCssFile($baseUrl.'/css/bootstrap.css');
$cs->registerCssFile($baseUrl.'/css/bootstrap-responsive.css');
$cs->registerCssFile($baseUrl.'/css/style.css');
$cs->registerCssFile($baseUrl.'/js/jquery-ui/css/smoothness/jquery-ui-1.10.4.custom.min.css');

$cs->registerScriptFile($baseUrl.'/js/jquery-ui/js/jquery-ui-1.10.4.custom.min.js');
$cs->registerScriptFile($baseUrl.'/js/tabs.js');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" style="box-sizing: border-box; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; height: 100%;">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta name="language" content="en" />
<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!-- Le styles -->
</head>

<body style="box-sizing: border-box; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; height: 100%;">
<!--
<p style="border:1px solid gray; background-color: black; color: white;margin: 10px;padding: 10px; display: block;">
<h4>DEBUG LOG</h4>
<pre></pre></p>
-->
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="#"><?php echo Yii::app()->name ?></a>
			</div>
		</div>
	</div>
	
	<div class="cont" style="box-sizing: border-box; -moz-box-sizing: border-box; -webkit-box-sizing: border-box; height: 100%;">
		<div style="margin-top: 50px;"></div>
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span4">&nbsp;</div>
				<div class="span4">
					<div class="main">
						<?php echo $content; ?>
					</div>	
				</div><!-- content -->
				<div class="span4">&nbsp;</div>
			</div>
		</div><!--/.fluid-container-->
	</div>

</body>
</html>
