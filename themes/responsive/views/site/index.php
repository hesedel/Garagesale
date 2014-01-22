<?php
$this->pageTitle = Yii::app()->name;

$this->layout = 'column2';
?>

<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'sidebar')); ?>

<div id="site_index-sidebar">
	
</div>

<?php $this->endWidget(); ?>

<div id="site_index">
	<h2>Featured Ads</h2>
	<?php $this->renderPartial('/item/_index', array(
		'dataProvider' => $dataProvider_featured,
		'options' => array(
			'toolbox' => array(
				'viewButton' => false,
				'sortButton' => false,
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
				'view' => 'list',
			),
		)); ?>
	</div>
</div>
