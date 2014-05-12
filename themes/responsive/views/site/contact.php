<?php
$this->pageTitle = Yii::app()->name . ' - Contact Us';
$this->breadcrumbs = array(
	'Contact',
);

$this->layout = 'column1';
?>

<div class="g-form" id="contact">
	<h2>Contact Us</h2>
	<div class="form">

	<?php if(Yii::app()->user->hasFlash('contact')): ?>

		<div class="flash-success">
			<?php echo Yii::app()->user->getFlash('contact'); ?>
		</div>

		<h3>Message sent</h3>
		<h4>What happens next?</h4>
		<p>We will contact you within 48 hrs regarding your enquiry</p>

		<?php else: ?>

		<p>
		If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
		</p>


<!-- form -->


		<div class="form">

				<?php $form = $this->beginWidget('CActiveForm', array(
					'id' => 'contact-form',
					'enableClientValidation' => true,
					'clientOptions' => array(
						'validateOnSubmit' => true,
					),
				)); ?>

		<p class="note">All fields are required.</p>

				<?php echo $form->errorSummary($model); ?>
				
				<table class="form" summary="contact">
					<caption class="hide">contact us</caption>
					<tbody>
					
					<tr>
						<th><?php echo $form->labelEx($model, 'name'); ?></th>
						<td>
							<div class="input-text">
								<?php echo $form->textField($model, 'name'); ?>
							</div>
							<?php echo $form->error($model, 'name'); ?>
						</td>
					</tr>
					<tr>
						<th><?php echo $form->labelEx($model, 'email'); ?></th>
						<td>
							<div class="input-text">
								<?php echo $form->textField($model, 'email'); ?>
							</div>
							<?php echo $form->error($model, 'email'); ?>
						</td>
					</tr>					
					<tr>
						<th><?php echo $form->labelEx($model, 'subject'); ?></th>
						<td>
							<div class="input-text">
						<?php echo $form->textField($model, 'subject', array('size' => 60, 'maxlength' => 128)); ?>							</div>
							<?php echo $form->error($model, 'subject'); ?>
						</td>
					</tr>					
					<tr>
						<th><?php echo $form->labelEx($model, 'body'); ?></th>
						<td>
							<div class="input-text">
						<?php echo $form->textArea($model, 'body', array('rows' => 6, 'cols' => 50)); ?>
							<?php echo $form->error($model, 'body'); ?>
						</td>
					</tr>					
					<?php if(CCaptcha::checkRequirements()): ?>
					<tr>
						<th><?php echo $form->labelEx($model, 'verifyCode'); ?></th>
						<td>
							<div class="captcha"><?php $this->widget('CCaptcha'); ?>
							</div>
							<div class="input-text">
							<?php echo $form->textField($model, 'verifyCode'); ?>
							</div>
						<div class="hint">Please enter the letters as they are shown in the image above.
						<br/>Letters are not case-sensitive.
						</div>
						<?php echo $form->error($model, 'verifyCode'); ?>
						</td>
					</tr>
					<?php endif; ?>
					</tbody>
					<tfoot>
						<tr>
							<?php //<th>&#160;</th> ?>
							<td colspan="2">
								<div class="submit g-button--primary">
									<?php echo CHtml::linkButton('Submit', array('class' => 'submit g-button--primary')); ?>
									<?php echo CHtml::submitButton('Submit', array('class' => 'submit g-button--primary')); ?>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div>
									<?php echo CHtml::link('Cancel', Yii::app()->user->getReturnUrl(), array('class' => '')); ?>
								</div>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
			<?php $this->endWidget(); ?>
					
			</div>
<!-- form -->

	<?php endif; ?>
