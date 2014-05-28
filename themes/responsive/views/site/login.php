<?php
$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
	'Login',
);

$this->layout = '/layouts/column1';
?>

<div class="g-form" id="site_login">
	<h2>Login</h2>

	<div class="alert alert-warning alert-dismissable">
		<!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
		Not yet a member? <?php echo CHtml::link('<i class="fa fa-thumbs-up"></i> register', array('/site/register'), array('class' => 'g-button small')); ?>
	</div>

	<div class="form">
		<?php $form = $this->beginWidget('CActiveForm', array(
			'id' => 'login-form',
			'enableClientValidation' => true,
			/*
			'clientOptions' => array(
				'validateOnSubmit' => true,
			),
			*/
			'focus' => strlen($model->username) == 0 || $model->getErrorCode() == 1 ? array($model, 'username') : array($model, 'password'),
		)); ?>
		<table class="form" summary="Login">
			<caption class="hide">Login</caption>
			<tbody>

				<tr>
					<th><?php echo $form->labelEx($model, 'username'); ?></th>
					<td>
						<div class="input-text">
							<?php echo $form->textField($model, 'username', array('autocapitalize' => 'none')); ?>
							<span class="placeholder">Your username or email address</span>
						</div>
						<?php echo $form->error($model, 'username'); ?>
					</td>
				</tr>

				<tr>
					<th><?php echo $form->labelEx($model, 'password'); ?></th>
					<td>
						<div class="input-text">
							<?php echo $form->passwordField($model, 'password'); ?>
							<span class="placeholder">Your password</span>
						</div>
						<?php echo $form->error($model, 'password'); ?>
						<?php if($model->getErrorCode() == 2):
							echo CHtml::link('Forgot password?', array('/admin/user/password_forgot', 'id' => $model->username), array('class' => 'forgotPassword'));
						endif; ?>
					</td>
				</tr>

			</tbody>
			<tfoot>

				<tr>
					<?php //<th>&#160;</th> ?>
					<td colspan="2">
						<?php echo $form->checkBox($model, 'rememberMe'); ?>
						<?php echo $form->label($model, 'rememberMe'); ?>
						<br>

						<?php echo CHtml::linkButton('Login', array('class' => 'submit g-button--primary')); ?>
						<?php echo CHtml::submitButton('Login', array('class' => 'submit g-button--primary')); ?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo CHtml::link('Cancel', Yii::app()->user->getReturnUrl(), array('class' => 'g-button')); ?>
					</td>
				</tr>
				

			</tfoot>
		</table>
		<?php $this->endWidget(); ?>
	</div>
</div>
