<?php
$email=Yii::app()->db->createCommand()
	->select('email')
	->from('user_email_change')
	->where('user_id=:id',array(':id'=>$model->id))
	->queryScalar();
?>
<?php if(!$email): ?>
<?php echo $model->email; ?> <?php echo CHtml::link('change', array('email_change')); ?>
<?php else: ?>
<span><?php echo $email; ?></span> <?php echo CHtml::link('re-verify', array('email_change_reverify'), array('class'=>'no-js')); ?><?php echo CHtml::ajaxLink('re-verify', array('email_change_reverify', 'ajax'=>true), null, array('class'=>'js')); ?><br><?php echo CHtml::link('cancel email change', array('email_change_cancel'), array('class'=>'no-js')); ?><?php echo CHtml::ajaxLink('cancel email change', array('email_change_cancel', 'ajax'=>true), array('update'=>'#user_account td.email'), array('class'=>'js')); ?>
<?php endif; ?>
