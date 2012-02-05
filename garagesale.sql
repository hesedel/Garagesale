SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE item (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  created timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  updated timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  title varchar(64) NOT NULL,
  price mediumint(8) unsigned NOT NULL,
  description text NOT NULL,
  category_id tinyint(3) unsigned DEFAULT NULL,
  condition_id tinyint(3) unsigned DEFAULT NULL,
  user_id int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (id),
  KEY condition_id (condition_id),
  KEY user_id (user_id),
  KEY category_id (category_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE item_category (
  id tinyint(3) unsigned NOT NULL,
  title varchar(16) NOT NULL,
  category_id tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (id),
  KEY category_id (category_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE item_condition (
  id tinyint(3) unsigned NOT NULL,
  title varchar(16) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE item_image (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(4) NOT NULL,
  item_id int(10) unsigned NOT NULL,
  PRIMARY KEY (id),
  KEY item_id (item_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
