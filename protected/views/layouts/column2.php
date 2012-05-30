<?php $this->beginContent('//layouts/main') ?>

<div id="column2">

<div id="content-container">

	<div id="content">

		<?php if(isset($this->breadcrumbs)) {
			$this->widget('zii.widgets.CBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
				'separator'=>' &#160; / &#160; ',
			));
		} ?>

		<?php echo $content ?>

	</div><!-- #content -->

</div><!-- #content-container -->

<div id="sidebar">

	<?php echo $this->clips['sidebar'] ?>

	<?php $this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Operations',
	)) ?>

	<?php $this->widget('zii.widgets.CMenu', array(
		'items'=>$this->menu,
		'htmlOptions'=>array('class'=>'operations'),
	)) ?>

	<?php $this->endWidget() ?>

</div><!-- #sidebar -->

<div class="clear"></div>

</div><!-- #column2 -->

<?php $this->endContent() ?>