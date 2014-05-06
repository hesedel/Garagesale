<?php
$this->pageTitle = Yii::app()->name;

$this->layout = 'column1';
?>

<div id="site_index">


	<div class="alert alert-danger fade in">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
	&times;</button>
	<div class="h2"><h4>Buy, Sell or give-it-away</h4>
	<p>Quickly buy or sell to students on your campus. <br> Save Money on your course materials<br>
	Support your local student community <br><i> And find free stuff!</i></p>
</div>
</div>
</div>



<div class="h2"><h2>Latest freebies</h2> <?php echo CHtml::link('See all', array('#'), array('class' => 'seeAll')); ?></div>

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

<div class="h2"><h2>Latest from your course</h2> <?php echo CHtml::link('See all', array('#'), array('class' => 'seeAll')); ?></div>
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

<div class="h2"><h2>Recently viewed by your classmates</h2> <?php echo CHtml::link('See all', array('#'), array('class' => 'seeAll')); ?></div>
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
