<?php
$this->pageTitle=Yii::app()->name . ' - ' . $model->id;
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

$this->layout='column3';

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id'=>'sidebar-left')); ?>

<div id="user_view-sidebar-left">
	<div class="g-sidebar-image"><?php
		if($model->image)
			echo CHtml::image('/img/vendor/slir/w263-be8e8e3'.$model->getImage(), $model->id, array('class'=>'image'));
		else
			$this->renderPartial('_noImage');
	?></div>

	<?php /*
	%table.info-ad
		%caption Ad Info
		%tr
			%th #{$model->getAttributeLabel('created')} on
			%td =time_local($model->created);
		%tr
			%th #{$model->getAttributeLabel('updated')} on
			%td =time_local($model->updated);
		%tr
			%th Expires on
			%td =time_local($model->updated, array('offset'=>(60*24*60*60)-(60*60))); // 60 days
		%tr
			%th Views
			%td ...
	*/ ?>
</div>

<?php $this->endWidget(); ?>

<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id'=>'sidebar-right')); ?>

<div id="item_view-sidebar-right">
	<?php /*
	.info-user
		%h2 User Info
		:php
			echo CHtml::link(
				CHtml::image('/img/transparent.gif'),
				array('/admin/user/view', 'id'=>$model->user_id),
				array('class'=>'image')
			);
		%span =CHtml::link($model->user_id, array('/admin/user/view', 'id'=>$model->user_id))
	*/ ?>
</div>

<?php $this->endWidget(); ?>

<div class="g-position-relative" id="user_view">

	<h2><?php echo $model->id; ?></h2>
	<?php $params = array('User'=>$model); ?>

	<div class="g-actions"><?php
		if(Yii::app()->user->checkAccess('updateSelf',$params) && !Yii::app()->user->checkAccess('super'))
			echo CHtml::link('Update', array('account'));
		if((Yii::app()->user->checkAccess('admin') && !sizeof(preg_grep('/admin|super/', array_keys(Yii::app()->authManager->getRoles($model->id))))) || Yii::app()->user->checkAccess('super'))
			echo CHtml::link('Update', array('update', 'id'=>$model->id));
		if((Yii::app()->user->checkAccess('admin') && !sizeof(preg_grep('/admin|super/', array_keys(Yii::app()->authManager->getRoles($model->id))))) || Yii::app()->user->checkAccess('super'))
			echo CHtml::link('Delete', '#', array('submit'=>array('delete', 'id'=>$model->id), 'confirm'=>'Are you sure you want to delete this user?'));
	?></div>

	<table class="g-table" cellspacing="1">
		<tr>
			<th><?php echo $model->getAttributeLabel('name_first'); ?></th>
			<td><?php echo $model->name_first; ?></td>
		</tr>
		<tr>
			<th><?php echo $model->getAttributeLabel('name_last'); ?></th>
			<td><?php echo $model->name_last; ?></td>
		</tr>
		<?php if($model->location_id): ?>
		<tr>
			<th><?php echo $model->getAttributeLabel('location_id'); ?></th>
			<td><?php echo $model->location->name; ?></td>
		</tr>
		<?php endif; ?>
		<?php if($model->id === Yii::app()->user->id || Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('super')): ?>
		<tr>
			<th><?php echo $model->getAttributeLabel('email'); ?></th>
			<td><?php echo $model->email; ?></td>
		<?php endif; ?>
		</tr>
		<tr>
			<th><?php echo $model->getAttributeLabel('phone'); ?></th>
			<td><?php echo $model->phone; ?></td>
		</tr>
		<tr>
			<th><?php echo $model->getAttributeLabel('created'); ?> On</th>
			<td><?php echo time_local($model->created); ?></td>
		</tr>
		<tr>
			<th>Last Logged-In On</th>
			<td>...</td>
		</tr>
	</table>
</div>
