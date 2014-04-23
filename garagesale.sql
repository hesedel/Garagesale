-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 03, 2012 at 03:34 AM
-- Server version: 5.5.9
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `garagesale`
--

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(64) NOT NULL,
  `price` int(10) unsigned NOT NULL,
  `description` text NOT NULL,
  `category_id` tinyint(3) unsigned DEFAULT NULL,
  `condition_id` tinyint(3) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `condition_id` (`condition_id`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB;

--
-- Dumping data for table `item`
--


-- --------------------------------------------------------

--
-- Table structure for table `item_category`
--

CREATE TABLE `item_category` (
  `id` tinyint(3) unsigned NOT NULL,
  `title` varchar(16) NOT NULL,
  `parent_id` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB;

--
-- Dumping data for table `item_category`
--


-- --------------------------------------------------------

--
-- Table structure for table `item_condition`
--

CREATE TABLE `item_condition` (
  `id` tinyint(3) unsigned NOT NULL,
  `title` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

--
-- Dumping data for table `item_condition`
--

INSERT INTO `item_condition` VALUES(0, 'Brand New');
INSERT INTO `item_condition` VALUES(1, 'Used');

-- --------------------------------------------------------

--
-- Table structure for table `item_image`
--

CREATE TABLE `item_image` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(4) NOT NULL,
  `size` int(10) unsigned NOT NULL,
  `data` mediumblob NOT NULL,
  `index` tinyint(3) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `index` (`index`)
) ENGINE=InnoDB;

--
-- Dumping data for table `item_image`
--

