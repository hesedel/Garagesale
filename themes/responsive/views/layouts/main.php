<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--><html class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=8">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

	<?php
	//Yii::app()->clientScript->registerCssFile(Yii::app()->getAssetManager()->publish(Yii::app()->theme->basePath . '/css/css.css'));
	Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/css.css');
	Yii::app()->clientScript->registerCoreScript('jquery.ui');
	Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::app()->theme->basePath . '/js/vendor/modernizr-2.6.2.min.js'));
	Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::app()->theme->basePath . '/js/vendor/respond.min.js'));
	?>

	<?php
	Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::app()->theme->basePath . '/js/vendor/jquery.lightbox-0.5.min.js'));
	Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::app()->theme->basePath . '/js/vendor/jquery.textarea-expander.js'));
	Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::app()->theme->basePath . '/js/vendor/jquery.timeago.js'));
	Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::app()->theme->basePath . '/js/vendor/php.min.js'));
	?>

	<?php Yii::app()->clientScript->registerScriptFile('//use.typekit.net/fas6ahs.js'); ?>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
</head>
<body>

<div id="body">

	<!--[if (gt IE 7)|!(IE)]><!--><?php $this->renderPartial('/layouts/_table'); ?><!--<![endif]-->
	<!--[if lt IE 8]><?php $this->renderPartial('/layouts/_table', array('lt_ie_8' => true)); ?><![endif]-->

	<div id="page">

		<?php if(Yii::app()->user->hasFlash('success')): ?>
		<div class="alert alert-success alert-dismissable timeout" id="alert">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&#215;</button>
			<?php echo Yii::app()->user->getFlash('success'); ?>
		</div>
		<?php endif; ?>
		<div class="alert alert-success alert-dismissable timeout" id="alert">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&#215;</button>
			The quick brown fox jumps over the lazy dog.
		</div>

		<?php echo $content; ?>

	</div><!-- #page -->

</div><!-- #body -->

<footer id="footer">
	<div id="copyright"><?php echo Yii::app()->name; ?> &#169; <?php echo time_local(date('Y-m-d H:i:s'), array('format' => 'Y')); ?></div>
</footer><!-- #footer -->

<?php /*
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
*/ ?>
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::app()->theme->basePath . '/js/plugins.js'),
	CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::app()->theme->basePath . '/js/vendor/bootstrap.min.js'),
	CClientScript::POS_END);
?>

<?php
Yii::app()->clientScript->registerScriptFile(
	Yii::app()->getAssetManager()->publish(Yii::app()->theme->basePath . '/js/form.js'),
	CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(
	Yii::app()->getAssetManager()->publish(Yii::app()->theme->basePath . '/js/main.js'),
	CClientScript::POS_END);
?>

<?php /*
<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
e=o.createElement(i);r=o.getElementsByTagName(i)[0];
e.src='//www.google-analytics.com/analytics.js';
r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
ga('create','UA-XXXXX-X');ga('send','pageview');
</script>
*/ ?>

<?php /*
if(env_is(array('dev'))) {
	Yii::app()->clientScript->registerScript(
		'livereload',
		file_get_contents(Yii::app()->theme->basePath . '/js/_livereload.js'),
		CClientScript::POS_END);
}
*/ ?>
</body>
</html>
