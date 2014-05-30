<strong>User reported:</strong> <?php echo Item::model()->findByPk($_GET['item_id'])->user->name_first; ?>


<strong>Report type:</strong>
<?php foreach($model->reportType as $report): ?>
<?php echo $report; ?>

<?php endforeach; ?>

<div id="message"><?php echo $model->reportDescription; ?></div>

<strong>Link to item:</strong> <?php echo $link; ?>