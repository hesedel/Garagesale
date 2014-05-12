<?php

class m140512_000536_update_itemCondition_table extends CDbMigration
{
	public function safeUp()
	{
		$this->update('item_condition', array(
			'title'=>'Totally New',
		), 'id=0');
		$this->update('item_condition', array(
			'title'=>'Almost New',
		), 'id=1');
		$this->insert('item_condition', array(
			'id'=>2,
			'title'=>'Not New',
		));
	}

	public function safeDown()
	{
		$this->delete('item_condition', 'id=2');
		$this->update('item_condition', array(
			'title'=>'Used',
		), 'id=1');
		$this->update('item_condition', array(
			'title'=>'Brand New',
		), 'id=0');
	}
}