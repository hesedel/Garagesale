<?php
//$this->pageTitle=Yii::app()->name . ' - ' . $model->title;

$this->breadcrumbs=array(
	'Ads' => array('index'),
	//$model->id,
);

$this->layout='column3';
?>

<div id="user_items">

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_item',
	'template'=>'{items}{pager}',
	'pager'=>array(
		'header'=>false,
		'htmlOptions'=>array('class'=>'g-pager'),
		'firstPageLabel'=>'‹‹',
		'prevPageLabel'=>'‹',
		'nextPageLabel'=>'›',
		'lastPageLabel'=>'››',
		//'maxButtonCount'=>3,
	)
)); ?>

</div><!-- #user_items -->