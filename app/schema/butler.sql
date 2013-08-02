SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `butler`
--

-- --------------------------------------------------------

--
-- Table structure for table `attribution`
--

DROP TABLE IF EXISTS `attribution`;
CREATE TABLE IF NOT EXISTS `attribution` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(512) NOT NULL,
  `author` varchar(255) NOT NULL,
  `used_for` varchar(255) NOT NULL,
  `ts_creation` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ts_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

DROP TABLE IF EXISTS `campaign`;
CREATE TABLE IF NOT EXISTS `campaign` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cost` decimal(10,2) NOT NULL,
  `ts_creation` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ts_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`id`, `name`, `start_time`, `end_time`, `cost`, `ts_creation`, `ts_update`, `deleted`) VALUES
(1, 'Default', '2013-01-01 00:00:00', '2013-12-31 23:59:59', 0.00, '2013-08-02 09:45:33', '2013-08-02 12:54:11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent` int(10) unsigned NOT NULL,
  `ts_creation` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ts_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `subject` varchar(255) NOT NULL,
  `comment` varchar(1024) NOT NULL,
  `id_user` int(10) unsigned NOT NULL,
  `id_business` int(10) unsigned NOT NULL,
  `id_state` int(10) unsigned NOT NULL DEFAULT '1',
  `ts_creation` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ts_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Triggers `contact`
--
DROP TRIGGER IF EXISTS `contact_insert`;
DELIMITER //
CREATE TRIGGER `contact_insert` AFTER INSERT ON `contact`
 FOR EACH ROW INSERT INTO contact_state_history
SET 
id_contact = NEW.id,
id_state = NEW.id_state,
ts_creation = NOW(),
ts_update = NOW()
//
DELIMITER ;
DROP TRIGGER IF EXISTS `contact_update`;
DELIMITER //
CREATE TRIGGER `contact_update` AFTER UPDATE ON `contact`
 FOR EACH ROW INSERT INTO contact_state_history
SET 
id_contact = NEW.id,
id_state = NEW.id_state,
ts_creation = NOW(),
ts_update = NOW()
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `contact_reply`
--

DROP TABLE IF EXISTS `contact_reply`;
CREATE TABLE IF NOT EXISTS `contact_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_contact` int(10) unsigned NOT NULL,
  `reply_text` text NOT NULL,
  `ts_creation` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ts_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `contact_state`
--

DROP TABLE IF EXISTS `contact_state`;
CREATE TABLE IF NOT EXISTS `contact_state` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `color_class` varchar(255) NOT NULL,
  `ts_creation` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ts_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `contact_state`
--

INSERT INTO `contact_state` (`id`, `name`, `description`, `color_class`, `ts_creation`, `ts_update`, `deleted`) VALUES
(1, 'pending', '', 'text-error', '2013-06-05 16:19:24', '2013-06-05 16:47:13', 0),
(2, 'closed', '', 'muted', '2013-06-05 16:19:24', '2013-06-05 16:19:24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact_state_history`
--

DROP TABLE IF EXISTS `contact_state_history`;
CREATE TABLE IF NOT EXISTS `contact_state_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_contact` int(10) unsigned NOT NULL,
  `id_state` int(10) unsigned NOT NULL,
  `ts_creation` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ts_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirmed` tinyint(1) NOT NULL,
  `seed` varchar(255) NOT NULL,
  `ts_creation` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ts_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `email_sended`
--

DROP TABLE IF EXISTS `email_sended`;
CREATE TABLE IF NOT EXISTS `email_sended` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL,
  `to` varchar(255) NOT NULL,
  `from` varchar(255) NOT NULL,
  `ts_creation` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ts_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `landing`
--

DROP TABLE IF EXISTS `landing`;
CREATE TABLE IF NOT EXISTS `landing` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `bg_image` varchar(255) NOT NULL,
  `phrase_1` varchar(255) NOT NULL,
  `phrase_2` varchar(255) NOT NULL,
  `phrase_3` varchar(255) NOT NULL,
  `placeholder` varchar(255) NOT NULL,
  `button_text` varchar(255) NOT NULL,
  `button_type` varchar(255) NOT NULL,
  `ts_creation` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ts_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `landing`
--

INSERT INTO `landing` (`id`, `name`, `bg_image`, `phrase_1`, `phrase_2`, `phrase_3`, `placeholder`, `button_text`, `button_type`, `ts_creation`, `ts_update`, `deleted`) VALUES
(1, 'Default', '', 'Do it simple', 'Develope faster', 'Enjoy your job', 'Put your email here...', 'Subscribe', 'success', '2013-08-02 09:45:10', '2013-08-02 12:53:27', 0);

-- --------------------------------------------------------

--
-- Table structure for table `landing_campaign`
--

DROP TABLE IF EXISTS `landing_campaign`;
CREATE TABLE IF NOT EXISTS `landing_campaign` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_landing` int(10) unsigned NOT NULL,
  `id_campaign` int(10) unsigned NOT NULL,
  `id_state` int(10) unsigned NOT NULL,
  `ts_creation` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ts_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `landing_campaign`
--

INSERT INTO `landing_campaign` (`id`, `id_landing`, `id_campaign`, `id_state`, `ts_creation`, `ts_update`, `deleted`) VALUES
(1, 1, 1, 2, '2013-08-02 09:47:49', '2013-08-02 16:49:43', 0);

--
-- Triggers `landing_campaign`
--
DROP TRIGGER IF EXISTS `landing_campaign_insert`;
DELIMITER //
CREATE TRIGGER `landing_campaign_insert` AFTER INSERT ON `landing_campaign`
 FOR EACH ROW INSERT INTO landing_campaign_history
SET 
id_landing_campaign = NEW.id,
id_state = NEW.id_state,
ts_creation = NOW(),
ts_update = NOW()
//
DELIMITER ;
DROP TRIGGER IF EXISTS `landing_campaign_update`;
DELIMITER //
CREATE TRIGGER `landing_campaign_update` AFTER UPDATE ON `landing_campaign`
 FOR EACH ROW INSERT INTO landing_campaign_history
SET id_landing_campaign = NEW.id,
id_state = NEW.id_state,
ts_creation = NOW( ) ,
ts_update = NOW( )
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `landing_campaign_history`
--

DROP TABLE IF EXISTS `landing_campaign_history`;
CREATE TABLE IF NOT EXISTS `landing_campaign_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_landing_campaign` int(10) unsigned NOT NULL,
  `id_state` int(10) unsigned NOT NULL,
  `ts_creation` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ts_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `landing_campaign_history`
--

INSERT INTO `landing_campaign_history` (`id`, `id_landing_campaign`, `id_state`, `ts_creation`, `ts_update`) VALUES
(1, 1, 1, '2013-08-02 09:47:49', '2013-08-02 09:47:49');

-- --------------------------------------------------------

--
-- Table structure for table `landing_campaign_state`
--

DROP TABLE IF EXISTS `landing_campaign_state`;
CREATE TABLE IF NOT EXISTS `landing_campaign_state` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `color_class` varchar(255) NOT NULL,
  `ts_creation` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ts_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `landing_campaign_state`
--

INSERT INTO `landing_campaign_state` (`id`, `name`, `description`, `color_class`, `ts_creation`, `ts_update`, `deleted`) VALUES
(1, 'Created', '', 'success', '2013-07-12 12:56:56', '2013-07-12 12:56:56', 0),
(2, 'Enabled', '', 'success', '2013-07-12 12:56:56', '2013-07-12 12:57:02', 0),
(3, 'Disabled', '', 'error', '2013-07-12 12:56:56', '2013-07-12 12:57:05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `landing_campaign_visit`
--

DROP TABLE IF EXISTS `landing_campaign_visit`;
CREATE TABLE IF NOT EXISTS `landing_campaign_visit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_landing_campaign` int(10) unsigned NOT NULL,
  `id_visit` int(10) unsigned NOT NULL,
  `ts_creation` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ts_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `landing_campaign_visit`
--

INSERT INTO `landing_campaign_visit` (`id`, `id_landing_campaign`, `id_visit`, `ts_creation`, `ts_update`) VALUES
(1, 1, 226, '2013-08-02 09:48:32', '2013-08-02 09:48:32'),
(2, 1, 252, '2013-08-02 10:13:34', '2013-08-02 10:13:34'),
(3, 1, 254, '2013-08-02 10:17:01', '2013-08-02 10:17:01'),
(4, 1, 256, '2013-08-02 10:17:08', '2013-08-02 10:17:08'),
(5, 1, 258, '2013-08-02 10:17:54', '2013-08-02 10:17:54'),
(6, 1, 260, '2013-08-02 10:18:58', '2013-08-02 10:18:58'),
(7, 1, 262, '2013-08-02 10:19:24', '2013-08-02 10:19:24'),
(8, 1, 263, '2013-08-02 10:20:00', '2013-08-02 10:20:00'),
(9, 1, 264, '2013-08-02 10:20:08', '2013-08-02 10:20:08'),
(10, 1, 265, '2013-08-02 10:20:36', '2013-08-02 10:20:36'),
(11, 1, 266, '2013-08-02 10:20:39', '2013-08-02 10:20:39'),
(12, 1, 339, '2013-08-02 12:48:57', '2013-08-02 12:48:57'),
(13, 1, 342, '2013-08-02 12:49:23', '2013-08-02 12:49:23'),
(14, 1, 345, '2013-08-02 12:49:27', '2013-08-02 12:49:27'),
(15, 1, 353, '2013-08-02 12:50:30', '2013-08-02 12:50:30'),
(16, 1, 356, '2013-08-02 12:52:14', '2013-08-02 12:52:14'),
(17, 1, 358, '2013-08-02 12:52:41', '2013-08-02 12:52:41'),
(18, 1, 366, '2013-08-02 12:54:15', '2013-08-02 12:54:15'),
(19, 1, 372, '2013-08-02 12:55:07', '2013-08-02 12:55:07'),
(20, 1, 373, '2013-08-02 12:55:46', '2013-08-02 12:55:46'),
(21, 1, 377, '2013-08-02 12:57:10', '2013-08-02 12:57:10'),
(22, 1, 384, '2013-08-02 12:59:39', '2013-08-02 12:59:39');

-- --------------------------------------------------------

--
-- Table structure for table `landing_campaign_visit_conversion`
--

DROP TABLE IF EXISTS `landing_campaign_visit_conversion`;
CREATE TABLE IF NOT EXISTS `landing_campaign_visit_conversion` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_landing_campaign_visit` int(10) unsigned NOT NULL,
  `id_customer` int(10) unsigned NOT NULL,
  `ts_creation` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ts_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `tags` varchar(255) NOT NULL,
  `author` int(10) unsigned NOT NULL,
  `published` tinyint(1) NOT NULL,
  `ts_creation` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ts_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `seo`
--

DROP TABLE IF EXISTS `seo`;
CREATE TABLE IF NOT EXISTS `seo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `robots` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `canonical` varchar(255) NOT NULL,
  `resource` varchar(255) NOT NULL,
  `task` varchar(255) NOT NULL,
  `ts_creation` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ts_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `seo`
--

INSERT INTO `seo` (`id`, `name`, `title`, `description`, `robots`, `author`, `canonical`, `resource`, `task`, `ts_creation`, `ts_update`, `deleted`) VALUES
(1, 'Home', 'Discover Incredible Experiences', '', 'INDEX, FOLLOW', '', '', 'static', 'home', '2013-06-17 15:58:20', '2013-08-02 14:26:35', 0),
(2, 'About Us', 'About Us', '', 'INDEX, FOLLOW', '', '', 'static', 'about', '2013-06-17 15:58:46', '2013-08-02 14:26:26', 0),
(3, 'Partner With Us', 'Partner With Us', '', 'INDEX, FOLLOW', '', '', 'static', 'partner', '2013-06-17 15:59:26', '2013-08-02 14:26:16', 0),
(4, 'Contact Form', 'Contact Form', '', 'INDEX, FOLLOW', '', '', 'static', 'contact', '2013-06-17 15:59:39', '2013-08-02 14:26:08', 0),
(5, 'Privacy Policy', 'Privacy Policy', '', 'INDEX, NOFOLLOW', 'Olan O''Sullivan, olan@tripclocker.com', '', 'static', 'privacy', '2013-06-17 15:59:55', '2013-08-02 14:25:59', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL DEFAULT 'guest',
  `ts_creation` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ts_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `usertype`, `ts_creation`, `ts_update`, `deleted`) VALUES
(15, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '2012-09-22 15:29:56', '2013-07-09 16:55:56', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `ts_creation` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ts_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `name`, `description`, `ts_creation`, `ts_update`, `deleted`) VALUES
(1, 'admin', '', '2013-06-05 23:00:00', '2013-06-05 23:00:00', 0),
(2, 'guest', '', '2013-06-05 23:00:00', '2013-06-05 23:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `visit`
--

DROP TABLE IF EXISTS `visit`;
CREATE TABLE IF NOT EXISTS `visit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `visitor_hash` varchar(255) CHARACTER SET latin1 NOT NULL,
  `browser` varchar(255) CHARACTER SET latin1 NOT NULL,
  `os` varchar(255) CHARACTER SET latin1 NOT NULL,
  `uri` varchar(255) CHARACTER SET latin1 NOT NULL,
  `referer` varchar(255) CHARACTER SET latin1 NOT NULL,
  `ip` varchar(255) CHARACTER SET latin1 NOT NULL,
  `user_agent` varchar(255) CHARACTER SET latin1 NOT NULL,
  `ts_creation` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ts_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
