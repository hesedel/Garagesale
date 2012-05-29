<?php

class m120529_094525_create_userLocation_table extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('user_location', array(
			'id'=>'mediumint UNSIGNED PRIMARY KEY',
			'name'=>'varchar(32) NOT NULL',
		), 'ENGINE InnoDB');
		$this->addColumn('user', 'location_id', 'mediumint UNSIGNED');
		//$this->createIndex('location_id', 'user', 'location_id');
		$this->addForeignKey('location', 'user', 'location_id', 'user_location', 'id', 'SET NULL', 'CASCADE');
		$this->insert('user_location', array(
			'id'=>8000,
			'name'=>'Davao City',
		));
	}

	public function safeDown()
	{
		$this->dropForeignKey('location', 'user');
		$this->dropColumn('user', 'location_id');
		$this->dropTable('user_location');
	}
}