<?php
if(env_is(array('dev-strict', 'int-strict', 'sta-strict', 'pro-strict')))
	header('Content-Type: ' . (stristr($_SERVER['HTTP_ACCEPT'], 'application/xhtml+xml') && !stristr($_SERVER['HTTP_USER_AGENT'], 'msie') ? 'application/xhtml+xml' : 'text/html'));
?>
<?php if(env_is(array('sta', 'sta-strict', 'pro', 'pro-strict'))): ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<?php else: ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php endif ?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"<?php echo preg_match('/^localhost./', $_SERVER['HTTP_HOST']) == 0 ? ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"' : '' ?>>

<?php $this->renderPartial('/layouts/_head') ?>

<!--[if lt IE 7]><body class="no-js ie6"><![endif]-->
<!--[if IE 7]><body class="no-js ie7"><![endif]-->
<!--[if IE 8]><body class="no-js ie8"><![endif]-->
<!--[if IE 9]><body class="no-js ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><body class="no-js"><!--<![endif]-->

<div id="body">

	<div id="body-top"></div>

	<div id="page">

		<!--[if (gt IE 7)|!(IE)]><!--><?php $this->renderPartial('/layouts/_table') ?><!--<![endif]-->
		<!--[if lt IE 8]><?php $this->renderPartial('/layouts/_table', array('legacy'=>true)) ?><![endif]-->

		<?php if(Yii::app()->user->hasFlash('success')): ?>
		<div class="alert alert-success timeout"><?php echo Yii::app()->user->getFlash('success') ?></div>
		<?php endif ?>

		<?php echo $content ?>

	</div><!-- #page -->

</div><!-- #body -->

<div id="footer"></div><!-- #footer -->

</body>

</html>

<?php
	Yii::app()->clientScript->registerScript('main',
		file_get_contents('js/main.js'),
	CClientScript::POS_READY);