<?php
$this->pageTitle=Yii::app()->name . ' - Account';
$this->breadcrumbs=array(
	$model->id=>array('view','id'=>$model->id),
	'Account',
);

$this->layout='column1';
?>

<div class="g-form" id="user_account">
	<h2>Account</h2>
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'user-account-form',
		'enableAjaxValidation'=>true,
		'enableClientValidation'=>true,
		'htmlOptions'=>array('enctype'=>'multipart/form-data'),
		'focus'=>array($model,'title'),
	)); ?>
	<div class="row">
		<div class="col-md-6 col-sm-6">
			<table class="form">
				<caption>User Info</caption>
				<tbody>

					<tr>
						<th>
							<?php if($model->image): ?>
							<div class="image">
								<?php echo CHtml::image('/img/vendor/slir/w73-h70-c73x70-be8e8e3'.$model->getImage(), $model->id); ?>
								<?php echo CHtml::link('<i class="fa fa-times"></i>', array('image_delete'), array('title'=>'remove profile picture')); ?>
							</div>
							<?php else:
								echo $this->renderPartial('_noImage', array('model'=>$model));
							endif; ?>
						</th>
						<td>
							<?php if($model->image): ?>
							<span>Replace your profile picture:</span>
							<?php else: ?>
							<span>Upload a profile picture:</span>
							<?php endif; ?>
							<?php echo $form->fileField($model,'image_temp'); ?>
							<?php echo $form->error($model,'image_temp'); ?>
						</td>
					</tr>

					<tr>
						<th><?php echo $form->label($model,'id'); ?></th>
						<td>
							<?php echo $model->id; ?>
							<?php /*
							<div class="input-text">
								<?php echo $form->textField($model,'id'); ?>
								<span class="placeholder">ID</span>
							</div>
							<?php echo $form->error($model,'id'); ?>
							*/ ?>
						</td>
					</tr>

					<tr>
						<th><?php echo $form->labelEx($model,'name_first'); ?></th>
						<td>
							<div class="input-text">
								<?php echo $form->textField($model,'name_first'); ?>
								<span class="placeholder">First Name</span>
							</div>
							<?php echo $form->error($model,'name_first'); ?>
						</td>
					</tr>

					<tr>
						<th><?php echo $form->labelEx($model,'name_last'); ?></th>
						<td>
							<div class="input-text">
								<?php echo $form->textField($model,'name_last'); ?>
								<span class="placeholder">Last Name</span>
							</div>
							<?php echo $form->error($model,'name_last'); ?>
						</td>
					</tr>

					<tr>
						<th><?php echo $form->labelEx($model,'email'); ?></th>
						<td class="email"><?php echo $this->renderPartial('account/_email', array('model'=>$model), true); ?></td>
					</tr>

					<tr>
						<th><?php echo $form->labelEx($model,'phone'); ?></th>
						<td>
							<div class="input-text">
								<?php echo $form->textField($model,'phone'); ?>
								<span class="placeholder">Phone</span>
							</div>
							<?php echo $form->error($model,'phone'); ?>
						</td>
					</tr>

					<tr>
						<th><?php echo $form->labelEx($model,'course'); ?></th>
						<td>
							<?php echo $model->getCourseDropDownList(); ?>
							<?php echo $form->error($model,'course'); ?>
						</td>
					</tr>

					<tr>
						<th><?php echo $form->labelEx($model,'location_id'); ?></th>
						<td>
							<?php
							// get the locations
							$locations = Yii::app()->db->createCommand()
								->select('*')
								->from('user_location')
								->order('name')
								->queryAll();
	
							// store the locations in a real array
							$listData = array();
							foreach($locations as $location)
								$listData[] = array('id'=>$location['id'], 'name'=>CHtml::encode($location['name']));
							?>
							<?php echo CHtml::activeDropDownList($model, 'location_id', CHtml::listData($listData, 'id', 'name'), array('encode'=>false, 'empty'=>'select a location')); ?>
							<?php echo $form->error($model,'location_id'); ?>
						</td>
					</tr>

				</tbody>
			</table>
		</div>
		<div class="col-md-6 col-sm-6">
			<table class="form">
				<caption>Password Change</caption>
				<tbody>

					<tr>
						<th><?php echo $form->labelEx($model,'password_old'); ?></th>
						<td>
							<div class="input-text">
								<?php echo $form->passwordField($model,'password_old',array('size'=>32,'maxlength'=>32)); ?>
								<span class="placeholder">Old Password</span>
							</div>
							<?php echo $form->error($model,'password_old'); ?>
						</td>
					</tr>

					<tr>
						<th><?php echo $form->labelEx($model,'password'); ?></th>
						<td>
							<div class="input-text">
								<?php echo $form->passwordField($model,'password',array('size'=>32,'maxlength'=>32,'value'=>isset($_POST['AccountForm']) ? $model->password : '')); ?>
								<span class="placeholder">New Password</span>
							</div>
							<?php echo $form->error($model,'password'); ?>
						</td>
					</tr>

					<tr class="repeat">
						<th><?php echo $form->labelEx($model,'password_repeat'); ?></th>
						<td>
							<div class="input-text">
								<?php echo $form->passwordField($model,'password_repeat',array('size'=>32,'maxlength'=>32)); ?>
								<span class="placeholder">New Password</span>
							</div>
							<?php echo $form->error($model,'password_repeat'); ?>
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
					<?php echo CHtml::linkButton('Save', array('class'=>'submit g-button orange')); ?>
					<?php echo CHtml::submitButton('Save', array('class'=>'submit g-button orange')); ?>
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
