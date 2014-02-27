<?php

class m120513_195839_create_userEmailChange_table extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('user_email_change', array(
			'id'=>'varchar(32) PRIMARY KEY',
			'user_id'=>'varchar(64) NOT NULL UNIQUE',
			'email'=>'varchar(64) NOT NULL UNIQUE',
		));
		$this->addForeignKey('email_change', 'user_email_change', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
	}

	public function safeDown()
	{
		$this->dropForeignKey('email_change', 'user_email_change');
		$this->dropTable('user_email_change');
	}
}