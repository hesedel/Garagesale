<?php $this->beginContent('//layouts/main') ?>

<div class="Column3">

<div class="row">
	<div class="col-md-6 col-md-push-3">

		<div class="Content">

			<?php if(isset($this->breadcrumbs)) {
				$this->widget('zii.widgets.CBreadcrumbs', array(
					'links' => $this->breadcrumbs,
					'separator' => ' &#160; / &#160; ',
				));
			} ?>

			<?php echo $content ?>

		</div><!-- .Content -->

	</div>
	<div class="col-md-3 col-md-pull-6">

		<aside class="Sidebar-left">

			<?php echo $this->clips['sidebar-left']; ?>

			<?php $this->beginWidget('zii.widgets.CPortlet', array(
					'title' => 'Operations',
			)) ?>

			<?php $this->widget('zii.widgets.CMenu', array(
				'items' => $this->menu,
				'htmlOptions' => array('class' => 'operations'),
			)) ?>

			<?php $this->endWidget(); ?>

		</aside><!-- .Sidebar-left -->

	</div>
	<div class="col-md-3">

		<aside class="Sidebar-right">

			<?php echo $this->clips['sidebar-right'] ?>

		</aside><!-- .Sidebar-right -->

	</div>
</div>

</div><!-- .Column3 -->

<?php $this->endContent(); ?>
