<div class="form">

	<?php $form = $this->beginWidget('CActiveForm', array(
		'id' => 'item-form',
		'enableAjaxValidation' => true,
		'htmlOptions' => array('enctype' => 'multipart/form-data'),
		'focus' => array($model, 'title'),
	)); ?>

	<?php //echo $form->errorSummary($model); ?>

	<table class="form" summary="Post a New Wanted Item">
		<caption class="hide">Item</caption>

		<tbody>

			<tr>
				<th><?php echo $form->labelEx($model, 'title'); ?></th>
				<td>
					<div class="input-text">
						<?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 64)); ?>
						<span class="placeholder"></span>
					</div>
					<?php echo $form->error($model, 'title'); ?>
				</td>
			</tr>

			<tr>
				<th><?php echo $form->labelEx($model, 'price'); ?></th>
				<td>

					<table class="price"><tr>
						<th>
						<div class="price input-text">
							<span class="prepend">AU$</span>
							<?php echo $form->numberField($model, 'price'); ?>
							<span class="placeholder"></span>
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
				<th><?php echo $form->labelEx($model, 'condition_id'); ?></th>
				<td>
					<fieldset>
						<legend>Condition</legend>
						<?php
							echo $form->radioButtonList($model, 'condition_id', array('0' => 'Totally New', '1' => 'Almost New', '2' => 'Not New'), array('separator' => ' &#160; '));
							echo $form->error($model, 'condition_id');
						?>
					</fieldset>
				</td>
			</tr>

			<tr class="hidden">
				<th><?php echo $form->labelEx($model, 'location_id'); ?></th>
				<td><?php echo $model->getLocationDropDownList(); ?> Changing this will update your account and this will reflect on all your other ads.</td>
			</tr>

			<tr>
				<th><?php echo $form->labelEx($model, 'description'); ?></th>
				<td>
					<div class="textarea">
						<?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50)); ?>
						<span class="placeholder"></span>
					</div>
					<?php echo $form->error($model, 'description'); ?>
				</td>
			</tr>

			<?php /*
			<tr>
				<th><?php echo $form->labelEx($model, 'phone'); ?>
				<td>
					<div class="input-text half">
						<?php echo $form->textField($model, 'phone', array('maxLength' => 16)); ?>
						<span class="placeholder">Phone</span>
					</div>
					Changing this will update your account and this will reflect on all your other ads.
				</td>
			</tr>
			*/ ?>

			<tr>
				<th><?php echo $form->labelEx($model, 'pickup'); ?></th>
				<td>

					<div class="textarea">
						<?php echo $form->textArea($model, 'pickup', array('rows' => 6, 'cols' => 50)); ?>
						<span class="placeholder"></span>
					</div>
					<?php echo $form->error($model, 'pickup'); ?>
				</td>
			</tr>

		</tbody>

		<tfoot>

			<tr>
				<th><?php echo $form->hiddenField($model, 'user_id', array('value' => strlen($model->user_id) == 0 ? Yii::app()->user->getId() : $model->user_id)); ?></th>
				<td>
					<?php echo !$model->isNewRecord ? CHtml::link('Cancel', array('view', 'id' => $model->id), array('class' => 'g-button')) . ' ' : ''; ?>
					<?php echo CHtml::linkButton($model->isNewRecord ? 'Post' : 'Save', array('class' => 'submit g-button--primary')); ?>
					<?php echo CHtml::submitButton($model->isNewRecord ? 'Post' : 'Save', array('class' => 'submit g-button--primary')); ?>
				</td>
			</tr>

		</tfoot>

	</table>

	<?php $this->endWidget(); ?>

</div>

<?php
Yii::app()->clientScript->registerScript(
	'_formWanted',
	"
	$('input[type=checkbox]', $('label.free', '#item_create, #item_update')).bind('change', function() {
		if($(this).is(':checked')) {
			$('#WantedForm_price')
				.val(0)
				.attr('readonly', true);
		} else {
			$('#WantedForm_price')
				.val('')
				.attr('readonly', false)
				.trigger('focus')
				.trigger('select');
		}
		$('#Item_price').trigger('keyup');
	});
	",
	CClientScript::POS_READY
);
