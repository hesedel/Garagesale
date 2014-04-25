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

		<?php #header ?>

		<?php echo !isset($lt_ie_8) ? '<header class="td" id="header">' : '<td class="td" id="header">'; ?>

			<?php echo $this->getRoute() !== 'item/view' ? '<h1>' : ''; ?>
				<?php echo CHtml::link(
					CHtml::image(
						'/img/vendor/slir/h54/img/logo-white.png',
						CHtml::encode(Yii::app()->name)
					) .
						'St<span>ycle</span>',
					'/',
					array('id' => 'logo')
				); ?>
			<?php echo $this->getRoute() !== 'item/view' ? '</h1>' : ''; ?>

			<span class="alpha">alpha</span>

		<?php echo !isset($lt_ie_8) ? '</header>' : '</td>'; ?>

		<?php #header end ?>

		<?php #menu-toggle ?>

		<?php echo !isset($lt_ie_8) ? '<div class="td" id="menu-toggle">' : '<td class="td" id="menu">'; ?>
			<i class="fa fa-bars"></i>
		<?php echo !isset($lt_ie_8) ? '</div>' : '</td>'; ?>

		<?php #menu-toggle end ?>

		<?php if(Yii::app()->user->isGuest): ?>

		<?php /* #register ?>

		<?php echo !isset($lt_ie_8) ? '<div class="td" id="register">' : '<td class="td" id="register">'; ?>
			<?php echo CHtml::link('Register', array('/site/register')); ?>
		<?php echo !isset($lt_ie_8) ? '</div>' : '</td>'; ?>

		<?php #register end ?>

		<?php #login ?>

		<?php echo !isset($lt_ie_8) ? '<div class="td" id="login">' : '<td class="td" id="login">'; ?>
			<?php echo CHtml::link('<i class="fa fa-sign-in"></i> Login', array('/site/login')); ?>
		<?php echo !isset($lt_ie_8) ? '</div>' : '</td>'; ?>

		<?php #login end */ ?>

		<?php #user ?>

		<?php echo !isset($lt_ie_8) ? '<div class="td" id="user">' : '<td class="td" id="user">'; ?>
			<div class="a">
				<?php echo CHtml::link(
					'<i class="fa fa-user"></i> ' .
						Yii::app()->user->id .
							'<i class="fa fa-angle-down"></i>',
					array('#')
				); ?>
				<ul class="dropdown-menu">
					<li><?php echo CHtml::link('<i class="fa fa-sign-in"></i>Login', array('/site/login')); ?></li>
					<li><?php echo CHtml::link('<i class="fa fa-thumbs-up"></i>Register', array('/site/register')); ?></li>
				</ul>
			</div>
		<?php echo !isset($lt_ie_8) ? '</div>' : '</td>'; ?>

		<?php #user end ?>

		<?php else: ?>

		<?php #user ?>

		<?php echo !isset($lt_ie_8) ? '<div class="td" id="user">' : '<td class="td" id="user">'; ?>
			<div class="a">
				<?php echo CHtml::link(
					(Yii::app()->params['user']->image
						? CHtml::image(
							'/img/vendor/slir/w76-h68-c38x34-bfff' . Yii::app()->params['user']->getImage(),
							Yii::app()->user->id . '\'s avatar'
						)
						: '<i class="fa fa-user"></i> '
					) .
						Yii::app()->user->id .
							'<i class="fa fa-angle-down"></i>',
					array(
						'/admin/user/view',
						'id' => Yii::app()->user->id,
					)
				); ?>
				<ul class="dropdown-menu">
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

		<?php /* if($this->getRoute() !== 'site/index'): #search ?>

		<?php echo !isset($lt_ie_8) ? '<div class="td" id="search">' : '<td class="td" id="search">'; ?>

			<?php $this->renderPartial('/layouts/_search'); ?>

		<?php echo !isset($lt_ie_8) ? '</div>' : '</td>'; ?>

		<?php endif; #search end */ ?>

		<?php #post ?>

		<?php echo !isset($lt_ie_8) ? '<div class="td" id="post">' : '<td class="td" id="post">'; ?>
			<?php echo CHtml::link('Sell', array('/item/create')); ?>
		<?php echo !isset($lt_ie_8) ? '</div>' : '</td>'; ?>

		<?php #post end ?>

		<?php #menu ?>

		<div id="menu">
			<span class="x">&times;</span>
			<ul>
				<li class="heading">All categories</li>
				<li><a href="#">Category 1</a></li>
				<li><a href="#">Category 2</a></li>
				<li><a href="#">Category 3</a></li>
				<?php if(!Yii::app()->user->isGuest): ?>
				<li class="heading">Your categories</li>
				<li><a href="#">Category 1</a><span class="badge">#</span></li>
				<li><a href="#">Category 2</a><span class="badge">#</span></li>
				<li><a href="#">Category 3</a><span class="badge">#</span></li>
			<?php endif; ?>
			</ul>
		</div>

		<?php #menu end ?>

		<?php if(
			$this->getRoute() == 'item/search' ||
			$this->getRoute() == 'item/view'
		): #search ?>

		<?php echo !isset($lt_ie_8) ? '<div class="td" id="search">' : '<td class="td" id="search">'; ?>

			<?php $this->renderPartial('/layouts/_search'); ?>

		<?php echo !isset($lt_ie_8) ? '</div>' : '</td>'; ?>

		<?php endif; #search end ?>

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
