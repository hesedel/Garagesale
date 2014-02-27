<?php

class m120323_105250_create_userPasswordChange_table extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('user_password_change', array(
			'id'=>'varchar(32) PRIMARY KEY',
			'user_id'=>'varchar(64) NOT NULL UNIQUE',
		));
		$this->addForeignKey('password-change', 'user_password_change', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
	}

	public function safeDown()
	{
		$this->dropForeignKey('password_change', 'user_password_change');
		$this->dropTable('user_password_change');
	}
}