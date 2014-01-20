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
		'itemView' => $options['view'] === 'grid' ? '/item/_view-grid' : '/item/_view-list',
		'viewData' => array('options' => $options),
		'template' => '{items}{pager}',
		'pager' => array(
			'header' => false,
			'htmlOptions' => array('class' => 'g-pager'),
			'firstPageLabel' => '‹‹',
			'prevPageLabel' => '‹',
			'nextPageLabel' => '›',
			'lastPageLabel' => '››',
			//'maxButtonCount' => 3,
		),
		/*
		'afterAjaxUpdate' => "function(id) {
			categoryEllipsis(id);
		}",
		*/
	)); ?>

</div>

<?php /*
:php
	Yii::app()->clientScript->registerScript(
		'item_index',
		"
		function categoryEllipsis(id) {
			$('em', $('div.g-items.grid #' + id + ' div.view')).each(function() {
				$(this).css( {
					width: $(this).parents('div.view').width() - $(this).siblings('span.price').outerWidth()
				});
			});
		}
		$('div.g-items.grid').each(function() {
			categoryEllipsis($(this).children('div.list-view').attr('id'));
		});
		
		/*
		$('abbr', 'div.g-items.list').timeago();
		
		setTimeout(function() {
			$('div.g-items.list').each(function() {
				var width_price = 0;
				$('div.view', $(this)).each(function() {
					if($('td.price', $(this)).width() > width_price)
						width_price = $('td.price', $(this)).width()
				});
				$('td.price', $(this)).css( {
					width: width_price
				});
				var width_condition = 0;
				$('div.view', $(this)).each(function() {
					if($('td.condition', $(this)).width() > width_condition)
						width_condition = $('td.condition', $(this)).width()
				});
				$('td.condition', $(this)).css( {
					width: width_condition
				});
				$('th, th strong', $(this)).css( {
					width: $('table', $(this)).width() - width_condition - width_price - 20
				});
			});
		}, 250);
		*/
/*
		",
		CClientScript::POS_READY
	);
*/
