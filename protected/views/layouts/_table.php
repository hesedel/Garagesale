<?php echo !isset($legacy) ? '<div id="table">' : '<table id="table" cellspacing="0">' ?>

	<?php echo !isset($legacy) ? '<div class="tr">' : '<tr class="tr">' ?>

		<?php echo !isset($legacy) ? '<div id="header" class="td">' : '<td id="header" class="td">' ?>

			<?php echo $this->getRoute() !== 'item/view' ? '<h1>' : '' ?>
				<?php echo CHtml::link(
					CHtml::encode(Yii::app()->name) . ' <span>(beta)</span>',
					'/',
					array('id' => 'logo')
				) ?>
			<?php echo $this->getRoute() !== 'item/view' ? '</h1>' : '' ?>

		<?php echo !isset($legacy) ? '</div>' : '</td>' ?>

		<?php if(Yii::app()->user->isGuest): ?>

		<?php echo !isset($legacy) ? '<div id="register" class="td">' : '<td id="register" class="td">' ?>
			<?php echo CHtml::link('Register', array('/site/register')) ?>
		<?php echo !isset($legacy) ? '</div>' : '</td>' ?>

		<?php echo !isset($legacy) ? '<div id="login" class="td">' : '<td id="login" class="td">' ?>
			<?php echo CHtml::link('Login', array('/site/login')) ?>
		<?php echo !isset($legacy) ? '</div>' : '</td>' ?>

		<?php else: ?>

		<?php echo !isset($legacy) ? '<div id="user" class="td">' : '<td id="user" class="td">' ?>
			<?php echo CHtml::link(
				CHtml::image(
					'/images/transparent.gif',
					Yii::app()->user->id,
					array('style' => 'background-image: url(/images/slir/w20-h18-c20:18' . Yii::app()->params['user']->getImage(array('color'=>'black')) . ')')
				) .
					Yii::app()->user->id,
				array(
					'/admin/user/view',
					'id' => Yii::app()->user->id,
				)
			) ?>
		<?php echo !isset($legacy) ? '</div>' : '</td>' ?>

		<?php echo !isset($legacy) ? '<div id="logout" class="td">' : '<td id="logout" class="td">' ?>
			<?php echo CHtml::link('Logout', array('/site/logout')) ?>
		<?php echo !isset($legacy) ? '</div>' : '</td>' ?>

		<?php endif ?>

		<?php echo !isset($legacy) ? '<div id="filters" class="td">' : '<td id="filters" class="td">' ?>
			<?php echo CHtml::link('Filters <span></span>', '#') ?>
		<?php echo !isset($legacy) ? '</div>' : '</td>' ?>

		<?php echo !isset($legacy) ? '<div id="search" class="td">' : '<td id="search" class="td">' ?>

			<?php echo !isset($legacy) ? '<div class="table">' : '<table class="table" cellspacing="0">' ?>

				<?php echo !isset($legacy) ? '<div class="tr">' : '<tr class="tr">' ?>

					<?php echo !isset($legacy) ? '<div class="td left">' : '<td class="td left">' ?>
						<div class="input-text">
							<input title="Search" type="text" />
							<span class="placeholder">Search</span>
						</div>
					<?php echo !isset($legacy) ? '</div>' : '</td>' ?>

					<?php echo !isset($legacy) ? '<div class="td right">' : '<td class="td right">' ?>
						<?php echo CHtml::linkButton('Search', array('class' => 'g-button')) ?>
						<input type="submit" value="Search" />
					<?php echo !isset($legacy) ? '</div>' : '</td>' ?>

				<?php echo !isset($legacy) ? '</div>' : '</tr>' ?>

			<?php echo !isset($legacy) ? '</div>' : '</table>' ?>

		<?php echo !isset($legacy) ? '</div>' : '</td>' ?>

		<?php echo !isset($legacy) ? '<div id="post" class="td">' : '<td id="post" class="td">' ?>
			<?php echo CHtml::link('Post a<br />FREE Ad', array('/item/create')) ?>
		<?php echo !isset($legacy) ? '</div>' : '</td>' ?>

	<?php echo !isset($legacy) ? '</div>' : '</tr>' ?>

	<?php echo !isset($legacy) ? '<div class="tr filters hide">' : '<tr class="tr filters hide">' ?>

		<?php echo !isset($legacy) ? '<div class="td">&#160;</div>' : '<td class="td">&#160;</td>' ?>
		<?php echo !isset($legacy) ? '<div class="td">&#160;</div>' : '<td class="td">&#160;</td>' ?>
		<?php echo !isset($legacy) ? '<div class="td">&#160;</div>' : '<td class="td">&#160;</td>' ?>

		<?php echo !isset($legacy) ? '<div class="td filters-left">' : '<td class="td filters-left">' ?>
			<div>&#160;</div>
		<?php echo !isset($legacy) ? '</div>' : '</td>' ?>

		<?php echo !isset($legacy) ? '<div class="td filters-right">' : '<td class="td filters-right">' ?>
			<div>&#60; Filters Here &#62;</div>
		<?php echo !isset($legacy) ? '</div>' : '</td>' ?>

		<?php echo !isset($legacy) ? '<div class="td">&#160;</div>' : '<td class="td">&#160;</td>' ?>

	<?php echo !isset($legacy) ? '</div>' : '</tr>' ?>

<?php echo !isset($legacy) ? '</div>' : '</table>' ?>

<div id="user-dropdown" class="navbar">
	<ul class="dropdown-menu">
		<li><?php echo CHtml::link('Messages', '#') ?></li>
		<li><?php echo CHtml::link('Manage Items', '#') ?></li>
		<li class="divider"></li>
		<li><?php echo CHtml::link('Edit Account', '#') ?></li>
		<li><?php echo CHtml::link('View Profile', '#') ?></li>
	</ul>
</div><!-- #user-dropdown -->

<?php Yii::app()->clientScript->registerScript('main_table',
	"
	$('#user a, #user-dropdown ul.dropdown-menu').hover(function() {
		$('#user-dropdown').css( {
			left: $('a', '#user').position().left + 5
		});
		$('.dropdown-menu').show();
	}, function() {
		$('.dropdown-menu').hide();
	});
	",
CClientScript::POS_READY) ?>