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
			'title'=>'Agriculture, Agrifood, Horticulture and Food Security',
		));
		$this->insert('user_course', array(
			'id'=>1,
			'title'=>'Animal Sciences and Equine Studies',
		));
		$this->insert('user_course', array(
			'id'=>2,
			'title'=>'Architecture',
		));
		$this->insert('user_course', array(
			'id'=>3,
			'title'=>'Archaeology',
		));
		$this->insert('user_course', array(
			'id'=>4,
			'title'=>'Arts, Anthropology and Humanities',
		));
		$this->insert('user_course', array(
			'id'=>5,
			'title'=>'Aviation',
		));
		$this->insert('user_course', array(
			'id'=>6,
			'title'=>'Building and Construction',
		));
		$this->insert('user_course', array(
			'id'=>7,
			'title'=>'Business and Commerce',
		));
		$this->insert('user_course', array(
			'id'=>8,
			'title'=>'Communication',
		));
		$this->insert('user_course', array(
			'id'=>9,
			'title'=>'Computing and IT',
		));
		$this->insert('user_course', array(
			'id'=>10,
			'title'=>'Dental',
		));
		$this->insert('user_course', array(
			'id'=>11,
			'title'=>'Design and Technology',
		));

		$this->insert('user_course', array(
			'id'=>12,
			'title'=>'Engineering',
		));
	
		$this->insert('user_course', array(
			'id'=>13,
			'title'=>'Fashion and Textiles',
		));

		$this->insert('user_course', array(
			'id'=>14,
			'title'=>'Food Sciences and Culinary',
		));

		$this->insert('user_course', array(
			'id'=>15,
			'title'=>'Forensics',
		));

		$this->insert('user_course', array(
			'id'=>16,
			'title'=>'Health Sciences',
		));

		$this->insert('user_course', array(
			'id'=>17,
			'title'=>'Indigenous Studies',
		));

		$this->insert('user_course', array(
			'id'=>18,
			'title'=>'International and Global Studies',
		));

		$this->insert('user_course', array(
			'id'=>19,
			'title'=>'Languages',
		));

		$this->insert('user_course', array(
			'id'=>20,
			'title'=>'Law',
		));

		$this->insert('user_course', array(
			'id'=>21,
			'title'=>'Marine and Aquaculture',
		));

		$this->insert('user_course', array(
			'id'=>22,
			'title'=>'Maritime Studies',
		));
			$this->insert('user_course', array(
			'id'=>23,
			'title'=>'Medicine',
		));
			$this->insert('user_course', array(
			'id'=>24,
			'title'=>'Music',
		));
			$this->insert('user_course', array(
			'id'=>25,
			'title'=>'Nursing and Midwifery',
		));
			$this->insert('user_course', array(
			'id'=>26,
			'title'=>'Pharmacy',
		));
			$this->insert('user_course', array(
			'id'=>27,
			'title'=>'Policing, Criminology and Justice',
		));
			$this->insert('user_course', array(
			'id'=>28,
			'title'=>'Property, Surveying and Valuation',
		));
			$this->insert('user_course', array(
			'id'=>29,
			'title'=>'Research',
		));
			$this->insert('user_course', array(
			'id'=>30,
			'title'=>'Sciences',
		));
			$this->insert('user_course', array(
			'id'=>31,
			'title'=>'Social Sciences',
		));
			$this->insert('user_course', array(
			'id'=>32,
			'title'=>'Teaching and Education',
		));
			$this->insert('user_course', array(
			'id'=>33,
			'title'=>'Theology and Religious Studies',
		));
			$this->insert('user_course', array(
			'id'=>34,
			'title'=>'Veterinary Medicine',
		));
			$this->insert('user_course', array(
			'id'=>35,
			'title'=>'Visual Arts and Creative Industries',
		));
	}

	public function safeDown()
	{
		$this->dropForeignKey('course', 'user');
		$this->dropColumn('user', 'course_id');
		$this->dropTable('user_course');
	}
}