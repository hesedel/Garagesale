<?php

class m120501_190650_updateRbac extends CDbMigration
{
	public function up()
	{
		$auth=Yii::app()->authManager;
		
		$auth->createOperation('updateUser','');
		$auth->createOperation('deleteUser','');

		$bizRule='return Yii::app()->user->getId()===$params["User"]->id;';
		$task=$auth->createTask('updateSelf','',$bizRule);
		$task->addChild('updateUser');

		$bizRule='return Yii::app()->user->getId()===$params["User"]->id;';
		$task=$auth->createTask('deleteSelf','',$bizRule);
		$task->addChild('deleteUser');

		$role=$auth->getAuthItem('@');
		$role->addChild('updateSelf');
		$role->addChild('deleteSelf');
	}

	public function down()
	{
		echo "m120501_190650_updateRbac does not support migration down.\n";
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