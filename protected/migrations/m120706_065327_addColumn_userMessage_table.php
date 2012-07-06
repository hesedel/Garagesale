<?php

class m120706_065327_addColumn_userMessage_table extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('user_message', 'item_id', 'int UNSIGNED');
		$this->createIndex('item', 'user_message', 'item_id');
		//$this->addForeignKey('item', 'user_message', 'item_id', 'item', 'id', 'CASCADE', 'CASCADE');
		Yii::app()->db->createCommand('
			ALTER TABLE `user_message` ADD FOREIGN KEY ( `item_id` ) REFERENCES `item` (
			`id`
			) ON DELETE CASCADE ON UPDATE CASCADE ;
		')->execute();
	}

	public function safeDown()
	{
		//$this->dropForeignKey('item', 'user_message');
		Yii::app()->db->createCommand('
			ALTER TABLE `user_message` DROP FOREIGN KEY `user_message_ibfk_1` ;
		')->execute();
		$this->dropColumn('user_message', 'item_id');
	}
}