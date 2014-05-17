<?php
$this->pageTitle=Yii::app()->name . ' - Search Results for ' . ucwords($this->model_itemSearchForm->keywords);

//$this->breadcrumbs = array_merge($this->breadcrumbs, $categories);

$this->layout = 'column1';
?>

<div id="item_search">

<?php
$uri = Yii::app()->request->requestUri;
$value_prev = array('/item/search', 'category' => false);
foreach($categories as $key => $value) {
	if($value_prev['category'])
		$link = preg_replace('/(\?|\&)category=' . $_GET['category'] . '/', '$1category=' . $value_prev['category'], $uri);
	else
		$link = preg_replace('/(\?|\&)category=' . $_GET['category'] . '/', '', $uri);
	echo CHtml::link($key . ' <i class="fa fa-times"></i>', $link);
	$value_prev = $value;
}
?>

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
