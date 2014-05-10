<?php

class m140427_071102_update_itemCategory_table extends CDbMigration
{
	public function safeUp()
	{
		$this->dropForeignKey('category', 'item');
		$this->dropForeignKey('parentCategory', 'item_category');

		$this->alterColumn('item', 'category_id', 'smallint UNSIGNED');

		$this->alterColumn('item_category', 'id', 'smallint UNSIGNED');
		$this->alterColumn('item_category', 'title', 'varchar(32)');
		$this->alterColumn('item_category', 'parent_id', 'smallint UNSIGNED');

		$this->addForeignKey('category', 'item', 'category_id', 'item_category', 'id', 'SET NULL', 'CASCADE');
		$this->addForeignKey('parentCategory', 'item_category', 'parent_id', 'item_category', 'id', 'SET NULL', 'CASCADE');

		$this->update('item_category', array(
			'title'=>'Art, Craft, Made by Me',
		), 'id=1');
		$this->update('item_category', array(
			'title'=>'Automotive',
		), 'id=2');
		$this->update('item_category', array(
			'title'=>'Books and Stationery',
		), 'id=3');
		$this->update('item_category', array(
			'title'=>'Clothes and Accessories',
		), 'id=4');
		$this->insert('item_category', array(
			'id'=>5,
			'title'=>'Electronics',
		));
		$this->insert('item_category', array(
			'id'=>6,
			'title'=>'Gigs and Entertainment',
		));
		$this->insert('item_category', array(
			'id'=>7,
			'title'=>'Health and Beauty',
		));
		$this->insert('item_category', array(
			'id'=>8,
			'title'=>'Home and Garden',
		));
		$this->insert('item_category', array(
			'id'=>9,
			'title'=>'Movies and Music',
		));
		$this->insert('item_category', array(
			'id'=>10,
			'title'=>'Sport and Hobbies',
		));
		$this->insert('item_category', array(
			'id'=>11,
			'title'=>'Others',
		));

		{
			$this->insert('item_category', array(
				'id'=>101,
				'title'=>'Antiques, Collectables',
				'parent_id'=>1,
			));
			$this->insert('item_category', array(
				'id'=>102,
				'title'=>'Art',
				'parent_id'=>1,
			));
			$this->insert('item_category', array(
				'id'=>103,
				'title'=>'Made by Me',
				'parent_id'=>1,
			));
		}

		{
			$this->insert('item_category', array(
				'id'=>201,
				'title'=>'Bikes',
				'parent_id'=>2,
			));
			$this->insert('item_category', array(
				'id'=>202,
				'title'=>'Cars',
				'parent_id'=>2,
			));
			$this->insert('item_category', array(
				'id'=>203,
				'title'=>'Motorbikes',
				'parent_id'=>2,
			));
			$this->insert('item_category', array(
				'id'=>204,
				'title'=>'Scooters',
				'parent_id'=>2,
			));
			$this->insert('item_category', array(
				'id'=>205,
				'title'=>'Trikes',
				'parent_id'=>2,
			));
		}

		{
			$this->insert('item_category', array(
				'id'=>301,
				'title'=>'Books',
				'parent_id'=>3,
			));
			$this->insert('item_category', array(
				'id'=>302,
				'title'=>'Stationery',
				'parent_id'=>3,
			));
			$this->insert('item_category', array(
				'id'=>303,
				'title'=>'Textbooks',
				'parent_id'=>3,
			));
		}

		{
			$this->insert('item_category', array(
				'id'=>401,
				'title'=>'Accessories',
				'parent_id'=>4,
			));
			$this->insert('item_category', array(
				'id'=>402,
				'title'=>'Bags',
				'parent_id'=>4,
			));
			$this->insert('item_category', array(
				'id'=>403,
				'title'=>'Female Clothes and Shoes',
				'parent_id'=>4,
			));
			$this->insert('item_category', array(
				'id'=>404,
				'title'=>'Jewellery',
				'parent_id'=>4,
			));
			$this->insert('item_category', array(
				'id'=>405,
				'title'=>'Male Clothes and Shoes',
				'parent_id'=>4,
			));
			$this->insert('item_category', array(
				'id'=>406,
				'title'=>'Watches',
				'parent_id'=>4,
			));
		}

		{
			$this->insert('item_category', array(
				'id'=>501,
				'title'=>'Cameras',
				'parent_id'=>5,
			));
			$this->insert('item_category', array(
				'id'=>502,
				'title'=>'Computers',
				'parent_id'=>5,
			));
			$this->insert('item_category', array(
				'id'=>503,
				'title'=>'Game Consoles',
				'parent_id'=>5,
			));
			$this->insert('item_category', array(
				'id'=>504,
				'title'=>'Laptops',
				'parent_id'=>5,
			));
			$this->insert('item_category', array(
				'id'=>505,
				'title'=>'Phones',
				'parent_id'=>5,
			));
			$this->insert('item_category', array(
				'id'=>506,
				'title'=>'Tablets',
				'parent_id'=>5,
			));
			$this->insert('item_category', array(
				'id'=>507,
				'title'=>'Video Cameras',
				'parent_id'=>5,
			));
			$this->insert('item_category', array(
				'id'=>508,
				'title'=>'Video Games',
				'parent_id'=>5,
			));
		}

		{
			$this->insert('item_category', array(
				'id'=>601,
				'title'=>'Concerts',
				'parent_id'=>6,
			));
			$this->insert('item_category', array(
				'id'=>602,
				'title'=>'Theatre',
				'parent_id'=>6,
			));
			$this->insert('item_category', array(
				'id'=>603,
				'title'=>'Other Entertainment',
				'parent_id'=>6,
			));
		}

		{
			$this->insert('item_category', array(
				'id'=>801,
				'title'=>'Appliances',
				'parent_id'=>8,
			));
			$this->insert('item_category', array(
				'id'=>802,
				'title'=>'Furniture',
				'parent_id'=>8,
			));
			$this->insert('item_category', array(
				'id'=>803,
				'title'=>'Garden',
				'parent_id'=>8,
			));
			$this->insert('item_category', array(
				'id'=>804,
				'title'=>'Kitchenware',
				'parent_id'=>8,
			));
			$this->insert('item_category', array(
				'id'=>805,
				'title'=>'Other Home and Garden',
				'parent_id'=>8,
			));
		}

		{
			$this->insert('item_category', array(
				'id'=>901,
				'title'=>'CDs',
				'parent_id'=>9,
			));
			$this->insert('item_category', array(
				'id'=>902,
				'title'=>'DVDs',
				'parent_id'=>9,
			));
			$this->insert('item_category', array(
				'id'=>903,
				'title'=>'Musical Instruments',
				'parent_id'=>9,
			));
		}

		{
			$this->insert('item_category', array(
				'id'=>1001,
				'title'=>'Camping and Hiking',
				'parent_id'=>10,
			));
			$this->insert('item_category', array(
				'id'=>1002,
				'title'=>'Gym and Fitness',
				'parent_id'=>10,
			));
			$this->insert('item_category', array(
				'id'=>1003,
				'title'=>'Toys',
				'parent_id'=>10,
			));
			$this->insert('item_category', array(
				'id'=>1004,
				'title'=>'Other Hobbies',
				'parent_id'=>10,
			));
		}
	}

	public function safeDown()
	{
		$this->delete('item_category', 'id between 5 and 2000');

		$this->update('item_category', array(
			'title'=>'Real Estate',
		), 'id=4');
		$this->update('item_category', array(
			'title'=>'Mobile Phones',
		), 'id=3');
		$this->update('item_category', array(
			'title'=>'Computers',
		), 'id=2');
		$this->update('item_category', array(
			'title'=>'Cars',
		), 'id=1');

		$this->dropForeignKey('parentCategory', 'item_category');
		$this->dropForeignKey('category', 'item');

		$this->alterColumn('item_category', 'parent_id', 'tinyint UNSIGNED');
		$this->alterColumn('item_category', 'title', 'varchar(16)');
		$this->alterColumn('item_category', 'id', 'tinyint UNSIGNED');

		$this->alterColumn('item', 'category_id', 'tinyint UNSIGNED');

		$this->addForeignKey('parentCategory', 'item_category', 'parent_id', 'item_category', 'id', 'SET NULL', 'CASCADE');
		$this->addForeignKey('category', 'item', 'category_id', 'item_category', 'id', 'SET NULL', 'CASCADE');
	}
}