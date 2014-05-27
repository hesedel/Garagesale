<?php

class m140522_060626_addColumn_user_table extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('user', 'quirky', 'text NOT NULL AFTER verified');
	}

	public function safeDown()
	{
		$this->dropColumn('user', 'quirky');
	}
}