<div class="view<?php echo $data->getExpiry() ? '' : ' expired' ?>">

<?php $image = $data->getImage() ?>
<?php echo CHtml::link(
	CHtml::image(
		'/images/transparent.gif',
		CHtml::encode($data->title),
		array('style'=>'background-image: url(/images/slir/w40-h36-c40.36'.($image ? $image['path'] : '/images/item/no-image.gif').')')
	),
	array('/item/view', 'id'=>$data->id),
	array('class'=>'img')
); ?>

<strong><?php echo CHtml::link(CHtml::encode($data->title), array('/item/view', 'id'=>$data->id), array('title'=>$data->title)) ?></strong>

<?php if($data->category_id): ?>
<em><?php echo CHtml::encode($data->category->title) ?></em>
<span class="divider">|</span>
<?php endif ?>

<span class="price">P <?php echo number_format($data->price) ?></span>

<?php if($data->user->location): ?>
<span class="divider">|</span>
<span class="location"><?php echo $data->user->location->name ?></span>
<?php endif ?>

<?php if($data->condition_id != null): ?>
<span class="divider">|</span>
<?php
$condition = '';
switch($data->condition_id) {
	case 1:
		$condition = 'old';
		break;
	default:
		$condition = 'new';
}
?>
<span class="condition <?php echo $condition ?>"><?php echo CHtml::encode($data->condition->title) ?></span>
<?php endif ?>

<?php if($data->getExpiry()): ?>
<span class="expiration">expires in <em><?php echo time_word($data->getExpiry(), 'DAY'); ?></em></span>
<?php else: ?>
<span class="expiration">expired</span>
<?php endif ?>

<span class="caret"><span></span></span>

</div><!-- .view -->