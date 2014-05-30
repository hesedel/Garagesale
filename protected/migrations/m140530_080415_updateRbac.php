<?php

class m140530_080415_updateRbac extends CDbMigration
{
	public function up()
	{
		$auth=Yii::app()->authManager;

		$auth->createOperation('updateWantedItem','');
		$auth->createOperation('deleteWantedItem','');

		$bizRule='return Yii::app()->user->getId()===$params["WantedForm"]->user_id;';
		$task=$auth->createTask('updateOwnWantedItem','',$bizRule);
		$task->addChild('updateWantedItem');

		$bizRule='return Yii::app()->user->getId()===$params["WantedForm"]->user_id;';
		$task=$auth->createTask('deleteOwnWantedItem','',$bizRule);
		$task->addChild('deleteWantedItem');

		$role=$auth->getAuthItem('@');
		$role->addChild('updateOwnWantedItem');
		$role->addChild('deleteOwnWantedItem');
	}

	public function down()
	{
		echo "m140530_080415_updateRbac does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}