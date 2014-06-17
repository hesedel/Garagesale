<?php $this->beginContent('//layouts/main'); ?>

<div class="Column2">

<div class="row">
	<div class="col-md-9 col-md-push-3">

		<div class="Content">

			<?php if(isset($this->breadcrumbs)) {
				$this->widget('zii.widgets.CBreadcrumbs', array(
					'links' => $this->breadcrumbs,
					'separator' => ' &#160; / &#160; ',
				));
			}; ?>

			<?php echo $content; ?>

		</div><!-- .Content -->

	</div>
	<div class="col-md-3 col-md-pull-9">

		<aside class="Sidebar">

			<?php echo $this->clips['sidebar']; ?>

			<?php $this->beginWidget('zii.widgets.CPortlet', array(
					'title' => 'Operations',
			)); ?>

			<?php $this->widget('zii.widgets.CMenu', array(
				'items' => $this->menu,
				'htmlOptions' => array('class' => 'operations'),
			)); ?>

			<?php $this->endWidget(); ?>

		</aside><!-- .Sidebar -->

	</div>
</div>

</div><!-- .Column2 -->

<?php $this->endContent(); ?>
