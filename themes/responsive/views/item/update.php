<?php
$this->pageTitle=Yii::app()->name . ' - Update Ad ' . $model->id;
$this->breadcrumbs=array(
	'Ads'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Item', 'url'=>array('index')),
	array('label'=>'Create Item', 'url'=>array('create')),
	array('label'=>'View Item', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Item', 'url'=>array('admin')),
);
?>

<div class="g-form" id="item_update">

	<h2>Update Ad <?php echo $model->id; ?></h2>

	<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>