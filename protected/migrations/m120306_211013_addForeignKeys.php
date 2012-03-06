<?php

class m120306_211013_addForeignKeys extends CDbMigration
{
	public function safeUp()
	{
		// item
		$this->addForeignKey('category', 'item', 'category_id', 'item_category', 'id', 'SET NULL', NULL);
		$this->addForeignKey('condition', 'item', 'condition_id', 'item_condition', 'id', 'SET NULL', NULL);
		$this->addForeignKey('user', 'item', 'user_id', 'user', 'id', NULL, 'CASCADE');
		// item_image
		$this->addForeignKey('item', 'item_image', 'item_id', 'item', 'id', 'CASCADE', NULL);
	}

	public function safeDown()
	{
		$this->dropForeignKey('item', 'item_image');
		$this->dropForeignKey('user', 'item');
		$this->dropForeignKey('condition', 'item');
		$this->dropForeignKey('category', 'item');
	}
}