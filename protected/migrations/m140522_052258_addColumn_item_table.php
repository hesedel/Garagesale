<?php

class m140522_052258_addColumn_item_table extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('item', 'course', 'boolean DEFAULT false AFTER price');
	}

	public function safeDown()
	{
		$this->dropColumn('item', 'course');
	}
}