<?php

class m120305_193507_create_user_table extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('user', array(
			'id'=>'varchar(64) PRIMARY KEY',
			'created'=>'timestamp DEFAULT "0000-00-00 00:00:00"',
			'updated'=>'timestamp DEFAULT CURRENT_TIMESTAMP',
			'name_first'=>'varchar(32) NOT NULL',
			'name_last'=>'varchar(32)',
		));
		$this->alterColumn('item', 'user_id', 'varchar(64)');
	}

	public function safeDown()
	{
		$this->alterColumn('item', 'user_id', 'int(10) UNSIGNED');
		$this->dropTable('user');
	}
}