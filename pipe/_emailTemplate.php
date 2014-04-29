<?php 
	// Initial message
	if ( $item_contact_result->num_rows > 1 ):
?>
<table id="html" cellspacing="0"><tr><td>

<table id="body" cellspacing="0">

	<tbody><tr>
		<td>
			Dear <?php echo $recipient_user['name_first'] ?>,
			<br />
			<br />
			<br />
			Someone just left a private message for you as follows:
			<br />
			<br />
			<?php echo $body ?>
			<br />
			<br />
			<br />
			<br />
			You may respond to the sender of this private message by replying directly to this email. 
			<br />
			<br />
			Don't want to receive this kind of message from me? You can edit your notification alert on your profile settings.
			<br />
			<br />
			Cheers,
			<?php echo 'Garagesale' ?> Team
		</td>
	</tr></tbody>

	<tfoot><tr>
		<td>Copyright &#169; <?php echo date('Y-m-d H:i:s') ?> by <?php echo 'Garagsale.ph' ?></td>
	</tr></tfoot>

</table><!-- #body -->

</td></tr></table><!-- #html -->
<?php else: ?>
	<table id="html" cellspacing="0"><tr><td>

	<table id="body" cellspacing="0">

		<tbody>
			<tr>
				<td>
					<?php echo $body ?>
				</td>
			</tr>
		</tbody>
	</table><!-- #body -->

	</td></tr></table><!-- #html -->
<?php endif;?>