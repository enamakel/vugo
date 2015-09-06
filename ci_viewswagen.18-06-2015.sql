-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 18, 2015 at 08:28 PM
-- Server version: 5.5.41-log
-- PHP Version: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ci_viewswagen`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_campaigns`
--

CREATE TABLE IF NOT EXISTS `ci_campaigns` (
  `campaign_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `landing_url` varchar(255) NOT NULL,
  `adv_type` smallint(1) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `budget` decimal(12,2) NOT NULL,
  `monthly_cap` decimal(12,2) NOT NULL,
  `daily_cap` decimal(12,2) NOT NULL,
  `frequency` int(5) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`campaign_id`),
  KEY `owner_id` (`owner_id`),
  KEY `type` (`type`),
  KEY `status` (`status`),
  KEY `owner_id_2` (`owner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `ci_campaigns`
--

INSERT INTO `ci_campaigns` (`campaign_id`, `name`, `landing_url`, `adv_type`, `file_path`, `budget`, `monthly_cap`, `daily_cap`, `frequency`, `owner_id`, `type`, `status`) VALUES
(17, 'Campaign name 17', 'http://landing.page.com', 0, '', '40000.00', '3333.00', '22.00', 5, 5, 'image', 1),
(18, 'Campaign name', 'http://landing.page.com', 0, '', '40000.00', '3333.00', '22.00', 5, 5, 'image', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ci_campaigns_location`
--

CREATE TABLE IF NOT EXISTS `ci_campaigns_location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign` int(11) NOT NULL,
  `address` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `radius` int(3) NOT NULL,
  `state` varchar(50) NOT NULL,
  `location_zip` text NOT NULL,
  `country` varchar(255) NOT NULL,
  PRIMARY KEY (`location_id`),
  KEY `campaign_id` (`campaign`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ci_campaigns_location`
--

INSERT INTO `ci_campaigns_location` (`location_id`, `campaign`, `address`, `location`, `radius`, `state`, `location_zip`, `country`) VALUES
(1, 17, 'Paris, TX, United States', '33.660939,-95.555513', 11, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ci_campaigns_media`
--

CREATE TABLE IF NOT EXISTS `ci_campaigns_media` (
  `media_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign` int(11) NOT NULL,
  `real_path` text NOT NULL,
  `absolute_url` text NOT NULL,
  PRIMARY KEY (`media_id`),
  KEY `campaign_id` (`campaign`),
  KEY `media_id` (`media_id`),
  KEY `campaign` (`campaign`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ci_campaigns_media`
--

INSERT INTO `ci_campaigns_media` (`media_id`, `campaign`, `real_path`, `absolute_url`) VALUES
(1, 18, 'E:/OpenServer/domains/viewswagen/uploads/5/a6ffd761b8b1f979224c54023e468bf7.jpg', 'http://viewswagen/uploads/5/a6ffd761b8b1f979224c54023e468bf7.jpg'),
(2, 17, 'E:/OpenServer/domains/viewswagen/uploads/5/988ee4a23084b7aa9c64c4c58234714f.jpg', 'http://viewswagen/uploads/5/988ee4a23084b7aa9c64c4c58234714f.jpg'),
(3, 17, '', ''),
(4, 17, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ci_campaigns_schedule`
--

CREATE TABLE IF NOT EXISTS `ci_campaigns_schedule` (
  `schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `week_days` tinyint(2) NOT NULL,
  `schedule_from` time NOT NULL,
  `schedule_until` time NOT NULL,
  PRIMARY KEY (`schedule_id`),
  KEY `campaign` (`campaign`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ci_campaigns_schedule`
--

INSERT INTO `ci_campaigns_schedule` (`schedule_id`, `campaign`, `date_start`, `date_end`, `week_days`, `schedule_from`, `schedule_until`) VALUES
(1, 17, '2015-06-30', '0000-00-00', 3, '02:30:00', '03:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('d6605ec2d1b546e3f7e3475c41c4f343', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', 1434647441, ''),
('ee26e19f53ac60bd918bb333c648b90e', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', 1434647441, ''),
('b6b5a3f62f8e5eacac6168e1a63bcd18', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:38.0) Gecko/20100101 Firefox/38.0', 1434647756, 'a:6:{s:9:"user_data";s:0:"";s:2:"id";s:1:"5";s:8:"username";s:9:"stranger3";s:5:"email";s:22:"stranger.2k6@gmail.com";s:8:"is_login";b:1;s:10:"first_name";s:5:"Maxim";}');

-- --------------------------------------------------------

--
-- Table structure for table `ci_users`
--

CREATE TABLE IF NOT EXISTS `ci_users` (
  `user_id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `country` varchar(3) CHARACTER SET utf16 NOT NULL,
  `phone_number` varchar(20) CHARACTER SET utf16 NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username_2` (`username`),
  KEY `username` (`username`),
  KEY `email` (`email`),
  KEY `country` (`country`),
  KEY `first_name` (`first_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `ci_users`
--

INSERT INTO `ci_users` (`user_id`, `username`, `password`, `email`, `first_name`, `last_name`, `company_name`, `country`, `phone_number`) VALUES
(1, 'test11', '212313123123123', 'test@test.com', 'Test', 'Last Test', '', '', ''),
(2, 'stranger', 'a111111', '11111@1232.ee', 'Maxim', 'Kabanov', 'ViewsWagen', 'US', 'US113215688'),
(4, 'stranger2', 'a111111', 'maxim_kabanov@mail.ru', 'Maxim', '111111111111', 'ViewsWagen', 'US', 'US113215688'),
(5, 'stranger3', 'ceb4c546211a95fa6990cc85eb211eb8', 'stranger.2k6@gmail.com', 'Maxim', 'Kabanov2', 'ViewsWagen', 'US', 'US113215688'),
(6, 'stranger4', 'aqwqwqwqw', 'stranger.2k6@gmail.com', 'Maxim', 'Kabanov2', 'ViewsWagen', 'US', 'US113215688'),
(7, 'stranger5', 'aqwqwqwqw', 'stranger.2k6@gmail.com', 'Maxim', 'Kabanov2', 'ViewsWagen', 'US', 'US113215688');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_users`
--

CREATE TABLE IF NOT EXISTS `tbl_admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `block` tinyint(4) NOT NULL DEFAULT '0',
  `user_type` enum('SA','A') DEFAULT 'SA' COMMENT 'SA: Super Admin,A: Admin',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_admin_users`
--

INSERT INTO `tbl_admin_users` (`id`, `username`, `email`, `password`, `block`, `user_type`) VALUES
(1, 'demo', 'abhishek@devzone.co.in', '7e466fc01a0c7932e96a4a925b11b06a', 0, 'SA');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cms`
--

CREATE TABLE IF NOT EXISTS `tbl_cms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(100) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_cms`
--

INSERT INTO `tbl_cms` (`id`, `label`, `content`) VALUES
(1, 'About Us', '<p style="padding-left: 30px; text-align: left;"><img src="/ark_admin_v2/uploads/images/Water_lilies.jpg" alt="" width="179" height="134" />Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.<br /><br />Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.<br /><br />Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.<br /><br />Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.<br /><br />Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>\r\n<p>&nbsp;</p>'),
(2, 'What We do', '<p>This is the new text.</p>\r\n<p>&nbsp;</p>\r\n<p>ggg</p>\r\n<p>&nbsp;</p>'),
(3, 'Services', '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.<br /><br />Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.<br /><br />Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.<br /><br />Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus.<br /><br />Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,</p>'),
(4, 'Contact Us', '<p>294, Street Name,</p>\r\n<p>Area- Zip Code,</p>\r\n<p>City, State, Country</p>\r\n<p>&nbsp;</p>\r\n<p>phone: 999-999-9999</p>\r\n<p>Email: abc@xyz.com</p>');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(60) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `signup_date` datetime DEFAULT NULL,
  `phone_mobile` varchar(50) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `address_street` varchar(150) DEFAULT NULL,
  `address_city` varchar(100) DEFAULT NULL,
  `address_state` varchar(100) DEFAULT NULL,
  `address_country` varchar(100) DEFAULT NULL,
  `address_postalcode` varchar(20) DEFAULT NULL,
  `deleted` enum('Y','N') DEFAULT 'N',
  `user_status` enum('A','B') DEFAULT 'A' COMMENT 'A: Active; B: Blocked',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=649 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ci_campaigns`
--
ALTER TABLE `ci_campaigns`
  ADD CONSTRAINT `ci_campaigns_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `ci_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ci_campaigns_location`
--
ALTER TABLE `ci_campaigns_location`
  ADD CONSTRAINT `ci_campaigns_location_ibfk_1` FOREIGN KEY (`campaign`) REFERENCES `ci_campaigns` (`campaign_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ci_campaigns_media`
--
ALTER TABLE `ci_campaigns_media`
  ADD CONSTRAINT `ci_campaigns_media_ibfk_1` FOREIGN KEY (`campaign`) REFERENCES `ci_campaigns` (`campaign_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ci_campaigns_schedule`
--
ALTER TABLE `ci_campaigns_schedule`
  ADD CONSTRAINT `ci_campaigns_schedule_ibfk_1` FOREIGN KEY (`campaign`) REFERENCES `ci_campaigns` (`campaign_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
