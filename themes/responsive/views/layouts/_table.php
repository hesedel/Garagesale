<div id="table-container">

<?php echo !isset($legacy) ? '<div id="table">' : '<table id="table" cellspacing="0">'; ?>

	<?php echo !isset($legacy) ? '<div class="tr">' : '<tr class="tr">'; ?>

		<?php echo !isset($legacy) ? '<header class="td" id="header">' : '<td class="td" id="header">'; ?>

			<?php echo $this->getRoute() !== 'item/view' ? '<h1>' : ''; ?>
				<?php echo CHtml::link(
					'Garagesale<span>.ph</span>',
					'/',
					array('id' => 'logo')
				); ?>
			<?php echo $this->getRoute() !== 'item/view' ? '</h1>' : ''; ?>

			<span class="alpha">alpha</span>

		<?php echo !isset($legacy) ? '</header>' : '</td>'; ?>

		<?php if(Yii::app()->user->isGuest): ?>

		<?php echo !isset($legacy) ? '<div class="td" id="register">' : '<td class="td" id="register">'; ?>
			<?php echo CHtml::link('Register', array('/site/register')); ?>
		<?php echo !isset($legacy) ? '</div>' : '</td>'; ?>

		<?php echo !isset($legacy) ? '<div class="td" id="login">' : '<td class="td" id="login">'; ?>
			<?php echo CHtml::link('<i class="fa fa-sign-in"></i> Login', array('/site/login')); ?>
		<?php echo !isset($legacy) ? '</div>' : '</td>'; ?>

		<?php else: ?>

		<?php echo !isset($legacy) ? '<div class="td" id="user">' : '<td class="td" id="user">'; ?>
			<div class="a">
				<?php echo CHtml::link(
					(Yii::app()->params['user']->image
						? CHtml::image(
							'/img/vendor/slir/w76-h68-c38x34' . Yii::app()->params['user']->getImage(),
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
				</ul>
			</div>
		<?php echo !isset($legacy) ? '</div>' : '</td>'; ?>

		<?php echo !isset($legacy) ? '<div class="td" id="logout">' : '<td class="td" id="logout">'; ?>
			<?php echo CHtml::link('<i class="fa fa-sign-out"></i> <span>Logout</span>', array('/site/logout')); ?>
		<?php echo !isset($legacy) ? '</div>' : '</td>'; ?>

		<?php endif ?>

		<?php echo !isset($legacy) ? '<div class="td" id="filters">' : '<td class="td" id="filters">'; ?>
			<span class="a"><i class="fa fa-filter"></i> <span>Filters</span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span>
		<?php echo !isset($legacy) ? '</div>' : '</td>'; ?>

		<?php echo !isset($legacy) ? '<div class="td" id="search">' : '<td class="td" id="search">'; ?>

			<?php echo !isset($legacy) ? '<div class="table">' : '<table class="table" cellspacing="0">'; ?>

				<?php echo !isset($legacy) ? '<div class="tr">' : '<tr class="tr">'; ?>

					<?php echo !isset($legacy) ? '<div class="td left">' : '<td class="td left">'; ?>
						<div class="input-text">
							<input title="Search" type="text" />
							<span class="placeholder">Search</span>
						</div>
					<?php echo !isset($legacy) ? '</div>' : '</td>'; ?>

					<?php echo !isset($legacy) ? '<div class="td right">' : '<td class="td right">'; ?>
						<?php echo CHtml::linkButton('<i class="fa fa-search"></i> <span>Search</span>', array('class' => 'g-button')); ?>
						<input type="submit" value="Search" />
					<?php echo !isset($legacy) ? '</div>' : '</td>'; ?>

				<?php echo !isset($legacy) ? '</div>' : '</tr>'; ?>

			<?php echo !isset($legacy) ? '</div>' : '</table>'; ?>

		<?php echo !isset($legacy) ? '</div>' : '</td>'; ?>

		<?php echo !isset($legacy) ? '<div class="td" id="post">' : '<td class="td" id="post">'; ?>
			<?php echo CHtml::link('Post a<br>FREE Ad', array('/item/create')); ?>
		<?php echo !isset($legacy) ? '</div>' : '</td>'; ?>

	<?php echo !isset($legacy) ? '</div>' : '</tr>'; ?>

	<?php echo !isset($legacy) ? '<div class="tr filters hidden">' : '<tr class="tr filters hidden">'; ?>

		<?php echo !isset($legacy) ? '<div class="td">&#160;</div>' : '<td class="td">&#160;</td>'; ?>
		<?php echo !isset($legacy) ? '<div class="td">&#160;</div>' : '<td class="td">&#160;</td>'; ?>
		<?php echo !isset($legacy) ? '<div class="td">&#160;</div>' : '<td class="td">&#160;</td>'; ?>

		<?php echo !isset($legacy) ? '<div class="td filters-left">' : '<td class="td filters-left">'; ?>
			<div>&#160;</div>
		<?php echo !isset($legacy) ? '</div>' : '</td>'; ?>

		<?php echo !isset($legacy) ? '<div class="td filters-right">' : '<td class="td filters-right">'; ?>
			<div>&#60; Filters Here &#62;</div>
		<?php echo !isset($legacy) ? '</div>' : '</td>'; ?>

		<?php echo !isset($legacy) ? '<div class="td">&#160;</div>' : '<td class="td">&#160;</td>'; ?>

	<?php echo !isset($legacy) ? '</div>' : '</tr>'; ?>

<?php echo !isset($legacy) ? '</div>' : '</table>'; ?>

</div>

<?php Yii::app()->clientScript->registerScript('main_table',
	"
	
	",
CClientScript::POS_READY) ?>
