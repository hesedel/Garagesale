<?php
$protocol = 'HTTP/1.0';
if($_SERVER['SERVER_PROTOCOL'] === 'HTTP/1.1')
	$protocol = 'HTTP/1.1';
header($protocol . ' 503 Service Unavailable', true, 503);
header('Retry-After: 3600'); // 1 hour
?>
<!DOCTYPE html>
<!--[if lt IE 7]><html class="503 no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html class="503 no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="503 no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--><html class="503 no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

	<?php
	Yii::app()->clientScript->registerCssFile(Yii::app()->getAssetManager()->publish(Yii::app()->theme->basePath . '/css/503.css'));
	Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::app()->theme->basePath . '/js/vendor/modernizr-2.6.2.min.js'));
	Yii::app()->clientScript->registerScriptFile(Yii::app()->getAssetManager()->publish(Yii::app()->theme->basePath . '/js/vendor/respond.min.js'));
	?>

	<?php Yii::app()->clientScript->registerScriptFile('//use.typekit.net/fas6ahs.js'); ?>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
</head>
<body>

<div id="body">

	<div id="body-top"></div>

	<div id="page">

		<header id="header">
			<h1 id="logo">Garagesale<span>.ph</span></h1>
		</header>

		<?php echo $content; ?>

	</div><!-- #page -->

</div><!-- #body -->

<footer id="footer">

	<?php echo Yii::app()->name; ?> &#169; <?php echo time_local(date('Y-m-d H:i:s'), array('format'=>'Y')); ?>

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

<?php
if(env_is(array('dev'))) {
	Yii::app()->clientScript->registerScript(
		'livereload',
		file_get_contents(Yii::app()->theme->basePath . '/js/_livereload.js'),
		CClientScript::POS_END);
}
?>
</body>
</html>
