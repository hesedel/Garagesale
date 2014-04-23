<?php
$defaults = array(
	'toolbox' => array(
		'viewButton' => true,
		'sortButton' => true,
	),
	'view' => 'grid',
	'grid' => array(
		'itemsPerRow' => 5,
	),
);
if(isset($options))
	$options = array_merge($defaults, $options);
else
	$options = $defaults;
?>

<div class="g-items<?php echo ($options['view'] === 'grid' ? ' grid' : ' list') . (!$options['toolbox']['viewButton'] && !$options['toolbox']['sortButton'] ? ' no-toolbox' : ''); ?>">

<?php if(true): ?>
<div class="toolbox">

	<?php if($options['toolbox']['viewButton']): ?>
		<a class="g-button" href="#"><i class="fa fa-th"></i> Grid</a>
		<a class="g-button" href="#"><i class="fa fa-th-list"></i> List</a>
	<?php endif; ?>

	<?php if($options['toolbox']['sortButton']): ?>
		<a class="g-button" href="#"><i class="fa fa-sort-amount-asc"></i> Sort</a>
	<?php endif; ?>

</div>
<?php endif; ?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider' => $dataProvider,
	'itemView' => '/item/_view',
	'viewData' => array('options' => $options),
	'template' => '{items}{pager}',
	'pager' => array(
		'header' => false,
		'htmlOptions' => array('class' => 'g-pager'),
		'firstPageLabel' => '‹‹',
		'prevPageLabel' => '‹',
		'nextPageLabel' => '›',
		'lastPageLabel' => '››',
		//'maxButtonCount' => 5,
	),
	'afterAjaxUpdate'=>"function(id) {
		$('time.timeago', '#' + id).timeago();
	}",
)); ?>

</div>
