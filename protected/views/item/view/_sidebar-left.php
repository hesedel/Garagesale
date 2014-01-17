<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'sidebar-left')) ?>

<div id="item_view-sidebar-left">

<?php
$image=$model->getImage();
if($image) {
	echo CHtml::link(
		CHtml::image(
			'/img/vendor/slir/w188-h302-bbabaab' . $image['path'],
			$image['id'] . '.' . $image['type'],
			array('title' => 'click photo to enlarge')
		),
		'/img/vendor/slir/w530-bfff' . $image['path'],
		array('class' => 'lightbox')
	);
} else {
	echo CHtml::image(
		'/img/vendor/slir/w190-h117-c190:117-bbabaab/img/item/no-image.gif',
		$model->title,
		array('class' => 'no-image')
	);
}
?>

<table class="info-ad" cellspacing="0">
	<caption>Ad Info</caption>
	<tr>
		<th><?php echo $model->getAttributeLabel('created') ?> on</th>
		<td><?php echo time_local($model->created) ?></td>
	</tr>
	<tr>
		<th><?php echo $model->getAttributeLabel('updated') ?> on</th>
		<td><?php echo time_local($model->updated) ?></td>
	</tr>
	<tr>
		<th>Expires on</th>
		<td><?php echo time_local($model->updated, array('offset' => 60*24*60*60)) // 60 days ?></td>
	</tr>
	<tr>
		<th>Views</th>
		<td>...</td>
	</tr>
</table><!-- .info-ad -->

</div><!-- #item_view-sidebar-left -->

<?php $this->endWidget() ?>