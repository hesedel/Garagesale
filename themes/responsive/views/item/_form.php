<div class="form">

	<?php $form = $this->beginWidget('CActiveForm', array(
		'id' => 'item-form',
		'enableAjaxValidation' => true,
		'htmlOptions' => array('enctype' => 'multipart/form-data'),
		'focus' => array($model, 'title'),
	)); ?>

	<?php //echo $form->errorSummary($model); ?>

	<table class="form" summary="Post a New Item">
		<caption class="hide">Item</caption>

		<tbody>

			<tr>
				<th><?php echo $form->labelEx($model, 'title'); ?>
				<td>
					<div class="input-text">
						<?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 64)); ?>
						<span class="placeholder">What are you selling?</span>
					</div>
					<?php echo $form->error($model, 'title'); ?>
				</td>
			</tr>

			<tr>
				<th><?php echo $form->labelEx($model, 'price'); ?>
				<td>
					<div class="price input-text">
						<span class="prepend">AU$</span>
						<?php echo $form->numberField($model, 'price'); ?>
						<span class="placeholder">How much does it cost?</span>
					</div>
					<?php echo $form->error($model, 'price'); ?>
				</td>
			</tr>

			<tr>
				<th><?php echo $form->labelEx($model, 'category_id'); ?></th>
				<td><?php echo $model->getCategoryDropDownList(); ?></td>
			</tr>

			<tr>
				<th><?php echo $form->labelEx($model, 'location_id'); ?></th>
				<td><?php echo $model->getLocationDropDownList(); ?> Changing this will update your account and this will reflect on all your other ads.</td>
			</tr>

			<tr>
				<th>Condition</th>
				<td>
					<fieldset>
						<legend>Condition</legend>
						<?php
							echo $form->radioButtonList($model, 'condition_id', array('' => 'N/A', '0' => 'Brand New', '1' => 'Used'), array('separator' => ' &#160; '));
							echo $form->error($model, 'condition_id');
						?>
					</fieldset>
				</td>
			</tr>

			<tr>
				<th><?php echo $form->labelEx($model, 'description'); ?>
				<td>
					<div class="textarea">
						<?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50)); ?>
						<span class="placeholder">Describe what you are selling.<br/>Longer descriptions sell more.</span>
					</div>
					<?php echo $form->error($model, 'description'); ?>
				</td>
			</tr>

			<tr>
				<th><?php echo $form->labelEx($model, 'images'); ?>
				<td>
					<?php
					$uploads = unserialize(base64_decode($model->uploads));
					if(!$model->isNewRecord && !$uploads) {
						$images = Yii::app()->db->createCommand()
							->select('id')
							->from('item_image')
							->where('item_id=:item_id', array(':item_id' => $model->id))
							->order('index')
							->queryAll();
						foreach($images as $image)
							$uploads[] = array('name' => $image['id'], 'tempName' => '', 'new' => false);
					}
					$i = 0;
					if(strlen(strip_tags($form->error($model, 'images'))) == 0) {
						$images = CUploadedFile::getInstances($model, 'images');
						foreach($images as $image) {
							$name = md5($image->name . time() . $i) . '.' . strtolower($image->extensionName);
							$image->saveAs(Yii::getPathOfAlias('webroot') . '/img/uploads/temp/' . $name);
							$uploads[] = array('name' => $image->name, 'tempName' => $name, 'new' => true);
							$i++;
						}
					}
					if(strlen(strip_tags($form->error($model, 'photo'))) == 0) {
						$photos = CUploadedFile::getInstances($model, 'photo');
						foreach($photos as $photo) {
							$name = md5($photo->name . time() . $i) . '.' . strtolower($photo->extensionName);
							$photo->saveAs(Yii::getPathOfAlias('webroot') . '/img/uploads/temp/' . $name);
							$uploads[] = array('name' => $photo->name, 'tempName' => $name, 'new' => true);
							$i++;
						}
					}
					?>
					<?php if($uploads): ?>
					<div class="images">
						<?php foreach($uploads as $upload): ?>
						<div class="image-container">
							<?php
							if($upload['new'])
								echo '<div class="image new" title="' . CHtml::encode($upload['name']) . '">' .
									CHtml::image('/img/vendor/slir/w142-h142-c142x142-bffffff/img/uploads/temp/' . CHtml::encode($upload['tempName']), CHtml::encode($upload['name'])) .
									CHtml::link('<i class="fa fa-times"></i>', '#', array('title' => 'remove ' . CHtml::encode($upload['name']))) .
								'</div>';
							else {
								$image = Yii::app()->db->createCommand()
									->select('id, type')
									->from('item_image')
									->where('id=:id', array(':id' => $upload['name']))
									->queryRow();
								echo '<div class="image" title="' . $image['id'] . '.' . $image['type'] . '">' .
									CHtml::image('/img/vendor/slir/w142-h142-c142x142-bffffff/' . db_image('item_image', $image['id']), CHtml::encode($upload['name'])) .
									CHtml::link('<i class="fa fa-times"></i>', '#', array('title' => 'remove ' . CHtml::encode($upload['name']))) .
								'</div>';
							}
							?>
						</div>
						<?php endforeach; ?>
						<?php
						echo $form->hiddenField($model, 'uploads', array('value' => base64_encode(serialize($uploads))));
						?>
						<div class="clear"></div>
					</div>
					<?php endif; ?>
					<div class="label label-default">Select upto 5 images to upload</div>
					<?php $this->widget('CMultiFileUpload', array(
						'model' => $model,
						'attribute' => 'images',
						'accept' => 'gif|jpg|jpeg|png',
						'options' => array(
							'afterFileAppend' => file_get_contents(Yii::app()->theme->basePath . '/js/item/_form/_CMultiFileUpload-afterFileAppend.js'),
						),
						'htmlOptions' => array(
							'accept' => 'image/*',
							'multiple' => true,
						),
						'max' => 5,
						'remove' => 'remove',
					)); ?>
					<?php echo $form->error($model, 'images'); ?>
					<div class="label label-default">or take a photo.</div>
					<?php $this->widget('CMultiFileUpload', array(
						'model' => $model,
						'attribute' => 'photo',
						'accept' => 'gif|jpg|jpeg|png',
						'htmlOptions' => array(
							'accept' => 'image/*',
						),
						'max' => 1,
						'remove' => 'remove',
					)); ?>
					<?php echo $form->error($model, 'photo'); ?>
					<div class="no-js">JavaScript required</div>
				</td>
			</tr>

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

		</tbody>

		<tfoot>

			<tr>
				<th><?php echo $form->hiddenField($model, 'user_id', array('value' => strlen($model->user_id) == 0 ? Yii::app()->user->getId() : $model->user_id)); ?>
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
