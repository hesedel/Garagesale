<table id="html" cellspacing="0"><tr><td>

<table id="body" cellspacing="0">

	<tbody><tr>
		<td><?php echo nl2br($data) ?></td>
	</tr></tbody>

	<thead>
		<tr><th><?php echo CHtml::link(
			Yii::app()->name,
			//CHtml::image('/img/transparent.gif', Yii::app()->name),
			Yii::app()->params['serverName'],
			array('id'=>'logo')
		) ?></th></tr>
		<tr><td><?php echo Yii::app()->params['tagline'] ?></td></tr>
	</thead>

	<tfoot><tr>
		<td>Copyright &#169; <?php echo time_local(date('Y-m-d H:i:s'), array('format'=>'Y')) ?> by <?php echo CHtml::link(Yii::app()->name, Yii::app()->params['serverName']) ?></td>
	</tr></tfoot>

</table><!-- #body -->

</td></tr></table><!-- #html -->