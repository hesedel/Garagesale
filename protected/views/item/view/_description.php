<p><?php echo Yii::app()->format->formatNtext($model->description) ?></p>

<?php if($images = $model->getImages()): ?>
<div class="images"><?php foreach($images as $image) {
	echo CHtml::link(
		CHtml::image(
			'/img/transparent.gif',
			$image['id'] . '.' . $image['type'],
			array(
				'title' => 'click to enlarge photo',
				'style' => 'background-image: url(/img/vendor/slir/w116-h106-c116.106-be8e8e3' . $image['path'] . ')',
			)
		),
		'/img/vendor/slir/w510-bfff' . $image['path'],
		array('class' => 'lightbox')
	);
} ?></div><!-- .images -->
<?php endif ?>