<?php

class m140508_040618_update_user_table extends CDbMigration
{
	public function safeUp()
	{
		$this->alterColumn('user', 'id', 'varchar(64)');
	}

	public function safeDown()
	{
		$this->execute('SET foreign_key_checks = 0;');
		$this->alterColumn('user', 'id', 'varchar(32)');
	}
}