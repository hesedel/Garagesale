<?php

class m140314_112253_create_itemContact_table extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('item_contact', array(
			'id'=>'int UNSIGNED AUTO_INCREMENT PRIMARY KEY',
			'created'=>'timestamp DEFAULT "0000-00-00 00:00:00"',
			'updated'=>'timestamp DEFAULT CURRENT_TIMESTAMP',
			'item_id'=>'int UNSIGNED NOT NULL',
			'user_id_replier'=>'varchar(64) DEFAULT NULL',
			'replier_email'=>'varchar(64) DEFAULT NULL',
			'replier_name'=>'varchar(32) DEFAULT NULL',
			'user_id_poster'=>'varchar(64) NOT NULL',
		), 'ENGINE InnoDB');
		$this->addForeignKey('item_contact', 'item_contact', 'item_id', 'item', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('user_replier', 'item_contact', 'user_id_replier', 'user', 'id', 'CASCADE', 'CASCADE');
		$this->addForeignKey('user_poster', 'item_contact', 'user_id_poster', 'user', 'id', 'CASCADE', 'CASCADE');
	}

	public function safeDown()
	{
		$this->dropForeignKey('user_poster', 'item_contact');
		$this->dropForeignKey('user_replier', 'item_contact');
		$this->dropForeignKey('item_contact', 'item_contact');
		$this->dropTable('item_contact');
	}
}