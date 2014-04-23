<?php
$this->pageTitle=Yii::app()->name . ' - Search Results for ' . ucwords($this->model_itemSearchForm->keywords);

$this->layout = 'column1';
?>

<div id="item_search">

<div class="row">
	<div class="col-md-12 col-lg-8">

		<h2>Search Results for <?php echo ucwords(CHTML::encode($this->model_itemSearchForm->keywords)); ?></h2>

		<?php $this->renderPartial('/item/_index', array(
			'dataProvider' => $dataProvider,
			'options' => array(
				'toolbox' => array(
					'viewButton' => false,
					'sortButton' => false,
				),
			),
		)); ?>

	</div>
</div>

</div><!-- #item_search -->
