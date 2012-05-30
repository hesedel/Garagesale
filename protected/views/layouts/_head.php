<head>

<?php if(env_is(array('sta', 'pro'))): ?>
	<meta http-equiv="X-UA-Compatible" content="IE-edge, chrome=1" />
<?php endif ?>

<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta name="language" content="en" />

<!-- <link rel="shortcut icon" type="image/x-icon" href="/favicon.<?php echo env_is(array('dev', 'dev-strict')) ? 'png' : 'ico' ?>" /> -->
<!-- <link rel="alternate" type="application/rss+xml" title="" href="" /> -->

<!-- css -->

<!-- Blueprint Framework -->
<link rel="stylesheet" type="text/css" href="/css/print.css" media="print" />
<!--[if lt IE 8]><link rel="stylesheet" type="text/css" href="/css/ie.css" media="screen, projection" /><![endif]-->

<?php Yii::app()->clientScript->registerCssFile(Yii::app()->getAssetManager()->publish('css/all.css')) ?>

<!-- css -->

<!-- js -->

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish('js/bootstrap.min.js')) ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish('js/php.min.js')) ?>

<!-- jQuery -->
<?php Yii::app()->clientScript->registerCoreScript('jquery') ?>
<?php Yii::app()->clientScript->registerCoreScript('jquery.ui') ?>

<!-- third-party -->
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish('js/jquery.lightbox-0.5.min.js')) ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish('js/jquery.textarea-expander.js')) ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish('js/jquery.timeago.js')) ?>

<!-- js -->

<title><?php echo CHtml::encode($this->pageTitle) ?></title>

</head>