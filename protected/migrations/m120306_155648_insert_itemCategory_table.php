<?php

class m120306_155648_insert_itemCategory_table extends CDbMigration
{
	public function safeUp()
	{
		$this->insert('item_category', array(
			'id'=>'1',
			'title'=>'Cars',
		));
		$this->insert('item_category', array(
			'id'=>'2',
			'title'=>'Computers',
		));
		$this->insert('item_category', array(
			'id'=>'3',
			'title'=>'Mobile Phones',
		));
		$this->insert('item_category', array(
			'id'=>'4',
			'title'=>'Real Estate',
		));
	}

	public function safeDown()
	{
		$this->update('item', array(
			'category_id'=>NULL,
		), 'category_id=4 or category_id=3 or category_id=2 or category_id=1');
		$this->delete('item_category', array(
			'id=4 or id=3 or id=2 or id=1',
		));
	}
}