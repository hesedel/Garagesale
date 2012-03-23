<?php

class m120323_105250_create_userChangePassword_table extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('user_changePassword', array(
			'id'=>'varchar(32) PRIMARY KEY',
			'user_id'=>'varchar(64) NOT NULL UNIQUE',
		));
		$this->addForeignKey('changePassword', 'user_changePassword', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
	}

	public function safeDown()
	{
		$this->dropForeignKey('changePassword', 'user_changePassword');
		$this->dropTable('user_changePassword');
	}
}