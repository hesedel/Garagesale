<?php

class m140421_034415_create_userCourse_table extends CDbMigration
{
		public function safeUp()
	{
		$this->createTable('user_course', array(
			'id'=>'mediumint UNSIGNED PRIMARY KEY',
			'title'=>'varchar(64) NOT NULL',
		), 'ENGINE InnoDB');
		$this->addColumn('user', 'course_id', 'mediumint UNSIGNED');
		$this->addForeignKey('course', 'user', 'course_id', 'user_course', 'id', 'SET NULL', 'CASCADE');

		$this->insert('user_course', array(
			'id'=>0,
			'title'=>'Business',
		));
		$this->insert('user_course', array(
			'id'=>1,
			'title'=>'Communication',
		));
		$this->insert('user_course', array(
			'id'=>2,
			'title'=>'Creative Intelligence and Innovation',
		));
		$this->insert('user_course', array(
			'id'=>3,
			'title'=>'Design, Architecture and Building',
		));
		$this->insert('user_course', array(
			'id'=>4,
			'title'=>'Education',
		));
		$this->insert('user_course', array(
			'id'=>5,
			'title'=>'Engineering',
		));
		$this->insert('user_course', array(
			'id'=>6,
			'title'=>'Health',
		));
		$this->insert('user_course', array(
			'id'=>7,
			'title'=>'Information Technology',
		));
		$this->insert('user_course', array(
			'id'=>8,
			'title'=>'International Studies',
		));
		$this->insert('user_course', array(
			'id'=>9,
			'title'=>'Law',
		));
		$this->insert('user_course', array(
			'id'=>10,
			'title'=>'Pharmacy',
		));
		$this->insert('user_course', array(
			'id'=>11,
			'title'=>'Science',
		));

	}

	public function safeDown()
	{
		$this->dropForeignKey('course', 'user');
		$this->dropColumn('user', 'course_id');
		$this->dropTable('user_course');
	}
}