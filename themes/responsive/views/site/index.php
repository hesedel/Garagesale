<?php
$this->pageTitle = Yii::app()->name;

$this->layout = 'column1';
?>

<div id="site_index">

<?php if(Yii::app()->user->isGuest): ?>
<div class="alert alert-warning alert-dismissable intro">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<h2>Buy, Sell or give-it-away</h2>
	<p>Quickly buy or sell to students and staff on your campus.</p>
	<p>Save Money on your course materials<br>
	Support your local student community<br>
	<em>And find free stuff!</em></p>
	<div class="call-to-action">
	<?php echo CHtml::link('Join our Community', array('/site/register'), array('class' => 'g-button--primary')); ?>
	</div>
</div>
<?php endif; ?>

<?php if(Yii::app()->user->isGuest): ?>
<div class="h2"><h2>Stycle freebies</h2> <?php echo CHtml::link('See all', array('/item/search', 'price-max' => 0), array('class' => 'seeAll')); ?></div>
<?php else: ?>
<div class="h2">Latest freebies from your Uni<h2></h2> <?php echo CHtml::link('See all', array('/item/search', 'price-max' => 0), array('class' => 'seeAll')); ?></div>
<?php endif; ?>
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

<?php if(Yii::app()->user->isGuest): ?>
<div class="h2"><h2>Course materials and supplies</h2> <?php echo CHtml::link('See all', array('#'), array('class' => 'seeAll')); ?></div>
<?php else: ?>
<div class="h2"><h2>Latest from your area of study</h2> <?php echo CHtml::link('See all', array('/item/search', 'course' => Yii::app()->params['user']->course_id), array('class' => 'seeAll')); ?></div>
<?php endif; ?>
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

<?php if(Yii::app()->user->isGuest): ?>
<div class="h2"><h2>Popular items</h2> <?php echo CHtml::link('See all', array('#'), array('class' => 'seeAll')); ?></div>
<?php $this->renderPartial('/item/_index', array(
	'dataProvider' => $dataProvider_popular,
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
<?php else: ?>
<div class="h2"><h2>Something a little odd...</h2> <?php echo CHtml::link('See all', array('#'), array('class' => 'seeAll')); ?></div>
<?php $this->renderPartial('/item/_index', array(
'dataProvider' => $dataProvider_odd,
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
<?php endif; ?>

</div><!-- #site_index -->
