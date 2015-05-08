<?php

$webBaseUrl = Yii::app()->baseUrl;
$baseUrl = Yii::app()->theme->baseUrl; 
$cs = Yii::app()->getClientScript();
	  
Yii::app()->clientscript->registerCoreScript( 'jquery' )
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

$cs->registerCssFile($baseUrl.'/css/core.css');
$cs->registerCssFile($baseUrl.'/css/bootstrap.css');
$cs->registerCssFile($baseUrl.'/css/bootstrap-responsive.css');
$cs->registerCssFile($baseUrl.'/css/style.css');
$cs->registerCssFile($baseUrl.'/js/jquery-ui/css/smoothness/jquery-ui-1.10.4.custom.min.css');

$cs->registerScriptFile($baseUrl.'/js/jquery-ui/js/jquery-ui-1.10.4.custom.min.js');
$cs->registerScriptFile($baseUrl.'/js/tabs.js');
$cs->registerScriptFile($baseUrl.'/js/lib/google-chart.js');

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta name="language" content="en" />
<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!-- Le styles -->

<script src="<?php echo $baseUrl; ?>/js/ckeditor/ckeditor.js"></script>

<?php if(!Yii::app()->user->isGuest && Yii::app()->user->getState('is_top_admin')){ ?>

<style type="text/css">

/*.brand{
    padding: 0 !important;
    margin-right: 10px;
}
*/
</style>

<?php } ?>

</head>

<body>
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
				<div class="nav-collapse">
					<?php require_once('navigation.php'); ?>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>
	
	<div class="cont">
	<div class="container-fluid">
	  <?php if(isset($this->breadcrumbs)):?>
			<?php 
			/*
$this->widget('zii.widgets.CBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
				'homeLink'=>false,
				'tagName'=>'ul',
				'separator'=>'',
				'activeLinkTemplate'=>'<li><a href="{url}">{label}</a> <span class="divider">/</span></li>',
				'inactiveLinkTemplate'=>'<li><span>{label}</span></li>',
				'htmlOptions'=>array ('class'=>'breadcrumb')
			)); 
*/
			?>
		<!-- breadcrumbs -->
	  <?php endif?>
	
	<?php echo $content ?>
	</div><!--/.fluid-container-->
	</div>

	<div class="footer">
	  <div class="container">
		<div class="row">
			<div id="footer-copyright" style="width:48%;display: inline-block;">
				About us | Contact us | Terms & Conditions
			</div> <!-- /span6 -->
			<div id="footer-terms" style="width:48%;display: inline-block;">
				© 2012-13 Black Bootstrap. <a href="http://nachi.me.pn" target="_blank">Nachi</a>.
			</div> <!-- /.span6 -->
		 </div> <!-- /row -->
	  </div> <!-- /container -->
	</div>
</body>
</html>
