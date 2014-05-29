<div id="item_view-sidebar">

<?php $user = User::model()->findByPk($model->user_id); ?>
<div class="user">

	<strong>Email Seller</strong>


	<?php echo CHtml::link(
		($user->image
			? CHtml::image(
				'/img/vendor/slir/w60-h54-c30x27-bfff' . $user->getImage() . '?' . time(),
				$model->user->name_first . '\'s avatar'
			)
			: '<i class="fa fa-user"></i>'
		) .
			$model->user->name_first,
		array(
			'/admin/user/view',
			'id' => $model->user_id,
		),
		array('class' => 'user-img')
	); ?>

	<span class="user-created">member since <?php echo time_local($user->created, array('format' => 'Y')); ?></span>

</div>

<div class="contact">

	<?php /* if(strlen($model->user->phone) != 0): ?>
	<span class="phone"><i class="fa fa-phone"></i> <?php echo $model->user->phone; ?></span>
	<?php endif; */ ?>

	<?php //<span class="email"><i class="fa fa-envelope"></i> Email seller</span> ?>

	<?php if(Yii::app()->user->isGuest): ?>
	<div class="guest">
		<p>Interested in this item? <?php echo CHtml::link('Login', array('/site/login')); ?> to contact this seller.</p>
		<p>Don't have an account yet? Click here to <?php echo CHtml::link('register', array('/site/register')); ?> now</p>
	</div>
	<?php else: ?>
	<div class="form">
		<p>Your email address will not be visible to the seller</p>
		<?php $this->renderPartial('view/_contact', array(
			'model' => $model_contactForm,
			'model_success' => $model_contactForm_success,
		)); ?>
	</div>
	<?php endif; ?>

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
