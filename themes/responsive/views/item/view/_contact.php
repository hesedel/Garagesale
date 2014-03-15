<?php if(!$model_success): ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'item-contact-form',
	'enableClientValidation'=>true,
	/*
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	*/
)); ?>

<div class="textarea">
	<?php echo $form->textArea($model, 'body'); ?>
	<span class="placeholder">Your message</span>
</div>
<?php echo $form->error($model,'body'); ?>

<div class="input-text">
	<?php echo $form->textField($model, 'email'); ?>
	<span class="placeholder">Your email address</span>
</div>
<?php echo $form->error($model,'email'); ?>

<div class="input-text">
	<?php echo $form->textField($model, 'name'); ?>
	<span class="placeholder">Your name</span>
</div>
<?php echo $form->error($model,'name'); ?>

<?php echo CHtml::linkButton('Send', array('class'=>'submit g-button')); ?>
<?php echo CHtml::submitButton('Send', array('class'=>'submit g-button')); ?>

<?php $this->endWidget(); ?>

<?php else: ?>

<p>Success!</p>

<?php endif; ?>
