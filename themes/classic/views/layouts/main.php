<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title> <?php echo $this->pageTitle; ?> </title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="<?= Yii::app()->theme->baseUrl?>/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?= Yii::app()->theme->baseUrl?>/css/style.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
	</body>
</html>