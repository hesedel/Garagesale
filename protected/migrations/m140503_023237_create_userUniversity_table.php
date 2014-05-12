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

		//Australian Universities
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
			'title'=>'Grifﬁth University',
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


//University campuses, ACU
		$this->insert('item_category', array(
			'id'=>41,
			'title'=>'Adelaide',
			'parent_id'=>1,
		));

		$this->insert('item_category', array(
			'id'=>42,
			'title'=>'Ballarat',
			'parent_id'=>1,
		));
		$this->insert('item_category', array(
			'id'=>43,
			'title'=>'Brisbane',
			'parent_id'=>1,
		));
		$this->insert('item_category', array(
			'id'=>44,
			'title'=>'Canberra',
			'parent_id'=>1,
		));
		$this->insert('item_category', array(
			'id'=>45,
			'title'=>'Melbourne',
			'parent_id'=>1,
		));

		$this->insert('item_category', array(
			'id'=>46,
			'title'=>'North Sydney',
			'parent_id'=>1,
		));

		$this->insert('item_category', array(
			'id'=>47,
			'title'=>'Strathfield',
			'parent_id'=>1,
		));

		//Central Queensland Uni
		$this->insert('item_category', array(
			'id'=>48,
			'title'=>'Brisbane',
			'parent_id'=>5,
		));

		$this->insert('item_category', array(
			'id'=>49,
			'title'=>'Bundaberg',
			'parent_id'=>5,
		));

		$this->insert('item_category', array(
			'id'=>50,
			'title'=>'Cairns Distance Education Study Centre',
			'parent_id'=>5,
		));

		$this->insert('item_category', array(
			'id'=>51,
			'title'=>'Emerald',
			'parent_id'=>5,
		));

		$this->insert('item_category', array(
			'id'=>52,
			'title'=>'Gladstone, Marina',
			'parent_id'=>5,
		));

		$this->insert('item_category', array(
			'id'=>53,
			'title'=>'Gladstone, Marina',
			'parent_id'=>5,
		));

		$this->insert('item_category', array(
			'id'=>54,
			'title'=>'Gladstone, City',
			'parent_id'=>5,
		));

		$this->insert('item_category', array(
			'id'=>55,
			'title'=>'Mackay, Ooralea',
			'parent_id'=>5,
		));

		$this->insert('item_category', array(
			'id'=>56,
			'title'=>'Mackay, City',
			'parent_id'=>5,
		));

		$this->insert('item_category', array(
			'id'=>57,
			'title'=>'Melbourne',
			'parent_id'=>5,
		));

		$this->insert('item_category', array(
			'id'=>58,
			'title'=>'Noosa',
			'parent_id'=>5,
		));

		$this->insert('item_category', array(
			'id'=>59,
			'title'=>'Rockhampton, North',
			'parent_id'=>5,
		));

		$this->insert('item_category', array(
			'id'=>60,
			'title'=>'Rockhampton, City',
			'parent_id'=>5,
		));

		$this->insert('item_category', array(
			'id'=>61,
			'title'=>'Sydney',
			'parent_id'=>5,
		));

		$this->insert('item_category', array(
			'id'=>62,
			'title'=>'Yeppoon Study Centre',
			'parent_id'=>5,
		));

		$this->insert('item_category', array(
			'id'=>63,
			'title'=>'Great Barrier Reef Institute of Tafe',
			'parent_id'=>5,
		));

		$this->insert('item_category', array(
			'id'=>64,
			'title'=>'Edithvale',
			'parent_id'=>5,
		));

		//Charles Sturt

		$this->insert('item_category', array(
			'id'=>65,
			'title'=>'Albury-Wodonga',
			'parent_id'=>7,
		));

		$this->insert('item_category', array(
			'id'=>66,
			'title'=>'Bathurst',
			'parent_id'=>7,
		));

		$this->insert('item_category', array(
			'id'=>67,
			'title'=>'Canberra',
			'parent_id'=>7,
		));

		$this->insert('item_category', array(
			'id'=>68,
			'title'=>'Dubbo',
			'parent_id'=>7,
		));

		$this->insert('item_category', array(
			'id'=>69,
			'title'=>'Goulburn',
			'parent_id'=>7,
		));

		$this->insert('item_category', array(
			'id'=>70,
			'title'=>'Griffith',
			'parent_id'=>7,
		));

		$this->insert('item_category', array(
			'id'=>71,
			'title'=>'Manly',
			'parent_id'=>7,
		));

		$this->insert('item_category', array(
			'id'=>72,
			'title'=>'Melbourne',
			'parent_id'=>7,
		));

		$this->insert('item_category', array(
			'id'=>73,
			'title'=>'Ontario',
			'parent_id'=>7,
		));

		$this->insert('item_category', array(
			'id'=>74,
			'title'=>'Orange',
			'parent_id'=>7,
		));

		$this->insert('item_category', array(
			'id'=>75,
			'title'=>'Parkes',
			'parent_id'=>7,
		));

		$this->insert('item_category', array(
			'id'=>76,
			'title'=>'Parramatta',
			'parent_id'=>7,
		));

		$this->insert('item_category', array(
			'id'=>77,
			'title'=>'Port Macquarie',
			'parent_id'=>7,
		));

		$this->insert('item_category', array(
			'id'=>78,
			'title'=>'Sydney',
			'parent_id'=>7,
		));

		$this->insert('item_category', array(
			'id'=>79,
			'title'=>'Wagga Wagga',
			'parent_id'=>7,
		));

		$this->insert('item_category', array(
			'id'=>80,
			'title'=>'Wangaratta',
			'parent_id'=>7,
		));

		//Curtin Uni of Tech

		$this->insert('item_category', array(
			'id'=>81,
			'title'=>'Bentley',
			'parent_id'=>8,
		));

		$this->insert('item_category', array(
			'id'=>82,
			'title'=>'Kalgoorlie',
			'parent_id'=>8,
		));

		$this->insert('item_category', array(
			'id'=>83,
			'title'=>'Margaret River',
			'parent_id'=>8,
		));

		$this->insert('item_category', array(
			'id'=>84,
			'title'=>'Perth',
			'parent_id'=>8,
		));

		$this->insert('item_category', array(
			'id'=>85,
			'title'=>'Shenton Park',
			'parent_id'=>8,
		));

//Deakin Uni
		$this->insert('item_category', array(
			'id'=>86,
			'title'=>'Geelong Waterfront',
			'parent_id'=>9,
		));

		$this->insert('item_category', array(
			'id'=>87,
			'title'=>'Geelong Waurn',
			'parent_id'=>9,
		));

		$this->insert('item_category', array(
			'id'=>88,
			'title'=>'Melbourne',
			'parent_id'=>9,
		));

		$this->insert('item_category', array(
			'id'=>89,
			'title'=>'Warrnambool',
			'parent_id'=>9,
		));

		//Edith Cowan

		$this->insert('item_category', array(
			'id'=>90,
			'title'=>'Joondaloop',
			'parent_id'=>10,
		));

		$this->insert('item_category', array(
			'id'=>91,
			'title'=>'Mount Lawley',
			'parent_id'=>10,
		));

		$this->insert('item_category', array(
			'id'=>92,
			'title'=>'South West',
			'parent_id'=>10,
		));


//Federation Uni
		$this->insert('item_category', array(
			'id'=>93,
			'title'=>'Ararat',
			'parent_id'=>11,
		));

		$this->insert('item_category', array(
			'id'=>94,
			'title'=>'Ararat',
			'parent_id'=>11,
		));

		$this->insert('item_category', array(
			'id'=>95,
			'title'=>'Camp St',
			'parent_id'=>11,
		));

		$this->insert('item_category', array(
			'id'=>96,
			'title'=>'Gippsland',
			'parent_id'=>11,
		));

		$this->insert('item_category', array(
			'id'=>97,
			'title'=>'Horsham',
			'parent_id'=>11,
		));

		$this->insert('item_category', array(
			'id'=>98,
			'title'=>'Mount Helen',
			'parent_id'=>11,
		));

		$this->insert('item_category', array(
			'id'=>99,
			'title'=>'SMB',
			'parent_id'=>11,
		));

		$this->insert('item_category', array(
			'id'=>100,
			'title'=>'Stawell',
			'parent_id'=>11,
		));

//FLinders Uni
		$this->insert('item_category', array(
			'id'=>101,
			'title'=>'Barossa',
			'parent_id'=>12,
		));

		$this->insert('item_category', array(
			'id'=>102,
			'title'=>'Bedford Park',
			'parent_id'=>12,
		));

		$this->insert('item_category', array(
			'id'=>103,
			'title'=>'Mount Gambier',
			'parent_id'=>12,
		));

		$this->insert('item_category', array(
			'id'=>104,
			'title'=>'Murray Bridge',
			'parent_id'=>12,
		));

		$this->insert('item_category', array(
			'id'=>105,
			'title'=>'Northern Territory',
			'parent_id'=>12,
		));

		$this->insert('item_category', array(
			'id'=>106,
			'title'=>'Port Lincoln',
			'parent_id'=>12,
		));

		$this->insert('item_category', array(
			'id'=>107,
			'title'=>'Renmark',
			'parent_id'=>12,
		));

		$this->insert('item_category', array(
			'id'=>108,
			'title'=>'Victor Harbor',
			'parent_id'=>12,
		));

//Griffith Uni
		$this->insert('item_category', array(
			'id'=>109,
			'title'=>'Gold Coast',
			'parent_id'=>13,
		));

		$this->insert('item_category', array(
			'id'=>110,
			'title'=>'Logan',
			'parent_id'=>13,
		));

		$this->insert('item_category', array(
			'id'=>111,
			'title'=>'Mount Gravatt',
			'parent_id'=>13,
		));

		$this->insert('item_category', array(
			'id'=>112,
			'title'=>'Nathan',
			'parent_id'=>13,
		));

		$this->insert('item_category', array(
			'id'=>113,
			'title'=>'South Bank',
			'parent_id'=>13,
		));

// James Cook Uni
		$this->insert('item_category', array(
			'id'=>114,
			'title'=>'Brisbane',
			'parent_id'=>14,
		));

		$this->insert('item_category', array(
			'id'=>115,
			'title'=>'Cairns',
			'parent_id'=>14,
		));

		$this->insert('item_category', array(
			'id'=>116,
			'title'=>'Mackay',
			'parent_id'=>14,
		));

		$this->insert('item_category', array(
			'id'=>117,
			'title'=>'Mount Isa',
			'parent_id'=>14,
		));

		$this->insert('item_category', array(
			'id'=>118,
			'title'=>'Thursday Island',
			'parent_id'=>14,
		));

		$this->insert('item_category', array(
			'id'=>119,
			'title'=>'Townsville',
			'parent_id'=>14,
		));

		//La Trobe

		$this->insert('item_category', array(
			'id'=>120,
			'title'=>'Albury-Wodonga',
			'parent_id'=>15,
		));

		$this->insert('item_category', array(
			'id'=>121,
			'title'=>'Bendigo',
			'parent_id'=>15,
		));

		$this->insert('item_category', array(
			'id'=>122,
			'title'=>'City',
			'parent_id'=>15,
		));

		$this->insert('item_category', array(
			'id'=>123,
			'title'=>'Franklin Street',
			'parent_id'=>15,
		));

		$this->insert('item_category', array(
			'id'=>124,
			'title'=>'Mildura',
			'parent_id'=>15,
		));

		$this->insert('item_category', array(
			'id'=>125,
			'title'=>'Shepparton',
			'parent_id'=>15,
		));

		$this->insert('item_category', array(
			'id'=>126,
			'title'=>'Sydney',
			'parent_id'=>15,
		));

// Monash Uni

		$this->insert('item_category', array(
			'id'=>127,
			'title'=>'Berwick',
			'parent_id'=>18,
		));

		$this->insert('item_category', array(
			'id'=>128,
			'title'=>'Clayton',
			'parent_id'=>18,
		));

		$this->insert('item_category', array(
			'id'=>129,
			'title'=>'Caulfield',
			'parent_id'=>18,
		));

		$this->insert('item_category', array(
			'id'=>130,
			'title'=>'Parkville',
			'parent_id'=>18,
		));

		//Murdoch Uni

		$this->insert('item_category', array(
			'id'=>131,
			'title'=>'Peel',
			'parent_id'=>19,
		));

		$this->insert('item_category', array(
			'id'=>132,
			'title'=>'Rockingham',
			'parent_id'=>19,
		));

		$this->insert('item_category', array(
			'id'=>133,
			'title'=>'South Street',
			'parent_id'=>19,
		));

//Queensland University of Technology 

		$this->insert('item_category', array(
			'id'=>134,
			'title'=>'Cabooltre',
			'parent_id'=>20,
		));

		$this->insert('item_category', array(
			'id'=>135,
			'title'=>'Gardens Point',
			'parent_id'=>20,
		));

		$this->insert('item_category', array(
			'id'=>136,
			'title'=>'Kelvin Grove',
			'parent_id'=>20,
		));

//RMIT
		$this->insert('item_category', array(
			'id'=>137,
			'title'=>'Brunswick',
			'parent_id'=>21,
		));

		$this->insert('item_category', array(
			'id'=>138,
			'title'=>'Bundoora',
			'parent_id'=>21,
		));

		$this->insert('item_category', array(
			'id'=>139,
			'title'=>'Melbourne',
			'parent_id'=>21,
		));

//Southern Cross
		$this->insert('item_category', array(
			'id'=>140,
			'title'=>'Coffs Harbour',
			'parent_id'=>22,
		));

		$this->insert('item_category', array(
			'id'=>141,
			'title'=>'Gold Coast',
			'parent_id'=>22,
		));

		$this->insert('item_category', array(
			'id'=>142,
			'title'=>'Lismore',
			'parent_id'=>22,
		));

		$this->insert('item_category', array(
			'id'=>143,
			'title'=>'Sydney',
			'parent_id'=>22,
		));

//Swinburne University of Technology 
		$this->insert('item_category', array(
			'id'=>144,
			'title'=>'Croydon',
			'parent_id'=>23,
		));

		$this->insert('item_category', array(
			'id'=>145,
			'title'=>'Hawthorn',
			'parent_id'=>23,
		));
		$this->insert('item_category', array(
			'id'=>146,
			'title'=>'Melbourne',
			'parent_id'=>23,
		));

		$this->insert('item_category', array(
			'id'=>147,
			'title'=>'Prahran',
			'parent_id'=>23,
		));

		$this->insert('item_category', array(
			'id'=>148,
			'title'=>'Sydney',
			'parent_id'=>23,
		));

		$this->insert('item_category', array(
			'id'=>149,
			'title'=>'Wantirna',
			'parent_id'=>23,
		));

//Uni of Adelaide
		$this->insert('item_category', array(
			'id'=>150,
			'title'=>'North Terrace',
			'parent_id'=>24,
		));

		$this->insert('item_category', array(
			'id'=>151,
			'title'=>'Roseworthy',
			'parent_id'=>24,
		));

		$this->insert('item_category', array(
			'id'=>152,
			'title'=>'The Waite',
			'parent_id'=>24,
		));

		$this->insert('item_category', array(
			'id'=>153,
			'title'=>'Thebarton',
			'parent_id'=>24,
		));

		//Uni of Canberra

		$this->insert('item_category', array(
			'id'=>154,
			'title'=>'Batemans Bay',
			'parent_id'=>25,
		));

		$this->insert('item_category', array(
			'id'=>155,
			'title'=>'Bega',
			'parent_id'=>25,
		));

		$this->insert('item_category', array(
			'id'=>156,
			'title'=>'Bruce',
			'parent_id'=>25,
		));

		$this->insert('item_category', array(
			'id'=>157,
			'title'=>'Chadstone',
			'parent_id'=>25,
		));

		$this->insert('item_category', array(
			'id'=>158,
			'title'=>'Cooma',
			'parent_id'=>25,
		));

		$this->insert('item_category', array(
			'id'=>159,
			'title'=>'Erindale College',
			'parent_id'=>25,
		));

		$this->insert('item_category', array(
			'id'=>160,
			'title'=>'Goulburn',
			'parent_id'=>25,
		));

		$this->insert('item_category', array(
			'id'=>161,
			'title'=>'Griffith',
			'parent_id'=>25,
		));

		$this->insert('item_category', array(
			'id'=>162,
			'title'=>'Liverpool',
			'parent_id'=>25,
		));

		$this->insert('item_category', array(
			'id'=>163,
			'title'=>'Melbourne City',
			'parent_id'=>25,
		));

		$this->insert('item_category', array(
			'id'=>164,
			'title'=>'Merimbula',
			'parent_id'=>25,
		));

		$this->insert('item_category', array(
			'id'=>165,
			'title'=>'Moorabbin',
			'parent_id'=>25,
		));

		$this->insert('item_category', array(
			'id'=>166,
			'title'=>'St Leonards',
			'parent_id'=>25,
		));

		$this->insert('item_category', array(
			'id'=>167,
			'title'=>'Ulladulla',
			'parent_id'=>25,
		));

			$this->insert('item_category', array(
			'id'=>168,
			'title'=>'Waverley',
			'parent_id'=>25,
		));

			$this->insert('item_category', array(
			'id'=>169,
			'title'=>'Young',
			'parent_id'=>25,
		));

//Uni of Melbourne

			$this->insert('item_category', array(
			'id'=>170,
			'title'=>'Bio21 Institute',
			'parent_id'=>26,
		));


			$this->insert('item_category', array(
			'id'=>171,
			'title'=>'Burnley',
			'parent_id'=>26,
		));


			$this->insert('item_category', array(
			'id'=>172,
			'title'=>'Creswick',
			'parent_id'=>26,
		));


			$this->insert('item_category', array(
			'id'=>173,
			'title'=>'Dookie',
			'parent_id'=>26,
		));


			$this->insert('item_category', array(
			'id'=>174,
			'title'=>'Hawthorn',
			'parent_id'=>26,
		));


			$this->insert('item_category', array(
			'id'=>175,
			'title'=>'Parkville',
			'parent_id'=>26,
		));

			$this->insert('item_category', array(
			'id'=>176,
			'title'=>'Shepparton',
			'parent_id'=>26,
		));

			$this->insert('item_category', array(
			'id'=>177,
			'title'=>'Werribee',
			'parent_id'=>26,
		));

			//Uni of New England

			$this->insert('item_category', array(
			'id'=>178,
			'title'=>'Armidale',
			'parent_id'=>27,
		));

			$this->insert('item_category', array(
			'id'=>179,
			'title'=>'Bellevue',
			'parent_id'=>27,
		));

			//Uni of NSW

			$this->insert('item_category', array(
			'id'=>180,
			'title'=>'Cliffbrook',
			'parent_id'=>28,
		));


			$this->insert('item_category', array(
			'id'=>181,
			'title'=>'David Phillips Field',
			'parent_id'=>28,
		));


			$this->insert('item_category', array(
			'id'=>182,
			'title'=>'Canberra',
			'parent_id'=>28,
		));

			$this->insert('item_category', array(
			'id'=>183,
			'title'=>'COFA',
			'parent_id'=>28,
		));

			$this->insert('item_category', array(
			'id'=>184,
			'title'=>'Kensington',
			'parent_id'=>28,
		));

			$this->insert('item_category', array(
			'id'=>185,
			'title'=>'Cliffbrook',
			'parent_id'=>28,
		));

			$this->insert('item_category', array(
			'id'=>186,
			'title'=>'Manly Vale',
			'parent_id'=>28,
		));

			$this->insert('item_category', array(
			'id'=>187,
			'title'=>'Randwick',
			'parent_id'=>28,
		));

			$this->insert('item_category', array(
			'id'=>188,
			'title'=>'Sydney City',
			'parent_id'=>28,
		));

			//uni of Newcastle

			$this->insert('item_category', array(
			'id'=>189,
			'title'=>'Armidale',
			'parent_id'=>29,
		));

			$this->insert('item_category', array(
			'id'=>190,
			'title'=>'Callaghan',
			'parent_id'=>29,
		));

			$this->insert('item_category', array(
			'id'=>191,
			'title'=>'Central Coast',
			'parent_id'=>29,
		));

			$this->insert('item_category', array(
			'id'=>192,
			'title'=>'Moree',
			'parent_id'=>29,
		));

			$this->insert('item_category', array(
			'id'=>193,
			'title'=>'Newcastle City',
			'parent_id'=>29,
		));

			$this->insert('item_category', array(
			'id'=>194,
			'title'=>'Orange',
			'parent_id'=>29,
		));

			$this->insert('item_category', array(
			'id'=>195,
			'title'=>'Port Macquarie',
			'parent_id'=>29,
		));

			$this->insert('item_category', array(
			'id'=>196,
			'title'=>'Sydney',
			'parent_id'=>29,
		));

			$this->insert('item_category', array(
			'id'=>197,
			'title'=>'Tamworth',
			'parent_id'=>29,
		));

//Uni of Notre Dame

			$this->insert('item_category', array(
			'id'=>198,
			'title'=>'Broome',
			'parent_id'=>30,
		));


			$this->insert('item_category', array(
			'id'=>199,
			'title'=>'Fremantle',
			'parent_id'=>30,
		));


			$this->insert('item_category', array(
			'id'=>200,
			'title'=>'Sydney',
			'parent_id'=>30,
		));
			//Uni of QLD

			$this->insert('item_category', array(
			'id'=>201,
			'title'=>'Gatton',
			'parent_id'=>31,
		));

			$this->insert('item_category', array(
			'id'=>202,
			'title'=>'Herston',
			'parent_id'=>31,
		));

			$this->insert('item_category', array(
			'id'=>203,
			'title'=>'Ipswich',
			'parent_id'=>31,
		));

			$this->insert('item_category', array(
			'id'=>204,
			'title'=>'St Lucia',
			'parent_id'=>31,
		));

			//Uni of Sth Australia

			$this->insert('item_category', array(
			'id'=>205,
			'title'=>'City East',
			'parent_id'=>32,
		));


			$this->insert('item_category', array(
			'id'=>206,
			'title'=>'City West',
			'parent_id'=>32,
		));


			$this->insert('item_category', array(
			'id'=>207,
			'title'=>'Magill',
			'parent_id'=>32,
		));


			$this->insert('item_category', array(
			'id'=>208,
			'title'=>'Mawson Lakes',
			'parent_id'=>32,
		));


			$this->insert('item_category', array(
			'id'=>209,
			'title'=>'Mount Gambia',
			'parent_id'=>32,
		));

			$this->insert('item_category', array(
			'id'=>210,
			'title'=>'Whyalla',
			'parent_id'=>32,
		));

//Uni of Southern QLD

		$this->insert('user_university', array(
			'id'=>211,
			'title'=>'University of Southern Queensland ',
		));

			$this->insert('item_category', array(
			'id'=>212,
			'title'=>'Online',
			'parent_id'=>211,
		));

			$this->insert('item_category', array(
			'id'=>213,
			'title'=>'Fraser Coast',
			'parent_id'=>211,
		));

			$this->insert('item_category', array(
			'id'=>214,
			'title'=>'Springfield',
			'parent_id'=>211,
		));

			$this->insert('item_category', array(
			'id'=>215,
			'title'=>'Toowoomba',
			'parent_id'=>211,
		));

			$this->insert('item_category', array(
			'id'=>216,
			'title'=>'Queensland College',
			'parent_id'=>211,
		));

			//Uni of Sydney

			$this->insert('item_category', array(
			'id'=>217,
			'title'=>'Camperdown/Darlington',
			'parent_id'=>33,
		));

			$this->insert('item_category', array(
			'id'=>218,
			'title'=>'Camden',
			'parent_id'=>33,
		));

			$this->insert('item_category', array(
			'id'=>219,
			'title'=>'Cumberland',
			'parent_id'=>33,
		));

			$this->insert('item_category', array(
			'id'=>220,
			'title'=>'Mallett Street',
			'parent_id'=>33,
		));

			$this->insert('item_category', array(
			'id'=>221,
			'title'=>'Rozelle',
			'parent_id'=>33,
		));

			$this->insert('item_category', array(
			'id'=>222,
			'title'=>'Surry Hills',
			'parent_id'=>33,
		));

			$this->insert('item_category', array(
			'id'=>223,
			'title'=>'Sydney Conservatorium of Music',
			'parent_id'=>33,
		));

//Uni of Tasmania
			$this->insert('item_category', array(
			'id'=>224,
			'title'=>'Burnie',
			'parent_id'=>34,
		));

			$this->insert('item_category', array(
			'id'=>225,
			'title'=>'Hobart',
			'parent_id'=>34,
		));

			$this->insert('item_category', array(
			'id'=>226,
			'title'=>'Launceston',
			'parent_id'=>34,
		));

			$this->insert('item_category', array(
			'id'=>227,
			'title'=>'Sydney',
			'parent_id'=>34,
		));

//UTS
			$this->insert('item_category', array(
			'id'=>228,
			'title'=>'Kuring-gai',
			'parent_id'=>35,
		));

			$this->insert('item_category', array(
			'id'=>229,
			'title'=>'Sydney City',
			'parent_id'=>35,
		));

			//University of Western Australia
			$this->insert('item_category', array(
			'id'=>230,
			'title'=>'Albany',
			'parent_id'=>37,
		));

			$this->insert('item_category', array(
			'id'=>231,
			'title'=>'Claremont',
			'parent_id'=>37,
		));

			$this->insert('item_category', array(
			'id'=>232,
			'title'=>'Crawley',
			'parent_id'=>37,
		));

//Uni of Western Syd
			$this->insert('item_category', array(
			'id'=>233,
			'title'=>'Bankstown',
			'parent_id'=>38,
		));

			$this->insert('item_category', array(
			'id'=>234,
			'title'=>'Blacktown',
			'parent_id'=>38,
		));

			$this->insert('item_category', array(
			'id'=>235,
			'title'=>'Campbelltown',
			'parent_id'=>38,
		));

			$this->insert('item_category', array(
			'id'=>236,
			'title'=>'Hawkesbury',
			'parent_id'=>38,
		));

			$this->insert('item_category', array(
			'id'=>237,
			'title'=>'Lithgow',
			'parent_id'=>38,
		));

			$this->insert('item_category', array(
			'id'=>238,
			'title'=>'Parramatta',
			'parent_id'=>38,
		));

			$this->insert('item_category', array(
			'id'=>239,
			'title'=>'Parramatta City',
			'parent_id'=>38,
		));

			$this->insert('item_category', array(
			'id'=>240,
			'title'=>'Penrith',
			'parent_id'=>38,
		));

			$this->insert('item_category', array(
			'id'=>241,
			'title'=>'Westmead',
			'parent_id'=>38,
		));

//Uni of Wollongong
			$this->insert('item_category', array(
			'id'=>242,
			'title'=>'Batemans Bay',
			'parent_id'=>39,
		));

			$this->insert('item_category', array(
			'id'=>243,
			'title'=>'Bega',
			'parent_id'=>39,
		));

			$this->insert('item_category', array(
			'id'=>244,
			'title'=>'Shoalhaven',
			'parent_id'=>39,
		));

			$this->insert('item_category', array(
			'id'=>245,
			'title'=>'Southern Highlands',
			'parent_id'=>39,
		));

			$this->insert('item_category', array(
			'id'=>246,
			'title'=>'Southern Sydney',
			'parent_id'=>39,
		));

			$this->insert('item_category', array(
			'id'=>247,
			'title'=>'Sydney',
			'parent_id'=>39,
		));

//Victoria Uni

			$this->insert('item_category', array(
			'id'=>248,
			'title'=>'City Flinders',
			'parent_id'=>40,
		));

			$this->insert('item_category', array(
			'id'=>249,
			'title'=>'City Flinders Lane',
			'parent_id'=>40,
		));
			$this->insert('item_category', array(
			'id'=>250,
			'title'=>'City King',
			'parent_id'=>40,
		));

			$this->insert('item_category', array(
			'id'=>251,
			'title'=>'City Queen',
			'parent_id'=>40,
		));

			$this->insert('item_category', array(
			'id'=>252,
			'title'=>'Footscray Nicolson',
			'parent_id'=>40,
		));

			$this->insert('item_category', array(
			'id'=>253,
			'title'=>'Footscray Park',
			'parent_id'=>40,
		));

			$this->insert('item_category', array(
			'id'=>254,
			'title'=>'Melton',
			'parent_id'=>40,
		));

			$this->insert('item_category', array(
			'id'=>255,
			'title'=>'St Albans',
			'parent_id'=>40,
		));

			$this->insert('item_category', array(
			'id'=>256,
			'title'=>'Sunshine',
			'parent_id'=>40,
		));


			$this->insert('item_category', array(
			'id'=>257,
			'title'=>'Sydney',
			'parent_id'=>40,
		));

			$this->insert('item_category', array(
			'id'=>258,
			'title'=>'Werribee',
			'parent_id'=>40,

		));
	}

	

	public function safeDown()
	{
		$this->dropForeignKey('university', 'user');
		$this->dropColumn('user', 'university_id');
		$this->dropTable('user_university');
	}
}