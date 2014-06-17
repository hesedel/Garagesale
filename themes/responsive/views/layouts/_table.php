<div id="table-container"><div class="container">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'item-search-form',
	//'enableClientValidation'=>true,
	//'clientOptions'=>array(
	//	'validateOnSubmit'=>true,
	//),
	'action'=>array('/item/search'),
	'method'=>'get',
)); ?>

<?php echo !isset($lt_ie_8) ? '<div id="table">' : '<table id="table" cellspacing="0">'; ?>

	<?php echo !isset($lt_ie_8) ? '<div class="tr">' : '<tr class="tr">'; ?>

		<div class="XS-menu-toggle"><i class="XS-menu-toggle__icon fa fa-bars"></i></div>

		<?php // .Header ?>

		<?php echo !isset($lt_ie_8) ? '<header class="td Header">' : '<td class="td Header">'; ?>

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

		<?php #search-toggle ?>

		<div id="search-toggle"><i class="fa fa-search"></i></div>

		<?php #search-toggle end ?>

		<?php if(Yii::app()->user->isGuest): ?>

		<?php #register ?>

		<?php echo !isset($lt_ie_8) ? '<div class="td" id="register">' : '<td class="td" id="register">'; ?>
			<?php echo CHtml::link('<i class="fa fa-thumbs-up"></i> Register', array('/site/register')); ?>
		<?php echo !isset($lt_ie_8) ? '</div>' : '</td>'; ?>

		<?php #register end ?>

		<?php #login ?>

		<?php echo !isset($lt_ie_8) ? '<div class="td" id="login">' : '<td class="td" id="login">'; ?>
			<?php echo CHtml::link('<i class="fa fa-user"></i> <span>Login</span>', array('/site/login')); ?>
		<?php echo !isset($lt_ie_8) ? '</div>' : '</td>'; ?>

		<?php #login end ?>

		<?php else: ?>

		<?php #user ?>

		<?php echo !isset($lt_ie_8) ? '<div class="td" id="user">' : '<td class="td" id="user">'; ?>
			<div class="a">
				<?php echo CHtml::link(
					(Yii::app()->params['user']->image
						? CHtml::image(
							'/img/vendor/slir/w76-h68-c38x34-bfff' . Yii::app()->params['user']->getImage() . '?' . time(),
							Yii::app()->user->id . '\'s avatar'
						)
						: '<i class="fa fa-user"></i> '
					) .
						'<span>' . Yii::app()->user->id . '</span>' .
							'<i class="fa fa-angle-down"></i>',
					array(
						'/admin/user/view',
						'id' => Yii::app()->user->id,
					)
				); ?>
				<ul class="dropdown-menu">
					<li class="username"><?php echo Yii::app()->user->id; ?></li>
					<li class="divider visible-xs"></li>
					<li><?php echo CHtml::link('<i class="fa fa-tachometer"></i>Dashboard', array('/admin/user/dashboard')); ?></li>
					<li class="divider"></li>
					<li><?php echo CHtml::link('<i class="fa fa-wrench"></i>Edit Account', array('/admin/user/account')); ?></li>
					<li><?php echo CHtml::link('<i class="fa fa-user"></i>View Profile', array('/admin/user/view', 'id' => Yii::app()->user->id)); ?></li>
					<li class="divider visible-xs"></li>
					<li class="visible-xs"><?php echo CHtml::link('<i class="fa fa-sign-out"></i>Logout', array('/site/logout')); ?></li>
				</ul>
			</div>
		<?php echo !isset($lt_ie_8) ? '</div>' : '</td>'; ?>

		<?php #user end ?>

		<?php #logout ?>

		<?php echo !isset($lt_ie_8) ? '<div class="td" id="logout">' : '<td class="td" id="logout">'; ?>
			<?php echo CHtml::link('<i class="fa fa-sign-out"></i> <span>Logout</span>', array('/site/logout')); ?>
		<?php echo !isset($lt_ie_8) ? '</div>' : '</td>'; ?>

		<?php #logout end ?>

		<?php endif; ?>

		<?php /* #filters ?>

		<?php echo !isset($lt_ie_8) ? '<div class="td" id="filters">' : '<td class="td" id="filters">'; ?>
			<span class="a-container"><span class="a"><i class="fa fa-filter"></i> <span>Filters</span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span></span>
		<?php echo !isset($lt_ie_8) ? '</div>' : '</td>'; ?>

		<?php #filters end */ ?>

		<?php #search ?>

		<?php echo !isset($lt_ie_8) ? '<div class="td" id="search">' : '<td class="td" id="search">'; ?>

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

		<?php echo !isset($lt_ie_8) ? '<div class="td" id="post">' : '<td class="td" id="post">'; ?>
			<?php echo CHtml::link('Post a<br>FREE Ad', array('/item/create')); ?>
		<?php echo !isset($lt_ie_8) ? '</div>' : '</td>'; ?>

		<?php #post end ?>

	<?php echo !isset($lt_ie_8) ? '</div>' : '</tr>'; ?>

	<?php /*

	<?php echo !isset($lt_ie_8) ? '<div class="tr filters is-hidden">' : '<tr class="tr filters is-hidden">'; ?>

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

</div></div><?php #table-container ?>
