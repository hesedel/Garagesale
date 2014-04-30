<?php
$this->pageTitle = Yii::app()->name . ' - Confirmation';
$this->breadcrumbs = array(
	'Confirmation',
);

$this->layout = 'column1';
?>

<div class="g-form" id="site_register">
	<h3>Message sent</h3>
	<h5>What happens next?</h5>
	<p>We will contact you within 48 hrs regarding your enquiry</p>
	
<!--
	<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array(
			'id' => 'register-form',
			'enableClientValidation' => true,
			/*
			'clientOptions' => array(
				'validateOnSubmit' => true,
			),
			*/
			'focus' => array($model, 'id'),
		)); ?>
		<?php //echo $form->errorSummary($model); ?>
		<table class="form" summary="Contact">
			<caption class="hide">Contact</caption>
			<tbody>

			</tbody>
			<tfoot>

				<tr>
					<?php //<th>&#160;</th> ?>
					<td colspan="1">
						<?php echo CHtml::link('Cancel', Yii::app()->user->getReturnUrl(), array('class' => 'g-button')); ?>
						<?php echo CHtml::linkButton('Go to home page', array('class' => 'submit g-button--primary')); ?>
						<?php echo CHtml::submitButton('Go to home page', array('class' => 'submit g-button--primary')); ?>
					</td>
				</tr>

			</tfoot>
		</table>
		<?php $this->endWidget(); ?>
	</div>
-->
</div>
