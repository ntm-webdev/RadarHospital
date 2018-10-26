<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title> <?php echo $this->pageTitle; ?> </title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="<?= Yii::app()->theme->baseUrl?>/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="<?= Yii::app()->theme->baseUrl?>/css/range-styles.css">
		<link rel="stylesheet" type="text/css" href="<?= Yii::app()->theme->baseUrl?>/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?= Yii::app()->theme->baseUrl?>/css/style.css">
		<link rel="stylesheet" type="text/css" href="<?= Yii::app()->theme->baseUrl?>/css/jquery.gritter.css">
		<script type="text/javascript" src="<?=Yii::app()->theme->baseUrl?>/js/jquery-3.3.1.min.js"></script>
	</head>
	<body>
		<?php if(isset($this->breadcrumbs)):?>
			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
			)); ?><!-- breadcrumbs -->
		<?php endif?>
  		<?=$content?>
		<script type="text/javascript" src="<?=Yii::app()->theme->baseUrl?>/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?=Yii::app()->theme->baseUrl?>/js/script.js"></script>
		<script type="text/javascript" src="<?=Yii::app()->theme->baseUrl?>/js/circle-progress.js"></script>
		<script type="text/javascript" src="<?=Yii::app()->theme->baseUrl?>/js/jquery.gritter.js"></script>
	</body>
</html>