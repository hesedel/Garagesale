<?php $this->beginContent('//layouts/main'); ?>

<div id="column1">

	<div id="content">

		<?php /* if(isset($this->breadcrumbs)) {
			$this->widget('zii.widgets.CBreadcrumbs', array(
				'links' => $this->breadcrumbs,
				'separator' => ' &#160; / &#160; ',
			));
		}; */ ?>

		<?php echo $content; ?>

	</div>

</div><!-- #column1 -->

<?php $this->endContent(); ?>
