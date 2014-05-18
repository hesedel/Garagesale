<?php
$this->pageTitle = Yii::app()->name . ' - Report Seller';

$this->breadcrumbs = array(
	'Report Seller',
);

$this->layout = 'column1';
?>

<div class="g-form" id="site_contact">
	<h2>Report Seller</h2>

	<?php if(Yii::app()->user->hasFlash('reported')): ?>

	<div class="flash-success">
		<?php echo Yii::app()->user->getFlash('reported'); ?>
	</div>
	<h3>User Reported</h3>
	<h4>What happens next?</h4>
	<p>We will contact you within 48 hrs regarding your enquiry</p>

	<?php else: ?>

	<div class="form">
		<p>If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.</p>
		<?php $form = $this->beginWidget('CActiveForm', array(
			'id' => 'contact-form',
			'enableClientValidation' => true,
			/*
			'clientOptions' => array(
				'validateOnSubmit' => true,
			),
			*/
		)); ?>

		<?php //echo $form->errorSummary($model); ?>

		<table class="form" summary="report">
			<caption class="hide">Contact</caption>
			<tbody>

				<tr>
					<th><?php echo $form->labelEx($model, 'reporterUserID'); ?></th>
					<td>
						<div class="input-text">
							<?php echo Yii::app()->params['user']->name_first; ?>
						</div>
						<?php echo $form->error($model, 'reporterUserID'); ?>
					</td>
				</tr>

				<tr>
					<th><?php echo $form->labelEx($model, 'reportedUserID'); ?></th>
					<td>
						<div class="input-text">
							<?php 
								if (Yii::app()->user->hasState('report_user')) {
									echo Yii::app()->user->getState('report_user');
									Yii::app()->user->setState('report_user',Yii::app()->user->getState('report_user'));
								}
							?>
						</div>
						<?php echo $form->error($model, 'reportedUserID'); ?>
					</td>
				</tr>

				<tr>
					<th><?php echo $form->labelEx($model, 'reportType'); ?></th>
					<td>
						
							<?php echo CHtml::activeDropDownList($model,'reportType', array(
								1 => 'Content is offensive',
								2 => 'User is being abusive',
								3 => 'Sexually explicit content',
								4 => 'Spam or a scam',
								5 => 'Violates Stycle\'s policy and terms and conditions',

							), array(
								'multiple'=>'multiple',
							)); ?>
						
						<?php echo $form->error($model, 'reportType'); ?>
					</td>
				</tr>
				<tr>
					<th><?php echo $form->labelEx($model, 'reportDescription'); ?></th>
					<td>
						<div class="input-text">
							<?php echo $form->textArea($model, 'reportDescription', array('rows' => 6, 'cols' => 50)); ?>
						</div>
						<?php echo $form->error($model, 'reportDescription'); ?>
					</td>
				</tr>

			<?php if(CCaptcha::checkRequirements()): ?>
			<tr>
				<th><?php echo $form->labelEx($model, 'verifyCode'); ?></th>
				<td>
					<div class="captcha"><?php $this->widget('CCaptcha', array('showRefreshButton' => false)); ?>
					</div>
					<div class="hint">Please enter the letters as they are shown in the image above.<br/>Letters are not case-sensitive.</div>
					<div class="input-text">
					<?php echo $form->textField($model, 'verifyCode'); ?>
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
						<?php echo CHtml::linkButton('Submit', array('class' => 'submit g-button--primary')); ?>
						<?php echo CHtml::submitButton('Submit', array('class' => 'submit g-button--primary')); ?>
					</td>
				</tr>

			</tfoot>
		</table>
		<?php $this->endWidget(); ?>			
	</div>

	<?php endif; ?>
</div>
