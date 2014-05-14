<?php

class m140503_023237_create_userUniversity_table extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('user_university', array(
			'id'=>'mediumint UNSIGNED PRIMARY KEY',
			'title'=>'varchar(64) NOT NULL',
			'parent_id'=>'mediumint UNSIGNED DEFAULT NULL',
		), 'ENGINE InnoDB');
		$this->addForeignKey('parentUniversity', 'user_university', 'parent_id', 'user_university', 'id', 'SET NULL', 'CASCADE');
		$this->addColumn('user', 'university_id', 'mediumint UNSIGNED AFTER location_id');
		$this->addForeignKey('university', 'user', 'university_id', 'user_university', 'id', 'SET NULL', 'CASCADE');

		// Australian Universities
		$this->insert('user_university', array(
			'id'=>1,
			'title'=>'Australian Catholic University',
		));
		$this->insert('user_university', array(
			'id'=>2,
			'title'=>'Australian National University',
		));
		$this->insert('user_university', array(
			'id'=>3,
			'title'=>'Batchelor Institute of Indigenous Tertiary Education',
		));
		$this->insert('user_university', array(
			'id'=>4,
			'title'=>'Bond University',
		));
		$this->insert('user_university', array(
			'id'=>5,
			'title'=>'Central Queensland University',
		));
		$this->insert('user_university', array(
			'id'=>6,
			'title'=>'Charles Darwin University ',
		));
		$this->insert('user_university', array(
			'id'=>7,
			'title'=>'Charles Sturt University ',
		));
		$this->insert('user_university', array(
			'id'=>8,
			'title'=>'Curtin University of Technology',
		));
		$this->insert('user_university', array(
			'id'=>9,
			'title'=>'Deakin University',
		));
		$this->insert('user_university', array(
			'id'=>10,
			'title'=>'Edith Cowan University',
		));
		$this->insert('user_university', array(
			'id'=>11,
			'title'=>'Federation University Australia',
		));
		$this->insert('user_university', array(
			'id'=>12,
			'title'=>'Flinders University',
		));
		$this->insert('user_university', array(
			'id'=>13,
			'title'=>'Griffith University',
		));
		$this->insert('user_university', array(
			'id'=>14,
			'title'=>'James Cook University',
		));
		$this->insert('user_university', array(
			'id'=>15,
			'title'=>'La Trobe University',
		));
		$this->insert('user_university', array(
			'id'=>16,
			'title'=>'Macquarie University',
		));
		$this->insert('user_university', array(
			'id'=>17,
			'title'=>'MCD University of Divinity',
		));
		$this->insert('user_university', array(
			'id'=>18,
			'title'=>'Monash University',
		));
		$this->insert('user_university', array(
			'id'=>19,
			'title'=>'Murdoch University',
		));
		$this->insert('user_university', array(
			'id'=>20,
			'title'=>'Queensland University of Technology',
		));
		$this->insert('user_university', array(
			'id'=>21,
			'title'=>'RMIT University',
		));
		$this->insert('user_university', array(
			'id'=>22,
			'title'=>'Southern Cross University',
		));
		$this->insert('user_university', array(
			'id'=>23,
			'title'=>'Swinburne University of Technology',
		));
		$this->insert('user_university', array(
			'id'=>24,
			'title'=>'University of Adelaide',
		));
		$this->insert('user_university', array(
			'id'=>25,
			'title'=>'University of Canberra',
		));
		$this->insert('user_university', array(
			'id'=>26,
			'title'=>'University of Melbourne',
		));
		$this->insert('user_university', array(
			'id'=>27,
			'title'=>'University of New England',
		));
		$this->insert('user_university', array(
			'id'=>28,
			'title'=>'University of New South Wales',
		));
		$this->insert('user_university', array(
			'id'=>29,
			'title'=>'University of Newcastle',
		));
		$this->insert('user_university', array(
			'id'=>30,
			'title'=>'University of Notre Dame',
		));
		$this->insert('user_university', array(
			'id'=>31,
			'title'=>'University of Queensland',
		));
		$this->insert('user_university', array(
			'id'=>32,
			'title'=>'University of South Australia',
		));
		$this->insert('user_university', array(
			'id'=>33,
			'title'=>'University of Sydney',
		));
		$this->insert('user_university', array(
			'id'=>34,
			'title'=>'University of Tasmania',
		));
		$this->insert('user_university', array(
			'id'=>35,
			'title'=>'University of Technology Sydney',
		));
		$this->insert('user_university', array(
			'id'=>36,
			'title'=>'University of the Sunshine Coast',
		));
		$this->insert('user_university', array(
			'id'=>37,
			'title'=>'University of Western Australia',
		));
		$this->insert('user_university', array(
			'id'=>38,
			'title'=>'University of Western Sydney',
		));
		$this->insert('user_university', array(
			'id'=>39,
			'title'=>'University of Wollongong',
		));
		$this->insert('user_university', array(
			'id'=>40,
			'title'=>'Victoria University',
		));
		$this->insert('user_university', array(
			'id'=>41,
			'title'=>'University of Southern Queensland ',
		));

		// University Campuses

		// ACU
		$this->insert('user_university', array(
			'id'=>401,
			'title'=>'Adelaide',
			'parent_id'=>1,
		));
		$this->insert('user_university', array(
			'id'=>402,
			'title'=>'Ballarat',
			'parent_id'=>1,
		));
		$this->insert('user_university', array(
			'id'=>403,
			'title'=>'Brisbane',
			'parent_id'=>1,
		));
		$this->insert('user_university', array(
			'id'=>404,
			'title'=>'Canberra',
			'parent_id'=>1,
		));
		$this->insert('user_university', array(
			'id'=>405,
			'title'=>'Melbourne',
			'parent_id'=>1,
		));
		$this->insert('user_university', array(
			'id'=>406,
			'title'=>'North Sydney',
			'parent_id'=>1,
		));
		$this->insert('user_university', array(
			'id'=>407,
			'title'=>'Strathfield',
			'parent_id'=>1,
		));

		// Central Queensland Uni
		$this->insert('user_university', array(
			'id'=>501,
			'title'=>'Brisbane',
			'parent_id'=>5,
		));
		$this->insert('user_university', array(
			'id'=>502,
			'title'=>'Bundaberg',
			'parent_id'=>5,
		));
		$this->insert('user_university', array(
			'id'=>503,
			'title'=>'Cairns Distance Education Study Centre',
			'parent_id'=>5,
		));
		$this->insert('user_university', array(
			'id'=>504,
			'title'=>'Emerald',
			'parent_id'=>5,
		));
		$this->insert('user_university', array(
			'id'=>505,
			'title'=>'Gladstone, Marina',
			'parent_id'=>5,
		));
		$this->insert('user_university', array(
			'id'=>506,
			'title'=>'Gladstone, Marina',
			'parent_id'=>5,
		));
		$this->insert('user_university', array(
			'id'=>507,
			'title'=>'Gladstone, City',
			'parent_id'=>5,
		));
		$this->insert('user_university', array(
			'id'=>508,
			'title'=>'Mackay, Ooralea',
			'parent_id'=>5,
		));
		$this->insert('user_university', array(
			'id'=>509,
			'title'=>'Mackay, City',
			'parent_id'=>5,
		));
		$this->insert('user_university', array(
			'id'=>510,
			'title'=>'Melbourne',
			'parent_id'=>5,
		));
		$this->insert('user_university', array(
			'id'=>511,
			'title'=>'Noosa',
			'parent_id'=>5,
		));
		$this->insert('user_university', array(
			'id'=>512,
			'title'=>'Rockhampton, North',
			'parent_id'=>5,
		));
		$this->insert('user_university', array(
			'id'=>513,
			'title'=>'Rockhampton, City',
			'parent_id'=>5,
		));
		$this->insert('user_university', array(
			'id'=>514,
			'title'=>'Sydney',
			'parent_id'=>5,
		));
		$this->insert('user_university', array(
			'id'=>515,
			'title'=>'Yeppoon Study Centre',
			'parent_id'=>5,
		));
		$this->insert('user_university', array(
			'id'=>516,
			'title'=>'Great Barrier Reef Institute of Tafe',
			'parent_id'=>5,
		));
		$this->insert('user_university', array(
			'id'=>517,
			'title'=>'Edithvale',
			'parent_id'=>5,
		));

		//Charles Sturt
		$this->insert('user_university', array(
			'id'=>701,
			'title'=>'Albury-Wodonga',
			'parent_id'=>7,
		));
		$this->insert('user_university', array(
			'id'=>702,
			'title'=>'Bathurst',
			'parent_id'=>7,
		));
		$this->insert('user_university', array(
			'id'=>703,
			'title'=>'Canberra',
			'parent_id'=>7,
		));
		$this->insert('user_university', array(
			'id'=>704,
			'title'=>'Dubbo',
			'parent_id'=>7,
		));
		$this->insert('user_university', array(
			'id'=>705,
			'title'=>'Goulburn',
			'parent_id'=>7,
		));
		$this->insert('user_university', array(
			'id'=>706,
			'title'=>'Griffith',
			'parent_id'=>7,
		));
		$this->insert('user_university', array(
			'id'=>707,
			'title'=>'Manly',
			'parent_id'=>7,
		));
		$this->insert('user_university', array(
			'id'=>708,
			'title'=>'Melbourne',
			'parent_id'=>7,
		));
		$this->insert('user_university', array(
			'id'=>709,
			'title'=>'Ontario',
			'parent_id'=>7,
		));
		$this->insert('user_university', array(
			'id'=>710,
			'title'=>'Orange',
			'parent_id'=>7,
		));
		$this->insert('user_university', array(
			'id'=>711,
			'title'=>'Parkes',
			'parent_id'=>7,
		));
		$this->insert('user_university', array(
			'id'=>712,
			'title'=>'Parramatta',
			'parent_id'=>7,
		));
		$this->insert('user_university', array(
			'id'=>713,
			'title'=>'Port Macquarie',
			'parent_id'=>7,
		));
		$this->insert('user_university', array(
			'id'=>714,
			'title'=>'Sydney',
			'parent_id'=>7,
		));
		$this->insert('user_university', array(
			'id'=>715,
			'title'=>'Wagga Wagga',
			'parent_id'=>7,
		));
		$this->insert('user_university', array(
			'id'=>716,
			'title'=>'Wangaratta',
			'parent_id'=>7,
		));

		// Curtin Uni of Tech
		$this->insert('user_university', array(
			'id'=>801,
			'title'=>'Bentley',
			'parent_id'=>8,
		));
		$this->insert('user_university', array(
			'id'=>802,
			'title'=>'Kalgoorlie',
			'parent_id'=>8,
		));
		$this->insert('user_university', array(
			'id'=>803,
			'title'=>'Margaret River',
			'parent_id'=>8,
		));
		$this->insert('user_university', array(
			'id'=>804,
			'title'=>'Perth',
			'parent_id'=>8,
		));
		$this->insert('user_university', array(
			'id'=>805,
			'title'=>'Shenton Park',
			'parent_id'=>8,
		));

		// Deakin Uni
		$this->insert('user_university', array(
			'id'=>901,
			'title'=>'Geelong Waterfront',
			'parent_id'=>9,
		));
		$this->insert('user_university', array(
			'id'=>902,
			'title'=>'Geelong Waurn',
			'parent_id'=>9,
		));
		$this->insert('user_university', array(
			'id'=>903,
			'title'=>'Melbourne',
			'parent_id'=>9,
		));
		$this->insert('user_university', array(
			'id'=>904,
			'title'=>'Warrnambool',
			'parent_id'=>9,
		));

		// Edith Cowan
		$this->insert('user_university', array(
			'id'=>1001,
			'title'=>'Joondaloop',
			'parent_id'=>10,
		));
		$this->insert('user_university', array(
			'id'=>1002,
			'title'=>'Mount Lawley',
			'parent_id'=>10,
		));
		$this->insert('user_university', array(
			'id'=>1003,
			'title'=>'South West',
			'parent_id'=>10,
		));

		// Federation Uni
		$this->insert('user_university', array(
			'id'=>1101,
			'title'=>'Ararat',
			'parent_id'=>11,
		));
		$this->insert('user_university', array(
			'id'=>1102,
			'title'=>'Ararat',
			'parent_id'=>11,
		));
		$this->insert('user_university', array(
			'id'=>1103,
			'title'=>'Camp St',
			'parent_id'=>11,
		));
		$this->insert('user_university', array(
			'id'=>1104,
			'title'=>'Gippsland',
			'parent_id'=>11,
		));
		$this->insert('user_university', array(
			'id'=>1105,
			'title'=>'Horsham',
			'parent_id'=>11,
		));
		$this->insert('user_university', array(
			'id'=>1106,
			'title'=>'Mount Helen',
			'parent_id'=>11,
		));
		$this->insert('user_university', array(
			'id'=>1107,
			'title'=>'SMB',
			'parent_id'=>11,
		));
		$this->insert('user_university', array(
			'id'=>1108,
			'title'=>'Stawell',
			'parent_id'=>11,
		));

		// FLinders Uni
		$this->insert('user_university', array(
			'id'=>1201,
			'title'=>'Barossa',
			'parent_id'=>12,
		));
		$this->insert('user_university', array(
			'id'=>1202,
			'title'=>'Bedford Park',
			'parent_id'=>12,
		));
		$this->insert('user_university', array(
			'id'=>1203,
			'title'=>'Mount Gambier',
			'parent_id'=>12,
		));
		$this->insert('user_university', array(
			'id'=>1204,
			'title'=>'Murray Bridge',
			'parent_id'=>12,
		));
		$this->insert('user_university', array(
			'id'=>1205,
			'title'=>'Northern Territory',
			'parent_id'=>12,
		));
		$this->insert('user_university', array(
			'id'=>1206,
			'title'=>'Port Lincoln',
			'parent_id'=>12,
		));
		$this->insert('user_university', array(
			'id'=>1207,
			'title'=>'Renmark',
			'parent_id'=>12,
		));
		$this->insert('user_university', array(
			'id'=>1208,
			'title'=>'Victor Harbor',
			'parent_id'=>12,
		));

		// Griffith Uni
		$this->insert('user_university', array(
			'id'=>1301,
			'title'=>'Gold Coast',
			'parent_id'=>13,
		));
		$this->insert('user_university', array(
			'id'=>1302,
			'title'=>'Logan',
			'parent_id'=>13,
		));
		$this->insert('user_university', array(
			'id'=>1303,
			'title'=>'Mount Gravatt',
			'parent_id'=>13,
		));
		$this->insert('user_university', array(
			'id'=>1304,
			'title'=>'Nathan',
			'parent_id'=>13,
		));
		$this->insert('user_university', array(
			'id'=>1305,
			'title'=>'South Bank',
			'parent_id'=>13,
		));

		// James Cook Uni
		$this->insert('user_university', array(
			'id'=>1401,
			'title'=>'Brisbane',
			'parent_id'=>14,
		));
		$this->insert('user_university', array(
			'id'=>1402,
			'title'=>'Cairns',
			'parent_id'=>14,
		));
		$this->insert('user_university', array(
			'id'=>1403,
			'title'=>'Mackay',
			'parent_id'=>14,
		));
		$this->insert('user_university', array(
			'id'=>1404,
			'title'=>'Mount Isa',
			'parent_id'=>14,
		));
		$this->insert('user_university', array(
			'id'=>1405,
			'title'=>'Thursday Island',
			'parent_id'=>14,
		));
		$this->insert('user_university', array(
			'id'=>1406,
			'title'=>'Townsville',
			'parent_id'=>14,
		));

		// La Trobe
		$this->insert('user_university', array(
			'id'=>1501,
			'title'=>'Albury-Wodonga',
			'parent_id'=>15,
		));
		$this->insert('user_university', array(
			'id'=>1502,
			'title'=>'Bendigo',
			'parent_id'=>15,
		));
		$this->insert('user_university', array(
			'id'=>1503,
			'title'=>'City',
			'parent_id'=>15,
		));
		$this->insert('user_university', array(
			'id'=>1504,
			'title'=>'Franklin Street',
			'parent_id'=>15,
		));
		$this->insert('user_university', array(
			'id'=>1505,
			'title'=>'Mildura',
			'parent_id'=>15,
		));
		$this->insert('user_university', array(
			'id'=>1506,
			'title'=>'Shepparton',
			'parent_id'=>15,
		));
		$this->insert('user_university', array(
			'id'=>1507,
			'title'=>'Sydney',
			'parent_id'=>15,
		));

		// Monash Uni
		$this->insert('user_university', array(
			'id'=>1801,
			'title'=>'Berwick',
			'parent_id'=>18,
		));
		$this->insert('user_university', array(
			'id'=>1802,
			'title'=>'Clayton',
			'parent_id'=>18,
		));
		$this->insert('user_university', array(
			'id'=>1803,
			'title'=>'Caulfield',
			'parent_id'=>18,
		));
		$this->insert('user_university', array(
			'id'=>1804,
			'title'=>'Parkville',
			'parent_id'=>18,
		));

		// Murdoch Uni
		$this->insert('user_university', array(
			'id'=>1901,
			'title'=>'Peel',
			'parent_id'=>19,
		));
		$this->insert('user_university', array(
			'id'=>1902,
			'title'=>'Rockingham',
			'parent_id'=>19,
		));
		$this->insert('user_university', array(
			'id'=>1903,
			'title'=>'South Street',
			'parent_id'=>19,
		));

		// Queensland University of Technology 
		$this->insert('user_university', array(
			'id'=>2001,
			'title'=>'Cabooltre',
			'parent_id'=>20,
		));
		$this->insert('user_university', array(
			'id'=>2002,
			'title'=>'Gardens Point',
			'parent_id'=>20,
		));
		$this->insert('user_university', array(
			'id'=>2003,
			'title'=>'Kelvin Grove',
			'parent_id'=>20,
		));

		// RMIT
		$this->insert('user_university', array(
			'id'=>2101,
			'title'=>'Brunswick',
			'parent_id'=>21,
		));
		$this->insert('user_university', array(
			'id'=>2102,
			'title'=>'Bundoora',
			'parent_id'=>21,
		));
		$this->insert('user_university', array(
			'id'=>2103,
			'title'=>'Melbourne',
			'parent_id'=>21,
		));

		// Southern Cross
		$this->insert('user_university', array(
			'id'=>2201,
			'title'=>'Coffs Harbour',
			'parent_id'=>22,
		));
		$this->insert('user_university', array(
			'id'=>2202,
			'title'=>'Gold Coast',
			'parent_id'=>22,
		));
		$this->insert('user_university', array(
			'id'=>2203,
			'title'=>'Lismore',
			'parent_id'=>22,
		));
		$this->insert('user_university', array(
			'id'=>2204,
			'title'=>'Sydney',
			'parent_id'=>22,
		));

		// Swinburne University of Technology 
		$this->insert('user_university', array(
			'id'=>2301,
			'title'=>'Croydon',
			'parent_id'=>23,
		));
		$this->insert('user_university', array(
			'id'=>2302,
			'title'=>'Hawthorn',
			'parent_id'=>23,
		));
		$this->insert('user_university', array(
			'id'=>2303,
			'title'=>'Melbourne',
			'parent_id'=>23,
		));
		$this->insert('user_university', array(
			'id'=>2304,
			'title'=>'Prahran',
			'parent_id'=>23,
		));
		$this->insert('user_university', array(
			'id'=>2305,
			'title'=>'Sydney',
			'parent_id'=>23,
		));
		$this->insert('user_university', array(
			'id'=>2306,
			'title'=>'Wantirna',
			'parent_id'=>23,
		));

		// Uni of Adelaide
		$this->insert('user_university', array(
			'id'=>2401,
			'title'=>'North Terrace',
			'parent_id'=>24,
		));
		$this->insert('user_university', array(
			'id'=>2402,
			'title'=>'Roseworthy',
			'parent_id'=>24,
		));
		$this->insert('user_university', array(
			'id'=>2403,
			'title'=>'The Waite',
			'parent_id'=>24,
		));
		$this->insert('user_university', array(
			'id'=>2404,
			'title'=>'Thebarton',
			'parent_id'=>24,
		));

		// Uni of Canberra
		$this->insert('user_university', array(
			'id'=>2501,
			'title'=>'Batemans Bay',
			'parent_id'=>25,
		));
		$this->insert('user_university', array(
			'id'=>2502,
			'title'=>'Bega',
			'parent_id'=>25,
		));
		$this->insert('user_university', array(
			'id'=>2503,
			'title'=>'Bruce',
			'parent_id'=>25,
		));
		$this->insert('user_university', array(
			'id'=>2504,
			'title'=>'Chadstone',
			'parent_id'=>25,
		));
		$this->insert('user_university', array(
			'id'=>2505,
			'title'=>'Cooma',
			'parent_id'=>25,
		));
		$this->insert('user_university', array(
			'id'=>2506,
			'title'=>'Erindale College',
			'parent_id'=>25,
		));
		$this->insert('user_university', array(
			'id'=>2507,
			'title'=>'Goulburn',
			'parent_id'=>25,
		));
		$this->insert('user_university', array(
			'id'=>2508,
			'title'=>'Griffith',
			'parent_id'=>25,
		));
		$this->insert('user_university', array(
			'id'=>2509,
			'title'=>'Liverpool',
			'parent_id'=>25,
		));
		$this->insert('user_university', array(
			'id'=>2510,
			'title'=>'Melbourne City',
			'parent_id'=>25,
		));
		$this->insert('user_university', array(
			'id'=>2511,
			'title'=>'Merimbula',
			'parent_id'=>25,
		));
		$this->insert('user_university', array(
			'id'=>2512,
			'title'=>'Moorabbin',
			'parent_id'=>25,
		));
		$this->insert('user_university', array(
			'id'=>2513,
			'title'=>'St Leonards',
			'parent_id'=>25,
		));
		$this->insert('user_university', array(
			'id'=>2514,
			'title'=>'Ulladulla',
			'parent_id'=>25,
		));
		$this->insert('user_university', array(
			'id'=>2515,
			'title'=>'Waverley',
			'parent_id'=>25,
		));
		$this->insert('user_university', array(
			'id'=>2516,
			'title'=>'Young',
			'parent_id'=>25,
		));

		// Uni of Melbourne
		$this->insert('user_university', array(
			'id'=>2601,
			'title'=>'Bio21 Institute',
			'parent_id'=>26,
		));
		$this->insert('user_university', array(
			'id'=>2602,
			'title'=>'Burnley',
			'parent_id'=>26,
		));
		$this->insert('user_university', array(
			'id'=>2603,
			'title'=>'Creswick',
			'parent_id'=>26,
		));
		$this->insert('user_university', array(
			'id'=>2604,
			'title'=>'Dookie',
			'parent_id'=>26,
		));
		$this->insert('user_university', array(
			'id'=>2605,
			'title'=>'Hawthorn',
			'parent_id'=>26,
		));
		$this->insert('user_university', array(
			'id'=>2606,
			'title'=>'Parkville',
			'parent_id'=>26,
		));
		$this->insert('user_university', array(
			'id'=>2607,
			'title'=>'Shepparton',
			'parent_id'=>26,
		));
		$this->insert('user_university', array(
			'id'=>2608,
			'title'=>'Werribee',
			'parent_id'=>26,
		));

		// Uni of New England
		$this->insert('user_university', array(
			'id'=>2701,
			'title'=>'Armidale',
			'parent_id'=>27,
		));
		$this->insert('user_university', array(
			'id'=>2702,
			'title'=>'Bellevue',
			'parent_id'=>27,
		));

		// Uni of NSW
		$this->insert('user_university', array(
			'id'=>2801,
			'title'=>'Cliffbrook',
			'parent_id'=>28,
		));
		$this->insert('user_university', array(
			'id'=>2802,
			'title'=>'David Phillips Field',
			'parent_id'=>28,
		));
		$this->insert('user_university', array(
			'id'=>2803,
			'title'=>'Canberra',
			'parent_id'=>28,
		));
		$this->insert('user_university', array(
			'id'=>2804,
			'title'=>'COFA',
			'parent_id'=>28,
		));
		$this->insert('user_university', array(
			'id'=>2805,
			'title'=>'Kensington',
			'parent_id'=>28,
		));
		$this->insert('user_university', array(
			'id'=>2806,
			'title'=>'Cliffbrook',
			'parent_id'=>28,
		));
		$this->insert('user_university', array(
			'id'=>2807,
			'title'=>'Manly Vale',
			'parent_id'=>28,
		));
		$this->insert('user_university', array(
			'id'=>2808,
			'title'=>'Randwick',
			'parent_id'=>28,
		));
		$this->insert('user_university', array(
			'id'=>2809,
			'title'=>'Sydney City',
			'parent_id'=>28,
		));

		// Uni of Newcastle
		$this->insert('user_university', array(
			'id'=>2901,
			'title'=>'Armidale',
			'parent_id'=>29,
		));
		$this->insert('user_university', array(
			'id'=>2902,
			'title'=>'Callaghan',
			'parent_id'=>29,
		));
		$this->insert('user_university', array(
			'id'=>2903,
			'title'=>'Central Coast',
			'parent_id'=>29,
		));
		$this->insert('user_university', array(
			'id'=>2904,
			'title'=>'Moree',
			'parent_id'=>29,
		));
		$this->insert('user_university', array(
			'id'=>2905,
			'title'=>'Newcastle City',
			'parent_id'=>29,
		));
		$this->insert('user_university', array(
			'id'=>2906,
			'title'=>'Orange',
			'parent_id'=>29,
		));
		$this->insert('user_university', array(
			'id'=>2907,
			'title'=>'Port Macquarie',
			'parent_id'=>29,
		));
		$this->insert('user_university', array(
			'id'=>2908,
			'title'=>'Sydney',
			'parent_id'=>29,
		));
		$this->insert('user_university', array(
			'id'=>2909,
			'title'=>'Tamworth',
			'parent_id'=>29,
		));

		// Uni of Notre Dame
		$this->insert('user_university', array(
			'id'=>3001,
			'title'=>'Broome',
			'parent_id'=>30,
		));
		$this->insert('user_university', array(
			'id'=>3002,
			'title'=>'Fremantle',
			'parent_id'=>30,
		));
		$this->insert('user_university', array(
			'id'=>3003,
			'title'=>'Sydney',
			'parent_id'=>30,
		));

		// Uni of QLD
		$this->insert('user_university', array(
			'id'=>3101,
			'title'=>'Gatton',
			'parent_id'=>31,
		));
		$this->insert('user_university', array(
			'id'=>3102,
			'title'=>'Herston',
			'parent_id'=>31,
		));
		$this->insert('user_university', array(
			'id'=>3103,
			'title'=>'Ipswich',
			'parent_id'=>31,
		));
		$this->insert('user_university', array(
			'id'=>3104,
			'title'=>'St Lucia',
			'parent_id'=>31,
		));

		// Uni of Sth Australia
		$this->insert('user_university', array(
			'id'=>3201,
			'title'=>'City East',
			'parent_id'=>32,
		));
		$this->insert('user_university', array(
			'id'=>3202,
			'title'=>'City West',
			'parent_id'=>32,
		));
		$this->insert('user_university', array(
			'id'=>3203,
			'title'=>'Magill',
			'parent_id'=>32,
		));
		$this->insert('user_university', array(
			'id'=>3204,
			'title'=>'Mawson Lakes',
			'parent_id'=>32,
		));
		$this->insert('user_university', array(
			'id'=>3205,
			'title'=>'Mount Gambia',
			'parent_id'=>32,
		));
		$this->insert('user_university', array(
			'id'=>3206,
			'title'=>'Whyalla',
			'parent_id'=>32,
		));

		// Uni of Sydney
		$this->insert('user_university', array(
			'id'=>3301,
			'title'=>'Camperdown/Darlington',
			'parent_id'=>33,
		));
		$this->insert('user_university', array(
			'id'=>3302,
			'title'=>'Camden',
			'parent_id'=>33,
		));
		$this->insert('user_university', array(
			'id'=>3303,
			'title'=>'Cumberland',
			'parent_id'=>33,
		));
		$this->insert('user_university', array(
			'id'=>3304,
			'title'=>'Mallett Street',
			'parent_id'=>33,
		));
		$this->insert('user_university', array(
			'id'=>3305,
			'title'=>'Rozelle',
			'parent_id'=>33,
		));
		$this->insert('user_university', array(
			'id'=>3306,
			'title'=>'Surry Hills',
			'parent_id'=>33,
		));
		$this->insert('user_university', array(
			'id'=>3307,
			'title'=>'Sydney Conservatorium of Music',
			'parent_id'=>33,
		));

		// Uni of Tasmania
		$this->insert('user_university', array(
			'id'=>3401,
			'title'=>'Burnie',
			'parent_id'=>34,
		));
		$this->insert('user_university', array(
			'id'=>3402,
			'title'=>'Hobart',
			'parent_id'=>34,
		));
		$this->insert('user_university', array(
			'id'=>3403,
			'title'=>'Launceston',
			'parent_id'=>34,
		));
		$this->insert('user_university', array(
			'id'=>3404,
			'title'=>'Sydney',
			'parent_id'=>34,
		));

		// UTS
		$this->insert('user_university', array(
			'id'=>3501,
			'title'=>'Kuring-gai',
			'parent_id'=>35,
		));
		$this->insert('user_university', array(
			'id'=>3502,
			'title'=>'Sydney City',
			'parent_id'=>35,
		));

		// University of Western Australia
		$this->insert('user_university', array(
			'id'=>3701,
			'title'=>'Albany',
			'parent_id'=>37,
		));
		$this->insert('user_university', array(
			'id'=>3702,
			'title'=>'Claremont',
			'parent_id'=>37,
		));
		$this->insert('user_university', array(
			'id'=>3703,
			'title'=>'Crawley',
			'parent_id'=>37,
		));

		// Uni of Western Syd
		$this->insert('user_university', array(
			'id'=>3801,
			'title'=>'Bankstown',
			'parent_id'=>38,
		));
		$this->insert('user_university', array(
			'id'=>3802,
			'title'=>'Blacktown',
			'parent_id'=>38,
		));
		$this->insert('user_university', array(
			'id'=>3803,
			'title'=>'Campbelltown',
			'parent_id'=>38,
		));
		$this->insert('user_university', array(
			'id'=>3804,
			'title'=>'Hawkesbury',
			'parent_id'=>38,
		));
		$this->insert('user_university', array(
			'id'=>3805,
			'title'=>'Lithgow',
			'parent_id'=>38,
		));
		$this->insert('user_university', array(
			'id'=>3806,
			'title'=>'Parramatta',
			'parent_id'=>38,
		));
		$this->insert('user_university', array(
			'id'=>3807,
			'title'=>'Parramatta City',
			'parent_id'=>38,
		));
		$this->insert('user_university', array(
			'id'=>3808,
			'title'=>'Penrith',
			'parent_id'=>38,
		));
		$this->insert('user_university', array(
			'id'=>3809,
			'title'=>'Westmead',
			'parent_id'=>38,
		));

		// Uni of Wollongong
		$this->insert('user_university', array(
			'id'=>3901,
			'title'=>'Batemans Bay',
			'parent_id'=>39,
		));
		$this->insert('user_university', array(
			'id'=>3902,
			'title'=>'Bega',
			'parent_id'=>39,
		));
		$this->insert('user_university', array(
			'id'=>3903,
			'title'=>'Shoalhaven',
			'parent_id'=>39,
		));
		$this->insert('user_university', array(
			'id'=>3904,
			'title'=>'Southern Highlands',
			'parent_id'=>39,
		));
		$this->insert('user_university', array(
			'id'=>3905,
			'title'=>'Southern Sydney',
			'parent_id'=>39,
		));
		$this->insert('user_university', array(
			'id'=>3906,
			'title'=>'Sydney',
			'parent_id'=>39,
		));

		// Victoria Uni
		$this->insert('user_university', array(
			'id'=>4001,
			'title'=>'City Flinders',
			'parent_id'=>40,
		));
		$this->insert('user_university', array(
			'id'=>4002,
			'title'=>'City Flinders Lane',
			'parent_id'=>40,
		));
		$this->insert('user_university', array(
			'id'=>4003,
			'title'=>'City King',
			'parent_id'=>40,
		));
		$this->insert('user_university', array(
			'id'=>4004,
			'title'=>'City Queen',
			'parent_id'=>40,
		));
		$this->insert('user_university', array(
			'id'=>4005,
			'title'=>'Footscray Nicolson',
			'parent_id'=>40,
		));
		$this->insert('user_university', array(
			'id'=>4006,
			'title'=>'Footscray Park',
			'parent_id'=>40,
		));
		$this->insert('user_university', array(
			'id'=>4007,
			'title'=>'Melton',
			'parent_id'=>40,
		));
		$this->insert('user_university', array(
			'id'=>4008,
			'title'=>'St Albans',
			'parent_id'=>40,
		));
		$this->insert('user_university', array(
			'id'=>4009,
			'title'=>'Sunshine',
			'parent_id'=>40,
		));
		$this->insert('user_university', array(
			'id'=>4010,
			'title'=>'Sydney',
			'parent_id'=>40,
		));
		$this->insert('user_university', array(
			'id'=>4011,
			'title'=>'Werribee',
			'parent_id'=>40,
		));

		// Uni of Southern QLD
		$this->insert('user_university', array(
			'id'=>4101,
			'title'=>'Online',
			'parent_id'=>41,
		));
		$this->insert('user_university', array(
			'id'=>4102,
			'title'=>'Fraser Coast',
			'parent_id'=>41,
		));
		$this->insert('user_university', array(
			'id'=>4103,
			'title'=>'Springfield',
			'parent_id'=>41,
		));
		$this->insert('user_university', array(
			'id'=>4104,
			'title'=>'Toowoomba',
			'parent_id'=>41,
		));
		$this->insert('user_university', array(
			'id'=>4105,
			'title'=>'Queensland College',
			'parent_id'=>41,
		));
	}

	public function safeDown()
	{
		$this->dropForeignKey('university', 'user');
		$this->dropColumn('user', 'university_id');
		$this->dropTable('user_university');
	}
}