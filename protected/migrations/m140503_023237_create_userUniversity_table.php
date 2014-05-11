<?php

class m140503_023237_create_userUniversity_table extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('user_university', array(
			'id'=>'mediumint UNSIGNED PRIMARY KEY',
			'title'=>'varchar(64) NOT NULL',
		), 'ENGINE InnoDB');
		$this->addColumn('user', 'university_id', 'mediumint UNSIGNED');
		$this->addForeignKey('university', 'user', 'university_id', 'user_university', 'id', 'SET NULL', 'CASCADE');

		$this->insert('user_university', array(
			'id'=>1,
			'title'=>'Uni title',
			
		));
	}

	

	public function safeDown()
	{
		$this->dropForeignKey('university', 'user');
		$this->dropColumn('user', 'university_id');
		$this->dropTable('user_university');
	}
}