<?php
$this->pageTitle = Yii::app()->name . ' - Contact';
$this->breadcrumbs = array(
	'Contact',
);

$this->layout = 'column1';
?>

<div class="g-form" id="site_register">
	<h3>Contact</h3>
	<p>For queries, please complete the following form</p>
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

				<tr>
					<th><?php echo $form->labelEx($model, 'name'); ?></th>
					<td>
						<div class="input-text">
							<?php echo $form->textField($model, 'name_first'); ?>
							<span class="placeholder"></span>
						</div>
						<?php echo $form->error($model, 'name_first'); ?>
					</td>
				</tr>

				<tr>
					<th><?php echo $form->labelEx($model, 'email'); ?></th>
					<td>
						<div class="input-text">
							<?php echo $form->textField($model, 'email'); ?>
							<span class="placeholder"></span>
						</div>
						<?php echo $form->error($model, 'email'); ?>
					</td>
				</tr>

<!--
				<?php /*
				<tr class="repeat">
					<th><?php echo $form->labelEx($model, 'email_repeat'); ?></th>
					<td>
						<div class="input-text">
							<?php echo $form->textField($model, 'email_repeat'); ?>
							<span class="placeholder">Re-enter your email address</span>
						</div>
						<?php echo $form->error($model, 'email_repeat'); ?>
					</td>
				</tr>
				*/ ?>
-->

				<tr>
					<th><?php echo $form->labelEx($model, 'mobile'); ?></th>
					<td>
						<div class="input-text">
							<?php echo $form->passwordField($model, 'phone'); ?>
							<span class="placeholder">Include area code</span>
						</div>
						<?php echo $form->error($model, 'phone'); ?>
					</td>
				</tr>

<!--
				<?php /*
				<tr class="repeat">
					<th><?php echo $form->labelEx($model, 'password_repeat'); ?></th>
					<td>
						<div class="input-text">
							<?php echo $form->passwordField($model, 'password_repeat'); ?>
							<span class="placeholder">Re-enter the password you created.</span>
						</div>
						<?php echo $form->error($model, 'password_repeat'); ?>
					</td>
				</tr>
				*/ ?>
-->

				<tr>
					<th><?php echo $form->labelEx($model, 'Enquiry'); ?></th>
					<td>
						<div class="input-text">
							<?php echo $form->textArea($model, 'name_first'); ?>
							<span class="placeholder"></span>
						</div>
						<?php echo $form->error($model, 'name_first'); ?>
					</td>
				</tr>

<!--
				<?php /*
				<tr>
					<th><?php echo $form->labelEx($model, 'name_last'); ?></th>
					<td>
						<div class="input-text">
							<?php echo $form->textField($model, 'name_last'); ?>
							<span class="placeholder">Your last name</span>
						</div>
						<?php echo $form->error($model, 'name_last'); ?>
					</td>
				</tr>
				*/ ?>

				<?php /*
				<tr>
					<th><?php echo $form->labelEx($model, 'phone'); ?></th>
					<td>
						<div class="input-text">
							<?php echo $form->textField($model, 'phone'); ?>
							<span class="placeholder">The phone number to contact you with</span>
						</div>
						<?php echo $form->error($model, 'phone'); ?>
					</td>
				</tr>
				*/ ?>
-->

<!--
				<?php if(CCaptcha::checkRequirements()): ?>
				<tr>
					<th><?php echo $form->labelEx($model, 'verifyCode'); ?></th>
					<td>
						<div class="captcha"><?php $this->widget('CCaptcha', array('showRefreshButton' => false)); ?></div>
						<div class="input-text">
							<?php echo $form->textField($model, 'verifyCode'); ?>
							<span class="placeholder">Please enter the letters as they are shown in the image above.</span>
						</div>
						<?php echo $form->error($model, 'verifyCode'); ?>
					</td>
				</tr>
				<?php endif; ?>
-->

			</tbody>
			<tfoot>

				<tr>
					<?php //<th>&#160;</th> ?>
					<td colspan="1">
<!-- 						<?php echo CHtml::link('Cancel', Yii::app()->user->getReturnUrl(), array('class' => 'g-button')); ?> -->
						<?php echo CHtml::linkButton('Submit enquiry', array('class' => 'submit g-button--primary')); ?>
						<?php echo CHtml::submitButton('Register', array('class' => 'submit g-button--primary')); ?>
					</td>
				</tr>

			</tfoot>
		</table>
		<?php $this->endWidget(); ?>
	</div>
</div>
