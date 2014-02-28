<?php $this->beginContent('//layouts/main') ?>

<div id="column3">

<div class="row">
	<div class="col-md-6 col-md-push-3">

		<div id="content">

			<?php if(isset($this->breadcrumbs)) {
				$this->widget('zii.widgets.CBreadcrumbs', array(
					'links' => $this->breadcrumbs,
					'separator' => ' &#160; / &#160; ',
				));
			} ?>

			<?php echo $content ?>

		</div><!-- #content -->

	</div>
	<div class="col-md-3 col-md-pull-6">

		<aside id="sidebar-left">

			<?php echo $this->clips['sidebar-left']; ?>

			<?php $this->beginWidget('zii.widgets.CPortlet', array(
					'title' => 'Operations',
			)) ?>

			<?php $this->widget('zii.widgets.CMenu', array(
				'items' => $this->menu,
				'htmlOptions' => array('class' => 'operations'),
			)) ?>

			<?php $this->endWidget(); ?>

		</aside><!-- #sidebar-left -->

	</div>
	<div class="col-md-3">

		<aside id="sidebar-right">

			<?php echo $this->clips['sidebar-right'] ?>

		</aside><!-- #sidebar-right -->

	</div>
</div>

</div><!-- #column3 -->

<?php $this->endContent(); ?>
