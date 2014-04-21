<?php echo !isset($lt_ie_8) ? '<div class="table">' : '<table class="table" cellspacing="0">'; ?>

	<?php echo !isset($lt_ie_8) ? '<div class="tr">' : '<tr class="tr">'; ?>

		<?php echo !isset($lt_ie_8) ? '<div class="td left">' : '<td class="td left">'; ?>
			<div class="input-text">
				<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
					'model' => $this->model_itemSearchForm,
					'attribute' => 'keywords',
					'sourceUrl' => array('/item/search_autocomplete'),
					'options' => array(
						'appendTo' => '#search .input-text',
						'minLength' => 2,
						'position' => array(
							'of' => '.input-text',
							'collision' => 'fit',
						),
					),
				)); ?>
				<span class="placeholder"><i class="fa fa-search"></i> <?php echo $this->model_itemSearchForm->getAttributeLabel('keywords'); ?></span>
			</div>
		<?php echo !isset($lt_ie_8) ? '</div>' : '</td>'; ?>

		<?php echo !isset($lt_ie_8) ? '<div class="td right">' : '<td class="td right">'; ?>
			<?php echo CHtml::linkButton('<i class="fa fa-search"></i> <span>Go!</span>', array('class' => 'g-button submit')); ?>
			<?php echo CHtml::submitButton('Go!'); ?>
		<?php echo !isset($lt_ie_8) ? '</div>' : '</td>'; ?>

	<?php echo !isset($lt_ie_8) ? '</div>' : '</tr>'; ?>

<?php echo !isset($lt_ie_8) ? '</div>' : '</table>'; ?>