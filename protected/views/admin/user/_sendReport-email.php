User reported: <?php echo Item::model()->findByPk($_GET['item_id'])->user->name_first; ?>


Report type:
<?php foreach($model->reportType as $report): ?>
<?php echo $report; ?>

<?php endforeach; ?>

Report descrption:
<?php echo $model->reportDescription; ?>


Link to item: <?php echo $link; ?>