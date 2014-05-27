<?php
$this->pageTitle=Yii::app()->name . ' - Change Password';
?>

<div id="user_changePassword">

	<div class="form">

		<?php
		$form=$this->beginWidget('CActiveForm', array(
			'id'=>'user-passwordChange-form',
			'enableClientValidation'=>true,
			'focus'=>array($model,'password'),
		));
		?>

		<table class="form" summary="Password Change">
			<caption class="hide">Password Change</cation>

			<tbody>

				<tr>
					<th><?php echo $form->labelEx($model,'password'); ?></th>
					<td>
						<div class="input-text">
							<?php echo $form->passwordField($model,'password'); ?>
							<span class="placeholder">Create a new password</span>
						</div>
						<?php echo $form->error($model,'password'); ?>
				</tr>

				<tr>
					<th><?php echo $form->labelEx($model,'password_repeat'); ?>
					<td>
						<div class="input-text">
							<?php echo $form->passwordField($model,'password_repeat'); ?>
							<span class="placeholder">Re-enter the password you created</span>
						</div>
						<?php echo $form->error($model,'password_repeat'); ?>
					</td>
				</tr>

			</tbody>
			<tfoot>

				<tr>
					<th>\\&#160;</th>
					<td>
						<?php echo CHtml::linkButton('Change Password', array('class'=>'submit g-button orange')); ?>
						<?php echo CHtml::submitButton('Change Password', array('class'=>'submit g-button orange')); ?>
					</td>
				</tr>

			</tfoot>
		</table>

		<?php
		$this->endWidget();
		?>

	</form>

</div>
