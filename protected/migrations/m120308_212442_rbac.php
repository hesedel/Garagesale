<?php

class m120308_212442_rbac extends CDbMigration
{
	public function safeUp()
	{
		Yii::app()->db->createCommand('
			create table `AuthItem`
			(
				`name`			varchar(64) not null,
				`type`			integer not null,
				`description`	text,
				`bizrule`		text,
				`data`			text,
				primary key (`name`)
			) engine InnoDB;
		')->execute();
		Yii::app()->db->createCommand('
			create table `AuthItemChild`
			(
				`parent`		varchar(64) not null,
				`child`			varchar(64) not null,
				primary key (`parent`,`child`),
				foreign key (`parent`) references `AuthItem` (`name`) on delete cascade on update cascade,
				foreign key (`child`) references `AuthItem` (`name`) on delete cascade on update cascade
			) engine InnoDB;
		')->execute();
		Yii::app()->db->createCommand('
			create table `AuthAssignment`
			(
				`itemname`		varchar(64) not null,
				`userid`		varchar(64) not null,
				`bizrule`		text,
				`data`			text,
				primary key (`itemname`,`userid`),
				foreign key (`itemname`) references `AuthItem` (`name`) on delete cascade on update cascade
			) engine InnoDB;
		')->execute();
	}

	public function safeDown()
	{
		$this->dropTable('AuthAssignment');
		$this->dropTable('AuthItemChild');
		$this->dropTable('AuthItem');
	}
}