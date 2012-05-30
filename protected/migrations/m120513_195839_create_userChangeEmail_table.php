<?php

class m120513_195839_create_userChangeEmail_table extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('user_changeEmail', array(
			'id'=>'varchar(32) PRIMARY KEY',
			'user_id'=>'varchar(64) NOT NULL UNIQUE',
			'email'=>'varchar(64) NOT NULL UNIQUE',
		), 'ENGINE InnoDB');
		$this->addForeignKey('changeEmail', 'user_changeEmail', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
	}

	public function safeDown()
	{
		$this->dropForeignKey('changeEmail', 'user_changeEmail');
		$this->dropTable('user_changeEmail');
	}
}