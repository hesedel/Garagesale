<?php
$this->pageTitle = Yii::app()->name . ' - ' . $model->title;

$this->breadcrumbs = array(
	'Items' => array('index'),
);

if($model->user->location) {
	$this->breadcrumbs[] = $model->user->location->name;
}

if($model->category_id != null) {
	$this->breadcrumbs = array_merge($this->breadcrumbs, $model->getCategories());
}

$this->breadcrumbs[] = 'Ad ID ' . $model->id;

$this->layout = 'column1';

/*
$this->menu=array(
	array('label'=>'List Item', 'url'=>array('index')),
	array('label'=>'Create Item', 'url'=>array('create')),
	array('label'=>'Update Item', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Item', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Item', 'url'=>array('admin')),
);
*/
?>

<div id="item_view">

<table class="header" cellspacing="0">
	<thead>
		<tr>

			<th><h1><?php echo CHtml::encode($model->title); ?></h1></th>

			<td><span class="price">PHP <?php echo number_format($model->price); ?></span></td>

		</tr>
	</thead>
	<tbody>
		<tr>
			<th>

				<span><i class="fa fa-clock-o"></i> <time class="timeago" datetime="<?php echo date('Y-m-d H:i:sO', strtotime($model->updated)); ?>"><?php echo $model->getTimeAgo('updated'); ?></time></span>

				<?php if($model->user->location): ?>
				<span><i class="fa fa-map-marker"></i> <?php echo $model->user->location->name; ?></span>
				<?php endif; ?>

			</th>
			<td>

				<?php if($model->condition_id != null): ?>
				<span class="condition <?php echo $model->getConditionClass(); ?>"><?php echo $model->condition->title; ?></span>
				<?php endif; ?>

			</td>
		</tr>
	</tbody>
</table>

<div class="row">
	<div class="col-md-8">

		<?php if($images = $model->getImages()): ?>

		<div class="hes-slider img">
			<div class="hes-slider-scroll">
				<div class="hes-slider-slides"><!--

					<?php foreach($images as $image): ?>
					--><div class="hes-slider-slide"><div>
						<?php echo CHtml::link(
							CHtml::image(
								'/img/vendor/slir/w1234-h774-c1234x774-bfff' . $image['path'],
								$image['id'] . '.' . $image['type'],
								array(
									'title' => 'click to enlarge photo',
								)
							),
							'/img/vendor/slir/w510-bfff' . $image['path'],
							array('class' => 'lightbox')
						); ?>
					</div></div><!--
					<?php endforeach; ?>

				--></div>
			</div>

			<div class="hes-slider-prev"><span>&lsaquo;</span><div></div></div>
			<div class="hes-slider-next"><span>&rsaquo;</span><div></div></div>

		</div>

		<div class="hes-slider imgs">
			<div class="hes-slider-scroll">
				<div class="hes-slider-slides"><!--

					<?php foreach($images as $image): ?>
					--><div class="hes-slider-slide"><div>
						<?php echo CHtml::link(
							CHtml::image(
								'/img/vendor/slir/w246-h246-c246x246-bfff' . $image['path'],
								$image['id'] . '.' . $image['type'],
								array(
									'title' => 'click to enlarge photo',
								)
							),
							'/img/vendor/slir/w510-bfff' . $image['path'],
							array('class' => 'lightbox')
						); ?>
					</div></div><!--
					<?php endforeach; ?>

				--></div>
			</div>

			<div class="hes-slider-prev"><span>&lsaquo;</span><div></div></div>
			<div class="hes-slider-next"><span>&rsaquo;</span><div></div></div>

		</div>

		<?php endif; ?>

	</div>
	<div class="col-sm-6 col-md-8">

		<?php
		$info = array();
		$info[$model->getAttributeLabel('created') . ' on'] = time_local($model->created);
		$info[$model->getAttributeLabel('updated') . ' on'] = time_local($model->updated);
		$info['Expires on'] = time_local($model->updated, array('offset' => 60*24*60*60)); // 60 days
		?>
		<table class="info" cellspacing="0">
			<?php $i = 0; foreach($info as $key => $value) { ?>
			<?php if($i % 2 == 0): ?><tr><?php endif; ?>
				<th><?php echo $key; ?></th>
				<td><?php echo $value; ?></td>
			<?php $i++; ?>
			<?php if($i % 2 == 0 || $i == sizeof($info)): ?></tr><?php endif; ?>
			<?php } ?>
		</table>

		<p class="description"><?php echo Yii::app()->format->formatNtext($model->description); ?></p>

	</div>
	<aside class="col-sm-6 col-md-4">

		<?php $this->renderPartial('view/_sidebar-right', array(
			'model' => $model,
			'model_contact' => $model_contact,
			'model_contact_success' => $model_contact_success,
		)); ?>

	</aside>
</div>

</div><!-- #item_view -->

<?php Yii::app()->clientScript->registerScript('item_view',
	"
	$('a.lightbox', '#item_view').lightBox( {
		//overlayBgColor: '#',
		//overlayOpacity: .25,
		imageLoading: '/images/lightbox-ico-loading.gif',
		imageBtnClose: '/images/lightbox-btn-close.gif',
		imageBtnPrev: '/images/lightbox-btn-prev.gif',
		imageBtnNext: '/images/lightbox-btn-next.gif'
		//containerResizeSpeed: 1000,
		//txtImage: '',
		//txtOf: ''
	});
	$('a.lightbox', '#item_view-sidebar-left').lightBox( {
		//overlayBgColor: '#',
		//overlayOpacity: .25,
		imageLoading: '/images/lightbox-ico-loading.gif',
		imageBtnClose: '/images/lightbox-btn-close.gif',
		imageBtnPrev: '/images/lightbox-btn-prev.gif',
		imageBtnNext: '/images/lightbox-btn-next.gif'
		//containerResizeSpeed: 1000,
		//txtImage: '',
		//txtOf: ''
	});
	",
CClientScript::POS_READY);
