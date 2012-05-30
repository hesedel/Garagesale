<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'sidebar-right')) ?>

<div id="item_view-sidebar-right">

<div class="info-user">

	<h2>User Info</h2>

	<?php echo CHtml::link(
		CHtml::image(
			'/images/transparent.gif',
			$model->user_id,
			array('style' => 'background-image: url(/images/slir/w38-h34-c38:34-bbabaab' . User::model()->findByPk($model->user_id)->getImage() . ')')
		),
		array('/admin/user/view', 'id' => $model->user_id),
		array('class' => 'image')
	) ?>

	<span><?php echo CHtml::link($model->user_id, array('/admin/user/view', 'id' => $model->user_id)) ?></span>

</div><!-- .info-user -->

</div><!-- #item_view-sidebar-right -->

<?php $this->endWidget() ?>