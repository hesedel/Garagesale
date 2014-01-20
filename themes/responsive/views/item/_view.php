<div class="view-container<?php echo $index % $options['grid']['itemsPerRow'] == 0 ? ' clear-left' : ''; ?>" style="width: <?php echo 100 / $options['grid']['itemsPerRow']; ?>%">

<div class="view">
	<?php
	$image = Yii::app()->db->createCommand()
		->select('id')
		->from('item_image')
		->where('item_id=:id and `index`=0', array(':id' => $data->id))
		->queryRow();

	echo CHtml::link(
		CHtml::image(
			'/img/vendor/slir/w276-h216-c138x108-be8e8e3' . ($image ? db_image('item_image', $image['id']) : '/img/item/no-image.gif'),
			CHtml::encode($data->title),
			array('title' => $data->description)
		),
		array('/item/view', 'id' => $data->id),
		array('class' => 'img')
	);
	?>

	<strong><?php echo CHtml::link(CHtml::encode($data->title), array('/item/view', 'id' => $data->id), array('title' => $data->title)); ?></strong>

	<em<?php echo $data->category_id ? ' title="' . CHtml::encode($data->category->title) . '"' : ''; ?>><?php echo $data->category_id ? CHtml::encode($data->category->title) : ''; ?></em>

	<span class="price">P <?php echo number_format($data->price); ?></span>

	<span class="location"><?php echo $data->user->location ? $data->user->location->name : ''; ?></span>

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
