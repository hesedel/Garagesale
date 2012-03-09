<?php

class m120309_054203_updateRbac extends CDbMigration
{
	public function up()
	{
		$auth=Yii::app()->authManager;

		$auth->createOperation('updateItem','');
		$auth->createOperation('deleteItem','');

		$bizRule='return Yii::app()->user->getId()===$params["Item"]->user_id;';
		$task=$auth->createTask('updateOwnItem','',$bizRule);
		$task->addChild('updateItem');

		$bizRule='return Yii::app()->user->getId()===$params["Item"]->user_id;';
		$task=$auth->createTask('deleteOwnItem','',$bizRule);
		$task->addChild('deleteItem');

		$bizRule='return Yii::app()->user->isGuest;';
		$role=$auth->createRole('?','',$bizRule);

		$bizRule='return !Yii::app()->user->isGuest;';
		$role=$auth->createRole('@','',$bizRule);
		$role->addChild('updateOwnItem');
		$role->addChild('deleteOwnItem');

		$role=$auth->createRole('admin');

		$role=$auth->createRole('super');
	}

	public function down()
	{
		echo "m120309_054203_updateRbac does not support migration down.\n";
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