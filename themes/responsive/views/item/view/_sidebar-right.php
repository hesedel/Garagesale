<div id="item_view-sidebar">

<?php if($model->userCanUpdate() || $model->userCanDelete()): ?>
<div class="actions">

	<?php echo $model->userCanUpdate() ? CHtml::link('<i class="fa fa-pencil"></i> Edit', array('update', 'id' => $model->id), array('class' => 'g-button')) : ''; ?>

	<?php echo $model->userCanDelete() ? CHtml::link('<i class="fa fa-trash-o"></i> Delete', '#', array('class' => 'g-button', 'submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')) : ''; ?>

</div>
<?php endif; ?>

<?php $user = User::model()->findByPk($model->user_id); ?>
<div class="user">

	<?php echo CHtml::link(
		($user->image
			? CHtml::image(
				'/img/vendor/slir/w76-h68-c38x34-bfff' . $user->getImage(),
				$model->user_id . '\'s avatar'
			)
			: '<i class="fa fa-user"></i> '
		) .
			$model->user_id,
		array(
			'/admin/user/view',
			'id' => $model->user_id,
		),
		array('class' => 'user-img')
	); ?>

	<span class="user-created">member since <?php echo time_local($user->created, array('format' => 'Y')); ?></span>

</div>

<div class="contact">

	<?php if(strlen($model->user->phone) != 0): ?>
	<span class="phone"><i class="fa fa-phone"></i> <?php echo $model->user->phone; ?></span>
	<?php endif; ?>

	<span class="email"><i class="fa fa-envelope"></i> Email poster</span>

	<div class="form">
		<?php $this->renderPartial('view/_contact', array(
			'model' => $model_contactForm,
			'model_success' => $model_contactForm_success,
		)); ?>
	</div>

</div>

<?php /* if($items = $model->getOtherItems()): ?>

<div class="other">

	<h2>Other Ads by This User</h2>

	<div class="items">

		<?php foreach($items as $item): ?>

			<div class="item">

				<?php
				$image = $item->old_getImage();
				echo CHtml::link(
					CHtml::image(
						'/img/transparent.gif',
						$item->title,
						array('style' => 'background-image: url(/img/vendor/slir/w38-h34-c38.34-bbabaab' . ($image ? $image['path'] : '/img/item/no-image.gif') . ')')
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

<?php endif; */ ?>

</div><!-- #item_view-sidebar -->
