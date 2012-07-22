<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
	<div class="row">
		<div id="statusMsg"></div>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model_userMessage,'message'); ?>
		<?php echo $form->textArea($model_userMessage,'message'); ?>
		<?php echo $form->error($model_userMessage,'message'); ?>
	</div>

	<div class="row buttons">
		<?php echo $form->hiddenField($model_userMessage,'item_id',array('value'=>$model->id)); ?>
		<?php
			$url = Yii::app()->createUrl('item/view',array('id'=>$model->id));
			echo CHtml::ajaxLink('Send',$url,array(
				'type'=>'POST',
				'success'=>'function(data){
					$("#statusMsg").html(data).slideDown("fast").delay(1500).slideUp("fast");
				}',
			),
			array('class'=>'submit g-button orange'));
		?>
		<?php echo CHtml::submitButton('Send', array('class'=>'submit g-button orange')); ?>
	</div>

<?php $this->endWidget(); ?>