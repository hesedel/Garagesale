<?php
$this->pageTitle = Yii::app()->name;

$this->layout = 'column1';
?>

<div id="site_index">

<div class="row">
	<div class="col-md-12 col-lg-8">

		<?php $this->renderPartial('/item/_index', array(
			'dataProvider' => $dataProvider_featured,
			'options' => array(
				'toolbox' => array(
					'viewButton' => false,
					'sortButton' => false,
				),
			),
		)); ?>

	</div>
	<aside class="col-md-4 col-md-push-8 col-lg-4 col-lg-push-0">

		...

	</aside>
	<div class="col-md-8 col-md-pull-4 col-lg-8 col-lg-pull-0">

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
