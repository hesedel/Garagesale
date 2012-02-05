<?php
$this->breadcrumbs=array(
	'Items',
);

$this->menu=array(
	array('label'=>'Create Item', 'url'=>array('create')),
	array('label'=>'Manage Item', 'url'=>array('admin')),
);
?>

<h1>Items</h1>

<?php $this->renderPartial('/item/_index', array('dataProvider'=>$dataProvider)); ?>
