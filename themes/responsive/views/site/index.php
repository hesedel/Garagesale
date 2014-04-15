<?php
$this->pageTitle = Yii::app()->name;

$this->layout = 'column1';
?>

<div id="site_index">

<h2>Latest freebies</h2>
<?php $this->renderPartial('/item/_index', array(
	'dataProvider' => $dataProvider_freebies,
	'options' => array(
		'toolbox' => array(
			'viewButton' => false,
			'sortButton' => false,
		),
		'grid' => array(
			'itemsPerRow' => 3,
		),
	),
)); ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	//'enableClientValidation'=>true,
	//'clientOptions'=>array(
	//	'validateOnSubmit'=>true,
	//),
	'action'=>array('/item/search'),
	'method'=>'get',
)); ?>

<div id="search"><?php $this->renderPartial('/layouts/_search'); ?></div>

<?php $this->endWidget(); ?>

<h2>Latest from your course</h2>
<?php $this->renderPartial('/item/_index', array(
	'dataProvider' => $dataProvider_course,
	'options' => array(
		'toolbox' => array(
			'viewButton' => false,
			'sortButton' => false,
		),
		'grid' => array(
			'itemsPerRow' => 3,
		),
	),
)); ?>

<h2>Recently viewed by your classmates</h2>
<?php $this->renderPartial('/item/_index', array(
	'dataProvider' => $dataProvider_classmates,
	'options' => array(
		'toolbox' => array(
			'viewButton' => false,
			'sortButton' => false,
		),
		'grid' => array(
			'itemsPerRow' => 3,
		),
	),
)); ?>

</div><!-- #site_index -->
