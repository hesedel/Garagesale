<?php
$this->pageTitle = Yii::app()->name . ' - Register';
$this->breadcrumbs = array(
	'Register',
);

$this->layout = 'column1';
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

				<?php /*
				<tr>
					<th><?php echo $form->labelEx($model, 'id'); ?></th>
					<td>
						<div class="input-text">
							<?php echo $form->textField($model, 'id', array('autocapitalize' => 'none')); ?>
							<span class="placeholder">Only small letters, numbers, and underscores are allowed.</span>
						</div>
						<?php echo $form->error($model, 'id'); ?>
					</td>
				</tr>
				*/ ?>

				<tr>
					<th><?php echo $form->labelEx($model, 'email'); ?></th>
					<td>
						<div class="input-text">
							<?php echo $form->emailField($model, 'email'); ?>
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

				<tr>
					<th><?php echo $form->labelEx($model, 'university_id'); ?></th>
					<td>
						<?php echo $model->getUniversityDropDownList(); ?>
						<?php echo $form->error($model, 'university_id'); ?>
					</td>
				</tr>

				<tr class="campus">
					<th><?php echo $form->labelEx($model, 'campus_id'); ?></th>
					<td>
						<?php echo $model->getCampusDropDownList(); ?>
						<?php echo $form->error($model, 'campus_id'); ?>
					</td>
				</tr>

				<tr>
					<th><?php echo $form->labelEx($model, 'course_id'); ?></th>
					<td>
						<?php echo $model->getCourseDropDownList(); ?>
						<?php echo $form->error($model, 'course_id'); ?>
					</td>
				</tr>

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
						<div class="hint">Please enter the letters as they are shown in the image above.
						<br>Letters are not case-sensitive.</div>
						<div class="input-text">
							<?php echo $form->textField($model, 'verifyCode', array('autocapitalize' => 'none')); ?>
							<span class="placeholder">Please enter the letters as they are shown in the image above.</span>
						</div>
						<?php echo $form->error($model, 'verifyCode'); ?>
					</td>
				</tr>
				<?php endif; ?>

				<tr>
					<td colspan="2">
						<?php echo $form->checkBox($model, 'agree'); ?>
						<?php echo $form->label($model, 'agree'); ?>
						<?php echo $form->error($model, 'agree'); ?>
					</td>
				</tr>

			</tbody>
			<tfoot>

				<tr>
					<?php //<th>&#160;</th> ?>
					<td colspan="2">
						<?php echo CHtml::link('Cancel', Yii::app()->user->getReturnUrl(), array('class' => 'g-button')); ?>
						<?php echo CHtml::linkButton('Register', array('class' => 'submit g-button--primary')); ?>
						<?php echo CHtml::submitButton('Register', array('class' => 'submit g-button--primary')); ?>
					</td>
				</tr>

			</tfoot>
		</table>
		<?php $this->endWidget(); ?>
	</div>
</div>

<?php Yii::app()->clientScript->registerScript('site_register',
	"
	$('#RegisterForm_email').bind('keyup', function() {
		var \$this = $(this);
		$('option', '#RegisterForm_university_id').each(function() {
			if($(this).attr('data-domain')) {
				var string = $(this).attr('data-domain').replace(/\./g, '\\\.');
				var re = new RegExp(string, 'i');
				if(\$this.val().match(re)) {
					$('#RegisterForm_university_id')
						.val($(this).val())
						.trigger('change');
					//$(this).attr('selected', true);
				}
			}
		});
	});

	var campuses = [];
	$('option:not(:first-child)', '#RegisterForm_campus_id').each(function() {
		campuses.push({'val': $(this).val(), 'text': $(this).text(), 'data-parent_id': $(this).attr('data-parent_id')});
	});

	$('#RegisterForm_university_id')
		.bind('change', function() {
			var \$this = $(this);
			var campuses_filtered = campuses.filter(function(campuses) {
				return campuses['data-parent_id'] === \$this.val();
			});

			if(campuses_filtered.length > 0) {
				$('option:not(:first-child)', '#RegisterForm_campus_id')
					.remove();
				$.each(campuses_filtered, function(i, campus) {
					var \$option = $('<option>');
					\$option
						.val(campus.val)
						.text(campus.text)
						.attr('data-parent_id', campus['data-parent_id']);
					console.log(\$option);
					$('#RegisterForm_campus_id').append(\$option);
				});
				$('#RegisterForm_campus_id')
					.val('')
					.attr('disabled', false);
				$('.campus', '#site_register').removeClass('hidden');
			} else {
				$('.campus', '#site_register').addClass('hidden');
				$('#RegisterForm_campus_id').attr('disabled', true);
			}
		})
		.trigger('change');
	",
CClientScript::POS_READY);
