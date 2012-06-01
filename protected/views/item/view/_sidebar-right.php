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

<?php if($items = $model->getOtherItems()): ?>

<div class="other">

	<h2>Other Ads by This User</h2>

	<div class="items">

		<?php foreach($items as $item): ?>

			<div class="item">

				<?php
				$image = $item->getImage();
				if($image) {
					echo CHtml::link(
						CHtml::image(
							'/images/transparent.gif',
							$item->title,
							array('style' => 'background-image: url(/images/slir/w38-h34-c38:34-bbabaab' . $image['path'] . ')')
						),
						array('/item/view', 'id' => $item->id),
						array('class' => 'image')
					);
				} else {
					echo CHtml::image(
						'/images/transparent.gif',
						$item->title,
						array(
							'class' => 'no-image',
							'style' => 'background-image: url(/images/slir/w38-h34-c38:34-bbabaab/images/item/no-image.gif)'
						)
					);
				}
				?>

				<strong><?php echo CHtml::link(
					CHtml::encode($item->title),
					array(
						'/item/view',
						'id'=>$item->id),
					array('title'=>$item->title)
				) ?></strong>

				<span class="price">PHP <?php echo number_format($item->price) ?></span>

				<p title="<?php echo CHtml::encode($item->description) ?>"><?php echo CHtml::encode($item->description) ?></p>

				<?php if($item->category_id != null): ?>
				<em><?php echo $item->category->title ?></em>
				<?php endif ?>

				<?php if($item->condition_id != null): ?>
				<span class="condition <?php echo $item->getConditionClass() ?>"><span><?php echo $item->condition->title ?></span></span>
				<?php endif ?>

			</div><!-- .item -->

		<?php endforeach ?>

	</div><!-- .items -->

</div><!-- .other -->

<?php endif ?>

</div><!-- #item_view-sidebar-right -->

<?php $this->endWidget() ?>