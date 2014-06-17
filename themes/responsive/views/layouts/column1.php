<?php $this->beginContent('//layouts/main'); ?>

<div class="Column1">

<div class="Content">

	<?php if(isset($this->breadcrumbs)) {
		$this->widget('zii.widgets.CBreadcrumbs', array(
			'links' => $this->breadcrumbs,
			'separator' => ' &#160; / &#160; ',
		));
	}; ?>

	<?php echo $content; ?>

</div><!-- .Content -->

</div><!-- .Column1 -->

<?php $this->endContent(); ?>
