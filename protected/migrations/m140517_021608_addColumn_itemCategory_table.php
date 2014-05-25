<?php

class m140517_021608_addColumn_itemCategory_table extends CDbMigration
{
	public function safeUp()
	{
		$this->addColumn('item_category', 'icon', 'varchar(32) DEFAULT NULL');

		$this->update('item_category', array(
			'icon'=>'craft',
		), 'id=1');
		$this->update('item_category', array(
			'icon'=>'automotive',
		), 'id=2');
		$this->update('item_category', array(
			'icon'=>'books',
		), 'id=3');
		$this->update('item_category', array(
			'icon'=>'clothes',
		), 'id=4');
		$this->update('item_category', array(
			'icon'=>'electronics',
		), 'id=5');
		$this->update('item_category', array(
			'icon'=>'entertainment',
		), 'id=6');
		$this->update('item_category', array(
			'icon'=>'health',
		), 'id=7');
		$this->update('item_category', array(
			'icon'=>'home',
		), 'id=8');
		$this->update('item_category', array(
			'icon'=>'music',
		), 'id=9');
		$this->update('item_category', array(
			'icon'=>'sport',
		), 'id=10');
		/*
		$this->update('item_category', array(
			'icon'=>'',
		), 'id=11');
		*/
	}

	public function safeDown()
	{
		$this->dropColumn('item_category', 'fa');
	}
}