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
							'of' => '#search .input-text',
							'collision' => 'fit',
						),
					),
				)); ?>
				<span class="placeholder"><i class="fa fa-search"></i> <?php echo $this->model_itemSearchForm->getAttributeLabel('keywords'); ?></span>
			</div>

			<?php
			if(isset($_GET['wanted'])) {
				echo CHtml::hiddenField('wanted', false, array('id' => false));
			}
			if(isset($_GET['course'])) {
				echo CHtml::hiddenField('course', $_GET['course'], array('id' => false));
			}
			if(isset($_GET['price-max'])) {
				echo CHtml::hiddenField('price-max', $_GET['price-max'], array('id' => false));
			}
			if(isset($_GET['category'])) {
				echo CHtml::hiddenField('category', $_GET['category'], array('id' => false));
			}
			if(isset($_GET['sort'])) {
				echo CHtml::hiddenField('sort', $_GET['sort'], array('id' => false));
			}
			?>

		<?php echo !isset($lt_ie_8) ? '</div>' : '</td>'; ?>

		<?php echo !isset($lt_ie_8) ? '<div class="td right">' : '<td class="td right">'; ?>
			<?php echo CHtml::linkButton('<i class="fa fa-search"></i> <span>Go!</span>', array('class' => 'g-button submit')); ?>
			<?php echo CHtml::submitButton('Go!'); ?>
		<?php echo !isset($lt_ie_8) ? '</div>' : '</td>'; ?>

	<?php echo !isset($lt_ie_8) ? '</div>' : '</tr>'; ?>

<?php echo !isset($lt_ie_8) ? '</div>' : '</table>'; ?>
