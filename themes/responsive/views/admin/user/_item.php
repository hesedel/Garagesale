<div class="g-userItemView<?php echo $data->getExpiry() ? '' : ' expired' ?>">

<?php	echo CHtml::link(
	CHtml::image(
		'/img/vendor/slir/w40-h36-c40x36' . $data->getImage(),
		CHtml::encode($data->title),
		array('title' => $data->description)
	),
	array('/item/view', 'id' => $data->id),
	array('class' => 'img')
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
<span class="expiration">expires in <em><?php echo time_word($data->getExpiry(), 'DAY') ?></em></span>
<?php else: ?>
<span class="expiration">expired</span>
<?php endif ?>

<span class="caret"><span></span></span>

</div><!-- .view -->
