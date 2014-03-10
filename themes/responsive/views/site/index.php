<?php
$this->pageTitle = Yii::app()->name;
$this->layout = 'column1';
?>

<div id="site_index">

<h2>Featured Items</h2>

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

			<h3>Latest Items</h3>

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

</div><!-- #site_index -->
