<?php
$this->pageTitle=Yii::app()->name . ' - ' . $model->id;
$this->breadcrumbs=array(
	//'Users'=>array('index'),
	$model->id,
);

$this->layout='column3';
?>

<?php $this->beginWidget('system.web.widgets.CClipWidget', array('id'=>'sidebar-left')); ?>

<div id="user_view-sidebar-left">

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
			%th item_view-sidebar-right
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
	<!-- Needs to be inline span (or change div to display:inline-block; -->

<div id="user-view-header">
	<?php
		if($model->image)
			echo CHtml::image('/img/vendor/slir/w263-be8e8e3'.$model->getImage(), $model->id, array('class'=>'image profileImg'));
		else
			$this->renderPartial('_noImage');
	?>
	<div id="user-view-header-content">
		<h3> 
			<?php echo $model->name_first; ?>
		</h3>
		<p><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></p>
		<p>Joined: <?php echo time_local($model->created); ?></p>
	</div>
</div>
<div>
	<hr />
	<?php $params = array('User'=>$model); ?>

	<p><?php echo $model->university->parent_id ? $model->university->parent->title : $model->university->title; ?></p>
	<p>Insert Campus</p> 
	<p>Insert Area of Study</p> 	
	<p>Insert quirky fact details</p>
	<p><?php if($model->id === Yii::app()->user->id || Yii::app()->user->checkAccess('admin') || Yii::app()->user->checkAccess('super')): ?><?php echo $model->getAttributeLabel('email'); ?>: <?php echo $model->email; ?></p>
	<?php echo $model->getAttributeLabel('phone'); ?>: <?php echo $model->phone; ?>
</div>
<hr />
	<div class="g-actions btn-group"><?php echo CHtml::link('Reset password', array('account'), array('class' => 'btn btn-default'));?><?php
		if(Yii::app()->user->checkAccess('updateSelf',$params) && !Yii::app()->user->checkAccess('super'))
			echo CHtml::link('Update profile', array('account'), array('class' => 'btn btn-default'));
		if((Yii::app()->user->checkAccess('admin') && !sizeof(preg_grep('/admin|super/', array_keys(Yii::app()->authManager->getRoles($model->id))))) || Yii::app()->user->checkAccess('super'))
			echo CHtml::link('Update profile', array('update', 'id'=>$model->id), array('class' => 'btn btn-default'));
		if((Yii::app()->user->checkAccess('admin') && !sizeof(preg_grep('/admin|super/', array_keys(Yii::app()->authManager->getRoles($model->id))))) || Yii::app()->user->checkAccess('super'))
			echo CHtml::link('Delete', '#', array('class' => 'btn btn-default', 'submit'=>array('delete', 'id'=>$model->id), 'confirm'=>'Are you sure you want to delete this user?'));
	?>
	<?php endif; ?></div>
<hr />
<h4>Items for sale</h4>

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
