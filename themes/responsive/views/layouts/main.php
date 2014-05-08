<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--><html class="no-js"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

	<?php
	Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/css.css');
	Yii::app()->clientScript->registerPackage('modernizr');
	Yii::app()->clientScript->registerPackage('respond');
	Yii::app()->clientScript->registerPackage('php');
	?>

	<?php
	Yii::app()->clientScript->registerPackage('hes.slider');
	Yii::app()->clientScript->registerPackage('lightbox');
	Yii::app()->clientScript->registerPackage('textarea-expander');
	Yii::app()->clientScript->registerPackage('timeago');
	?>

	<?php Yii::app()->clientScript->registerScriptFile('//use.typekit.net/fas6ahs.js'); ?>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
</head>
<body>

<div id="xs">

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

		<?php echo $content; ?>

	</div><!-- #page -->

</div><!-- #body -->

<footer id="footer">
	<nav id="utility">
		<ul>
			<li><?php echo CHtml::link('About', array('/site/page', 'view' => 'about')); ?></li>
			<li><?php echo CHtml::link('FAQs', array('/site/page', 'view' => 'faqs')); ?></li>
			<li><?php echo CHtml::link('Policy', array('/site/page', 'view' => 'policy')); ?></li>
			<li><?php echo CHtml::link('Terms', array('/site/page', 'view' => 'terms')); ?></li>
		</ul>
	</nav>
	<div id="copyright"><?php echo Yii::app()->name; ?> &#169; <?php echo time_local(date('Y-m-d H:i:s'), array('format' => 'Y')); ?></div>
</footer><!-- #footer -->

</div><!-- #xs -->

<div id="menu-x"></div>

<div class="modal fade" id="alert" tabindex="-1" role="dialog" aria-labelledby="Alert" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-body"></div>
			<div class="modal-footer">
				<button type="button" class="g-button g-button--primary" data-dismiss="modal">OK</button>
			</div>
		</div>
	</div>
</div>

<div id="not-mobile">
	<div>
		<?php echo CHtml::image(
			'/img/vendor/slir/h144/img/logo-white.png',
			CHtml::encode(Yii::app()->name)
		); ?>
		<h2>Welcome to Stycle!</h2>
		<p>Please view this site on mobile device to receive the best experience,<br>or scale your browser window down.</p>
	</div>
</div>

<?php /*
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
*/ ?>

<?php
Yii::app()->clientScript->registerPackage('plugins');
Yii::app()->clientScript->registerPackage('bootstrap');
?>

<?php
Yii::app()->clientScript->registerPackage('form');
Yii::app()->clientScript->registerPackage('main');
?>

<?php if(env_is(array('int', 'sta', 'pro'))): ?>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-50631477-1', 'pajaroncreative.com');
ga('send', 'pageview');
</script>
<?php endif; ?>

</body>
</html>
