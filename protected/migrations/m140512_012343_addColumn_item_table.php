<?php

class m140512_012343_addColumn_item_table extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('item', 'pickup', 'text NOT NULL AFTER description');
	}

	public function safeDown()
	{
		$this->dropColumn('item', 'pickup');
	}
}