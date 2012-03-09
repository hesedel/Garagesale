<?php

class m120309_130619_update_user_table extends CDbMigration
{
	public function safeUp()
	{
		$this->alterColumn('user','id','varchar(32)');
		$this->addColumn('user','email','varchar(64) NOT NULL AFTER id');
		$this->createIndex('email','user','email',true);
	}

	public function safeDown()
	{
		$this->dropIndex('email','user');
		$this->dropColumn('user','email');
		$this->alterColumn('user','id','varchar(64)');
	}
}