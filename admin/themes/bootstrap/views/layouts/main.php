<?php 
/* @var $this Controller */ 
$baseUrl = Yii::app()->theme->baseUrl;

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta charset="UTF-8" />
	<meta name="language" content="en" />
		
    <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/styles.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/js/jquery-ui-1.11.0.custom/jquery-ui.min.css" />
    
<!--
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
-->

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>
	
	<!-- chart libraries start -->
    <script src="<?php echo $baseUrl; ?>/js/script.js"></script>
	<script src="<?php echo $baseUrl; ?>/js/excanvas.js"></script>
	<script src="<?php echo $baseUrl; ?>/js/jquery.flot.min.js"></script>
	<script src="<?php echo $baseUrl; ?>/js/jquery.flot.pie.min.js"></script>
	<script src="<?php echo $baseUrl; ?>/js/jquery.flot.stack.js"></script>
	<script src="<?php echo $baseUrl; ?>/js/jquery.flot.resize.min.js"></script>
	<!-- chart libraries end -->
</head>

<body>

<?php require_once('navigation.php'); ?>

<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
			'homeLink'=>false,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

</div><!-- page -->

</body>
</html>
