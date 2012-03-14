<?php

class m120314_061245_addColumn_user_table extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('user', 'phone', 'varchar(16)');
	}

	public function safeDown()
	{
		$this->dropColumn('user', 'phone');
	}
}