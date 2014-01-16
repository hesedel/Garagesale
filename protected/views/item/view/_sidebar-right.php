<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'sidebar-right')) ?>

<div id="item_view-sidebar-right">

<div class="info-user">

	<h2>User Info</h2>

	<div<?php echo strlen($model->user->phone) != 0 ? ' class="hasPhone"' : '' ?>>

		<?php echo CHtml::link(
			CHtml::image(
				'/img/transparent.gif',
				$model->user_id,
				array('style' => 'background-image: url(/img/vendor/slir/w38-h34-c38.34-bbabaab' . User::model()->findByPk($model->user_id)->getImage() . ')')
			),
			array('/admin/user/view', 'id' => $model->user_id),
			array('class' => 'image')
		) ?>

		<strong><?php echo CHtml::link(
			$model->user_id,
			array(
				'/admin/user/view',
				'id' => $model->user_id
			),
			array('title' => $model->user_id)
		) ?></strong>

		<?php if(strlen($model->user->phone) != 0): ?>
		<span><?php echo $model->user->phone ?></span>
		<?php endif ?>

	</div>

</div><!-- .info-user -->

<?php if($items = $model->getOtherItems()): ?>

<div class="other">

	<h2>Other Ads by This User</h2>

	<div class="items">

		<?php foreach($items as $item): ?>

			<div class="item">

				<?php
				$image = $item->getImage();
				echo CHtml::link(
					CHtml::image(
						'/img/transparent.gif',
						$item->title,
						array('style' => 'background-image: url(/img/vendor/slir/w38-h34-c38.34-bbabaab' . ($image ? $image['path'] : '/images/item/no-image.gif') . ')')
					),
					array('/item/view', 'id' => $item->id),
					array('class' => 'image')
				);
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