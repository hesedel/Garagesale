<!-- TODO: add security measures to only allow deletion from '/img/uploads/temp' for now -->
<?php unlink($_POST['image']); ?>
