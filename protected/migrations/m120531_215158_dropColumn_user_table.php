<?php

class m120531_215158_dropColumn_user_table extends CDbMigration
{
	public function up()
	{
		$this->dropColumn('user', 'role');
	}

	public function down()
	{
		echo "m120531_215158_dropColumn_user_table does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}