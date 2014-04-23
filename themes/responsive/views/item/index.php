<?php
$this->pageTitle=Yii::app()->name . ' - Items';
$this->breadcrumbs=array(
	'Items',
);

$this->menu=array(
	array('label'=>'Create Item', 'url'=>array('create')),
	array('label'=>'Manage Item', 'url'=>array('admin')),
);
?>

<div id="item_index">
	<br><br>
	<?php $this->renderPartial('/item/_index', array(
		'dataProvider'=>$dataProvider,
		'options'=>array(
			'grid'=>array(
				'itemsPerRow'=>4,
			),
		),
	)); ?>
</div>
