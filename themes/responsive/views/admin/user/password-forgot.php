<?php
$this->pageTitle=Yii::app()->name . ' - Forgot Password';

$this->layout = '/layouts/transition';
?>

<div id="user_password-forgot">

	<h2 class="alert alert-success">Password change email sent!</h2>

	<p class="alert alert-info">An email has been sent to you ( <strong><?php echo $email; ?></strong> )<br/>Please follow the instructions in the email to change your password.<br/>If you can't see the email, it might be in your spam folder.</p>

	<?php echo CHtml::link('← return to where you left off', Yii::app()->user->getReturnUrl(), array('class'=>'g-button small')); ?>

</div>
