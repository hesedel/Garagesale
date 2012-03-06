<?php

class m120306_202855_addColumn_user_table extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('user', 'password', 'varchar(32) NOT NULL AFTER updated');
		$this->addColumn('user', 'role', 'tinyint UNSIGNED NOT NULL AFTER password');
	}

	public function safeDown()
	{
		$this->dropColumn('user', 'role');
		$this->dropColumn('user', 'password');
	}
}