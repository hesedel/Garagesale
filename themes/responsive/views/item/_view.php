<?php if($index % $options['grid']['itemsPerRow'] == 0): ?>
<div class="view-row">
<?php endif; ?>

<div class="view-container<?php echo $index % $options['grid']['itemsPerRow'] == 0 ? ' clear-left' : ''; ?>" style="width: <?php echo 100 / $options['grid']['itemsPerRow']; ?>%">

	<div class="view">

		<?php	echo CHtml::link(
			CHtml::image(
				'/img/vendor/slir/w334-h288-c334x288-bfff' . $data->getImage(),
				CHtml::encode($data->title),
				array('title' => $data->description)
			),
			array('/item/view', 'id' => $data->id),
			array('class' => 'img')
		); ?>

		<strong>
			<?php echo CHtml::link(CHtml::encode($data->title), array('/item/view', 'id' => $data->id), array('title' => $data->title)); ?>

			<span class="price-xs visible-xs">P <?php echo number_format($data->price); ?></span>

			<span class="time-xs visible-xs"><i class="fa fa-clock-o"></i><time class="timeago" datetime="<?php echo date('Y-m-d H:i:sO', strtotime($data->updated)); ?>"><?php echo $data->getTimeAgo(); ?></time></span>

			<span class="location-xs visible-xs"><i class="fa fa-map-marker"></i><?php echo $data->user->location ? $data->user->location->name : ''; ?></span>
		</strong>

		<?php /*
		<em<?php echo $data->category_id ? ' title="' . CHtml::encode($data->category->title) . '"' : ''; ?>><?php echo $data->category_id ? CHtml::encode($data->category->title) : ''; ?></em>
		*/ ?>

		<span class="price">₱ <?php echo number_format($data->price); ?></span>

		<span class="time"><i class="fa fa-clock-o"></i><time class="timeago" datetime="<?php echo date('Y-m-d H:i:sO', strtotime($data->updated)); ?>"><?php echo $data->getTimeAgo('updated'); ?></time></span>

		<span class="location"><i class="fa fa-map-marker"></i><?php echo $data->user->location ? $data->user->location->name : ''; ?></span>

		<?php if($data->condition_id != null) {
			$condition = '';
			switch($data->condition_id) {
				case 1:
					$condition = 'old';
					break;
				default:
					$condition = 'new';
			}
		} ?>
		<span class="condition<?php echo isset($condition) ? ' ' . $condition : ''; ?>">
			<?php if($data->condition_id != null): ?>
			<span><?php echo CHtml::encode($data->condition->title); ?></span>
			<?php endif; ?>
		</span>

	</div>

</div>

<?php if($index % $options['grid']['itemsPerRow'] == $options['grid']['itemsPerRow'] - 1 || $index == $widget->dataProvider->getItemCount() - 1): ?>
</div><!-- END ROW -->
<?php endif; ?>
