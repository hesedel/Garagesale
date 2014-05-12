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

	<?php if(count($images) > 1): ?>
	<div class="hes-slider-prev"><span>&lsaquo;</span><div></div></div>
	<div class="hes-slider-next"><span>&rsaquo;</span><div></div></div>
	<?php endif; ?>

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

<header class="header">
	<h1><?php echo CHtml::encode($model->title); ?></h1>
	<span class="price">AU$ <?php echo number_format($model->price); ?></span>
</header>

<?php if($model->userCanUpdate() || $model->userCanDelete()): ?>
<div class="actions">

	<?php echo $model->userCanUpdate() ? CHtml::link('<i class="fa fa-pencil"></i> Edit', array('update', 'id' => $model->id), array('class' => 'g-button')) : ''; ?>

	<?php echo $model->userCanDelete() ? CHtml::link('<i class="fa fa-trash-o"></i> Delete', '#', array('class' => 'g-button', 'submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')) : ''; ?>

</div>
<?php endif; ?>

<div class="social-share">

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-type="button_count"></div>

	<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

</div>

<?php
$info = array();
//$info[$model->getAttributeLabel('created') . ' on'] = time_local($model->created);
//$info[$model->getAttributeLabel('updated') . ' on'] = time_local($model->updated);
//$info['Expires on'] = time_local($model->updated, array('offset' => 60*24*60*60)); // 60 days
if($model->condition_id)
	$info[$model->getAttributeLabel('condition')] = $model->condition->title;
if($model->user->location_id)
	$info['Collection'] = $model->user->location->name;
$info['Seller'] = CHtml::link(
	$model->user->name_first,
	array(
		'/admin/user/view',
		'id' => $model->user_id,
	)
);
?>
<table class="info" cellspacing="0">
	<tbody>
		<?php $i = 0; foreach($info as $key => $value) { ?>
		<?php if($i % 2 == 0): ?><tr><?php endif; ?>
			<th><?php echo $key; ?></th>
			<td colspan="3"><?php echo $value; ?></td>
		<?php $i++; ?>
		<?php if($i % 1 == 0 || $i == sizeof($info)): ?></tr><?php endif; ?>
		<?php } ?>
	</tbody>
	<tfoot>
		<tr>
			<th class="created">Listed</th>
			<td class="created"><time class="timeago" datetime="<?php echo date('Y-m-d H:i:sO', strtotime($model->updated)); ?>"><?php echo $model->getTimeAgo(); ?></time></td>
			<th class="views">Views</th>
			<td class="views">...</td>
		</tr>
	</tfoot>
</table>

<p class="description"><?php echo Yii::app()->format->formatNtext($model->description); ?></p>

<div class="tabs">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#item_view-collection" data-toggle="tab">Collection Details</a></li>
		<li><a href="#item_view-user" data-toggle="tab">Seller Info</a></li>
	</ul>

	<div class="tab-content">
		<div class="tab-pane active" id="item_view-collection">
			<table>
				<?php if($model->user->location_id): ?>
				<tr>
					<th>Location</th>
					<td><?php echo $model->user->location->name; ?></td>
				</tr>
				<?php endif; ?>
				<tr>
					<th>Time</th>
					<td>...</td>
				</tr>
				<tr>
					<th>Day</th>
					<td>...</td>
				</tr>
			</table>
		</div>
		<div class="tab-pane" id="item_view-user">
			<table>
				<tbody>
					<tr>
						<th>University</th>
						<td>...</td>
					</tr>
					<?php if($model->user->course_id): ?>
					<tr>
						<th>Area of Study</th>
						<td><?php echo $model->user->course->title; ?></td>
					</tr>
					<?php endif; ?>
					<tr>
						<th>Rating</th>
						<td>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star-half-o"></i>
							<i class="fa fa-star-o"></i>
							<i class="fa fa-star-o"></i>
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="2">
							<?php echo CHtml::link('Follow Seller', array('#'), array('class' => 'g-button')); ?>
							<?php echo CHtml::link('All Seller Items', array('#'), array('class' => 'g-button')); ?>
							<?php echo CHtml::link('Report Seller', array('#'), array('class' => 'g-button')); ?>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>

<?php $this->renderPartial('view/_sidebar-right', array(
	'model' => $model,
	'model_contactForm' => $model_contactForm,
	'model_contactForm_success' => $model_contactForm_success,
)); ?>

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
