<?php

class m120506_182730_addColumn_user_table extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('user', 'image', 'mediumblob AFTER phone');
		$this->addColumn('user', 'image_type', 'varchar(4) AFTER image');
		$this->addColumn('user', 'image_size', 'int UNSIGNED AFTER image_type');
	}

	public function safeDown()
	{
		$this->dropColumn('user', 'image_size');
		$this->dropColumn('user', 'image_type');
		$this->dropColumn('user', 'image');
	}
}