<?php
$this->pageTitle = Yii::app()->name . ' - Register';
$this->breadcrumbs = array(
	'Register',
);

$this->layout = 'column2';
?>

<div class="g-form" id="site_register">
	<h2>Register</h2>
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
		<table class="form" summary="Register">
			<caption class="hide">Register</caption>
			<tbody>

				<tr>
					<th><?php echo $form->labelEx($model, 'id'); ?></th>
					<td>
						<div class="input-text">
							<?php echo $form->textField($model, 'id'); ?>
							<span class="placeholder">Only small letters, numbers, and underscores are allowed.</span>
						</div>
						<?php echo $form->error($model, 'id'); ?>
					</td>
				</tr>

				<tr>
					<th><?php echo $form->labelEx($model, 'email'); ?></th>
					<td>
						<div class="input-text">
							<?php echo $form->textField($model, 'email'); ?>
							<span class="placeholder">Your email address</span>
						</div>
						<?php echo $form->error($model, 'email'); ?>
					</td>
				</tr>

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

				<tr>
					<th><?php echo $form->labelEx($model, 'password'); ?></th>
					<td>
						<div class="input-text">
							<?php echo $form->passwordField($model, 'password'); ?>
							<span class="placeholder">Create a password.</span>
						</div>
						<?php echo $form->error($model, 'password'); ?>
					</td>
				</tr>

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

				<tr>
					<th><?php echo $form->labelEx($model, 'name_first'); ?></th>
					<td>
						<div class="input-text">
							<?php echo $form->textField($model, 'name_first'); ?>
							<span class="placeholder">Your first name</span>
						</div>
						<?php echo $form->error($model, 'name_first'); ?>
					</td>
				</tr>

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

			</tbody>
			<tfoot>

				<tr>
					<?php //<th>&#160;</th> ?>
					<td colspan="2">
						<?php echo CHtml::link('Cancel', Yii::app()->user->getReturnUrl(), array('class' => 'g-button')); ?>
						<?php echo CHtml::linkButton('Register', array('class' => 'submit g-button orange')); ?>
						<?php echo CHtml::submitButton('Register', array('class' => 'submit g-button orange')); ?>
					</td>
				</tr>

			</tfoot>
		</table>
		<?php $this->endWidget(); ?>
	</div>
</div>
