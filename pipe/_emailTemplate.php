<table id="html" cellspacing="0"><tr><td>

<table id="body" cellspacing="0">

	<tbody><tr>
		<td>
			Dear <?php echo $name ?>,
			<br />
			<br />
			<br />
			You've received this email because you've just recently registered
			with us.
			<br />
			<br />
			To activate your account, please click the following link:
			<br />
			<br />
			<?php echo $link ?>
			<br />
			<br />
			<br />
			<br />
			If you did not register with us, just delete this email.
			<br />
			<br />
			<br />
			<br />
			Cheers,
			<?php echo $team ?> Team
		</td>
	</tr></tbody>

	<tfoot><tr>
		<td>Copyright &#169; <?php echo date('Y-m-d H:i:s') ?> by <?php echo $app_name ?></td>
	</tr></tfoot>

</table><!-- #body -->

</td></tr></table><!-- #html -->