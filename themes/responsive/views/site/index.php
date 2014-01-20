<?php
$this->pageTitle = Yii::app()->name;

$this->layout = 'column2';
?>

<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'sidebar')); ?>

<div id="site_index-sidebar">
	<div class="about"></div>
</div>

<?php $this->endWidget(); ?>

<div id="site_index">
	<h2>Featured Ads</h2>
	<?php $this->renderPartial('/item/_index', array(
		'dataProvider' => $dataProvider_featured,
		'options' => array(
			'toolbox' => array(
				'viewButton' => true,
				'sortButton' => true,
			),
		),
	)); ?>
	<div class="latest">
		<h3>Latest Ads</h3>
		<?php $this->renderPartial('/item/_index', array(
			'dataProvider' => $dataProvider_latest,
			'options' => array(
				'toolbox' => array(
					'viewButton' => false,
					'sortButton' => false,
				),
			),
		)); ?>
	</div>
</div>

<?php /*
:php
	Yii::app()->clientScript->registerScript(
		'index',
		"
		/*
		$(window)
			.resize(function() {
				switch($('#yw0').width()) {
					case 917:
						if($('div.view', '#yw0').size() != 5)
							$.fn.yiiListView.update('yw0', {data: {ajax_pageSize: 5}});
						break;
					case 732:
						if($('div.view', '#yw0').size() != 4)
						$.fn.yiiListView.update('yw0', {data: {ajax_pageSize: 4}});
					default:
				}
			})
			.resize();
		*/
/*
		",
		CClientScript::POS_READY
	);
*/
