<div class="view">

<?php $image = $data->getImage() ?>
<?php echo CHtml::link(
	CHtml::image(
		'/images/transparent.gif',
		CHtml::encode($data->title),
		array('style'=>'background-image: url(/images/slir/w40-h36-c40.36-b000000'.($image ? $image['path'] : '/images/item/no-image.gif').')')
	),
	array('/item/view', 'id'=>$data->id),
	array('class'=>'img')
); ?>

<strong><?php echo CHtml::link(CHtml::encode($data->title), array('/item/view', 'id'=>$data->id), array('title'=>$data->title)) ?></strong>

</div><!-- .view -->

<?php /*
.view
	:php
		$image = Yii::app()->db->createCommand()
			->select('id')
			->from('item_image')
			->where('item_id=:id and `index`=0', array(':id'=>$data->id))
			->queryRow();
		echo CHtml::link(
			CHtml::image(
				'/images/transparent.gif',
				CHtml::encode($data->title),
				array('title'=>$data->description, 'style'=>'background-image: url(/images/slir/w155-h120-c155:120-be8e8e3'.($image ? db_image('item_image', $image['id']) : '/images/item/no-image.gif').')')
			),
			array('/item/view', 'id'=>$data->id),
			array('class'=>'img')
		);
	%strong =CHtml::link(CHtml::encode($data->title), array('/item/view', 'id'=>$data->id), array('title'=>$data->title))
	%em =$data->category_id ? CHtml::encode($data->category->title) : ''
	%span.price P #{number_format($data->price)}
	.clear
	-if($data->user->location):
	%span.location =$data->user->location->name
	-endif
	:php
		if($data->condition_id != null) {
			$condition = '';
			switch($data->condition_id) {
				case 1:
					$condition = 'old';
					break;
				default:
					$condition = 'new';
			}
	%span.condition.#{$condition} =CHtml::encode($data->condition->title)
	:php
		}
*/ ?>