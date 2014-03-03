<?php
$this->pageTitle=Yii::app()->name . ' - ' . $model->title;

$this->breadcrumbs=array(
	'Items' => array('index'),
	$model->id,
);

$this->layout='column3';

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
	<caption>Header</caption>
	<tr>
		<th><h1><?php echo CHtml::encode($model->title) ?></h1></th>
		<td>PHP <?php echo number_format($model->price) ?></td>
	</tr>
</table>

<?php $params = array('Item' => $model) ?>
<div class="g-actions">

	<?php echo $model->userCanUpdate() ? CHtml::link('<i class="icon-pencil"></i> Edit', array('update', 'id' => $model->id)) : '' ?>

	<?php echo $model->userCanDelete() ? CHtml::link('<i class="icon-trash"></i> Delete', '#', array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')) : '' ?>

</div><!-- .g-actions -->

<?php if($model->category_id != null || $model->user->location || $model->condition_id != null): ?>

<div class="tags">

	<?php if($model->category_id != null): ?>
	<span class="category"><i class="icon-tag"></i> <?php echo $model->getCategoriesString(array('separator' => ' &#160; / &#160; ')) ?></span>
	<?php endif ?>

	<?php if($model->user->location): ?>
	<span><i class="icon-map-marker"></i> <?php echo $model->user->location->name ?></span>
	<?php endif ?>

	<?php if($model->condition_id != null): ?>
	<span class="condition <?php echo $model->getConditionClass() ?>"><?php echo $model->condition->title ?></span>
	<?php endif ?>

</div><!-- .tags -->

<?php endif ?>

<?php $this->widget('zii.widgets.jui.CJuiTabs', array(
	'tabs'=>array(
		'Description + Photos' => $this->renderPartial('view/_description', array('model' => $model), true),
		//'Video' => '...',
		//'Map' => '...',
		//'Comments' => '...',
		'Contact' => '...',
	),
	'htmlOptions' => array('class' => 'g-tabs'),
	'headerTemplate' => '<li><a href="{url}">{title}</a></li>',
	'contentTemplate' => '<div id="{id}" class="tab-content">{content}</div>',
)); ?>

</div><!-- #item_view -->

<!-- sidebars -->
<?php $this->renderPartial('view/_sidebar-left', array('model' => $model)) ?>
<?php $this->renderPartial('view/_sidebar-right', array('model' => $model)) ?>

<?php Yii::app()->clientScript->registerScript('item_view',
	"
	$('h1', '#item_view table.header').css( {
		width: $('#item_view').width() - $('td', '#item_view table.header').outerWidth() - 30
	});
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
