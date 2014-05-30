<?php

class m140530_062445_update_itemCategory_table extends CDbMigration
{
	public function safeUp()
	{
		$this->update('item_category', array(
			'id'=>12,
			'title'=>'Other',
			'icon'=>'other',
		), 'id=11');

		$this->update('item_category', array(
			'id'=>11,
			'parent_id'=>null,
			'icon'=>'toys',
		), 'id=1003');
		$this->update('item_category', array(
			'id'=>1003,
		), 'id=1004');

		$this->delete('item_category', 'id=101');
		$this->update('item_category', array(
			'id'=>101,
		), 'id=102');
		$this->update('item_category', array(
			'id'=>102,
		), 'id=103');

		$this->update('item_category', array(
			'id'=>407,
		), 'id=406');
		$this->update('item_category', array(
			'id'=>406,
		), 'id=405');
		$this->update('item_category', array(
			'id'=>405,
		), 'id=404');
		$this->update('item_category', array(
			'id'=>404,
		), 'id=403');
		$this->update('item_category', array(
			'id'=>403,
		), 'id=402');
		$this->insert('item_category', array(
			'id'=>402,
			'title'=>'Baby\'s and Kid\'s Clothes',
			'parent_id'=>4,
		));
	}

	public function safeDown()
	{
		$this->delete('item_category', 'id=402');
		$this->update('item_category', array(
			'id'=>402,
		), 'id=403');
		$this->update('item_category', array(
			'id'=>403,
		), 'id=404');
		$this->update('item_category', array(
			'id'=>404,
		), 'id=405');
		$this->update('item_category', array(
			'id'=>405,
		), 'id=406');
		$this->update('item_category', array(
			'id'=>406,
		), 'id=407');

		$this->update('item_category', array(
			'id'=>103,
		), 'id=102');
		$this->update('item_category', array(
			'id'=>102,
		), 'id=101');
		$this->insert('item_category', array(
			'id'=>101,
			'title'=>'Antiques, Collectables',
			'parent_id'=>1,
		));

		$this->update('item_category', array(
			'id'=>1004,
		), 'id=1003');
		$this->update('item_category', array(
			'id'=>1003,
			'parent_id'=>10,
			'icon'=>null,
		), 'id=11');

		$this->update('item_category', array(
			'id'=>11,
			'title'=>'Others',
			'icon'=>null,
		), 'id=12');
	}
}