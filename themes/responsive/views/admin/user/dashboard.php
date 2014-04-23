<?php
$this->pageTitle=Yii::app()->name . ' - Dashboard';
$this->breadcrumbs=array(
	'Dashboard'
);

$this->layout='column3';
?>

<div id="user_dashboard">

<h2>Your Ads</h2>

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

</div><!-- #user_dashboard -->
