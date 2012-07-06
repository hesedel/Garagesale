<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model_userMessage,'message'); ?>
		<?php echo $form->textArea($model_userMessage,'message'); ?>
		<?php echo $form->error($model_userMessage,'message'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::textField($model_userMessage,'item_id') ?>
		<?php echo CHtml::linkButton('Send', array('class'=>'submit g-button orange')); ?>
		<?php echo CHtml::submitButton('Send', array('class'=>'submit g-button orange')); ?>
	</div>

<?php $this->endWidget(); ?>