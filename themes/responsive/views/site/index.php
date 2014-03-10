<?php
$this->pageTitle = Yii::app()->name;

$this->layout = 'column1';
?>

<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id' => 'sidebar')); ?>

<div id="site_index-sidebar">
	<div style="background-color: rgba(255, 255, 255, .1); height: 480px; border-radius: 4px;"></div>
</div>

<?php $this->endWidget(); ?>

<div id="site_index">
	<h2>Featured Items</h2>
	<div style="clear: both;"></div>
	<?php $this->renderPartial('/item/_index', array(
		'dataProvider' => $dataProvider_featured,
		'options' => array(
			'toolbox' => array(
				'viewButton' => false,
				'sortButton' => false,
			),
		),
	)); ?>
	<div class="row">
		<div class="col-md-8">
			<div class="latest">
				<h3>Latest Items</h3>
				<div style="clear: both;"></div>
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
	</div>
</div>
