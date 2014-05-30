<?php
$this->pageTitle = Yii::app()->name;

$this->layout = 'column1';
?>

<div id="site_index">

<?php if(Yii::app()->user->isGuest): ?>
<div class="alert alert-warning alert-dismissable intro">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<h4><?php echo Yii::app()->params['tagline']; ?></h4>
	<div class="call-to-action">
	<?php echo CHtml::link('Post an item to sell', array('/post/'), array('class' => 'g-button--primary')); ?>
	</div>
	<p><span class="small">Already a member? <?php echo CHtml::link('Login', array('/login')); ?></span></p> 
</div>
<?php endif; ?>

<?php if(Yii::app()->user->isGuest): ?>
<div class="h2"><h2>Freebies</h2><?php echo CHtml::link('See all', array('/item/search', 'price-max' => 0), array('class' => 'seeAll')); ?></div>
<?php else: ?>
<div class="h2">Latest freebies<h2></h2> <?php echo CHtml::link('See all', array('/item/search', 'price-max' => 0), array('class' => 'seeAll')); ?></div>
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

<div id="site_index-search"><?php $this->renderPartial('/layouts/_site_index-search'); ?></div>

<?php $this->endWidget(); ?>

<?php if(Yii::app()->user->isGuest): ?>
<div class="h2"><h2>Course materials</h2> <?php echo CHtml::link('See all', array('/item/search', 'course' => ''), array('class' => 'seeAll')); ?></div>
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
