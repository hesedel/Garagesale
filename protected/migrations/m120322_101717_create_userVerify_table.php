<?php

class m120322_101717_create_userVerify_table extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('user_verify', array(
			'id'=>'varchar(32) PRIMARY KEY',
			'user_id'=>'varchar(64) NOT NULL UNIQUE',
		), 'ENGINE InnoDB');
		$this->addForeignKey('verified', 'user_verify', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
		$this->addColumn('user', 'verified', 'boolean NOT NULL');
		$this->update('user', array(
			'verified'=>1,
		));
	}

	public function safeDown()
	{
		$this->dropColumn('user', 'verified');
		$this->dropForeignKey('verified', 'user_verify');
		$this->dropTable('user_verify');
	}
}