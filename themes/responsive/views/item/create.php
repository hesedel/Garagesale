<?php
$this->pageTitle = Yii::app()->name . ' - Post a FREE Ad';
$this->breadcrumbs = array(
	'Items',
	'Post',
);

$this->menu = array(
	array('label'=>'List Item', 'url' => array('index')),
	array('label' => 'Manage Item', 'url' => array('admin')),
);
?>

<div class="g-form" id="item_create">

	<h2>List an item</h2>

	<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
</div>
