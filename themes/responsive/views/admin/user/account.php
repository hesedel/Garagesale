<?php
$this->pageTitle = Yii::app()->name . ' - Account';
$this->breadcrumbs = array(
	$model->id => array('view', 'id' => $model->id),
	'Account',
);

$this->layout = 'column1';
?>

<div class="g-form" id="user_account">
	<h2>Account</h2>
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id' => 'user-account-form',
		'enableAjaxValidation' => true,
		'enableClientValidation' => true,
		'htmlOptions' => array('enctype' => 'multipart/form-data'),
		'focus' => array($model, 'title'),
	)); ?>

	<ul class="nav nav-tabs">
		<li class="active"><a href="#user_account-user" data-toggle="tab">User</a></li>
		<li><a href="#user_account-community" data-toggle="tab">Community</a></li>
		<li><a href="#user_account-password" data-toggle="tab">Password</a></li>
	</ul>

	<div class="tab-content">
		<div class="tab-pane active" id="user_account-user">

			<table class="form">
				<caption>User</caption>
				<tbody>

					<tr class="avatar">
						<th>
							<?php if($model->image): ?>
							<div class="image">
								<?php echo CHtml::image('/img/vendor/slir/w73-h70-c73x70-be8e8e3' . $model->getImage() . '?' . time(), $model->id); ?>
								<?php echo CHtml::link('<i class="fa fa-times"></i>', array('/admin/user/image_delete'), array('title' => 'remove profile picture')); ?>
							</div>
							<?php else:
								echo $this->renderPartial('_noImage', array('model' => $model));
							endif; ?>
						</th>
						<td>
							<?php if($model->image): ?>
							<span>Replace your profile picture:</span>
							<?php else: ?>
							<span>Upload a profile picture:</span>
							<?php endif; ?>
							<?php echo $form->fileField($model, 'image_temp'); ?>
							<?php echo $form->error($model, 'image_temp'); ?>
						</td>
					</tr>

					<tr>
						<th><?php echo $form->label($model, 'id'); ?></th>
						<td>
							<?php echo $model->id; ?>
							<?php /*
							<div class="input-text">
								<?php echo $form->textField($model, 'id'); ?>
								<span class="placeholder">ID</span>
							</div>
							<?php echo $form->error($model, 'id'); ?>
							*/ ?>
						</td>
					</tr>

					<tr>
						<th><?php echo $form->labelEx($model, 'name_first'); ?></th>
						<td>
							<div class="input-text">
								<?php echo $form->textField($model, 'name_first'); ?>
								<span class="placeholder">First Name</span>
							</div>
							<?php echo $form->error($model, 'name_first'); ?>
						</td>
					</tr>

					<tr>
						<th><?php echo $form->labelEx($model, 'name_last'); ?></th>
						<td>
							<div class="input-text">
								<?php echo $form->textField($model, 'name_last'); ?>
								<span class="placeholder">Last Name</span>
							</div>
							<?php echo $form->error($model, 'name_last'); ?>
						</td>
					</tr>

					<tr>
						<th><?php echo $form->labelEx($model, 'email'); ?></th>
						<td class="email"><?php echo $this->renderPartial('account/_email', array('model' => $model), true); ?></td>
					</tr>

					<tr>
						<th><?php echo $form->labelEx($model, 'phone'); ?></th>
						<td>
							<div class="input-text">
								<?php echo $form->textField($model, 'phone'); ?>
								<span class="placeholder">Phone</span>
							</div>
							<?php echo $form->error($model, 'phone'); ?>
						</td>
					</tr>

				</tbody>
			</table>

		</div>
		<div class="tab-pane" id="user_account-community">

			<table class="form">
				<caption>Community</caption>
				<tbody>

					<tr>
						<th><?php echo $form->labelEx($model, 'location_id'); ?></th>
						<td>
							<?php echo $model->getLocationDropDownList(); ?>
							<?php echo $form->error($model, 'location_id'); ?>
						</td>
					</tr>

					<tr>
						<th><?php echo $form->labelEx($model, 'course_id'); ?></th>
						<td>
							<?php echo $model->getCourseDropDownList(); ?>
							<?php echo $form->error($model, 'course_id'); ?>
						</td>
					</tr>

				</tbody>
			</table>

		</div>
		<div class="tab-pane" id="user_account-password">

			<table class="form">
				<caption>Password</caption>
				<tbody>

					<tr>
						<th><?php echo $form->labelEx($model, 'password_old'); ?></th>
						<td>
							<div class="input-text">
								<?php echo $form->passwordField($model, 'password_old', array('size' => 32, 'maxlength' => 32)); ?>
								<span class="placeholder">Old Password</span>
							</div>
							<?php echo $form->error($model, 'password_old'); ?>
						</td>
					</tr>

					<tr>
						<th><?php echo $form->labelEx($model, 'password'); ?></th>
						<td>
							<div class="input-text">
								<?php echo $form->passwordField($model, 'password', array('size' => 32, 'maxlength' => 32, 'value' => isset($_POST['AccountForm']) ? $model->password : '')); ?>
								<span class="placeholder">New Password</span>
							</div>
							<?php echo $form->error($model, 'password'); ?>
						</td>
					</tr>

					<tr class="repeat">
						<th><?php echo $form->labelEx($model, 'password_repeat'); ?></th>
						<td>
							<div class="input-text">
								<?php echo $form->passwordField($model, 'password_repeat', array('size' => 32, 'maxlength' => 32)); ?>
								<span class="placeholder">New Password</span>
							</div>
							<?php echo $form->error($model, 'password_repeat'); ?>
						</td>
					</tr>

				</tbody>
			</table>

		</div>
	</div>

	<table class="form foot">
		<tfoot>
			<tr>
				<?php //<th>&#160;</th> ?>
				<td>
					<?php echo CHtml::link('Cancel', array('view', 'id'=>$model->id), array('class'=>'g-button cancel')); ?>
					<?php echo CHtml::linkButton('Save', array('class'=>'submit g-button--primary')); ?>
					<?php echo CHtml::submitButton('Save', array('class'=>'submit g-button--primary')); ?>
				</td>
			</tr>
		</tfoot>
	</table>

	<?php $this->endWidget(); ?>
</div>

<?php Yii::app()->clientScript->registerScript(
	'user_account',
	"
	$('a', '#user_account div.image').bind('click', function() {
		var \$this = $(this);
		if(confirm('Are you sure you want to delete your profile picture?')) {
			\$this.parent().addClass('loading');
			$.post(
				'".Yii::app()->createUrl('admin/user/image_delete')."',
				{
					ajax: true
				},
				function(data) {
					\$this.parents('tr').find('span').text('Upload a profile picture:');
					\$this.parent().replaceWith(data);
				}
			);
		}
		return false;
	});
	",
	CClientScript::POS_READY
);
