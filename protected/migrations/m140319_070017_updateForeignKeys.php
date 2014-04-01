<?php

class m140319_070017_updateForeignKeys extends CDbMigration
{
	public function safeUp()
	{
		// item
		$this->dropForeignKey('category', 'item');
		$this->addForeignKey('category', 'item', 'category_id', 'item_category', 'id', 'SET NULL', 'CASCADE');
		$this->dropForeignKey('condition', 'item');
		$this->addForeignKey('condition', 'item', 'condition_id', 'item_condition', 'id', 'SET NULL', 'CASCADE');
		// item_category
		$this->addForeignKey('parentCategory', 'item_category', 'parent_id', 'item_category', 'id', 'SET NULL', 'CASCADE');
		// item_image
		$this->dropForeignKey('item', 'item_image');
		$this->addForeignKey('item', 'item_image', 'item_id', 'item', 'id', 'RESTRICT', 'CASCADE');
	}

	public function safeDown()
	{
		// item_image
		$this->dropForeignKey('item', 'item_image');
		$this->addForeignKey('item', 'item_image', 'item_id', 'item', 'id', 'CASCADE', 'RESTRICT');
		// item_category
		$this->dropForeignKey('parentCategory', 'item_category');
		// item
		$this->dropForeignKey('condition', 'item');
		$this->addForeignKey('condition', 'item', 'condition_id', 'item_condition', 'id', 'SET NULL', 'RESTRICT');
		$this->dropForeignKey('category', 'item');
		$this->addForeignKey('category', 'item', 'category_id', 'item_category', 'id', 'SET NULL', 'RESTRICT');
	}
}