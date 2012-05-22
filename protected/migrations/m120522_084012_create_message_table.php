<?php

class m120522_084012_create_message_table extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('message', array(
			'id'=>'int UNSIGNED AUTO_INCREMENT PRIMARY KEY',
			'created'=>'timestamp DEFAULT "0000-00-00 00:00:00"',
			'message'=>'text NOT NULL',
			'read'=>'boolean NOT NULL DEFAULT 0',
			'from'=>'boolean NOT NULL DEFAULT 1',
			'to'=>'boolean NOT NULL DEFAULT 1',
			'user_id_from'=>'varchar(64)',
			'user_id_to'=>'varchar(64) NOT NULL',
			'parent_id'=>'int UNSIGNED',
		));
		$this->addForeignKey('from', 'message', 'user_id_from', 'user', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('to', 'message', 'user_id_to', 'user', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('parent', 'message', 'parent_id', 'message', 'id', 'CASCADE', 'CASCADE');
	}

	public function safeDown()
	{
		$this->dropForeignKey('parent', 'message');
		$this->dropForeignKey('to', 'message');
		$this->dropForeignKey('from', 'message');
		$this->dropTable('message');
	}
}