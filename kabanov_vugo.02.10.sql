-- Adminer 3.7.1 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = '+03:00';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `ci_campaigns`;
CREATE TABLE `ci_campaigns` (
  `campaign_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `landing_url` varchar(255) NOT NULL,
  `adv_type` smallint(1) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `budget` decimal(12,2) NOT NULL,
  `monthly_cap` decimal(12,2) NOT NULL,
  `daily_cap` decimal(12,2) NOT NULL,
  `price_per_click` decimal(12,2) NOT NULL,
  `price_per_view` decimal(12,2) NOT NULL,
  `frequency` int(5) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`campaign_id`),
  KEY `owner_id` (`owner_id`),
  KEY `type` (`type`),
  KEY `status` (`status`),
  KEY `owner_id_2` (`owner_id`),
  CONSTRAINT `ci_campaigns_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `ci_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ci_campaigns` (`campaign_id`, `name`, `landing_url`, `adv_type`, `file_path`, `budget`, `monthly_cap`, `daily_cap`, `price_per_click`, `price_per_view`, `frequency`, `owner_id`, `type`, `status`) VALUES
(25,	'111',	'http://landing2.page.com',	0,	'',	40000.00,	3333.00,	444.00,	0.00,	0.00,	3,	5,	'image',	1),
(26,	'Campaign name',	'http://landing.page.com',	0,	'',	40000.00,	11.00,	111.00,	0.00,	0.00,	3,	5,	'image',	1),
(27,	'Campaign name',	'http://landing2.page.com',	0,	'',	40000.00,	1.00,	1.00,	0.00,	0.00,	3,	5,	'image',	1),
(28,	'qqqqqqqqqqq',	'111',	0,	'',	1111.00,	11111.00,	11.00,	0.00,	0.00,	3,	5,	'image',	1),
(29,	'Vugo 1',	'http://vugo.com',	0,	'',	49999.00,	5000.00,	1000.00,	0.00,	0.00,	3,	8,	'video',	1),
(30,	'Vugo 2',	'http://vugo.com',	0,	'',	50000.00,	5000.00,	1000.00,	0.00,	0.00,	3,	8,	'image',	1),
(31,	'User1',	'http://vugo.com',	0,	'',	1222.00,	5000.00,	1000.00,	0.00,	0.00,	3,	8,	'image',	1),
(32,	'safari',	'http://safari.com',	0,	'',	33333.00,	3333.00,	333.00,	0.00,	0.00,	3,	8,	'image',	1),
(33,	'safari',	'http://safari.com',	0,	'',	33333.00,	3333.00,	333.00,	0.00,	0.00,	3,	8,	'image',	1),
(34,	'Test model',	'http://vugo.com',	0,	'',	22222.00,	2222.00,	222.00,	0.00,	0.00,	3,	8,	'image',	1),
(35,	'test price',	'http://vugo.com',	0,	'',	1222.00,	5000.00,	1000.00,	0.20,	0.02,	3,	8,	'video',	1),
(36,	'test referral',	'http://vugo.com',	0,	'',	11111.00,	1111.00,	111.00,	25.00,	2.00,	3,	8,	'image',	1);

DROP TABLE IF EXISTS `ci_campaigns_location`;
CREATE TABLE `ci_campaigns_location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign` int(11) NOT NULL,
  `address` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `radius` int(3) NOT NULL,
  `state` varchar(50) NOT NULL,
  `location_zip` text NOT NULL,
  `country` varchar(255) NOT NULL,
  PRIMARY KEY (`location_id`),
  KEY `campaign_id` (`campaign`),
  CONSTRAINT `ci_campaigns_location_ibfk_1` FOREIGN KEY (`campaign`) REFERENCES `ci_campaigns` (`campaign_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ci_campaigns_location` (`location_id`, `campaign`, `address`, `location`, `radius`, `state`, `location_zip`, `country`) VALUES
(5,	25,	'',	'',	0,	'',	'',	'United States'),
(6,	26,	'',	'',	0,	'Delaware',	'',	''),
(7,	27,	'',	'',	0,	'',	'',	'United States'),
(8,	30,	'Minsk, Belarus',	'53.90454,27.561524',	29,	'',	'',	''),
(9,	31,	'',	'',	0,	'',	'33333333333333,333333333333,54444444444444,5555555553245,46786785678,56865785678,678567856,5678567856,6785678567856,567856785678,856785678',	''),
(10,	29,	'',	'',	0,	'',	'',	'Соединенные Штаты Америки'),
(11,	33,	'',	'',	0,	'',	'',	'USA');

DROP TABLE IF EXISTS `ci_campaigns_media`;
CREATE TABLE `ci_campaigns_media` (
  `media_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign` int(11) NOT NULL,
  `real_path` text NOT NULL,
  `absolute_url` text NOT NULL,
  PRIMARY KEY (`media_id`),
  KEY `campaign_id` (`campaign`),
  KEY `media_id` (`media_id`),
  KEY `campaign` (`campaign`),
  CONSTRAINT `ci_campaigns_media_ibfk_1` FOREIGN KEY (`campaign`) REFERENCES `ci_campaigns` (`campaign_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ci_campaigns_media` (`media_id`, `campaign`, `real_path`, `absolute_url`) VALUES
(7,	25,	'E:/OpenServer/domains/viewswagen/uploads/5/911ed6a989b17fc24225ebdcd4002fae.jpg',	'http://viewswagen/uploads/5/911ed6a989b17fc24225ebdcd4002fae.jpg'),
(8,	26,	'',	''),
(9,	27,	'E:/OpenServer/domains/viewswagen/uploads/5/58f773aab8f94600c9a272e6e9609517.jpg',	'http://viewswagen/uploads/5/58f773aab8f94600c9a272e6e9609517.jpg'),
(10,	28,	'E:/OpenServer/domains/viewswagen/uploads/5/e9e03f1450fe9722583d869c669b2d5f.jpg',	'http://viewswagen/uploads/5/e9e03f1450fe9722583d869c669b2d5f.jpg'),
(22,	31,	'/home/kabanov/www/vugo/uploads/8/58b18f27e44ae5a611bbde41c95384fe.jpg',	'http://vugo.kabanov.phpdev.softeq.com/uploads/8/58b18f27e44ae5a611bbde41c95384fe.jpg'),
(26,	33,	'/home/kabanov/www/vugo/uploads/8/e6451983518938ce8c5ffaf8633f7d28.jpg',	'http://vugo.kabanov.phpdev.softeq.com/uploads/8/e6451983518938ce8c5ffaf8633f7d28.jpg'),
(28,	29,	'/home/kabanov/www/vugo/uploads/8/9030def77e6db6ed0b1eff8687da110c.mp4',	'http://vugo.kabanov.phpdev.softeq.com/uploads/8/9030def77e6db6ed0b1eff8687da110c.mp4'),
(29,	30,	'/home/kabanov/www/vugo/uploads/8/f50b8135a34ffb88a24cf5b4feffc396.png',	'http://vugo.kabanov.phpdev.softeq.com/uploads/8/f50b8135a34ffb88a24cf5b4feffc396.png'),
(30,	34,	'/home/kabanov/www/vugo/uploads/8/408c55484f0da8c33995a4eb070cd785.png',	'http://vugo.kabanov.phpdev.softeq.com/uploads/8/408c55484f0da8c33995a4eb070cd785.png'),
(31,	35,	'/home/kabanov/www/vugo/uploads/8/70deb89ab0c1e0b2003570395157d384.mp4',	'http://vugo.kabanov.phpdev.softeq.com/uploads/8/70deb89ab0c1e0b2003570395157d384.mp4'),
(32,	36,	'/home/kabanov/www/vugo/uploads/8/e163368f6930d82076d4bac71dada273.jpg',	'http://vugo.kabanov.phpdev.softeq.com/uploads/8/e163368f6930d82076d4bac71dada273.jpg');

DROP TABLE IF EXISTS `ci_campaigns_schedule`;
CREATE TABLE `ci_campaigns_schedule` (
  `schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `week_days` tinyint(2) NOT NULL,
  `schedule_from` time NOT NULL,
  `schedule_until` time NOT NULL,
  PRIMARY KEY (`schedule_id`),
  KEY `campaign` (`campaign`),
  CONSTRAINT `ci_campaigns_schedule_ibfk_1` FOREIGN KEY (`campaign`) REFERENCES `ci_campaigns` (`campaign_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ci_campaigns_schedule` (`schedule_id`, `campaign`, `date_start`, `date_end`, `week_days`, `schedule_from`, `schedule_until`) VALUES
(14,	25,	'0000-00-00',	'0000-00-00',	1,	'01:30:00',	'02:30:00'),
(15,	26,	'2015-07-29',	'2015-07-29',	1,	'12:00:00',	'01:00:00'),
(16,	27,	'2015-07-29',	'2015-07-29',	1,	'01:00:00',	'02:00:00'),
(17,	30,	'0000-00-00',	'2015-09-30',	2,	'12:30:00',	'02:30:00'),
(18,	31,	'0000-00-00',	'0000-00-00',	1,	'12:30:00',	'03:00:00'),
(19,	29,	'2015-09-01',	'0000-00-00',	2,	'12:30:00',	'01:30:00'),
(20,	33,	'0000-00-00',	'0000-00-00',	1,	'12:30:00',	'01:30:00'),
(21,	34,	'0000-00-00',	'0000-00-00',	1,	'02:00:00',	'01:30:00'),
(22,	35,	'0000-00-00',	'0000-00-00',	3,	'12:30:00',	'01:30:00');

DROP TABLE IF EXISTS `ci_campaigns_target`;
CREATE TABLE `ci_campaigns_target` (
  `target_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign` int(11) NOT NULL,
  `target` text NOT NULL,
  PRIMARY KEY (`target_id`),
  KEY `campaign` (`campaign`),
  CONSTRAINT `ci_campaigns_target_ibfk_1` FOREIGN KEY (`campaign`) REFERENCES `ci_campaigns` (`campaign_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ci_campaigns_target` (`target_id`, `campaign`, `target`) VALUES
(1,	25,	'a:27:{i:0;s:12:\"construction\";i:1;s:7:\"dentist\";i:2;s:7:\"doctors\";i:3;s:17:\"accounting_office\";i:4;s:8:\"attorney\";i:5;s:10:\"book_store\";i:6;s:13:\"apparel_store\";i:7;s:11:\"gas_station\";i:8;s:17:\"electronics_store\";i:9;s:7:\"florist\";i:10;s:15:\"shopping_center\";i:11;s:7:\"storage\";i:12;s:5:\"store\";i:13;s:9:\"dvd_store\";i:14;s:5:\"mover\";i:15;s:7:\"parking\";i:16;s:8:\"pharmacy\";i:17;s:7:\"plumber\";i:18;s:10:\"shoe_store\";i:19;s:15:\"furniture_store\";i:20;s:13:\"juwelry_store\";i:21;s:7:\"laundry\";i:22;s:12:\"liqour_store\";i:23;s:9:\"locksmith\";i:25;s:6:\"subway\";i:26;s:4:\"taxi\";i:27;s:13:\"train_station\";}'),
(2,	27,	'a:1:{i:0;s:13:\"travel_agency\";}'),
(3,	29,	'a:94:{i:0;s:10:\"car_dealer\";i:1;s:10:\"car_rental\";i:2;s:11:\"auto_repair\";i:3;s:10:\"car_washes\";i:4;s:12:\"beauty_salon\";i:5;s:10:\"hair_salon\";i:6;s:3:\"spa\";i:7;s:6:\"school\";i:8;s:7:\"college\";i:9;s:14:\"amusement_park\";i:10;s:8:\"aquarium\";i:11;s:11:\"art_gallery\";i:12;s:7:\"bowling\";i:13;s:6:\"casino\";i:14;s:6:\"cinema\";i:15;s:6:\"museum\";i:16;s:7:\"stadium\";i:17;s:3:\"zoo\";i:18;s:3:\"atm\";i:19;s:4:\"bank\";i:20;s:7:\"finance\";i:21;s:9:\"insurance\";i:22;s:6:\"bakery\";i:23;s:4:\"cafe\";i:24;s:4:\"food\";i:25;s:11:\"supermarket\";i:26;s:13:\"meal_delivery\";i:27;s:18:\"takeout_restaurant\";i:28;s:10:\"restaurant\";i:29;s:8:\"cemetery\";i:30;s:7:\"funeral\";i:31;s:9:\"buisiness\";i:32;s:9:\"city_hall\";i:33;s:5:\"court\";i:34;s:7:\"embassy\";i:35;s:10:\"fire_house\";i:36;s:7:\"library\";i:37;s:18:\"goverment_building\";i:38;s:3:\"law\";i:39;s:11:\"post_office\";i:40;s:7:\"fitness\";i:41;s:12:\"health_store\";i:42;s:14:\"hardware_store\";i:43;s:14:\"homegood_store\";i:44;s:10:\"electrican\";i:45;s:12:\"construction\";i:46;s:8:\"painting\";i:47;s:6:\"roofer\";i:48;s:7:\"dentist\";i:49;s:7:\"doctors\";i:50;s:8:\"hospital\";i:51;s:9:\"therapist\";i:52;s:3:\"bar\";i:53;s:10:\"night_club\";i:54;s:10:\"pet_supply\";i:55;s:15:\"animal_hospital\";i:56;s:17:\"accounting_office\";i:57;s:8:\"attorney\";i:58;s:11:\"real_estate\";i:59;s:6:\"church\";i:60;s:5:\"hindu\";i:61;s:6:\"mosque\";i:62;s:15:\"religious_place\";i:63;s:9:\"synagogue\";i:64;s:10:\"book_store\";i:65;s:13:\"apparel_store\";i:66;s:11:\"gas_station\";i:67;s:17:\"electronics_store\";i:68;s:7:\"florist\";i:69;s:15:\"shopping_center\";i:70;s:7:\"storage\";i:71;s:5:\"store\";i:72;s:9:\"dvd_store\";i:73;s:5:\"mover\";i:74;s:7:\"parking\";i:75;s:8:\"pharmacy\";i:76;s:7:\"plumber\";i:77;s:10:\"shoe_store\";i:78;s:15:\"furniture_store\";i:79;s:13:\"juwelry_store\";i:80;s:7:\"laundry\";i:81;s:12:\"liqour_store\";i:82;s:9:\"locksmith\";i:83;s:13:\"bicycle_store\";i:84;s:14:\"camping_ground\";i:85;s:4:\"park\";i:86;s:7:\"rv_park\";i:87;s:9:\"bus_stops\";i:88;s:6:\"subway\";i:89;s:4:\"taxi\";i:90;s:13:\"train_station\";i:91;s:7:\"airport\";i:92;s:5:\"lodge\";i:93;s:13:\"travel_agency\";}'),
(4,	33,	'a:4:{i:0;s:10:\"electrican\";i:1;s:12:\"construction\";i:2;s:8:\"painting\";i:3;s:6:\"roofer\";}'),
(5,	30,	'a:3:{i:0;s:6:\"school\";i:1;s:7:\"college\";i:2;s:6:\"cinema\";}');

DROP TABLE IF EXISTS `ci_config_data`;
CREATE TABLE `ci_config_data` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `config_path` varchar(255) NOT NULL,
  `config_value` varchar(255) NOT NULL,
  PRIMARY KEY (`config_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `ci_config_data` (`config_id`, `config_path`, `config_value`) VALUES
(1,	'price_per_view',	'0.02'),
(2,	'price_per_click',	'0.2');

DROP TABLE IF EXISTS `ci_referral_codes`;
CREATE TABLE `ci_referral_codes` (
  `referral_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `author` int(5) NOT NULL,
  `price_per_click` decimal(12,2) NOT NULL,
  `price_per_view` decimal(12,2) NOT NULL,
  `status` smallint(1) NOT NULL,
  `added` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`referral_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ci_referral_codes` (`referral_id`, `code`, `author`, `price_per_click`, `price_per_view`, `status`, `added`, `updated`) VALUES
(1,	'QSDPFMLZ',	1,	25.00,	2.00,	1,	'0000-00-00 00:00:00',	'2015-05-10 17:28:49'),
(2,	'RGRFQRWB',	1,	0.00,	0.00,	1,	'2015-09-28 15:44:32',	'0000-00-00 00:00:00'),
(3,	'SWEFEZPC',	1,	0.00,	0.00,	0,	'2015-09-28 15:44:32',	'0000-00-00 00:00:00'),
(4,	'TYUXJUQM',	1,	0.00,	0.00,	1,	'2015-09-28 15:44:32',	'0000-00-00 00:00:00'),
(5,	'UYYNMNUS',	1,	0.00,	0.00,	2,	'2015-09-28 15:44:32',	'0000-00-00 00:00:00'),
(6,	'VLADSCAR',	1,	0.00,	0.00,	2,	'2015-09-28 15:44:32',	'0000-00-00 00:00:00'),
(7,	'WAAXPZLH',	1,	0.00,	0.00,	1,	'2015-09-28 15:44:32',	'0000-00-00 00:00:00'),
(8,	'XTANESML',	1,	0.00,	0.00,	1,	'2015-09-28 15:44:32',	'0000-00-00 00:00:00'),
(9,	'YLFJDCPH',	1,	0.00,	0.00,	0,	'2015-09-28 15:44:32',	'0000-00-00 00:00:00'),
(10,	'ZSENKHBG',	1,	0.00,	0.00,	0,	'2015-09-28 15:44:32',	'0000-00-00 00:00:00'),
(16,	'SOFTEQ12',	1,	25.00,	2.00,	1,	'0000-00-00 00:00:00',	'2015-05-10 17:33:29');

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('d356bfcb17f62a884369ddeccd592a38',	'10.51.0.198',	'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36',	1443771815,	''),
('f18af08373d69ed283c60d2241b2cdbe',	'10.51.0.198',	'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36',	1443709349,	'a:7:{s:9:\"user_data\";s:0:\"\";s:2:\"id\";s:1:\"1\";s:8:\"username\";s:5:\"admin\";s:5:\"email\";s:25:\"maksim.kabanov@softeq.com\";s:14:\"is_admin_login\";b:1;s:9:\"user_type\";s:2:\"SA\";s:8:\"messages\";a:0:{}}'),
('45ef0a652d0d2171c49804caa41f5701',	'10.51.0.198',	'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0',	1443705141,	'a:5:{s:2:\"id\";s:1:\"8\";s:8:\"username\";s:6:\"max.by\";s:5:\"email\";s:25:\"maksim.kabanov@softeq.com\";s:8:\"is_login\";b:1;s:10:\"first_name\";s:5:\"Maxim\";}'),
('3444fee9b980ab3177fb052aad1784d5',	'10.51.0.198',	'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36',	1443710017,	'a:7:{s:9:\"user_data\";s:0:\"\";s:2:\"id\";s:1:\"1\";s:8:\"username\";s:5:\"admin\";s:5:\"email\";s:25:\"maksim.kabanov@softeq.com\";s:14:\"is_admin_login\";b:1;s:9:\"user_type\";s:2:\"SA\";s:8:\"messages\";a:0:{}}'),
('627f2f7f911b189f8bcb079d4d08ca74',	'10.51.0.198',	'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0',	1443709814,	'a:6:{s:9:\"user_data\";s:0:\"\";s:2:\"id\";s:1:\"8\";s:8:\"username\";s:6:\"max.by\";s:5:\"email\";s:25:\"maksim.kabanov@softeq.com\";s:8:\"is_login\";b:1;s:10:\"first_name\";s:5:\"Maxim\";}');

DROP TABLE IF EXISTS `ci_users`;
CREATE TABLE `ci_users` (
  `user_id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `country` varchar(3) CHARACTER SET utf16 NOT NULL,
  `phone_number` varchar(20) CHARACTER SET utf16 NOT NULL,
  `referral_code` int(11) NOT NULL,
  `registered_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username_2` (`username`),
  KEY `username` (`username`),
  KEY `email` (`email`),
  KEY `country` (`country`),
  KEY `first_name` (`first_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ci_users` (`user_id`, `username`, `password`, `email`, `first_name`, `last_name`, `company_name`, `country`, `phone_number`, `referral_code`, `registered_date`, `last_login`) VALUES
(1,	'test11',	'212313123123123',	'test@test.com',	'Test',	'Last Test',	'213123123',	'US',	'US (231) 231-2312',	0,	'2015-09-29 15:30:19',	'0000-00-00 00:00:00'),
(2,	'stranger',	'a111111',	'11111@1232.ee',	'Maxim',	'Kabanov',	'ViewsWagen',	'US',	'US (333) 334-4442',	0,	'2015-09-29 15:30:15',	'0000-00-00 00:00:00'),
(4,	'stranger2',	'a111111',	'maxim_kabanov@mail.ru',	'Maxim',	'111111111111',	'ViewsWagen',	'US',	'US (333) 344-5666',	0,	'2015-09-29 15:30:13',	'0000-00-00 00:00:00'),
(5,	'stranger3',	'ceb4c546211a95fa6990cc85eb211eb8',	'stranger.2k6@gmail.com',	'Maxim',	'Kabanov2',	'ViewsWagen',	'US',	'US (243) 423-4234',	0,	'2015-09-29 15:30:12',	'0000-00-00 00:00:00'),
(8,	'max.by',	'ee21da3d4a7172c8446c2c5111e1db98',	'maksim.kabanov@softeq.com',	'Maxim',	'Kabanov',	'Vugo',	'US',	'US33334676',	16,	'2015-09-29 15:30:05',	'2015-10-01 17:24:28'),
(9,	'SOFTEQ1234',	'4ade7a97bd2dd05dfdd7448bb3116b16',	'SOFTEQ1234@1233.ee',	'SOFTEQ1234',	'SOFTEQ1234',	'SOFTEQ1234',	'US',	'US (444) 444-4443',	16,	'2015-09-29 15:39:43',	'0000-00-00 00:00:00'),
(10,	'licenses@softeq.com',	'babd4a84418fb04015ac773f7459727c',	'licenses@softeq.com',	'licenses@softeq.com',	'licenses@softeq.com',	'licenses@softeq.com',	'US',	'US(555) 555-5555',	16,	'2015-09-29 15:49:04',	'2015-09-29 15:49:04'),
(11,	'admin',	'fe01ce2a7fbac8fafaed7c982a04e229',	'user@vugo.com',	'Test',	'Add',	'Uset',	'US',	'US (111) 222-4446',	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(17,	'',	'fe01ce2a7fbac8fafaed7c982a04e229',	'11111111111111111@wwwwwwww.33',	'111111',	'1111111111111',	'11111111111',	'US',	'US (333) 333-3333',	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(20,	'admin1',	'fe01ce2a7fbac8fafaed7c982a04e229',	'11111111111111111@wwwwwwww.33',	'111111111',	'',	'11111111111',	'US',	'US (111) 111-1111',	0,	'0000-00-00 00:00:00',	'0000-00-00 00:00:00'),
(21,	'admin3',	'fe01ce2a7fbac8fafaed7c982a04e229',	'33333333333@eeeeeeee',	'3333333333333333',	'',	'333333333333333',	'US',	'US (333) 333-3333',	0,	'2015-10-01 14:51:26',	'0000-00-00 00:00:00');

DROP TABLE IF EXISTS `tbl_admin_users`;
CREATE TABLE `tbl_admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `block` tinyint(4) NOT NULL DEFAULT '0',
  `user_type` enum('SA','A') DEFAULT 'SA' COMMENT 'SA: Super Admin,A: Admin',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tbl_admin_users` (`id`, `username`, `name`, `email`, `password`, `block`, `user_type`) VALUES
(1,	'admin',	'Maxim',	'maksim.kabanov@softeq.com',	'7e466fc01a0c7932e96a4a925b11b06a',	0,	'SA');

-- 2015-10-02 18:54:58
