<?php
$this->pageTitle = Yii::app()->name . ' - Email Change';
$this->breadcrumbs = array(
	Yii::app()->user->id => array('view', 'id' => Yii::app()->user->id),
	'Account' => array('/admin/user/account'),
	'Email Change',
);

$this->layout = '/layouts/column1';
?>

<div class="g-form" id="user_email-change">

	<?php if($success): ?>

		<h2 class="alert alert-success">Email Change Request Sent!</h2>

		<p class="alert alert-warning"><strong>ALERT!</strong>, you'll need to verify your new email address.<br/>An email has been sent to you ( <strong><?php echo $model->email; ?></strong> )<br/>Please follow the instructions in the email to change your email on account.<br/>If you can't see the email, it might be in your spam folder.</p>

		<?php echo CHtml::link('← return to where you left off', Yii::app()->user->getReturnUrl(), array('class'=>'g-button small')); ?>

	<?php else: ?>

	<h2>Email Change</h2>
	<div class="form">
		<?php $form = $this->beginWidget('CActiveForm', array(
			'id'=>'user-emailChange-form',
			'enableClientValidation'=>true,
			'focus'=>array($model,'password'),
		)); ?>
		<?php //echo $form->errorSummary($model); ?>
		<table class="form" summary="Email Change">
			<caption class="hide">Email Change</caption>
			<tbody>

				<tr>
					<th><?php echo $form->labelEx($model,'password'); ?></th>
					<td>
						<div class="input-text">
							<?php echo $form->passwordField($model,'password'); ?>
							<span class="placeholder">Password</span>
						</div>
						<?php echo $form->error($model,'password'); ?>
					</td>
				</tr>

				<tr>
					<th><?php echo $form->labelEx($model,'email'); ?></th>
					<td>
						<div class="input-text">
							<?php echo $form->textField($model,'email'); ?>
							<span class="placeholder">New Email</span>
						</div>
						<?php echo $form->error($model,'email'); ?>
					</td>
				</tr>

				<tr class="repeat">
					<th><?php echo $form->labelEx($model,'email_repeat'); ?></th>
					<td>
						<div class="input-text">
							<?php echo $form->textField($model,'email_repeat'); ?>
							<span class="placeholder">Repeat New Email</span>
						</div>
						<?php echo $form->error($model,'email_repeat'); ?>
					</td>
				</tr>

			</tbody>
			<tfoot>

				<tr>
					<?php //<th>&#160;</th> ?>
					<td colspan="2">
						<?php echo CHtml::link('Cancel', array('account'), array('class' => 'g-button')); ?>
						<?php echo CHtml::linkButton('Change Email', array('class' => 'submit g-button--primary')); ?>
						<?php echo CHtml::submitButton('Change Email', array('class' => 'submit g-button--primary')); ?>
					</td>
				</tr>

			</tfoot>
		</table>
		<?php $this->endWidget(); ?>
	</div>

	<?php endif; ?>

</div>
