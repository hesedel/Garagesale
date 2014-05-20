<?php
$this->pageTitle = Yii::app()->name . ' - Post a Wanted Ad';

$this->breadcrumbs = array(
	'Wanted',
);

$this->layout = 'column1';
?>

<div class="g-form" id="site_contact">
	<h2>Post a Wanted Ad</h2>

	<?php if(Yii::app()->user->hasFlash('reported')): ?>

	<div class="flash-success">
		<?php echo Yii::app()->user->getFlash('reported'); ?>
	</div>
	<h3>Your item has been posted successfully!</h3>

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

		<table class="form" summary="wanted">
			<caption class="hide">Contact</caption>
			<tbody>

				<tr>
					<th><?php echo $form->labelEx($model, 'title'); ?></th>
					<td>
						<div class="input-text">
							<?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 64)); ?>
						</div>
						<div class="input-text">
							<?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50)); ?>
						</div>
					</td>
				</tr>

				<tr>
				<th><?php echo $form->labelEx($model, 'price'); ?>
				<td>

					<table class="price"><tr>
						<th>
						<div class="price input-text">
							<span class="prepend">AU$</span>
							<?php echo $form->numberField($model, 'price'); ?>
							<span class="placeholder">Price prepared to pay</span>
						</div>
						</th>
						<td>
							<label class="g-button--primary small free"><input type="checkbox"> Free!</label>
						</td>
					</tr></table>

					<?php echo $form->error($model, 'price'); ?>
				</td>
			</tr>

				<tr>
					<th><?php echo $form->labelEx($model, 'itemCondition'); ?></th>
					<td>
						
							<?php echo CHtml::activeDropDownList($model,'itemCondition', array(
								1 => 'Brand New',
								2 => 'Newish',
								3 => 'Used',

							), 

							)); ?>
						
						<?php echo $form->error($model, 'itemCondition'); ?>
					</td>
				</tr>
				<tr>
					<th><?php echo $form->labelEx($model, 'collectionLocation'); ?></th>
					<td>
						<div class="input-text">
							<?php echo $form->textArea($model, 'collectionLocation', array('rows' => 6, 'cols' => 50)); ?>
						</div>
						<?php echo $form->error($model, 'collectionLocation'); ?>
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
