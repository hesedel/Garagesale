<?php

class m140421_034415_create_userCourse_table extends CDbMigration
{
		public function safeUp()
	{
		$this->createTable('user_course', array(
			'id'=>'mediumint UNSIGNED PRIMARY KEY',
			'name'=>'varchar(32) NOT NULL',
		), 'ENGINE InnoDB');
		$this->addColumn('user', 'course_area_id', 'mediumint UNSIGNED');
		//$this->createIndex('location_id', 'user', 'location_id');
		$this->addForeignKey('course_area', 'user', 'course_area_id', 'user_course', 'id', 'CASCADE', 'SET NULL');
		$this->insert('user_course', array(
			'id'=>0,
			'name'=>'Law',
		));

		$this->insert('user_course', array(
			'id'=>1,
			'name'=>'Science',
		));
	}

	public function safeDown()
	{
		$this->dropForeignKey('course_area', 'user');
		$this->dropColumn('user', 'course_area_id');
		$this->dropTable('user_course');
	}
}