<?php

class m140427_071102_update_itemCategory_table extends CDbMigration
{
	public function safeUp()
	{
		$this->update('item_category', array(
			'title'=>'Automotive',
		), 'id=1');
		$this->update('item_category', array(
			'title'=>'Bikes',
			'id=2',
			'parent_id'=>1,
		));
		$this->update('item_category', array(
			'title'=>'Cars',
			'id=3'
			'parent_id'=>1,
		));
		$this->update('item_category', array(
			'title'=>'Motorbikes', 
			'id=4'
			'parent_id'=>1,
		));
		$this->insert('item_category', array(
			'id'=>5,
			'title'=>'Trikes',
			'parent_id'=>1,
		));
		$this->insert('item_category', array(
			'id'=>6,
			'title'=>'Scooters',
			'parent_id'=>1,
		));
		$this->insert('item_category', array(
			'id'=>9,
			'title'=>'Electronics',
		));
		$this->insert('item_category', array(
			'id'=>10,
			'title'=>'Cameras',
			'parent_id'=>9,
		));
		$this->insert('item_category', array(
			'id'=>11,
			'title'=>'Computers',
			'parent_id'=>9,
		));
		$this->insert('item_category', array(
			'id'=>12,
			'title'=>'Game Consoles',
			'parent_id'=>9,
		));
		$this->insert('item_category', array(
			'id'=>13,
			'title'=>'Laptops',
			'parent_id'=>9,
		));
		$this->insert('item_category', array(
			'id'=>14,
			'title'=>'Phones',
			'parent_id'=>9,
		));
		$this->insert('item_category', array(
			'id'=>15,
			'title'=>'Tablets',
			'parent_id'=>9,
		));
		$this->insert('item_category', array(
			'id'=>16,
			'title'=>'Video Cameras',
			'parent_id'=>9,
		));
		$this->insert('item_category', array(
			'id'=>17,
			'title'=>'Video Games',
			'parent_id'=>9,
		));
		$this->insert('item_category', array(
			'id'=>18,
			'title'=>'Home and Garden',
		));
		$this->insert('item_category', array(
			'id'=>19,
			'title'=>'Appliances',
			'parent_id'=>18,
		));
		$this->insert('item_category', array(
			'id'=>20,
			'title'=>'Garden',
			'parent_id'=>18,
		));
		$this->insert('item_category', array(
			'id'=>21,
			'title'=>'Furniture',
			'parent_id'=>18,
		));
		$this->insert('item_category', array(
			'id'=>22,
			'title'=>'Kitchenware',
			'parent_id'=>18,
		));
		$this->insert('item_category', array(
			'id'=>23,
			'title'=>'Other Home and Garden',
			'parent_id'=>18,
		));
		$this->insert('item_category', array(
			'id'=>24,
			'title'=>'Clothes and Accessories',
		));
		$this->insert('item_category', array(
			'id'=>25,
			'title'=>'Jewellery',
			'parent_id'=>24,
		));
		$this->insert('item_category', array(
			'id'=>26,
			'title'=>'Watches',
			'parent_id'=>24,
		));
		$this->insert('item_category', array(
			'id'=>27,
			'title'=>'Female Clothes and Shoes',
			'parent_id'=>24,
		));
		$this->insert('item_category', array(
			'id'=>28,
			'title'=>'Male Clothes and Shoes',
			'parent_id'=>24,
		));
		$this->insert('item_category', array(
			'id'=>29,
			'title'=>'Bags',
			'parent_id'=>24,
		));
		$this->insert('item_category', array(
			'id'=>30,
			'title'=>'Accessories',
			'parent_id'=>24,
		));
		$this->insert('item_category', array(
			'id'=>31,
			'title'=>'Movies and Music',
		));
		$this->insert('item_category', array(
			'id'=>32,
			'title'=>'CDs',
			'parent_id'=>31,
		));
		$this->insert('item_category', array(
			'id'=>33,
			'title'=>'DVDs',
			'parent_id'=>31,
		));
		$this->insert('item_category', array(
			'id'=>34,
			'title'=>'Musical Instruments',
			'parent_id'=>31,
		));
		$this->insert('item_category', array(
			'id'=>35,
			'title'=>'Sport and Hobbies',
		));
		$this->insert('item_category', array(
			'id'=>36,
			'title'=>'Gym and Fitness',
			'parent_id'=>34,
		));
		$this->insert('item_category', array(
			'id'=>37,
			'title'=>'Camping and Hiking',
			'parent_id'=>34,
		));
		$this->insert('item_category', array(
			'id'=>38,
			'title'=>'Toys',
			'parent_id'=>34,
		));
		$this->insert('item_category', array(
			'id'=>39,
			'title'=>'Other Hobbies',
			'parent_id'=>34,
		));
		/* For phase 1, I don't think we need to go to this granular level 


		$this->insert('item_category', array(
			'id'=>40,
			'title'=>'Skateboards and Rollerblades',
			'parent_id'=>34,
		));
		$this->insert('item_category', array(
			'id'=>41,
			'title'=>'Water Sports',
			'parent_id'=>34,
		)); */
		$this->insert('item_category', array(
			'id'=>42,
			'title'=>'Gigs and Entertainment',
		));
		$this->insert('item_category', array(
			'id'=>43,
			'title'=>'Concerts',
			'parent_id'=>42,
		));
		$this->insert('item_category', array(
			'id'=>44,
			'title'=>'Theatre',
			'parent_id'=>42,
		));
		$this->insert('item_category', array(
			'id'=>45,
			'title'=>'Other Entertainment',
			'parent_id'=>42,
		));

		/* We already have Sports and Hobbies above

		$this->insert('item_category', array(
			'id'=>46,
			'title'=>'Sport',
			'parent_id'=>42,
		)); */
		$this->insert('item_category', array(
			'id'=>47,
			'title'=>'Art, Craft, Made by Me',
		));
		$this->insert('item_category', array(
			'id'=>48,
			'title'=>'Art',
			'parent_id'=>47,
		));
		$this->insert('item_category', array(
			'id'=>49,
			'title'=>'Made by Me',
			'parent_id'=>47,
		));
		$this->insert('item_category', array(
			'id'=>50,
			'title'=>'Antiques, Collectables',
			'parent_id'=>47,
		));
		$this->insert('item_category', array(
			'id'=>51,
			'title'=>'Bargains',
		));
		$this->insert('item_category', array(
			'id'=>52,
			'title'=>'Free Stuff',
			'parent_id'=>51,
		));
		/* Commnuity Noticeboards removed for Phase 1

		$this->insert('item_category', array(
			'id'=>53,
			'title'=>'Garage Sale Listing',
			'parent_id'=>51,
		));
		$this->insert('item_category', array(
			'id'=>54,
			'title'=>'Community Shout Out',
		));
		$this->insert('item_category', array(
			'id'=>55,
			'title'=>'Community Noticeboard',
			'parent_id'=>54,*/
		));
		$this->insert('item_category', array(
			'id'=>56,
			'title'=>'Health and Beauty',
		));
		/* No select level for Phase 1
		$this->insert('item_category', array(
			'id'=>57,
			'title'=>'Health',
			'parent_id'=>56,
		));
		$this->insert('item_category', array(
			'id'=>58,
			'title'=>'Beauty',
			'parent_id'=>56,
		)); */

		/* Employment Section Removed for Phase 1

		$this->insert('item_category', array(
			'id'=>59,
			'title'=>'Employment',
		));
		$this->insert('item_category', array(
			'id'=>60,
			'title'=>'Internships',
			'parent_id'=>59,
		));
		$this->insert('item_category', array(
			'id'=>61,
			'title'=>'Full Time Jobs',
			'parent_id'=>59,
		));
		$this->insert('item_category', array(
			'id'=>62,
			'title'=>'Part Time Jobs',
			'parent_id'=>59,
		)); */
		$this->insert('item_category', array(
			'id'=>63,
			'title'=>'Books and Stationery',
		));
		$this->insert('item_category', array(
			'id'=>64,
			'title'=>'Books',
			'parent_id'=>63,
		));
		$this->insert('item_category', array(
			'id'=>65,
			'title'=>'Textbooks',
			'parent_id'=>63,
		));
		$this->insert('item_category', array(
			'id'=>66,
			'title'=>'Stationery',
			'parent_id'=>63,
		));
		$this->insert('item_category', array(
			'id'=>67,
			'title'=>'Wanted',
		));
		$this->insert('item_category', array(
			'id'=>68,
			'title'=>'Other',
		));
	}

	public function safeDown()
	{
		$this->delete('item_category', 'id between 5 and 68');
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
	}
}