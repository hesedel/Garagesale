<?php

class m140517_071556_addColumn_item_table extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('item', 'wanted', 'boolean DEFAULT false AFTER pickup');
	}

	public function safeDown()
	{
		$this->dropColumn('item', 'wanted');
	}
}