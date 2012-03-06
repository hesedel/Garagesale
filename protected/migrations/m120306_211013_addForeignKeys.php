<?php

class m120306_211013_addForeignKeys extends CDbMigration
{
	public function safeUp()
	{
		// item
		$this->addForeignKey('category', 'item', 'category_id', 'item_category', 'id', 'SET NULL', 'RESTRICT');
		$this->addForeignKey('condition', 'item', 'condition_id', 'item_condition', 'id', 'SET NULL', 'RESTRICT');
		$this->addForeignKey('user', 'item', 'user_id', 'user', 'id', 'RESTRICT', 'CASCADE');
		// item_image
		$this->addForeignKey('item', 'item_image', 'item_id', 'item', 'id', 'CASCADE', 'RESTRICT');
	}

	public function safeDown()
	{
		$this->dropForeignKey('item', 'item_image');
		$this->dropForeignKey('user', 'item');
		$this->dropForeignKey('condition', 'item');
		$this->dropForeignKey('category', 'item');
	}
}