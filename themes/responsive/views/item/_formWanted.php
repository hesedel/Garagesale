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
	'_form',
	"
	$('input[type=checkbox]', $('label.free', '#item_create, #item_update')).bind('change', function() {
		if($(this).is(':checked')) {
			$('#Item_price')
				.val(0)
				.attr('readonly', true);
		} else {
			$('#Item_price')
				.val('')
				.attr('readonly', false)
				.trigger('focus')
				.trigger('select');
		}
		$('#Item_price').trigger('keyup');
	});

	var uploadIndex_from = 0;
	$('div.images', '#item_create, #item_update').sortable( {
		handle: '.image',
		opacity: .75,
		revert: true,
		start: function(event, ui) {
			uploadIndex_from = ui.item.index();
		},
		update: function(event, ui) {
			var uploadIndex_to = ui.item.index();
			var input = unserialize(base64_decode($('#Item_uploads').val()));
			var output = [];
			output[uploadIndex_to] = input[uploadIndex_from];
			for(var i in input) {
				if((i < uploadIndex_from && i < uploadIndex_to) || (i > uploadIndex_from && i > uploadIndex_to))
					output[i] = input[i];
				else if(i != uploadIndex_to) {
					if(uploadIndex_from < uploadIndex_to)
						output[i] = input[parseInt(i) + 1];
					else
						output[i] = input[i - 1];
				}
			}
			$('#Item_uploads').val(base64_encode(serialize(output)));
		}
	});
	$('a', '#item_create .images .image, #item_update .images .image').click(function() {
		var \$this = $(this);
		var input = unserialize(base64_decode($('#Item_uploads').val()));
		var output = [];
		for(var i in input) {
			if(i < \$this.parents('.image-container').index())
				output[i] = input[i];
			else if(i > \$this.parents('.image-container').index())
				output[i - 1] = input[i];
		}
		$('#Item_uploads').val(base64_encode(serialize(output)));
		if(\$this.parent().hasClass('new')) {
			var image = \$this.siblings('img').attr('src');
			$.post(
				'/item/ajaxRemoveImage/',
				{
					image: '" . Yii::getPathOfAlias('webroot') . "/img/uploads/temp/' + image.substring(image.lastIndexOf('/') + 1, image.length)
				},
				function() {
					if($('.images', '#item_create, #item_update').children('.image-container').size() == 0)
						$('.images', '#item_create, #item_update').remove();
				}
			);
		}
		\$this.parents('.image-container').remove();
		return false;
	});
	",
	CClientScript::POS_READY
);
