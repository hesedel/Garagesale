<?php

class RbacCommand extends CConsoleCommand
{
	public function actionAssign($role, $user_id)
	{
		Yii::app()->authManager->assign($role, $user_id);
	}

	public function actionRevoke($role, $user_id)
	{
		Yii::app()->authManager->revoke($role, $user_id);
	}
}
