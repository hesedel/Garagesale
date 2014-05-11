<?php if(!$model_success): ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'item-contact-form',
	'enableClientValidation'=>true,
	/*
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	*/
	'htmlOptions'=>array(
		'class'=>'ajax',
	),
)); ?>
<table class="form--partial">
	<tbody>

		<tr>
			<td>
				<div class="textarea">
					<?php echo $form->textArea($model, 'body'); ?>
					<span class="placeholder">Your message</span>
				</div>
				<?php echo $form->error($model,'body'); ?>
			</td>
		</tr>

		<tr>
			<td>
				<div class="input-text">
					<?php echo $form->textField($model, 'email', array('disabled' => Yii::app()->user->isGuest ? false : true)); ?>
					<span class="placeholder">Your email address</span>
				</div>
				<?php echo $form->error($model,'email'); ?>
				</td>
		</tr>

		<tr>
			<td>
				<div class="input-text">
					<?php echo $form->textField($model, 'name', array('disabled' => Yii::app()->user->isGuest ? false : true)); ?>
					<span class="placeholder">Your name</span>
				</div>
				<?php echo $form->error($model,'name'); ?>
				</td>
		</tr>

	</tbody>
	<tfoot>

		<tr>
			<td>
				<?php echo CHtml::linkButton('Send', array('class' => 'submit g-button g-button--primary', 'id' => 'item-contact-form-linkButton')); ?>
				<?php echo CHtml::submitButton('Send', array('class' => 'submit g-button g-button--primary', 'id' => 'item-contact-form-submitButton')); ?>
			</td>
		</tr>

	</tfoot>
</table>
<?php $this->endWidget(); ?>

<?php else: ?>

<p><i class="fa fa-check"></i>Your message has been sent to the seller! </p>

<?php endif; ?>
