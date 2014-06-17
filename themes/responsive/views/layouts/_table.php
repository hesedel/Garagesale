<div class="Table-container"><div class="container">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'item-search-form',
	'action'=>array('/item/search'),
	'method'=>'get',
)); ?>

<?php echo !isset($lt_ie_8) ? '<div class="Table">' : '<table class="Table" cellspacing="0">'; ?>

	<?php echo !isset($lt_ie_8) ? '<div class="Table__tr">' : '<tr class="Table__tr">'; ?>

		<div class="XS-menu-toggle"><i class="XS-menu-toggle__icon fa fa-bars"></i></div>

		<?php // .Header ?>

		<?php echo !isset($lt_ie_8) ? '<header class="Table__td Header">' : '<td class="Table__td Header">'; ?>

			<?php echo $this->getRoute() !== 'item/view' ? '<h1 class="Header__h1">' : ''; ?>
				<?php echo CHtml::link(
					'Garagesale<span class="Header__a__tld">.ph</span>',
					'/',
					array('class' => 'Header__a')
				); ?>
			<?php echo $this->getRoute() !== 'item/view' ? '</h1>' : ''; ?>

			<span class="Header__version">alpha</span>

		<?php echo !isset($lt_ie_8) ? '</header>' : '</td>'; ?>

		<?php // .Header end ?>

		<?php // .XS-menu ?>

		<div class="XS-menu">
			<ul class="XS-menu__ul">
				<li class="XS-menu__li">
					<?php echo CHtml::link(
						'<i class="XS-menu__a-icon fa fa-thumb-tack"></i>' .
						'<span class="XS-menu__a-text">Post a FREE Ad</span>',
						array('/item/create'),
						array('class' => 'XS-menu__a')
					); ?>
				</li>
				<?php if(Yii::app()->user->isGuest): ?>
				<li class="XS-menu__li">
					<?php echo CHtml::link(
						'<i class="XS-menu__a-icon fa fa-thumbs-up"></i>' .
						'<span class="XS-menu__a-text">Register</span>',
						array('/site/register'),
						array('class' => 'XS-menu__a')
					); ?>
				</li>
				<li class="XS-menu__li">
					<?php echo CHtml::link(
						'<i class="XS-menu__a-icon fa fa-user"></i>' .
						'<span class="XS-menu__a-text">Login</span>',
						array('/site/login'),
						array('class' => 'XS-menu__a')
					); ?>
				</li>
				<?php else: ?>
				<li class="XS-menu__li">
					<?php echo CHtml::link(
						'<i class="XS-menu__a-icon fa fa-sign-out"></i>' .
						'<span class="XS-menu__a-text">Logout</span>',
						array('/site/logout'),
						array('class' => 'XS-menu__a')
					); ?>
				</li>
				<?php endif; ?>
			</ul>
			<ul class="XS-menu__ul">
				<li class="XS-menu__li">
					<a class="XS-menu__a" href="#">Menu Item 4</a>
				</li>
				<li class="XS-menu__li">
					<a class="XS-menu__a" href="#">Menu Item 5</a>
				</li>
				<li class="XS-menu__li">
					<a class="XS-menu__a" href="#">Menu Item 6</a>
				</li>
				<li class="XS-menu__li">
					<a class="XS-menu__a" href="#">Menu Item 7</a>
				</li>
				<li class="XS-menu__li">
					<a class="XS-menu__a" href="#">Menu Item 8</a>
				</li>
				<li class="XS-menu__li">
					<a class="XS-menu__a" href="#">Menu Item 9</a>
				</li>
				<li class="XS-menu__li">
					<a class="XS-menu__a" href="#">Menu Item 10</a>
				</li>
				<li class="XS-menu__li">
					<a class="XS-menu__a" href="#">Menu Item 11</a>
				</li>
				<li class="XS-menu__li">
					<a class="XS-menu__a" href="#">Menu Item 12</a>
				</li>
				<li class="XS-menu__li">
					<a class="XS-menu__a" href="#">Menu Item 13</a>
				</li>
				<li class="XS-menu__li">
					<a class="XS-menu__a" href="#">Menu Item 14</a>
				</li>
				<li class="XS-menu__li">
					<a class="XS-menu__a" href="#">Menu Item 15</a>
				</li>
				<li class="XS-menu__li">
					<a class="XS-menu__a" href="#">Menu Item 16</a>
				</li>
				<li class="XS-menu__li">
					<a class="XS-menu__a" href="#">Menu Item 17</a>
				</li>
				<li class="XS-menu__li">
					<a class="XS-menu__a" href="#">Menu Item 18</a>
				</li>
				<li class="XS-menu__li">
					<a class="XS-menu__a" href="#">Menu Item 19</a>
				</li>
				<li class="XS-menu__li">
					<a class="XS-menu__a" href="#">Menu Item 20</a>
				</li>
			</ul>
		</div>

		<div class="XS-menu-footer"></div>

		<?php // .XS-menu end ?>

		<div class="Search-toggle"><i class="Search-toggle__icon fa fa-search"></i></div>

		<?php if(Yii::app()->user->isGuest): ?>

		<?php // .Register ?>

		<?php echo !isset($lt_ie_8) ? '<div class="Table__td Register">' : '<td class="Table__td Register">'; ?>
			<?php echo CHtml::link(
				'<i class="Table__a-icon fa fa-thumbs-up"></i> ' .
				'<span class="Table__a-text">Register</span>',
				array('/site/register'),
				array('class' => 'Table__a')
			); ?>
		<?php echo !isset($lt_ie_8) ? '</div>' : '</td>'; ?>

		<?php // .Register end ?>

		<?php // .Login ?>

		<?php echo !isset($lt_ie_8) ? '<div class="Table__td Login">' : '<td class="Table__td Login">'; ?>
			<?php echo CHtml::link(
				'<i class="Table__a-icon fa fa-user"></i> ' .
				'<span class="Table__a-text">Login</span>',
				array('/site/login'),
				array('class' => 'Table__a')
			); ?>
		<?php echo !isset($lt_ie_8) ? '</div>' : '</td>'; ?>

		<?php // .Login end ?>

		<?php else: ?>

		<?php // .User ?>

		<?php echo !isset($lt_ie_8) ? '<div class="Table__td User">' : '<td class="Table__td User">'; ?>
			<div class="User__div">
				<?php echo CHtml::link(
					(Yii::app()->params['user']->image
						? CHtml::image(
							'/img/vendor/slir/w76-h68-c38x34-bfff' . Yii::app()->params['user']->getImage() . '?' . time(),
							Yii::app()->user->id . '\'s avatar',
							array('class' => 'User__a-img')
						)
						: '<i class="Table__a-icon fa fa-user"></i> '
					) .
					'<span class="Table__a-text">' . Yii::app()->user->id . '</span>' .
					'<i class="User__a-caret fa fa-angle-down"></i>',
					array(
						'/admin/user/view',
						'id' => Yii::app()->user->id,
					),
					array('class' => 'Table__a User__a')
				); ?>
				<ul class="User__ul dropdown-menu">
					<li class="User__li--username"><?php echo Yii::app()->user->id; ?></li>
					<li class="divider visible-xs"></li>
					<li><?php echo CHtml::link(
						'<i class="fa fa-tachometer"></i>Dashboard',
						array('/admin/user/dashboard')
					); ?></li>
					<li class="divider"></li>
					<li><?php echo CHtml::link(
						'<i class="fa fa-wrench"></i>Edit Account',
						array('/admin/user/account')
					); ?></li>
					<li><?php echo CHtml::link(
						'<i class="fa fa-user"></i>View Profile',
						array(
							'/admin/user/view',
							'id' => Yii::app()->user->id,
						)
					); ?></li>
					<li class="divider visible-xs"></li>
					<li class="visible-xs"><?php echo CHtml::link(
						'<i class="fa fa-sign-out"></i>Logout',
						array('/site/logout')
					); ?></li>
				</ul>
			</div>
		<?php echo !isset($lt_ie_8) ? '</div>' : '</td>'; ?>

		<?php // .User end ?>

		<?php // .Logout ?>

		<?php echo !isset($lt_ie_8) ? '<div class="Table__td Logout">' : '<td class="Table__td Logout">'; ?>
			<?php echo CHtml::link(
				'<i class="Table__a-icon fa fa-sign-out"></i> ' .
				'<span class="Table__a-text">Logout</span>',
				array('/site/logout'),
				array('class' => 'Table__a')
			); ?>
		<?php echo !isset($lt_ie_8) ? '</div>' : '</td>'; ?>

		<?php // .Logout end ?>

		<?php endif; ?>

		<?php /* #filters ?>

		<?php echo !isset($lt_ie_8) ? '<div class="td" id="filters">' : '<td class="td" id="filters">'; ?>
			<span class="a-container"><span class="a"><i class="fa fa-filter"></i> <span>Filters</span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span></span>
		<?php echo !isset($lt_ie_8) ? '</div>' : '</td>'; ?>

		<?php #filters end */ ?>

		<?php #search ?>

		<?php echo !isset($lt_ie_8) ? '<div class="Table__td" id="search">' : '<td class="Table__td" id="search">'; ?>

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
							<span class="placeholder"><?php echo $this->model_itemSearchForm->getAttributeLabel('keywords'); ?></span>
						</div>
					<?php echo !isset($lt_ie_8) ? '</div>' : '</td>'; ?>

					<?php echo !isset($lt_ie_8) ? '<div class="td right">' : '<td class="td right">'; ?>
						<?php echo CHtml::linkButton('<i class="fa fa-search"></i> <span>Search</span>', array('class' => 'g-button submit')); ?>
						<?php echo CHtml::submitButton('Search'); ?>
					<?php echo !isset($lt_ie_8) ? '</div>' : '</td>'; ?>

				<?php echo !isset($lt_ie_8) ? '</div>' : '</tr>'; ?>

			<?php echo !isset($lt_ie_8) ? '</div>' : '</table>'; ?>

		<?php echo !isset($lt_ie_8) ? '</div>' : '</td>'; ?>

		<?php #search end ?>

		<?php #post ?>

		<?php echo !isset($lt_ie_8) ? '<div class="Table__td" id="post">' : '<td class="Table__td" id="post">'; ?>
			<?php echo CHtml::link('Post a<br>FREE Ad', array('/item/create')); ?>
		<?php echo !isset($lt_ie_8) ? '</div>' : '</td>'; ?>

		<?php #post end ?>

	<?php echo !isset($lt_ie_8) ? '</div>' : '</tr>'; ?>

	<?php /*
	<?php echo !isset($lt_ie_8) ? '<div class="Table__tr filters is-hidden">' : '<tr class="tr filters is-hidden">'; ?>

		<?php echo !isset($lt_ie_8) ? '<div class="td">&#160;</div>' : '<td class="td">&#160;</td>'; ?>
		<?php echo !isset($lt_ie_8) ? '<div class="td">&#160;</div>' : '<td class="td">&#160;</td>'; ?>
		<?php echo !isset($lt_ie_8) ? '<div class="td">&#160;</div>' : '<td class="td">&#160;</td>'; ?>

		<?php echo !isset($lt_ie_8) ? '<div class="td filters-left">' : '<td class="td filters-left">'; ?>
			<div><div>&#160;</div></div>
		<?php echo !isset($lt_ie_8) ? '</div>' : '</td>'; ?>

		<?php echo !isset($lt_ie_8) ? '<div class="td filters-right">' : '<td class="td filters-right">'; ?>
			<div><div>
				&#60; Filters Here &#62;<br>
				&#60; Filters Here &#62;<br>
				&#60; Filters Here &#62;<br>
				&#60; Filters Here &#62;<br>
				&#60; Filters Here &#62;
			</div></div>
		<?php echo !isset($lt_ie_8) ? '</div>' : '</td>'; ?>

		<?php echo !isset($lt_ie_8) ? '<div class="td">&#160;</div>' : '<td class="td">&#160;</td>'; ?>

	<?php echo !isset($lt_ie_8) ? '</div>' : '</tr>'; ?>
	*/ ?>

<?php echo !isset($lt_ie_8) ? '</div>' : '</table>'; ?>

<?php $this->endWidget(); ?>

</div></div><!-- .Table-container -->
