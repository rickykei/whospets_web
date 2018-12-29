-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 04, 2016 at 12:45 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sosopet`
--

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

CREATE TABLE IF NOT EXISTS `action` (
`id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `comment` text,
  `subject` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `action`
--

INSERT INTO `action` (`id`, `title`, `comment`, `subject`) VALUES
(1, 'create', NULL, NULL),
(2, 'read', NULL, NULL),
(3, 'update', NULL, NULL),
(4, 'delete', NULL, NULL),
(5, 'message', NULL, NULL),
(6, 'user', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `friendship`
--

CREATE TABLE IF NOT EXISTS `friendship` (
  `inviter_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `acknowledgetime` int(11) DEFAULT NULL,
  `requesttime` int(11) DEFAULT NULL,
  `updatetime` int(11) DEFAULT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE IF NOT EXISTS `membership` (
`id` int(11) unsigned NOT NULL,
  `membership_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `order_date` int(11) NOT NULL,
  `end_date` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `payment_date` int(11) DEFAULT NULL,
  `subscribed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
`id` int(10) unsigned NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  `from_user_id` int(10) unsigned NOT NULL,
  `to_user_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text,
  `message_read` tinyint(1) NOT NULL,
  `answered` tinyint(1) DEFAULT NULL,
  `draft` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `title`, `text`) VALUES
(1, 'Prepayment', NULL),
(2, 'Paypal', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `principal_id` int(11) NOT NULL,
  `subordinate_id` int(11) NOT NULL DEFAULT '0',
  `type` enum('user','role') NOT NULL,
  `action` int(11) unsigned NOT NULL,
  `subaction` int(11) unsigned NOT NULL,
  `template` tinyint(1) NOT NULL,
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`principal_id`, `subordinate_id`, `type`, `action`, `subaction`, `template`, `comment`) VALUES
(1, 0, 'role', 6, 2, 0, 'User Manager can read other users'),
(2, 0, 'role', 5, 1, 0, 'Demo role can write messages'),
(2, 0, 'role', 5, 2, 0, 'Demo role can read messages');

-- --------------------------------------------------------

--
-- Table structure for table `privacysetting`
--

CREATE TABLE IF NOT EXISTS `privacysetting` (
  `user_id` int(10) unsigned NOT NULL,
  `message_new_friendship` tinyint(1) NOT NULL DEFAULT '1',
  `message_new_message` tinyint(1) NOT NULL DEFAULT '1',
  `message_new_profilecomment` tinyint(1) NOT NULL DEFAULT '1',
  `appear_in_search` tinyint(1) NOT NULL DEFAULT '1',
  `show_online_status` tinyint(1) NOT NULL DEFAULT '1',
  `log_profile_visits` tinyint(1) NOT NULL DEFAULT '1',
  `ignore_users` varchar(255) DEFAULT NULL,
  `public_profile_fields` bigint(15) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `privacysetting`
--

INSERT INTO `privacysetting` (`user_id`, `message_new_friendship`, `message_new_message`, `message_new_profilecomment`, `appear_in_search`, `show_online_status`, `log_profile_visits`, `ignore_users`, `public_profile_fields`) VALUES
(1, 1, 1, 1, 1, 1, 1, '', NULL),
(3, 1, 1, 1, 1, 1, 1, '', NULL),
(4, 1, 1, 1, 1, 1, 1, '', NULL),
(5, 1, 1, 1, 1, 1, 1, '', NULL),
(6, 1, 1, 1, 1, 1, 1, '', NULL),
(7, 1, 1, 1, 1, 1, 1, '', NULL),
(8, 1, 1, 1, 1, 1, 1, '', NULL),
(9, 1, 1, 1, 1, 1, 1, '', NULL),
(10, 1, 1, 1, 1, 1, 1, '', NULL),
(11, 1, 1, 1, 1, 1, 1, '', NULL),
(12, 1, 1, 1, 1, 1, 1, '', NULL),
(13, 1, 1, 1, 1, 1, 1, '', NULL),
(14, 1, 1, 1, 1, 1, 1, '', NULL),
(15, 1, 1, 1, 1, 1, 1, '', NULL),
(16, 1, 1, 1, 1, 1, 1, '', NULL),
(17, 1, 1, 1, 1, 1, 1, '', NULL),
(20, 1, 1, 1, 1, 1, 1, '', NULL),
(21, 1, 1, 1, 1, 1, 1, '', NULL),
(22, 1, 1, 1, 1, 1, 1, '', NULL),
(23, 1, 1, 1, 1, 1, 1, '', NULL),
(24, 1, 1, 1, 1, 1, 1, '', NULL),
(25, 1, 1, 1, 1, 1, 1, '', NULL),
(26, 1, 1, 1, 1, 1, 1, '', NULL),
(27, 1, 1, 1, 1, 1, 1, '', NULL),
(28, 1, 1, 1, 1, 1, 1, '', NULL),
(29, 1, 1, 1, 1, 1, 1, '', NULL),
(30, 1, 1, 1, 1, 1, 1, '', NULL),
(31, 1, 1, 1, 1, 1, 1, '', NULL),
(32, 1, 1, 1, 1, 1, 1, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
`id` int(10) unsigned NOT NULL,
  `tc` varchar(1) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `about` text,
  `newsletter` varchar(1) DEFAULT NULL,
  `seller` varchar(1) DEFAULT NULL,
  `notification` varchar(1) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `bio` text
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `tc`, `user_id`, `lastname`, `firstname`, `email`, `street`, `city`, `about`, `newsletter`, `seller`, `notification`, `gender`, `birthday`, `bio`) VALUES
(1, '0', 1, 'admin', 'admin', 'sales.whospets@gmail.com', NULL, NULL, NULL, '', '1', '', 'M', NULL, NULL),
(3, '', 3, '', '', 'rickykei@yahoo.com.hk', NULL, NULL, NULL, '1', NULL, '', 'M', '2015-09-22', ''),
(4, '', 4, '', '', 'stephenfung84@yahoo.com', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL),
(5, '', 5, '', '', 'stephenfung84@gmail.com', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL),
(6, '', 6, '', '', 'rickykei@yahoo.com.hk', NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL),
(7, '', 7, '馮', '漢忠', 'stephenfung84@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '', 8, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, '', 9, 'w', 'w', 'rickykei@yahoo.com.hk', NULL, NULL, NULL, '0', NULL, NULL, 'M', NULL, NULL),
(10, '', 10, '', '', 'stephenfung84@mail.com', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL),
(11, '', 11, '', '', 'marketing@bmtrada.com.hk', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL),
(12, '', 12, '', 'whospets', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, '', 13, '', '', 'wongwankei@yahoo.com.hk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, '', 14, 'Kei', 'Ricky', 'rickykei@yahoo.com.hk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, '', 15, '', '', 'stfeohfeohcdwcw@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, '', 16, '', '', 'stephennnn@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, '', 17, 'Lam', 'Ken', 'ken50488642@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, '', 20, '', '', 'rickykei@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, '', 21, '', '', 'rickykei @gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, '', 22, '', '', 'rickyke9@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, '', 23, '', '', 'rickykei99@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, '0', 24, '', '', 'stephenfung@bmtrada.com.hk', NULL, NULL, NULL, NULL, NULL, NULL, 'M', NULL, NULL),
(25, '', 25, '', '', 'stephen.fung@qualitech.com.hk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, '0', 26, 'Richardson', 'Denise', 'deniserichardson@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'F', NULL, NULL),
(27, '', 27, '', '', 'raymondhlc@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, '', 28, '', '', 'jessmt@connect.hku.hk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, '', 29, '', '', 'glassestimmy@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, '', 30, '', '', 'ka_lam@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, '', 31, '', '', 'yukito925@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, '0', 32, '', '', 'bblui425@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'F', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profile2016`
--

CREATE TABLE IF NOT EXISTS `profile2016` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `about` text,
  `newsletter` varchar(1) DEFAULT NULL,
  `seller` varchar(1) DEFAULT NULL,
  `tc` varchar(1) NOT NULL,
  `notification` varchar(1) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `bio` text
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile2016`
--

INSERT INTO `profile2016` (`id`, `user_id`, `lastname`, `firstname`, `email`, `street`, `city`, `about`, `newsletter`, `seller`, `tc`, `notification`, `gender`, `birthday`, `bio`) VALUES
(1, 1, 'admin', 'admin', 'nfctouch84@gmail.com', NULL, NULL, NULL, '', '1', '0', '', 'M', NULL, NULL),
(3, 3, '', '', 'rickykei@gmail.com', NULL, NULL, NULL, '1', NULL, '0', '', 'M', '2015-09-22', ''),
(4, 4, '', '', 'stephenfung84@yahoo.com', NULL, NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL),
(5, 5, '', '', 'stephenfung84@gmail.com', NULL, NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL),
(6, 6, '', '', 'julianjctest@gmail.com', NULL, NULL, NULL, '1', NULL, '0', NULL, NULL, NULL, NULL),
(7, 7, '馮', '漢忠', 'stephenfung84@yahoo.com', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(8, 8, '', '', '', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL),
(9, 9, 'w', 'w', 'rickykei@yahoo.com.hk', NULL, NULL, NULL, '0', NULL, '0', NULL, 'M', NULL, NULL),
(10, 10, '', '', 'stephenfung84@mail.com', NULL, NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL),
(11, 11, '', '', 'marketing@bmtrada.com.hk', NULL, NULL, NULL, '0', NULL, '0', NULL, NULL, NULL, NULL),
(12, 12, '', 'whospets', '', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profile_comment`
--

CREATE TABLE IF NOT EXISTS `profile_comment` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `createtime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `profile_visit`
--

CREATE TABLE IF NOT EXISTS `profile_visit` (
  `visitor_id` int(11) NOT NULL,
  `visited_id` int(11) NOT NULL,
  `timestamp_first_visit` int(11) NOT NULL,
  `timestamp_last_visit` int(11) NOT NULL,
  `num_of_visits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
`id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `membership_priority` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL COMMENT 'Price (when using membership module)',
  `duration` int(11) DEFAULT NULL COMMENT 'How long a membership is valid'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `title`, `description`, `membership_priority`, `price`, `duration`) VALUES
(1, 'UserManager', 'These users can manage Users', 0, 0, 0),
(2, 'Demo', 'Users having the demo role', 0, 0, 0),
(3, 'Business', 'Example Business account', 1, 9.99, 7),
(4, 'Premium', 'Example Premium account', 2, 19.99, 28);

-- --------------------------------------------------------

--
-- Table structure for table `shop_address`
--

CREATE TABLE IF NOT EXISTS `shop_address` (
`id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_app_profile`
--

CREATE TABLE IF NOT EXISTS `shop_app_profile` (
  `code` varchar(45) NOT NULL,
  `description` varchar(255) NOT NULL,
  `val` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_app_profile`
--

INSERT INTO `shop_app_profile` (`code`, `description`, `val`) VALUES
('emailHost', 'Email Host', 'smtpout.secureserver.net'),
('emailPassword', 'Email Password', 'soso2016'),
('emailPort', 'Email Port', '465'),
('emailTransport', 'Protocol to transfer email (smtp for smtp server, empty for sendmail)', 'smtp'),
('emailUsername', 'Email Username', 'admin@whospets.com'),
('featureProductFee', 'Unit Price of Feature Product Slide', '0.5'),
('galleryProductFee', 'Unit Price of Gallery Product Slide', '0.8'),
('imageLimit', 'No. of images shown', '8'),
('linkDribbble', 'Dribbble Link', '#'),
('linkFacebook', 'Facebook Link', '#'),
('linkRSS', 'RSS Link', '#'),
('linkSkype', 'Skype Link', '#'),
('linkTwitter', 'Twitter Link', '#'),
('linkYouTube', 'YouTube Link', '#'),
('loginFacebookAppID', 'Facebook Login App ID', '1205825196113953'),
('loginFacebookAppSecret', 'Facebook Login App Secret', 'df67f51dbdafce6b9ab4839f0aaa5fcf'),
('loginTwitterConsumerKey', 'Twitter Login Consumer Key', 'Tup903TkIY9FvPJVO7j1onZ2P'),
('loginTwitterConsumerSecret', 'Twitter Login Consumer Secret', 'sD7eLrEZGtTBpp3R2Tvh2nagEt73LFofSzzvG79DThPF3jwWac'),
('mailTemplateRecoverBody', 'Recover Password Email Template (Content)', 'Dearest Member,<br>You have requested a new password.  Please use this URL to continue: {recovery_url}'),
('mailTemplateRecoverSubject', 'Recover Password Email Template (Subject)', 'Kixify Sandbox - You requested a new password'),
('mailTemplateRegistrationBody', 'Registration Email Template (Content)', 'Hello, {username}. Please activate your account with this url: {activation_url}'),
('mailTemplateRegistrationSubject', 'Registration Email Template (Subject)', 'Please activate your account for {username}'),
('payPalAPIAppID', 'PayPal API App ID', 'APP-80W284485P519543T'),
('payPalAPIPassword', 'PayPal API Password', '1405741231'),
('payPalAPISignature', 'PayPal API Signature', 'AFcWxV21C7fd0v3bYYYRCpSSRl31AgxFY-STP4tbD9Ul4iXpe2v4KomC'),
('payPalAPIUsername', 'PayPal API Username', 'julianjc82-co-kixify_api1.yahoo.com.hk'),
('payPalBusinessEmail', 'Site Owner PayPal Email', 'julianjc82-co-kixify@yahoo.com.hk'),
('payPalHandlingFeePercentage', 'Handling Fee Percentage to PayPal', '0.04'),
('payPalTestMode', 'PayPal Sandbox Mode', '1'),
('payPercentage', 'Percentage of order amount transferred to site owner', '0.07');

-- --------------------------------------------------------

--
-- Table structure for table `shop_category`
--

CREATE TABLE IF NOT EXISTS `shop_category` (
`category_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(45) NOT NULL,
  `description` text,
  `language` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=177 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_category`
--

INSERT INTO `shop_category` (`category_id`, `parent_id`, `title`, `description`, `language`) VALUES
(1, 0, 'Dog', 'Dog', 'English'),
(2, 0, 'Cat', 'Cat', 'English'),
(9, 1, 'German Shepherd', 'German Shepherd', 'English'),
(10, 1, 'Poodle', 'Poodle ', 'English'),
(11, 1, 'Chihuahua', 'Chihuahua', 'English'),
(12, 1, 'Golden Retriever', 'Golden Retriever', 'English'),
(13, 1, 'Yorkshire Terrier', 'Yorkshire Terrier', 'English'),
(14, 1, 'Dachshund', 'Dachshund', 'English'),
(15, 1, 'Beagle', 'Beagle', 'English'),
(16, 1, 'Boxer', 'Boxer', 'English'),
(17, 1, 'Miniature Schnauzer', 'Miniature Schnauzer', 'English'),
(18, 1, 'Shih Tzu', 'Shih Tzu', 'English'),
(19, 1, 'Bulldog', 'Bulldog', 'English'),
(20, 1, 'German Spitz', 'German Spitz', 'English'),
(21, 1, 'English Cocker Spaniel', 'English Cocker Spaniel', 'English'),
(22, 1, 'Cavalier King Charles Spaniel', 'Cavalier King Charles Spaniel', 'English'),
(23, 1, 'French Bulldog', 'French Bulldog', 'English'),
(24, 1, 'Pug', 'Pug', 'English'),
(25, 1, 'Rottweiler', 'Rottweiler', 'English'),
(26, 1, 'English Setter', 'English Setter', 'English'),
(27, 1, 'Maltese', 'Maltese', 'English'),
(28, 1, 'English Springer Spaniel', 'English Springer Spaniel', 'English'),
(29, 1, 'German Shorthaired Pointer', 'German Shorthaired Pointer', 'English'),
(30, 1, 'Staffordshire Bull Terrier', 'Staffordshire Bull Terrier', 'English'),
(31, 1, 'Border Collie', 'Border Collie', 'English'),
(32, 1, 'Shetland Sheepdog', 'Shetland Sheepdog', 'English'),
(33, 1, 'Dobermann', 'Dobermann', 'English'),
(34, 1, 'West Highland White Terrier', 'West Highland White Terrier', 'English'),
(35, 1, 'Bernese Mountain Dog', 'Bernese Mountain Dog', 'English'),
(36, 1, 'Great Dane', 'Great Dane', 'English'),
(37, 1, 'Brittany Spaniel', 'Brittany Spaniel', 'English'),
(38, 1, 'Other Dogs', 'Others Dogs', 'English'),
(39, 2, 'Abyssinian', 'Abyssinian', 'English'),
(40, 2, 'American Bobtail', 'American Bobtail', 'English'),
(41, 2, 'American Curl', 'American Curl', 'English'),
(42, 2, 'American Shorthair', 'American Shorthair', 'English'),
(43, 2, 'American Wirehair', 'American Wirehair', 'English'),
(44, 2, 'Balinese', 'Balinese', 'English'),
(45, 2, 'Bengal', 'Bengal', 'English'),
(46, 2, 'Birman', 'Birman', 'English'),
(47, 2, 'Bombay', 'Bombay', 'English'),
(48, 2, 'British Shorthair', 'British Shorthair', 'English'),
(49, 2, 'Burmese', 'Burmese', 'English'),
(50, 2, 'Chartreux', 'Chartreux', 'English'),
(51, 2, 'Cornish Rex', 'Cornish Rex', 'English'),
(52, 2, 'Cymric', 'Cymric', 'English'),
(53, 2, 'Devon Rex', 'Devon Rex', 'English'),
(54, 2, 'Egyptian Mau', 'Egyptian Mau', 'English'),
(55, 2, 'Exotic Shorthair', 'Exotic Shorthair', 'English'),
(56, 2, 'Havana Brown', 'Havana Brown', 'English'),
(57, 2, 'Himalayan', 'Himalayan', 'English'),
(58, 2, 'Japanese Bobtail', 'Japanese Bobtail', 'English'),
(59, 2, 'Javanese', 'Javanese', 'English'),
(60, 2, 'Korat', 'Korat', 'English'),
(61, 2, 'Maine Coon', 'Maine Coon', 'English'),
(62, 2, 'Manx', 'Manx', 'English'),
(63, 2, 'Munchkin', 'Munchkin', 'English'),
(64, 2, 'Nebelung', 'Nebelung', 'English'),
(65, 2, 'Norwegian Forest Cat', 'Norwegian Forest Cat', 'English'),
(66, 2, 'Ocicat', 'Ocicat', 'English'),
(67, 2, 'Oriental', 'Oriental', 'English'),
(68, 2, 'Persian', 'Persian', 'English'),
(69, 2, 'Ragdoll', 'Ragdoll', 'English'),
(70, 2, 'Russian Blue', 'Russian Blue', 'English'),
(71, 2, 'Scottish Fold', 'Scottish Fold', 'English'),
(72, 2, 'Selkirk Rex', 'Selkirk Rex', 'English'),
(73, 2, 'Siamese', 'Siamese', 'English'),
(74, 2, 'Siberian', 'Siberian', 'English'),
(75, 2, 'Singapura', 'Singapura', 'English'),
(76, 2, 'Snowshoe', 'Snowshoe', 'English'),
(77, 2, 'Somali', 'Somali', 'English'),
(78, 2, 'Sphynx', 'Sphynx', 'English'),
(79, 2, 'Tonkinese', 'Tonkinese', 'English'),
(80, 2, 'Turkish Angora', 'Turkish Angora', 'English'),
(81, 2, 'Turkish Van', 'Turkish Van', 'English'),
(82, 2, 'Other Cats', 'Other Cats', 'English'),
(83, 3, 'Sussex ', 'Sussex ', 'English'),
(84, 3, 'Dutch', 'Dutch', 'English'),
(85, 3, 'Himalayan', 'Himalayan', 'English'),
(86, 3, 'Havana', 'Havana', 'English'),
(87, 3, 'Standard Chinchilla', 'Standard Chinchilla', 'English'),
(88, 3, 'Florida White', 'Florida White', 'English'),
(89, 3, 'Californian', 'Californian', 'English'),
(90, 3, 'Harlequin', 'Harlequin', 'English'),
(91, 3, 'Palomino', 'Palomino', 'English'),
(92, 3, 'Thrianta', 'Thrianta', 'English'),
(93, 3, 'Other Rabbits', 'Other Rabbits', 'English'),
(94, 4, 'Canaries', 'Canaries', 'English'),
(95, 4, 'Finches', 'Finches', 'English'),
(96, 4, 'Cockatiels', 'Cockatiels', 'English'),
(97, 4, 'Lovebirds', 'Lovebirds', 'English'),
(98, 4, 'Small Parakeets', 'Small Parakeets', 'English'),
(99, 4, 'Parrotlets', 'Parrotlets', 'English'),
(100, 4, 'Caiques', 'Caiques', 'English'),
(101, 4, 'Small Conures', 'Small Conures', 'English'),
(102, 4, 'Lories & Lorikeets', 'Lories & Lorikeets', 'English'),
(103, 4, 'Large Parakeets', 'Large Parakeets', 'English'),
(104, 4, 'Pionus Parrots', 'Pionus Parrots', 'English'),
(105, 4, 'Poicephalus', 'Poicephalus', 'English'),
(106, 4, 'African Greys', 'African Greys', 'English'),
(107, 4, 'Amazons', 'Amazons', 'English'),
(108, 4, 'Small Cockatoos', 'Small Cockatoos', 'English'),
(109, 4, 'Large Conures', 'Large Conures', 'English'),
(110, 4, 'Eclectus', 'Eclectus', 'English'),
(111, 4, 'Hawk Headed Parrots', 'Hawk Headed Parrots', 'English'),
(112, 4, 'Mini-Macaws', 'Mini-Macaws', 'English'),
(113, 4, 'Large Cockatoos', 'Large Cockatoos', 'English'),
(114, 4, 'Macaws', 'Macaws', 'English'),
(115, 4, 'Crows', 'Crows', 'English'),
(116, 4, 'Doves & Pigeons', 'Doves & Pigeons', 'English'),
(117, 4, 'Mynah Birds', 'Mynah Birds', 'English'),
(118, 4, 'Toucans', 'Toucans', 'English'),
(119, 4, 'Other Birds', 'Other Birds', 'English'),
(120, 5, 'Syrian', 'Syrian', 'English'),
(121, 5, 'Campbell??s', 'Campbell??s', 'English'),
(122, 5, 'Winter White', 'Winter White', 'English'),
(123, 5, 'Roborovski', 'Roborovski', 'English'),
(124, 5, 'Chinese', 'Chinese', 'English'),
(125, 5, 'Other Hamsters', 'Other Hamsters', 'English'),
(126, 6, 'American Paint Horse', 'American Paint Horse', 'English'),
(127, 6, 'American Quarter Horse', 'American Quarter Horse', 'English'),
(128, 6, 'American Saddlebred Horse', 'American Saddlebred Horse', 'English'),
(129, 6, 'American Standardbred Horse', 'American Standardbred Horse', 'English'),
(130, 6, 'Appaloosa Horse', 'Appaloosa Horse', 'English'),
(131, 6, 'Arabian Horse', 'Arabian Horse', 'English'),
(132, 6, 'Clydesdale Horses', 'Clydesdale Horses', 'English'),
(133, 6, 'Ponies', 'Ponies', 'English'),
(134, 6, 'Hanoverian Horse', 'Hanoverian Horse', 'English'),
(135, 6, 'Missouri Fox Trotter', 'Missouri Fox Trotter', 'English'),
(136, 6, 'Morgan Horse', 'Morgan Horse', 'English'),
(137, 6, 'Palomino Horse', 'Palomino Horse', 'English'),
(138, 6, 'Peruvian Paso / Paso Fino', 'Peruvian Paso / Paso Fino', 'English'),
(139, 6, 'Tennessee Walking Horse', 'Tennessee Walking Horse', 'English'),
(140, 6, 'Thoroughbred Horse ', 'Thoroughbred Horse ', 'English'),
(141, 6, 'Miniature Horses', 'Miniature Horses', 'English'),
(142, 6, 'Pinto Horses', 'Pinto Horses', 'English'),
(143, 6, 'Mustang Horses', 'Mustang Horses', 'English'),
(144, 6, 'Hanoverian Horse', 'Hanoverian Horse', 'English'),
(145, 6, 'Other Horses', 'Other Horses', 'English'),
(146, 7, 'Abyssinian', 'Abyssinian', 'English'),
(147, 7, 'American', 'American', 'English'),
(148, 7, 'Crested', 'Crested', 'English'),
(149, 7, 'Coronet', 'Coronet', 'English'),
(150, 7, 'Peruvian', 'Peruvian', 'English'),
(151, 7, 'Silkie', 'Silkie', 'English'),
(152, 7, 'Skinny Pig', 'Skinny Pig', 'English'),
(153, 7, 'Teddy', 'Teddy', 'English'),
(154, 7, 'Texel', 'Texel', 'English'),
(155, 7, 'Other Guinea pigs', 'Other Guinea pigs', 'English'),
(156, 8, 'Albino', 'Albino', 'English'),
(157, 8, 'Black Sable', 'Black Sable', 'English'),
(158, 8, 'Black Sable Mitt', 'Black Sable Mitt', 'English'),
(159, 8, 'Blaze', 'Blaze', 'English'),
(160, 8, 'Champagne', 'Champagne', 'English'),
(161, 8, 'Chocolate', 'Chocolate', 'English'),
(162, 8, 'Chocolate Mitt', 'Chocolate Mitt', 'English'),
(163, 8, 'Cinnamon', 'Cinnamon', 'English'),
(164, 8, 'Cinnamon Mitts', 'Cinnamon Mitts', 'English'),
(165, 8, 'Dalmatian', 'Dalmatian', 'English'),
(166, 8, 'Heavy Silver or Pewter', 'Heavy Silver or Pewter', 'English'),
(167, 8, 'Panda', 'Panda', 'English'),
(168, 8, 'Light Pattern', 'Light Pattern', 'English'),
(169, 8, 'Medium Pattern', 'Medium Pattern', 'English'),
(170, 8, 'Sable', 'Sable', 'English'),
(171, 8, 'Sable Mitt', 'Sable Mitt', 'English'),
(172, 8, 'Siamese', 'Siamese', 'English'),
(173, 8, 'Siamese Mitt', 'Siamese Mitt', 'English'),
(174, 8, 'Striped White', 'Striped White', 'English'),
(175, 8, 'White with Dark Eyes', 'White with Dark Eyes', 'English'),
(176, 8, 'Other Ferrets', 'Other Ferrets', 'English');

-- --------------------------------------------------------

--
-- Table structure for table `shop_category2`
--

CREATE TABLE IF NOT EXISTS `shop_category2` (
`category_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(45) NOT NULL,
  `description` text,
  `language` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_category2`
--

INSERT INTO `shop_category2` (`category_id`, `parent_id`, `title`, `description`, `language`) VALUES
(1, 0, 'Dog', 'Dog', 'English'),
(2, 0, 'Cat', 'Cat', 'English'),
(3, 0, 'Rabbit', 'Rabbit', 'English'),
(4, 0, 'Birds', 'Birds', 'English'),
(5, 0, 'Hamsters', 'Hamsters', 'English'),
(6, 0, 'Horses', 'Horses', 'English'),
(7, 0, 'Guinea pigs', 'Guinea pigs', 'English'),
(8, 0, 'Ferret', 'Ferret', 'English'),
(9, 1, 'Abruzzenhund', 'Abruzzenhund', 'English'),
(10, 1, 'Affenpinscher', 'Affenpinscher', 'English');

-- --------------------------------------------------------

--
-- Table structure for table `shop_chat`
--

CREATE TABLE IF NOT EXISTS `shop_chat` (
`id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_chat`
--

INSERT INTO `shop_chat` (`id`, `recipient_id`, `user_id`, `title`, `created`, `modified`, `product_id`) VALUES
(1, 3, 3, 'Product: Hong Kong princessodwnconoc', '2015-09-18 12:04:19', '2015-09-20 09:11:26', 3),
(2, 3, 5, 'Product: The Princess of Kowloon pet found!', '2015-09-28 14:11:45', '2015-09-28 14:15:14', 2),
(3, 3, 3, 'Product: The Princess of Kowloon', '2015-09-30 05:46:11', '2015-09-30 05:46:11', 2),
(4, 3, 6, 'Product: The Princess of Kowloon', '2015-10-04 14:21:02', '2015-10-04 22:32:40', 2),
(5, 3, 3, 'Product: The Princess of Kowloon', '2015-10-12 23:39:06', '2015-10-12 23:39:06', 2),
(6, 3, 3, 'Product: The Princess of Kowloon', '2015-10-13 21:03:33', '2015-10-13 21:03:33', 2),
(7, 3, 3, 'Hi ricky, I have found your pet Do Do!', '2015-11-03 14:05:35', '2015-11-03 14:05:35', 2),
(8, 3, 8, 'Hi ricky, I have found your pet 11!', '2015-11-03 22:14:53', '2015-11-03 22:14:53', 3),
(9, 3, 8, 'Hi ricky, I have found your pet 11!', '2015-11-03 22:15:21', '2015-11-03 22:15:21', 3),
(10, 3, 3, 'Hi ricky, I have found your pet Do Do!', '2015-11-03 22:35:33', '2015-11-03 22:35:33', 2),
(11, 3, 3, 'Hi ricky, I have found your pet 11!', '2015-11-09 21:45:22', '2015-11-09 21:52:52', 3),
(12, 3, 3, 'Hi ricky, I have found your pet Hoody! trial 1', '2015-11-22 19:45:23', '2015-11-22 19:45:23', 1),
(13, 4, 3, 'Hi stephen, I have found your pet Mon Mon!', '2015-11-22 19:55:22', '2015-11-22 19:55:22', 5),
(14, 4, 4, 'Hi stephen, I have found your pet Mon Mon!', '2015-11-24 12:17:40', '2015-11-24 12:17:40', 5),
(15, 4, 8, 'Hi stephen, I have found your pet Mon Mon!', '2015-12-20 15:10:58', '2015-12-20 15:13:36', 5),
(16, 4, 4, 'Hi stephen, I have found your pet Mon Mon!', '2016-01-31 01:15:10', '2016-01-31 01:15:10', 5),
(17, 3, 4, 'Hi ricky, I have found your pet Do Do!', '2016-03-05 01:03:12', '2016-03-05 01:03:12', 2),
(18, 3, 4, 'Hi ricky, I have found your pet Do Do!', '2016-03-05 01:05:25', '2016-03-05 01:05:25', 2),
(19, 4, 4, 'Hi stephen, I have found your pet Mon Mon!', '2016-03-05 01:08:19', '2016-03-05 01:08:19', 5),
(20, 4, 8, 'Hi stephen, I have found your pet mun mun!', '2016-03-18 18:14:39', '2016-03-18 18:14:39', 7),
(21, 4, 4, 'Hi stephen, I have found your pet Mon Mon!', '2016-03-18 18:17:19', '2016-03-18 18:17:19', 5),
(22, 3, 1, 'Hi ricky, I have found your pet Do Do!', '2016-03-20 19:41:52', '2016-03-20 19:41:52', 2),
(23, 3, 1, 'Hi ricky, I have found your pet Do Do!', '2016-03-20 19:42:03', '2016-03-20 19:42:03', 2),
(24, 3, 1, 'Hi ricky, I have found your pet Do Do!', '2016-03-20 19:44:56', '2016-03-20 19:44:56', 2),
(25, 3, 1, 'Hi ricky, I have found your pet Do Do!', '2016-03-20 19:45:41', '2016-03-20 19:45:41', 2),
(26, 3, 1, 'Hi ricky, I have found your pet Do Do!', '2016-03-20 19:46:23', '2016-03-20 19:46:24', 2),
(27, 3, 1, 'Hi ricky, I have found your pet Do Do!', '2016-03-20 19:48:03', '2016-03-20 19:48:03', 2),
(28, 3, 3, 'Hi ricky, I have found your pet Do Do!', '2016-03-20 19:50:05', '2016-03-20 19:50:05', 2),
(29, 3, 3, 'Hi ricky, I have found your pet Do Do!', '2016-03-20 19:51:26', '2016-03-20 19:51:26', 2),
(30, 3, 3, 'Hi ricky, I have found your pet Do Do!', '2016-03-20 19:54:01', '2016-03-20 19:54:01', 2),
(31, 3, 3, 'Hi ricky, I have found your pet Hoody!', '2016-03-20 19:54:56', '2016-03-20 19:54:56', 1),
(32, 3, 3, 'Hi ricky, I have found your pet Do Do!', '2016-03-20 19:56:38', '2016-03-20 19:56:38', 2),
(33, 3, 3, 'Hi ricky, I have found your pet Do Do!', '2016-03-20 20:00:12', '2016-03-20 20:00:12', 2),
(34, 3, 3, 'Hi ricky, I have found your pet Do Do!', '2016-03-20 20:01:25', '2016-03-20 20:01:25', 2),
(35, 3, 3, 'Hi ricky, I have found your pet Do Do!', '2016-03-20 20:04:02', '2016-03-20 20:04:02', 2),
(36, 3, 3, 'Hi ricky, I have found your pet Do Do!', '2016-03-20 20:05:39', '2016-03-20 20:05:39', 2),
(37, 3, 3, 'Hi ricky, I have found your pet Do Do!', '2016-03-20 20:07:50', '2016-03-20 20:07:50', 2),
(38, 3, 3, 'Hi ricky, I have found your pet Do Do!', '2016-03-20 20:09:39', '2016-03-20 20:09:39', 2),
(39, 3, 3, 'Hi ricky, I have found your pet Do Do!', '2016-03-20 20:10:05', '2016-03-20 20:10:05', 2),
(40, 3, 3, 'Hi ricky, I have found your pet Do Do!', '2016-03-20 20:19:12', '2016-03-20 20:19:12', 2),
(41, 3, 3, 'Hi ricky, I have found your pet Do Do!', '2016-03-20 20:22:20', '2016-03-20 20:22:20', 2),
(42, 3, 3, 'Hi ricky, I have found your pet Do Do!', '2016-03-20 20:23:25', '2016-03-20 20:23:25', 2),
(43, 3, 3, 'Hi ricky, I have found your pet Do Do!', '2016-03-20 20:27:48', '2016-03-20 20:27:48', 2),
(44, 3, 3, 'Hi ricky, I have found your pet Do Do!', '2016-03-20 20:28:36', '2016-03-20 20:28:36', 2),
(45, 3, 3, 'Hi ricky, I have found your pet Do Do!', '2016-03-20 20:54:16', '2016-03-20 20:54:16', 2),
(46, 3, 3, 'Hi ricky, I have found your pet Hoody!', '2016-03-20 20:55:04', '2016-03-20 20:55:04', 1),
(47, 4, 7, 'Hi stephen, I have found your pet Mon Mon!', '2016-03-22 17:46:05', '2016-03-22 17:46:05', 5),
(48, 4, 4, 'Hi stephen, I have found your pet Mol Mol!', '2016-03-22 22:43:50', '2016-03-22 22:43:51', 9),
(49, 4, 4, 'Hi stephen, I have found your pet 小飛俠!', '2016-04-06 17:35:45', '2016-04-06 17:35:45', 27),
(50, 4, 7, 'Hi stephen, I have found your pet 小飛俠!', '2016-04-06 18:32:59', '2016-04-06 18:32:59', 27),
(51, 4, 7, 'Hi stephen, I have found your pet 小飛俠!', '2016-04-06 18:49:22', '2016-04-06 18:49:22', 27),
(52, 4, 7, 'Hi stephen, I have found your pet 小飛俠!', '2016-04-08 13:14:36', '2016-04-08 13:14:36', 27),
(53, 4, 7, 'Hi stephen, I have found your pet 小飛俠!', '2016-04-09 22:45:23', '2016-04-09 22:45:23', 27),
(54, 4, 7, 'Hi stephen, I have found your pet 小飛俠!', '2016-04-10 14:52:38', '2016-04-10 14:52:38', 27);

-- --------------------------------------------------------

--
-- Table structure for table `shop_chat_image`
--

CREATE TABLE IF NOT EXISTS `shop_chat_image` (
`id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message_id` int(11) NOT NULL,
  `is_default` varchar(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_chat_image`
--

INSERT INTO `shop_chat_image` (`id`, `filename`, `title`, `message_id`, `is_default`) VALUES
(1, '2/91ae8b151fd3301e25363bfc29f29c54.jpg', 'dog-apps.jpg', 2, NULL),
(2, '3/275859df9cf3254d12451cdd461d9c14.jpg', 'poodle-grooming.jpg', 3, NULL),
(3, '10/3d5b8b4c6b11c021bc7fd75ea1958f38.jpg', 'dog-apps.jpg', 10, NULL),
(4, '13/21d3806c8934522a4c51115aa6d21f07.gif', 'keroro1.gif', 13, NULL),
(5, '14/3a33166093a9bc4a8395b7bc669fabb5.gif', 'keroro1.gif', 14, NULL),
(6, '15/93d4ffc73334edca611339b8926b43ec.jpg', 'dog-apps.jpg', 15, NULL),
(7, '16/90f09587a4ffecfcc16b8435058681bb.jpg', 'german-shepherd-dog55.jpg', 16, NULL),
(8, '17/43e7118d57cff17cc75d56958cc89f7f.jpg', 'dog-apps.jpg', 17, NULL),
(9, '19/033e4aac41f9d14cd9b0499b1bedc890.jpg', '1450595421006.jpg', 19, NULL),
(10, '56/a45512ba979c551837d3e1de24a98360.jpg', '20160110_155640.jpg', 56, NULL),
(11, '56/e255f8174d6c90735f49615b02d87e35.jpg', '20160322_155343.jpg', 56, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_chat_message`
--

CREATE TABLE IF NOT EXISTS `shop_chat_message` (
`id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `read` varchar(1) NOT NULL,
  `recipient_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_chat_message`
--

INSERT INTO `shop_chat_message` (`id`, `chat_id`, `user_id`, `message`, `created`, `modified`, `read`, `recipient_id`) VALUES
(1, 1, 3, 'kjsndcd', '2015-09-18 12:04:19', '2015-09-18 12:04:19', 'Y', 3),
(2, 1, 3, 'is my dog at your place?', '2015-09-20 09:11:26', '2015-09-20 09:11:26', 'Y', 3),
(3, 2, 5, 'I have found your dog when i was walking in the park at 4:00pm today, he is save and not hurt anywhere, i am living in the hong kong island, please let me know know how you like to collect your pet back. my mobile is 68493020', '2015-09-28 14:11:45', '2015-09-28 14:11:45', 'Y', 3),
(4, 2, 3, 'hi steve,\r\n\r\nThank you very much, can you meet at the test MTR station tomorrow at 4:00pm?\r\n\r\nMany thanks,\r\nStephen', '2015-09-28 14:15:14', '2015-09-28 14:15:14', 'Y', 5),
(5, 3, 3, 'sdfsdfsd', '2015-09-30 05:46:11', '2015-09-30 05:46:11', 'Y', 3),
(6, 4, 6, 'test', '2015-10-04 14:21:02', '2015-10-04 14:21:02', 'Y', 3),
(7, 4, 6, 'test2', '2015-10-04 22:32:40', '2015-10-04 22:32:40', 'Y', 3),
(8, 5, 3, 'sdfsdf', '2015-10-12 23:39:06', '2015-10-12 23:39:06', 'Y', 3),
(9, 6, 3, 'hihi test by steve', '2015-10-13 21:03:33', '2015-10-13 21:03:33', 'Y', 3),
(10, 7, 3, 'trial 1 with photo', '2015-11-03 14:05:35', '2015-11-03 14:05:35', 'Y', 3),
(11, 8, 8, 'this is another trial with my facebook login', '2015-11-03 22:14:53', '2015-11-03 22:14:53', 'Y', 3),
(12, 9, 8, 'this is a trial with facebook login', '2015-11-03 22:15:21', '2015-11-03 22:15:21', 'Y', 3),
(13, 10, 3, '122112', '2015-11-03 22:35:33', '2015-11-03 22:35:33', 'Y', 3),
(14, 11, 3, 'wqeqwe', '2015-11-09 21:45:22', '2015-11-09 21:45:22', 'Y', 3),
(15, 11, 3, 'ihciudscd', '2015-11-09 21:52:52', '2015-11-09 21:52:52', 'Y', 3),
(16, 12, 3, 'this is another trial', '2015-11-22 19:45:23', '2015-11-22 19:45:23', 'Y', 3),
(17, 13, 3, 'I have find your dog in the park, how would you like to take mon mon back?', '2015-11-22 19:55:22', '2015-11-22 19:55:22', 'Y', 4),
(18, 14, 4, 'i found your dog', '2015-11-24 12:17:40', '2015-11-24 12:17:40', 'Y', 4),
(19, 15, 8, 'I found your pet with mobile', '2015-12-20 15:10:58', '2015-12-20 15:10:58', 'Y', 4),
(20, 15, 4, 'where to meet?', '2015-12-20 15:13:36', '2015-12-20 15:13:36', '', 8),
(21, 16, 4, 'in wong tai sin.......i want to see the HKD 2,000 tonight at 8:00pm MTR station , exit B', '2016-01-31 01:15:10', '2016-01-31 01:15:10', 'Y', 4),
(22, 17, 4, 'i found your pet in wong tai sin', '2016-03-05 01:03:12', '2016-03-05 01:03:12', '', 3),
(23, 18, 4, 'iuhbiuhiuh', '2016-03-05 01:05:25', '2016-03-05 01:05:25', '', 3),
(24, 19, 4, 'i find your pet, i want 100HKD for it.', '2016-03-05 01:08:19', '2016-03-05 01:08:19', 'Y', 4),
(25, 20, 8, 'Trail one', '2016-03-18 18:14:39', '2016-03-18 18:14:39', 'Y', 4),
(26, 21, 4, 'trial one', '2016-03-18 18:17:19', '2016-03-18 18:17:19', 'Y', 4),
(27, 22, 1, 'dfsdfdf', '2016-03-20 19:41:52', '2016-03-20 19:41:52', '', 3),
(28, 23, 1, 'dfsdfdf', '2016-03-20 19:42:03', '2016-03-20 19:42:03', '', 3),
(29, 24, 1, 'sdfsfdsf', '2016-03-20 19:44:56', '2016-03-20 19:44:56', '', 3),
(30, 25, 1, 'sdfsdf', '2016-03-20 19:45:41', '2016-03-20 19:45:41', '', 3),
(31, 26, 1, 'sdfsdfdsf', '2016-03-20 19:46:24', '2016-03-20 19:46:24', '', 3),
(32, 27, 1, 'sdfdsffd', '2016-03-20 19:48:03', '2016-03-20 19:48:03', '', 3),
(33, 28, 3, 'dfdfdf', '2016-03-20 19:50:05', '2016-03-20 19:50:05', '', 3),
(34, 29, 3, 'sdfdfsfd', '2016-03-20 19:51:26', '2016-03-20 19:51:26', '', 3),
(35, 30, 3, 'fsfas', '2016-03-20 19:54:01', '2016-03-20 19:54:01', '', 3),
(36, 31, 3, 'sfafs', '2016-03-20 19:54:56', '2016-03-20 19:54:56', '', 3),
(37, 32, 3, 'sdfsdfdsf', '2016-03-20 19:56:38', '2016-03-20 19:56:38', '', 3),
(38, 33, 3, 'dsfdsfdf', '2016-03-20 20:00:12', '2016-03-20 20:00:12', '', 3),
(39, 34, 3, '1333113', '2016-03-20 20:01:25', '2016-03-20 20:01:25', '', 3),
(40, 35, 3, 'sdfdsdf', '2016-03-20 20:04:02', '2016-03-20 20:04:02', '', 3),
(41, 36, 3, 'dsffdfd', '2016-03-20 20:05:39', '2016-03-20 20:05:39', '', 3),
(42, 37, 3, 'sdfdfdf', '2016-03-20 20:07:50', '2016-03-20 20:07:50', '', 3),
(43, 38, 3, 'aaa', '2016-03-20 20:09:39', '2016-03-20 20:09:39', '', 3),
(44, 39, 3, 'sdfdsf', '2016-03-20 20:10:05', '2016-03-20 20:10:05', '', 3),
(45, 40, 3, 'sadfdasfd', '2016-03-20 20:19:12', '2016-03-20 20:19:12', '', 3),
(46, 41, 3, 'sdfdf', '2016-03-20 20:22:20', '2016-03-20 20:22:20', '', 3),
(47, 42, 3, 'sdfdfs', '2016-03-20 20:23:25', '2016-03-20 20:23:25', '', 3),
(48, 43, 3, '123213', '2016-03-20 20:27:48', '2016-03-20 20:27:48', '', 3),
(49, 44, 3, 'sfdsfsdf', '2016-03-20 20:28:36', '2016-03-20 20:28:36', '', 3),
(50, 45, 3, 'sddsfdf', '2016-03-20 20:54:16', '2016-03-20 20:54:16', '', 3),
(51, 46, 3, 'dssdsdf', '2016-03-20 20:55:04', '2016-03-20 20:55:04', '', 3),
(52, 47, 7, 'yes, i find your dog', '2016-03-22 17:46:05', '2016-03-22 17:46:05', '', 4),
(53, 48, 4, 'Please contact me to arrange the best possible way to reunite with your pet, my contact detail is as follow:\r\n\r\nName: Stephen\r\nMobile number:68993286\r\nEmail:stephenfung84@yahii.com', '2016-03-22 22:43:51', '2016-03-22 22:43:51', 'Y', 4),
(54, 49, 4, 'Please contact me to arrange the best possible way to reunite with your pet, my contact detail is as follow:\r\n\r\nName: John\r\nMobile number: 6384 9372\r\nEmail: john@yahoo.com', '2016-04-06 17:35:45', '2016-04-06 17:35:45', 'Y', 4),
(55, 50, 7, '你好!\r\n\r\nPlease contact me to arrange the best possible way to reunite with your pet, my contact detail is as follow:\r\n\r\nName: 馮生\r\nMobile number: 96432574\r\nEmail: stephen@yahoo.com', '2016-04-06 18:32:59', '2016-04-06 18:32:59', 'Y', 4),
(56, 51, 7, 'Please contact me to arrange the best possible way to reunite with your pet, my contact detail is as follow:\r\n\r\nName: stephen\r\nMobile number:63538344\r\nEmail: stephen@yahoo.com', '2016-04-06 18:49:22', '2016-04-06 18:49:22', 'Y', 4),
(57, 52, 7, 'Please contact me to arrange the best possible way to reunite with your pet, my contact detail is as follow:\r\n\r\nName: John Fung\r\nMobile number: 67809876\r\nEmail: stephen@yahoo.com', '2016-04-08 13:14:36', '2016-04-08 13:14:36', '', 4),
(58, 53, 7, 'Please contact me to arrange the best possible way to reunite with your pet, my contact detail is as follow:\r\n\r\nName: John\r\nMobile number: 68783633\r\nEmail: john@yahoo.com', '2016-04-09 22:45:23', '2016-04-09 22:45:23', '', 4),
(59, 54, 7, 'Please contact me to arrange the best possible way to reunite with your pet, my contact detail is as follow:\r\n\r\nName: John\r\nMobile number: 6836332\r\nEmail:john@yahoo.com', '2016-04-10 14:52:38', '2016-04-10 14:52:38', '', 4);

-- --------------------------------------------------------

--
-- Table structure for table `shop_color`
--

CREATE TABLE IF NOT EXISTS `shop_color` (
  `color` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_color`
--

INSERT INTO `shop_color` (`color`) VALUES
('Black'),
('Black Tortie'),
('Blue'),
('Brown'),
('Chocolate'),
('Cream'),
('Grey'),
('Light brown'),
('Other'),
('Red'),
('Sliver'),
('White'),
('Yellow');

-- --------------------------------------------------------

--
-- Table structure for table `shop_customer`
--

CREATE TABLE IF NOT EXISTS `shop_customer` (
`customer_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `delivery_address_id` int(11) DEFAULT NULL,
  `billing_address_id` int(11) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_favorite`
--

CREATE TABLE IF NOT EXISTS `shop_favorite` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `store_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_feature_ipn`
--

CREATE TABLE IF NOT EXISTS `shop_feature_ipn` (
  `id` varchar(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sender_email` varchar(255) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `receive_time` datetime DEFAULT NULL,
  `receiver_email` varchar(255) NOT NULL,
  `amount` varchar(45) NOT NULL,
  `no_of_day` int(11) NOT NULL,
  `feature_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_feedback`
--

CREATE TABLE IF NOT EXISTS `shop_feedback` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `store_id` int(10) unsigned NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `feedback` int(2) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_feedback`
--

INSERT INTO `shop_feedback` (`id`, `user_id`, `store_id`, `order_id`, `create_date`, `feedback`, `comment`, `product_id`) VALUES
(1, 3, 2, NULL, '2015-10-13 20:35:11', 1, 'oihjoijoj', 2),
(2, 3, 2, NULL, '2015-11-17 22:35:22', 1, 'dasd', 1),
(3, 3, 4, NULL, '2015-11-23 20:39:30', 1, '3123', 5),
(4, 3, 4, NULL, '2015-11-23 20:39:43', 1, '1322313321', 5),
(5, 4, 4, NULL, '2015-11-25 23:23:00', 1, 'this is a sample review', 5),
(6, 4, 2, NULL, '2015-11-26 22:01:22', 1, 'review 1st', 3),
(7, 3, 4, NULL, '2015-12-05 11:56:57', 1, 'this good is cute, lovely, can''t believe he is 7 years old now, i like the red clothing on him. where do you get that from?', 5),
(8, 4, 4, NULL, '2016-03-18 23:58:17', 1, 'i love your dog', 7),
(9, 4, 2, NULL, '2016-04-01 21:28:58', 1, 'you have nice dog!', 1),
(10, 4, 4, NULL, '2016-04-17 15:02:22', 1, 'Super cute! Chihauhau.....', 27);

-- --------------------------------------------------------

--
-- Table structure for table `shop_image`
--

CREATE TABLE IF NOT EXISTS `shop_image` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `is_default` varchar(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_image`
--

INSERT INTO `shop_image` (`id`, `title`, `filename`, `product_id`, `is_default`) VALUES
(1, 'german-shepherd-dog55.jpg', '1/0e0fb75d20d1aeed234f5792ab2afe07.jpg', 1, NULL),
(2, 'German-Shepherd.jpg', '1/c76172b448ab89d9222ae04a96bf6bb9.jpg', 1, NULL),
(3, 'German-Shepherds.jpg', '1/cecfa3108fc2e5af668b4f3e8e61356a.jpg', 1, NULL),
(4, 't_2628_0.jpg', '1/85cdc875e6058b1a97c33b35641caee2.jpg', 1, NULL),
(5, 'poodle-grooming.jpg', '2/a33149b6acf48c4c569e71f33194491c.jpg', 2, NULL),
(6, 'Poodleminiaturedenmark.jpg', '2/af15b500e81c6be9f3312d6adcbf3132.jpg', 2, 'Y'),
(7, 'ToyPoodle_106527960.png', '2/1c37b227e6caf544a0449553099ae828.png', 2, NULL),
(22, 'd26639ee0aba1349cf8e91f7507bfeca.jpg', '8/c78676a007908f353aefadce584080ea.jpg', 8, NULL),
(23, 'Pug_hero.jpg', '7/9aee04873df55764c0af1c35497a2201.jpg', 7, NULL),
(24, 'beagle5.jpg', '5/07fea568566ede6f659d7fb0f1a38fae.jpg', 5, NULL),
(25, 'White_American_Shorthair.jpg', '9/1cc600a06e8c48acd3275732a5ac644c.jpg', 9, NULL),
(26, '2011Porok-018.jpg', '10/1194147c401a9a2719747338b350db76.jpg', 10, NULL),
(27, 'a8d6a5ffca3249bdca94aaeb58d40250.jpg', '11/2e2675743623b28107649acf7557baa9.jpg', 11, NULL),
(28, '6db.jpg', '12/071037d45d99e965607503fbcf29042a.jpg', 12, NULL),
(29, 'CSG0001 copy.jpg', '13/ca51380e9555e2693303a9524663f85f.jpg', 13, NULL),
(30, 'Exotic-Shorthair-3-1.jpg', '4/e0f466ce3e57563ffaaf66dcdf50ceda.jpg', 4, NULL),
(31, 'French-Bulldog-Cute-Puppy-Black.jpg', '3/46c68953187a7c01482144b5cd0b9560.jpg', 3, NULL),
(32, '423731.jpg', '1/8630498640bcb0880c3c8628255ad541.jpg', 1, 'Y'),
(33, 'beagle_with_hd_resolution_1920x1272.jpg', '14/2539766e17435dabec146f9e74dd11ef.jpg', 14, NULL),
(34, 'beagle_with_hd_resolution_1920x1272.jpg', '14/f3c402d4db4cc81eb6de521e60c4b7ee.jpg', 14, NULL),
(35, 'beagle_with_hd_resolution_1920x1272.jpg', '14/8177daa09ef02cc6abae9ab616c2e0c7.jpg', 14, NULL),
(36, 'Persian-Cat.jpg', '15/5579e988e96e8d4d4141d57df3b0d091.jpg', 15, NULL),
(37, 'lilac-abyssianian-cat.jpg', '16/feca551db5f2f67c78b19656125aa6bb.jpg', 16, NULL),
(38, 'chihuahua-810789_960_720.jpg', '17/8faff9ca82bd20160214a351fe6493d6.jpg', 17, NULL),
(39, 'stylish-chihuahua.jpg', '18/076ba7125917997d3dffb94017fd61f2.jpg', 18, NULL),
(40, '2008_04_09_20_35_22_Bruce_209_20months_1_1.JPG', '19/41d7d9b9033d282a743aafd86dcbe5eb.JPG', 19, NULL),
(42, 'american-shorthair-playing_95081-1440x900.jpg', '20/004f3675d07d74c20ad429ff4d8e6d7c.jpg', 20, NULL),
(43, 'American-shorthair_1158385939.jpg', '21/a65bedb0e7fc13d0634b77dcf86ed5c5.jpg', 21, NULL),
(45, 'bengal-cat6.jpg', '22/3d08748dc9209a5b45777af9f7913d48.jpg', 22, NULL),
(46, 'golden-retriever-gmccm1.jpg', '23/874f3bf0638e9d68f38b714ff966e436.jpg', 23, NULL),
(47, '20151224_115920.jpg', '24/017cdfc2ecc50f5f8f09f4f33345005e.jpg', 24, NULL),
(49, 'happy-afternoon-golden-retriever-yoko.jpg', '26/a64eaaf31798a4d6a29e1f3e7167298b.jpg', 26, NULL),
(50, 'dog.jpg', '27/423813347b22107b3de55933ccaa09bb.jpg', 27, NULL),
(58, 'photo_3888.jpg', '31/fee6975221a49522b2279c7e4e87f106.jpg', 31, NULL),
(59, 'photo_3887.jpg', '32/500e07658958d3af085af943b91b47a9.jpg', 32, NULL),
(60, 'photo_3909.jpg', '33/8819c49c497afe9f907fe5ae34452eb9.jpg', 33, NULL),
(63, 'photo_3900.jpg', '34/5aa437a1cb211de45a5cf23e4d3ee9b1.jpg', 34, NULL),
(65, 'IMG-20160411-WA0006.jpg', '38/8f19b35ca89d3b9da84c5c183a954785.jpg', 38, NULL),
(66, 'IMG-20160411-WA0004.jpg', '39/5d6b81f89e1db0f1e560700b1d2e5c72.jpg', 39, NULL),
(67, 'IMG-20160411-WA0020.jpg', '37/bc21ea70c976a7304d8cb1cff04beb0d.jpg', 37, NULL),
(68, 'IMG-20160411-WA0019.jpg', '36/8aa39ffdbfc83f4f4a61bc6e53f0a6aa.jpg', 36, NULL),
(69, 'IMG-20160411-WA0026.jpg', '35/173fab6da0410f76a1a0c2307ed7f232.jpg', 35, NULL),
(70, 'IMG-20160411-WA0017.jpg', '30/7fe7bfa4e7f870b9b963f3a205620528.jpg', 30, NULL),
(71, 'photo_3888.jpg', '40/06a8265edcc76d23507d7ab7e3e6f736.jpg', 40, NULL),
(72, 'photo_3887.jpg', '41/eb4fc050ea8840fa82fd67db836946df.jpg', 41, NULL),
(73, 'photo_3871.jpg', '42/8bd52f397ec62a22bc39125ba3d27cdb.jpg', 42, NULL),
(74, 'photo_3865.png', '43/82480cbfe2550c4df60149730a98f6b1.png', 43, NULL),
(76, 'photo_3863.jpg', '44/366256256e5c92f0cb9c5552883aa92f.jpg', 44, NULL),
(77, 'photo_3860.jpg', '45/cc555ddef94a2525629a8a8f61692ae1.jpg', 45, NULL),
(78, 'photo_3859.png', '46/244f0c7405f1a8982d6ad4597f124789.png', 46, NULL),
(79, 'photo_3854.jpg', '47/4f6568fca25a51871d09fc6deb95be3c.jpg', 47, NULL),
(80, 'photo_3852.jpg', '48/eba610cefd99c3f5bc0c1f22cbfa88cd.jpg', 48, NULL),
(81, 'photo_3835.jpg', '49/9134df4835e9ac7c3f6a7a4bdde15b41.jpg', 49, NULL),
(82, 'photo_3833.jpg', '50/82b3622453f781c74ecb21d15d5123ab.jpg', 50, NULL),
(83, 'photo_3832.jpg', '51/53d486ef89db412aebeff46ea7f1457f.jpg', 51, NULL),
(84, 'photo_3827.jpg', '52/ae1d0b768ba1e11b0ea78c42d3328088.jpg', 52, NULL),
(85, 'photo_3822.jpg', '53/6fd675397ca1a04d78380f2070f470c9.jpg', 53, NULL),
(86, 'photo_3805.jpg', '54/8413062b545017dee9e55174dccf9812.jpg', 54, NULL),
(87, 'photo_3801.jpg', '55/cb3a43c4121aff0c673f7337e8bf2047.jpg', 55, NULL),
(88, 'photo_3796.jpg', '56/df2310542d9fe368ae5c715c28bf2ad7.jpg', 56, NULL),
(89, 'Unknown-1.jpeg', '57/d69ba767c9c66a5f9bfd2b8b4c32da0a.jpeg', 57, NULL),
(90, 'Unknown-2.jpeg', '57/2ee68980716498925a6df04745508a2a.jpeg', 57, NULL),
(91, 'Unknown.jpeg', '57/f99c0139288ece42ee17e03296a18459.jpeg', 57, NULL),
(92, 'Unknown-3.jpeg', '58/87116d189e9f2ad5fa54d4e67f1f6813.jpeg', 58, NULL),
(93, '未命名-1.jpg', '59/acb283f65378c0890f5279410a07ffa5.jpg', 59, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_order`
--

CREATE TABLE IF NOT EXISTS `shop_order` (
`order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `delivery_address_id` int(11) DEFAULT NULL,
  `billing_address_id` int(11) DEFAULT NULL,
  `ordering_date` int(11) NOT NULL,
  `status` enum('new','in_progress','done','cancelled') NOT NULL DEFAULT 'new',
  `ordering_done` tinyint(1) DEFAULT NULL,
  `ordering_confirmed` tinyint(1) DEFAULT NULL,
  `payment_method` int(11) NOT NULL,
  `shipping_method` int(11) NOT NULL,
  `comment` text,
  `store_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_order_ipn`
--

CREATE TABLE IF NOT EXISTS `shop_order_ipn` (
  `tracking_id` varchar(26) NOT NULL,
  `order_id` int(11) NOT NULL,
  `sender_email` varchar(255) DEFAULT NULL,
  `pay_key` varchar(50) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `receive_time` datetime DEFAULT NULL,
  `receiver_email_1` varchar(255) NOT NULL,
  `amount_1` varchar(45) NOT NULL,
  `receiver_email_2` varchar(255) NOT NULL,
  `amount_2` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_order_position`
--

CREATE TABLE IF NOT EXISTS `shop_order_position` (
`id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `variation_id` int(11) DEFAULT NULL,
  `specifications` text NOT NULL,
  `unit_price` varchar(45) NOT NULL,
  `total_price` varchar(45) NOT NULL,
  `is_fee` varchar(1) NOT NULL,
  `fee_desc` varchar(255) DEFAULT NULL,
  `fee_type` varchar(20) DEFAULT NULL,
  `ship_country` varchar(20) DEFAULT NULL,
  `store_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_payment_method`
--

CREATE TABLE IF NOT EXISTS `shop_payment_method` (
`id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `tax_id` int(11) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_payment_method`
--

INSERT INTO `shop_payment_method` (`id`, `title`, `description`, `tax_id`, `price`) VALUES
(1, 'Courier (PayPal)', 'Courier (PayPal)', 1, 0),
(2, 'Courier (Cash)', 'Courier (Cash)', 1, 0),
(3, 'In Person', 'In Person', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shop_products`
--

CREATE TABLE IF NOT EXISTS `shop_products` (
`product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `status` int(10) NOT NULL,
  `store_id` int(10) unsigned NOT NULL,
  `tax_id` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `description` text,
  `descriptionDisplay` text,
  `keywords` varchar(255) DEFAULT NULL,
  `price` varchar(45) NOT NULL,
  `language` varchar(45) DEFAULT NULL,
  `specifications` text,
  `style_code` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `condition` varchar(50) DEFAULT NULL,
  `size` varchar(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `view` int(10) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `feature_date` datetime DEFAULT NULL,
  `gallery_date` datetime DEFAULT NULL,
  `banner_a` varchar(1) DEFAULT NULL,
  `banner_b` varchar(1) DEFAULT NULL,
  `banner_c` varchar(1) DEFAULT NULL,
  `todays_deal` varchar(1) DEFAULT NULL,
  `discount` varchar(45) DEFAULT NULL,
  `date_lost` datetime DEFAULT NULL,
  `date_born` datetime DEFAULT NULL,
  `sub_category` varchar(100) DEFAULT NULL,
  `weight` varchar(100) DEFAULT NULL,
  `height` varchar(100) DEFAULT NULL,
  `name_of_pet` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `pet_status` varchar(50) DEFAULT NULL,
  `count_down_end_date` datetime DEFAULT NULL,
  `last_seen_appearance` varchar(100) DEFAULT NULL,
  `questions` varchar(255) DEFAULT NULL,
  `pet_id` varchar(20) DEFAULT NULL,
  `gender` varchar(3) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_products`
--

INSERT INTO `shop_products` (`product_id`, `category_id`, `status`, `store_id`, `tax_id`, `title`, `description`, `descriptionDisplay`, `keywords`, `price`, `language`, `specifications`, `style_code`, `color`, `condition`, `size`, `quantity`, `view`, `created`, `feature_date`, `gallery_date`, `banner_a`, `banner_b`, `banner_c`, `todays_deal`, `discount`, `date_lost`, `date_born`, `sub_category`, `weight`, `height`, `name_of_pet`, `country`, `contact`, `pet_status`, `count_down_end_date`, `last_seen_appearance`, `questions`, `pet_id`, `gender`) VALUES
(1, 9, 1, 2, 0, 'Police Dog', 'A lovely well trained dog!', '<p>A lovely well trained dog!</p><br />', NULL, '100', NULL, NULL, NULL, 'Brown', '0', 'MEDIUM', 0, 180, '2015-09-26 09:32:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-16 00:00:00', '2011-09-15 00:00:00', '1', '29 kg', '70 cm', 'Hoody', 'HK', '', '1', '0000-00-00 00:00:00', '', '', 'A1600001', 'M'),
(2, 10, 1, 2, 0, 'The Princess of Kowloon', 'The amazing poodle!', '<p>The amazing poodle!</p><br />', NULL, '300', NULL, NULL, NULL, 'White', '0', 'SMALL', 0, 319, '2015-09-26 09:42:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-08 00:00:00', '2014-09-05 00:00:00', '1', '9 kg', '30 cm', 'Do Do', 'CY', '', '1', '0000-00-00 00:00:00', 'I have lost my dog, last time i have seen her was at the playground in Wong Tai Sin. Please help!', '131121', 'A1600002', 'F'),
(3, 23, 1, 2, 0, 'Abruzzenhund', ':D Friendly, cute & sweet', '<p>:D Friendly, cute &amp; sweet</p><br />', NULL, '10', NULL, NULL, NULL, 'Black', '0', 'MEDIUM', 0, 90, '2015-09-28 04:28:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-12-19 00:00:00', '2005-09-13 00:00:00', '1', '11 kg', '50 cm', 'Yo Yo', 'HK', '', '1', '0000-00-00 00:00:00', '', '', 'A1600003', 'F'),
(4, 42, 1, 2, 0, 'super cats', 'Fat cats', '<p>Fat cats</p><br />', NULL, '500', NULL, NULL, NULL, 'White', '0', 'SMALL', 0, 131, '2015-11-02 21:13:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-11-17 00:00:00', '2010-11-11 00:00:00', '2', '13kg', '30 cm', 'DO DO', 'HK', '', '1', '0000-00-00 00:00:00', 'last seen looking dirty with red tag and blue hat', '', 'A1600004', 'M'),
(5, 15, 1, 4, 0, '可愛的寶寶', 'This is a lovely dog from Stephen', '<p>This is a lovely dog from Stephen</p><br />', NULL, '0', NULL, NULL, NULL, 'Brown', '0', 'MEDIUM', 0, 259, '2015-11-22 19:52:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-11-17 00:00:00', '2013-11-12 00:00:00', '1', '20 kg', '102 cm', 'Mon Mon', 'HK', '68993286', '2', '2016-03-21 00:00:00', 'I was in the park, when mon mon ran away with his stick. It was kowloon park.', '', '9283042', 'M'),
(7, 24, 1, 4, 0, 'Jack', '', '<br />', NULL, '100', NULL, NULL, NULL, 'White', '0', 'SMALL', 0, 128, '2016-03-09 21:05:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-11-16 00:00:00', '2006-03-07 00:00:00', '1', '10kg', '30cm', 'mun mun', 'HK', '', '2', '2016-03-13 00:00:00', '', NULL, 'A0000320102', 'M'),
(8, 10, 1, 4, 0, 'Princess ', '', '<br />', NULL, '0', NULL, NULL, NULL, 'Brown', '0', 'SMALL', 0, 28, '2016-03-20 10:14:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2014-03-08 00:00:00', '1', '5kg', '40cm', 'Chu Chu', 'HK', '', '0', '0000-00-00 00:00:00', '', NULL, 'A00000102', 'F'),
(9, 42, 1, 4, 0, 'The Queen', '', '<br />', NULL, '0', NULL, NULL, NULL, 'White', '0', 'SMALL', 0, 43, '2016-03-20 10:35:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-14 00:00:00', '2013-03-08 00:00:00', '2', '10 kg', '35 cm', 'Mol Mol', 'HK', '', '1', '0000-00-00 00:00:00', '', NULL, 'A1000029303', 'F'),
(10, 41, 1, 4, 0, 'Tiny Baby', '', '<br />', NULL, '0', NULL, NULL, NULL, 'White', '0', 'SMALL', 0, 29, '2016-03-20 10:39:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-03 00:00:00', '2014-03-05 00:00:00', '2', '5 kg', '20 cm', 'Quency', 'HK', '', '0', '0000-00-00 00:00:00', '', NULL, 'B1000092837', 'F'),
(11, 19, 1, 4, 0, 'Mr. King of Hong Kong', '', '<br />', NULL, '0', NULL, NULL, NULL, 'Brown', '0', 'SMALL', 0, 69, '2016-03-20 10:53:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2016-01-12 00:00:00', '1', '14 kg', '50 cm', '大力', 'HK', '', '0', '0000-00-00 00:00:00', '', NULL, 'A0000192834', 'M'),
(12, 47, 1, 4, 0, 'Jo Jo', '', '<br />', NULL, '0', NULL, NULL, NULL, 'Black', '0', 'MEDIUM', 0, 34, '2016-03-20 11:01:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-03 00:00:00', '2014-09-18 00:00:00', '2', '8 kg', '40 cm', 'Jo Jo', 'HK', '', '1', '0000-00-00 00:00:00', '', NULL, 'A100092737', 'F'),
(13, 24, 1, 4, 0, 'Mun Mun', '', '<br />', NULL, '0', NULL, NULL, NULL, 'White', '0', 'SMALL', 0, 39, '2016-03-20 11:07:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2004-03-17 00:00:00', '1', '7 kg', '20 cm', 'Mun Mun', 'HK', '', '0', '2016-03-20 00:00:00', '', NULL, 'A1000927373', 'M'),
(14, 15, 1, 4, 0, 'Cute BB', 'Human best friend', '<p>Human best friend</p><br />', NULL, '0', NULL, NULL, NULL, 'Chocolate', '0', 'MEDIUM', 0, 24, '2016-03-22 21:48:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-03-12 00:00:00', '2009-03-19 00:00:00', '1', '40kg', '40cm', 'Be Be', 'HK', '', '2', '2016-01-29 00:00:00', '', NULL, 'A1600014', 'F'),
(15, 68, 1, 4, 0, 'Fattest Cat of Kowloon', '', '<br />', NULL, '0', NULL, NULL, NULL, 'Light brown', '0', 'SMALL', 0, 33, '2016-03-22 22:01:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-01-11 00:00:00', '2010-11-05 00:00:00', '2', '10 kg', '15 kg', 'Gew gew', 'HK', '', '2', '2016-02-14 00:00:00', '', NULL, 'A1600015', 'F'),
(16, 39, 1, 4, 0, 'Tobby', '', '<br />', NULL, '0', NULL, NULL, NULL, 'Cream', '0', 'MEDIUM', 0, 28, '2016-03-22 22:49:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-10-15 00:00:00', '2016-03-18 00:00:00', '2', '20 kg', '40cm', 'Di Di', 'HK', '', '1', '0000-00-00 00:00:00', '', NULL, 'A1600016', 'F'),
(17, 11, 1, 4, 0, 'Fat Fat', '', '<br />', NULL, '0', NULL, NULL, NULL, 'White', '0', 'MEDIUM', 0, 37, '2016-03-24 21:20:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-02-16 00:00:00', '2011-10-06 00:00:00', '1', '12 kg', '20 cm', 'Bo Bo', 'HK', '', '1', '0000-00-00 00:00:00', '', NULL, 'A1600017', 'F'),
(18, 11, 1, 4, 0, 'Chi Chi', '', '<br />', NULL, '0', NULL, NULL, NULL, 'Black', '0', 'MEDIUM', 0, 46, '2016-03-24 21:24:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-02 00:00:00', '2006-03-08 00:00:00', '1', '30 kg', '40cm', 'Gi Gi', 'HK', '', '2', '2016-03-06 00:00:00', '', NULL, 'A1600018', 'M'),
(19, 42, 1, 4, 0, 'Be Be', '', '<br />', NULL, '0', NULL, NULL, NULL, 'Black Tortie', '0', 'SMALL', 0, 79, '2016-03-28 21:13:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-02 00:00:00', '2012-03-15 00:00:00', '2', '', '', 'small B', 'HK', '', '1', '0000-00-00 00:00:00', '', NULL, 'A1600019', 'F'),
(20, 42, 1, 4, 0, 'Big Dee', '', '<br />', NULL, '0', NULL, NULL, NULL, 'Black Tortie', '0', 'SMALL', 0, 22, '2016-03-28 21:15:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2007-06-06 00:00:00', '2', '', '', 'Dee Dee', 'HK', '', '0', '0000-00-00 00:00:00', '', NULL, 'A1600020', 'F'),
(21, 42, 1, 4, 0, 'Holly', '', '<br />', NULL, '0', NULL, NULL, NULL, 'Black Tortie', '0', 'SMALL', 0, 14, '2016-03-28 21:18:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2005-06-10 00:00:00', '2', '', '', 'Holly', 'HK', '', '0', '0000-00-00 00:00:00', '', NULL, 'A1600021', 'M'),
(22, 45, 1, 4, 0, 'Coke', '', '<br />', NULL, '0', NULL, NULL, NULL, 'Brown', '0', 'SMALL', 0, 23, '2016-03-28 21:44:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2013-10-10 00:00:00', '2', '', '', '', 'HK', '', '2', '2015-11-10 00:00:00', '', NULL, 'A1600022', 'F'),
(23, 12, 1, 4, 0, 'LO LO', '', '<br />', NULL, '0', NULL, NULL, NULL, 'Light brown', '0', 'MEDIUM', 0, 24, '2016-03-29 23:40:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2009-03-13 00:00:00', '1', '', '', 'Low Low', 'HK', '', '0', '0000-00-00 00:00:00', '', NULL, 'A1600023', 'M'),
(24, 9, 0, 5, 0, 'guh', '', '<br />', NULL, '0', NULL, NULL, NULL, 'Black', '0', 'SMALL', 0, 17, '2016-03-31 01:25:07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2014-03-12 00:00:00', '1', '', '', 'ho', 'AF', '', '1', '0000-00-00 00:00:00', '', NULL, '', 'M'),
(26, 12, 1, 4, 0, 'Big Mac', '', '<br />', NULL, '0', NULL, NULL, NULL, 'Light brown', '0', 'MEDIUM', 0, 12, '2016-04-02 13:52:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2012-04-10 00:00:00', '1', '', '', 'Ball Chi', 'HK', '', '0', '0000-00-00 00:00:00', '', NULL, 'A1600026', 'M'),
(27, 11, 1, 4, 0, '蘭桂坊小飛俠', '體型小但膽大, 喜歡及信任人', '<p>體型小但膽大, 喜歡及信任人</p><br />', NULL, '0', NULL, NULL, NULL, 'Brown', '0', 'SMALL', 0, 86, '2016-04-06 17:33:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-05 00:00:00', '2011-04-13 00:00:00', '1', '15 kg', '20 cm', '小飛俠', 'HK', '', '1', '0000-00-00 00:00:00', '在青衣大王下村走失，希望有好心人恰擭及發現通知主', NULL, 'A1600027', 'M'),
(30, 18, 1, 12, 0, 'Alexander', '', '<br />', NULL, '0', NULL, NULL, NULL, 'Black Tortie', '0', 'SMALL', 0, 24, '2016-04-10 15:40:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2014-01-18 00:00:00', '1', '7 kg', '40 cm', 'Alexander', 'HK', '852 95071912', '0', '0000-00-00 00:00:00', '', NULL, '', 'M'),
(31, 10, 1, 13, 0, 'Gigi', 'Gigi is a female poodle with chocolate.', '<p>Gigi is a female poodle with chocolate.</p><br />', NULL, '0', NULL, NULL, NULL, 'Chocolate', '0', '', 0, 14, '2016-04-13 14:38:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '', '', 'Gigi', 'HK', '51172707', '1', '0000-00-00 00:00:00', '粉嶺 坪洋村 附近', NULL, '', 'F'),
(32, 24, 1, 13, 0, '仔仔', '在青衣大王下村走失，希望有好心人恰擭及發現通知主', '<p>在青衣大王下村走失，希望有好心人恰擭及發現通知主</p><br />', NULL, '0', NULL, NULL, NULL, 'Light brown', '0', 'SMALL', 0, 11, '2016-04-13 14:55:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1', '', '', '仔仔', 'HK', '54027681', '1', '0000-00-00 00:00:00', '在青衣大王下村走失，希望有好心人恰擭及發現通知主', NULL, '', 'M'),
(33, 21, 1, 13, 0, 'Midget', 'She is a very friendly dog, but is moderately deaf and does not have good eyesight due to her age. She was wearing a purple body harness with a name tag and my phone number inscribed on it.', '<p>She is a very friendly dog, but is moderately deaf and does not have good eyesight due to her age. She was wearing a purple body harness with a name tag and my phone number inscribed on it.</p><br />', NULL, '0', NULL, NULL, NULL, 'White', '0', '', 0, 19, '2016-04-20 15:05:26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-17 00:00:00', '0000-00-00 00:00:00', '1', '', '', 'Midget', 'HK', '98090417', '1', '0000-00-00 00:00:00', 'Lugard Road.', NULL, '', 'F'),
(34, 10, 1, 13, 0, '呀bee', '貴婦狗:名字叫bee,啡白色短毛,4歲,無精片。失蹤地點屯門友愛村愛勇樓3樓平台公園走失,時間2016年4月14號晚零晨4點左右,身上無任何飾物,如見到聯絡陳生9535-3189,巫小姐9139-0106', '<p>貴婦狗:名字叫bee,啡白色短毛,4歲,無精片。失蹤地點屯門友愛村愛勇樓3樓平台公園走失,時間2016年4月14號晚零晨4點左右,身上無任何飾物,如見到聯絡陳生9535-3189,巫小姐9139-0106</p><br />', NULL, '0', NULL, NULL, NULL, 'Brown', '0', '', 0, 1295, '2016-04-20 15:09:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-14 00:00:00', '0000-00-00 00:00:00', '1', '', '', '呀bee', 'HK', '9535-3189', '1', '0000-00-00 00:00:00', '失蹤地點屯門友愛村愛勇樓3樓平台公園走失,時間2016年4月14號晚零晨4點左右,身上無任何飾物', NULL, '', 'F'),
(35, 18, 1, 12, 0, 'Prince', '', '<br />', NULL, '0', NULL, NULL, NULL, 'Black Tortie', '0', 'SMALL', 0, 18, '2016-04-21 14:13:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2016-06-29 00:00:00', '1', '7 kg', '', 'Prince', 'HK', '852 95071912', '0', '0000-00-00 00:00:00', '', NULL, '', 'M'),
(36, 18, 1, 12, 0, 'Princess', 'Princess is completely blind', '<p>Princess is completely blind</p><br />', NULL, '0', NULL, NULL, NULL, 'Black Tortie', '0', 'SMALL', 0, 15, '2016-04-21 14:16:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2009-08-31 00:00:00', '1', '7 kg', '', 'Princess', 'HK', '852 95071912', '1', '0000-00-00 00:00:00', '', NULL, '', 'F'),
(37, 18, 1, 12, 0, 'Arrabella', '', '<br />', NULL, '0', NULL, NULL, NULL, 'Black Tortie', '0', 'SMALL', 0, 17, '2016-04-21 14:21:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2014-01-18 00:00:00', '1', '7kg', '', 'Arrabella', 'HK', '852 9507112', '0', '0000-00-00 00:00:00', '', NULL, '', 'F'),
(38, 18, 1, 12, 0, 'Oliver', '', '<br />', NULL, '0', NULL, NULL, NULL, 'Grey', '0', 'SMALL', 0, 17, '2016-04-21 14:24:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2009-10-11 00:00:00', '1', '5kg', '', 'Oliver', 'HK', '852 95071912', '0', '0000-00-00 00:00:00', '', NULL, '', 'M'),
(39, 10, 1, 12, 0, 'Olivia', '', '<br />', NULL, '0', NULL, NULL, NULL, 'Cream', '0', 'SMALL', 0, 17, '2016-04-21 14:27:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2009-03-03 00:00:00', '1', '4kg', '', 'Olivia', 'HK', '', '0', '0000-00-00 00:00:00', '', NULL, '', 'F'),
(40, 10, 1, 13, 0, 'Gigi', 'Gigi is a female poodle with chocolate. Contact person Miss Wong', '<p>Gigi is a female poodle with chocolate. Contact person Miss Wong</p><br />', NULL, '0', NULL, NULL, NULL, 'Chocolate', '0', '', 0, 12, '2016-04-21 21:33:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-06 00:00:00', '0000-00-00 00:00:00', '1', '', '', 'Gigi', 'HK', '51172707', '1', '0000-00-00 00:00:00', '粉嶺 坪洋村 附近', NULL, '', 'F'),
(41, 24, 1, 13, 0, '仔仔', 'Location: 青衣大王下村30号地下B室\r\nContact person: Lily', '<p>Location: 青衣大王下村30号地下B室<br />Contact person: Lily</p><br />', NULL, '0', NULL, NULL, NULL, 'Other', '0', '', 0, 9, '2016-04-21 21:36:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-02-01 00:00:00', '0000-00-00 00:00:00', '1', '', '', '仔仔', 'HK', '54027681', '1', '0000-00-00 00:00:00', '在青衣大王下村走失，希望有好心人恰擭及發現通知主', NULL, '', 'M'),
(42, 18, 1, 13, 0, '小吉/吉仔', '特徵:白色毛 大眼睛 兩隻耳仔淺啡色 身中間位置亦有淺啡色 有狗繩 ', '<p>特徵:白色毛 大眼睛 兩隻耳仔淺啡色 身中間位置亦有淺啡色 有狗繩</p><br />', NULL, '0', NULL, NULL, NULL, 'White', '0', '', 0, 10, '2016-04-21 21:40:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-19 00:00:00', '0000-00-00 00:00:00', '1', '', '', '小吉/吉仔', 'HK', '97501512', '1', '0000-00-00 00:00:00', '早上九點至十點 地點:屯門狗公園(屯門泳池側) 據現場目擊人士所指在三月十九日早上十時一名年約四十餘歲 穿著藍色外套，戴眼鏡的男子在屯門狗公園騎單車抱走狗隻，並往蝴蝶灣方向逃去 ', NULL, '', 'M'),
(43, 33, 1, 13, 0, 'Bee', 'Contact person: 彭先生', '<p>Contact person: 彭先生</p><br />', NULL, '0', NULL, NULL, NULL, 'Black', '0', '', 0, 8, '2016-04-21 21:42:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-17 00:00:00', '0000-00-00 00:00:00', '1', '', '', 'Bee', '', '67438922', '1', '0000-00-00 00:00:00', '在佐敦上海街一帶走失 右眼睇不到野，頸圈有銅錢', NULL, '', 'F'),
(44, 10, 1, 13, 0, '妹豬', '4歲女女 好小吠 好活躍 身上無穿任何衣物及頸繩 淺啡色毛 女女已絕育', '<p>4歲女女 好小吠 好活躍 身上無穿任何衣物及頸繩 淺啡色毛 女女已絕育</p><br />', NULL, '0', NULL, NULL, NULL, 'Brown', '0', '', 0, 13, '2016-04-21 21:45:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-15 00:00:00', '0000-00-00 00:00:00', '1', '', '', '妹豬', 'HK', '69384957', '1', '0000-00-00 00:00:00', '屯門富泰邨', NULL, '', 'F'),
(45, 82, 1, 13, 0, '貓仔/ 泡泡', '特徵: 白色淺灰紋，長毛、長尾，比較膽小，粗眼線，淚痕較深，頸帶粉紅色頸圈並有紅色啷啷 ', '<p>特徵: 白色淺灰紋，長毛、長尾，比較膽小，粗眼線，淚痕較深，頸帶粉紅色頸圈並有紅色啷啷</p><br />', NULL, '0', NULL, NULL, NULL, 'White', '0', '', 0, 11, '2016-04-21 21:47:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-09 00:00:00', '0000-00-00 00:00:00', '2', '', '', '貓仔/ 泡泡', 'HK', '98334692', '1', '0000-00-00 00:00:00', '於3月9日(星期三)約七時半，在大埔昌運中心貴昌閣走失貓貓 ', NULL, '', 'F'),
(46, 38, 1, 13, 0, 'Bobby', '姓名: Bobby 柴犬 6歲 (女) 狗狗已絕育及植入晶片,有帶狗牌(圖上) 如有發現, 請與本人聯絡 6711 7488 ,6890 2030(胡先生)', '<p>姓名: Bobby 柴犬 6歲 (女) 狗狗已絕育及植入晶片,有帶狗牌(圖上) 如有發現, 請與本人聯絡 6711 7488 ,6890 2030(胡先生)</p><br />', NULL, '0', NULL, NULL, NULL, 'Brown', '0', '', 0, 9, '2016-04-21 21:50:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-07 00:00:00', '0000-00-00 00:00:00', '1', '', '', '', 'HK', '6711 7488', '1', '0000-00-00 00:00:00', '走失日期: 3月7日 下午3點 走失地點: 粉嶺軍地虎地排村', NULL, '', 'F'),
(47, 38, 1, 13, 0, 'Coffee', '', '<br />', NULL, '0', NULL, NULL, NULL, 'Brown', '0', '', 0, 10, '2016-04-21 21:52:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-06 00:00:00', '0000-00-00 00:00:00', '1', '', '', 'Coffee', 'HK', '96234987', '1', '0000-00-00 00:00:00', '太子走失', NULL, '', 'M'),
(48, 10, 1, 13, 0, 'LEGO', '走失時帶著頭罩', '<p>走失時帶著頭罩</p><br />', NULL, '0', NULL, NULL, NULL, 'Black', '0', '', 0, 10, '2016-04-21 21:53:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-05 00:00:00', '0000-00-00 00:00:00', '1', '', '', 'LEGO', '', '91218506', '1', '0000-00-00 00:00:00', '兆康苑', NULL, '', 'M'),
(49, 38, 1, 13, 0, 'Tommy仔', '', '<br />', NULL, '0', NULL, NULL, NULL, 'White', '0', '', 0, 10, '2016-04-21 21:56:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-02-21 00:00:00', '0000-00-00 00:00:00', '1', '', '', 'Tommy仔', 'HK', '92679949', '1', '0000-00-00 00:00:00', '小狗因被車輛驚恐而走失，懷疑走到大埔工業邨附近一帶街道。小狗歲數為二歲，身型屬於大碼，毛色大概為白黃色，擁有晶盈通透啡色大眼睛，攜帶橙色頸圈。', NULL, '', 'M'),
(50, 13, 1, 13, 0, '朱古力', '左眼失明，左邊手腳一柺一柺，很膽小怕人，沒有頸圈，短毛，黑灰色身體，啡色手腳。', '<p>左眼失明，左邊手腳一柺一柺，很膽小怕人，沒有頸圈，短毛，黑灰色身體，啡色手腳。</p><br />', NULL, '0', NULL, NULL, NULL, 'Other', '0', '', 0, 11, '2016-04-21 21:58:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-02-19 00:00:00', '0000-00-00 00:00:00', '1', '', '', '朱古力', '', '96837736', '1', '0000-00-00 00:00:00', '大圍美林村附近', NULL, '', 'M'),
(51, 38, 1, 13, 0, '噹噹', '背上毛是曲毛。', '<p>背上毛是曲毛。</p><br />', NULL, '0', NULL, NULL, NULL, 'Brown', '0', '', 0, 13, '2016-04-21 22:00:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-02-18 00:00:00', '0000-00-00 00:00:00', '1', '', '', '噹噹', 'HK', '54011447', '1', '0000-00-00 00:00:00', '愛民邨，何文田邨', NULL, '', 'M'),
(52, 15, 1, 13, 0, 'Ronnie', '', '<br />', NULL, '0', NULL, NULL, NULL, 'Other', '0', '', 0, 12, '2016-04-21 22:02:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-02-12 00:00:00', '0000-00-00 00:00:00', '1', '', '', 'Ronnie', '', '92698300', '1', '0000-00-00 00:00:00', '2月11日下午约2時半走失 帶上狗連， 廣源邨，花心邨一帶', NULL, '', 'F'),
(53, 69, 1, 13, 0, 'Lovely', '', '<br />', NULL, '0', NULL, NULL, NULL, 'White', '0', '', 0, 10, '2016-04-21 22:03:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-02-01 00:00:00', '0000-00-00 00:00:00', '2', '', '', 'Lovely', 'HK', '94269420', '1', '0000-00-00 00:00:00', '耳朵曾受感染, 經常抓耳 失蹤時間：2016年2月1日下午 電話：94269420/ 56994012', NULL, '', 'M'),
(54, 10, 1, 13, 0, 'Chibi', '如果你現有的小狗由朋友Gina Chan或Kelvin Chung所贈,請你聯絡我,我才是chibi的真正主人,chibi在我不知情的情況下被送走,我好傷心,好掛住chibi,亦請各獸醫診所員工幫手留意下,感謝!!', '<p>如果你現有的小狗由朋友Gina Chan或Kelvin Chung所贈,請你聯絡我,我才是chibi的真正主人,chibi在我不知情的情況下被送走,我好傷心,好掛住chibi,亦請各獸醫診所員工幫手留意下,感謝!!</p><br />', NULL, '0', NULL, NULL, NULL, 'Cream', '0', '', 0, 15, '2016-04-21 22:06:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-12-30 00:00:00', '0000-00-00 00:00:00', '1', '', '', 'Chibi', '', '61909075', '1', '0000-00-00 00:00:00', '', NULL, '', 'F'),
(55, 38, 1, 13, 0, 'Bobo', '', '<br />', NULL, '0', NULL, NULL, NULL, 'Cream', '0', '', 0, 13, '2016-04-21 22:08:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-01-04 00:00:00', '0000-00-00 00:00:00', '1', '', '', 'Bobo', 'HK', '67739358', '1', '0000-00-00 00:00:00', '未絕育，走失時有一條熒光紅同黑色嘅狗帶， 東頭邨泰東樓附近', NULL, '', 'F'),
(56, 17, 1, 13, 0, 'Jay Jay', 'He is a small-medium sized Schnauzer with gray fur, 13 years of age and ', '<p>He is a small-medium sized Schnauzer with gray fur, 13 years of age and</p><br />', NULL, '0', NULL, NULL, NULL, 'Grey', '0', '', 0, 12, '2016-04-21 22:12:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-01-05 00:00:00', '0000-00-00 00:00:00', '1', '', '', 'Jay Jay ', 'HK', '67413905', '1', '0000-00-00 00:00:00', 'ran away Jan 5th 2016 morning in Cheung Chau.', NULL, '', 'M'),
(57, 9, 1, 4, 0, '洪福村巴士總站走失的混種邊界牧羊', '有頸帶, 電話寫住1823', '<p>有頸帶, 電話寫住1823</p><br />', NULL, '0', NULL, NULL, NULL, 'Light brown', '0', 'MEDIUM', 0, 178, '2016-04-24 16:42:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-23 00:00:00', '0000-00-00 00:00:00', '1', '', '', '不知名', 'HK', '68993286', '2', '2016-04-24 00:00:00', '見到他倆在洪福村巴士總站側，另外街市口都有一隻黃狗在睡覺', NULL, '', ''),
(58, 9, 1, 4, 0, '洪水橋狗狗求救', '昨天…有一個洪水橋村民求救\r\n於早兩日深夜見到一隻狗女在公廁附近路邊被兩隻狗公圍著（有所行動、狗女似起水），好心村民知道咩事，拉左隻狗女走，只好收留在一個！！！\r\n鬼地方暫避！巳困了三日，今天叫我去睇吓幫吾幫到手？？\r\n狗女~大約九個月大、未絶育\r\n現急尋領養、或暫託\r\n如果有人暫託，本人支付狗狗\r\n所有開支、狗糧和尿片、狗籠也有提供！下星期出領養，等\r\n待遇到好心人領養！', '<p>昨天…有一個洪水橋村民求救<br />於早兩日深夜見到一隻狗女在公廁附近路邊被兩隻狗公圍著（有所行動、狗女似起水），好心村民知道咩事，拉左隻狗女走，只好收留在一個！！！<br />鬼地方暫避！巳困了三日，今天叫我去睇吓幫吾幫到手？？<br />狗女~大約九個月大、未絶育<br />現急尋領養、或暫託<br />如果有人暫託，本人支付狗狗<br />所有開支、狗糧和尿片、狗籠也有提供！下星期出領養，等<br />待遇到好心人領養！</p><br />', NULL, '0', NULL, NULL, NULL, 'Light brown', '0', 'MEDIUM', 0, 805, '2016-04-25 11:49:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-24 00:00:00', '0000-00-00 00:00:00', '1', '', '', '洪水橋公廁附近路邊狗女', 'HK', '', '1', '0000-00-00 00:00:00', '', NULL, '', 'F'),
(59, 9, 1, 4, 0, '天水圍蝦尾新村路隻狗狗', '天水圍蝦尾新村路有隻狗狗似被遺棄，旁邊有包糧，好無陰功，有無人可以幫佢？\r\n4月27日update:包糧已經唔見咗，', '<p>天水圍蝦尾新村路有隻狗狗似被遺棄，旁邊有包糧，好無陰功，有無人可以幫佢？<br />4月27日update:包糧已經唔見咗，</p><br />', NULL, '0', NULL, NULL, NULL, 'Black', '0', 'MEDIUM', 0, 1845, '2016-04-27 19:08:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-26 00:00:00', '0000-00-00 00:00:00', '1', '', '', '天水圍蝦尾新村路隻狗狗', 'HK', '', '1', '0000-00-00 00:00:00', '', NULL, '', ''),
(60, 38, 1, 14, 0, 'Dexter', 'Rescue dog adopted \r\nTimid, scared of abandonment \r\nKindest heart, playful, cuddly ', '<p>Rescue dog adopted <br />Timid, scared of abandonment <br />Kindest heart, playful, cuddly</p><br />', NULL, '0', NULL, NULL, NULL, 'Brown', '0', 'MEDIUM', 0, 4, '2016-04-29 22:11:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', '2015-03-21 00:00:00', '1', '', '', 'Dexter', 'HK', '', '0', '0000-00-00 00:00:00', '', NULL, '', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_specification`
--

CREATE TABLE IF NOT EXISTS `shop_product_specification` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `input_type` enum('none','select','textfield','image') NOT NULL DEFAULT 'select',
  `required` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_product_specification`
--

INSERT INTO `shop_product_specification` (`id`, `title`, `input_type`, `required`) VALUES
(1, 'Size', 'select', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_variation`
--

CREATE TABLE IF NOT EXISTS `shop_product_variation` (
`id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `specification_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price_adjustion` float NOT NULL,
  `weight_adjustion` float NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_shipping_method`
--

CREATE TABLE IF NOT EXISTS `shop_shipping_method` (
`id` int(10) unsigned NOT NULL,
  `weight_range` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `tax_id` int(11) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_shipping_method`
--

INSERT INTO `shop_shipping_method` (`id`, `weight_range`, `title`, `description`, `tax_id`, `price`) VALUES
(1, '0-99999', 'Courier', 'Courier', 1, 20),
(2, '0-99999', 'In Person', 'In Person', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shop_size_guide`
--

CREATE TABLE IF NOT EXISTS `shop_size_guide` (
  `code` varchar(25) NOT NULL,
  `seq` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_size_guide`
--

INSERT INTO `shop_size_guide` (`code`, `seq`) VALUES
('BIG', 3),
('MEDIUM', 2),
('SMALL', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop_store`
--

CREATE TABLE IF NOT EXISTS `shop_store` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `store_banner` varchar(255) DEFAULT NULL,
  `store_logo` varchar(255) DEFAULT NULL,
  `store_name` varchar(100) NOT NULL,
  `store_description` text NOT NULL,
  `store_email` varchar(100) DEFAULT NULL,
  `store_phone` varchar(50) NOT NULL,
  `shipping_fee_us` double NOT NULL,
  `shipping_fee_ca` double DEFAULT NULL,
  `shipping_fee_intl` double DEFAULT NULL,
  `additional_shipping_fee` double NOT NULL,
  `shipping_info` text,
  `policy` text,
  `share_on_fb` varchar(1) DEFAULT NULL,
  `hook_paypal` varchar(100) DEFAULT NULL,
  `hook_facebook` varchar(100) DEFAULT NULL,
  `hook_google` varchar(100) DEFAULT NULL,
  `hook_twitter` varchar(100) DEFAULT NULL,
  `hook_instagram` varchar(100) DEFAULT NULL,
  `hook_pinterest` varchar(100) DEFAULT NULL,
  `ship_us` varchar(1) DEFAULT NULL,
  `ship_ca` varchar(1) DEFAULT NULL,
  `ship_other` varchar(1) DEFAULT NULL,
  `feedback` int(10) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_store`
--

INSERT INTO `shop_store` (`id`, `user_id`, `store_banner`, `store_logo`, `store_name`, `store_description`, `store_email`, `store_phone`, `shipping_fee_us`, `shipping_fee_ca`, `shipping_fee_intl`, `additional_shipping_fee`, `shipping_info`, `policy`, `share_on_fb`, `hook_paypal`, `hook_facebook`, `hook_google`, `hook_twitter`, `hook_instagram`, `hook_pinterest`, `ship_us`, `ship_ca`, `ship_other`, `feedback`) VALUES
(1, 1, 'images/banner/1_outthebox-02.jpg', 'images/logo/1_Taylor-Swift.jpg', 'my new store', 'This is my new store', 'stephenfung84@gmail.com', '1111122222', 10, 8, NULL, 1000, 'My store shipping information', 'Payment: PayPal only\r\nNo refuncd', '1', 'julianjc82-co-store@yahoo.com.hk', 'test', 'tses', 'dsdsdf', 'aaa', '', '1', '1', '0', NULL),
(2, 3, '', '', 'ricky', ' 123123', 'rickykei@yahoo.com.hk', '324234', 123123, NULL, NULL, 123123, '', '', '0', '12312312', '', '', '', '', '', '0', '0', '0', NULL),
(3, 9, NULL, NULL, '', '234', '324', '324234', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 4, NULL, NULL, '', 'Mon Mon''s Home', 'stephenfung84@yahoo.com', '92839302', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 8, NULL, NULL, '', 'Boi', 'sfgtg@yahoo.com', '67665679', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 7, NULL, NULL, '', 'Wong Tai Sin Home', 'stephenfung84@yahoo.com', '68993286', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 20, NULL, NULL, '', 'DSFSDF', 'rickykei@yahoo.com.hk', '123123', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 21, NULL, NULL, '', '23123', '2132@dfsdf.com', '1323123', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 22, NULL, NULL, '', '123213', '12321@sdfds.com', '1323123', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 23, NULL, NULL, '', 'dfdsf', '12321@sdfds.com', 'sdfdsf', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 12, NULL, NULL, '', 'Best Home', 'sim@yahoo.com', '87373423', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 26, NULL, NULL, '', 'The Fab Six', 'deniserichardson@hotmail.com ', '85295071912', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 27, NULL, NULL, '', 'trial', 'raymondhlc@gmail.com', '67100590', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 28, NULL, NULL, '', 'Jess', 'Jessmt@connect.hku.hk', '68786280', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 32, NULL, NULL, '', 'my Whiskey dog', 'bblui425@gmail.com', '90255533', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_tax`
--

CREATE TABLE IF NOT EXISTS `shop_tax` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `percent` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_tax`
--

INSERT INTO `shop_tax` (`id`, `title`, `percent`) VALUES
(1, 'Tax Free', 0);

-- --------------------------------------------------------

--
-- Table structure for table `shop_wishlist`
--

CREATE TABLE IF NOT EXISTS `shop_wishlist` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `translation`
--

CREATE TABLE IF NOT EXISTS `translation` (
  `message` varbinary(255) NOT NULL,
  `translation` varchar(255) NOT NULL,
  `language` varchar(5) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(10) unsigned NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` char(64) CHARACTER SET latin1 NOT NULL,
  `activationKey` varchar(128) NOT NULL DEFAULT '',
  `createtime` int(11) NOT NULL DEFAULT '0',
  `lastvisit` int(11) NOT NULL DEFAULT '0',
  `lastaction` int(11) NOT NULL DEFAULT '0',
  `lastpasswordchange` int(11) NOT NULL DEFAULT '0',
  `failedloginattempts` int(11) NOT NULL DEFAULT '0',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `avatar` varchar(255) DEFAULT NULL,
  `notifyType` enum('None','Digest','Instant','Threshold') DEFAULT 'Instant'
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `activationKey`, `createtime`, `lastvisit`, `lastaction`, `lastpasswordchange`, `failedloginattempts`, `superuser`, `status`, `avatar`, `notifyType`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', 1398182009, 1462279205, 1462087979, 0, 0, 1, 1, NULL, 'Instant'),
(3, 'ricky', 'a35fe15aa72dcc3c90c2ae858785ffea', '1', 1441106380, 1461681402, 1458494892, 1441106380, 0, 0, 1, NULL, 'Instant'),
(4, 'stephen', '7cbfc703d3e5c49092e5373420bee42e', 'f6dfc04684fa47b1d425b459af15135f', 1441107946, 1462079183, 1462086605, 1458371144, 1, 0, 1, NULL, 'Instant'),
(5, 'steve123', '7fe354a52a8e2d9a771cd618cf444cf6', '1', 1443449230, 1443449759, 1443450036, 1443449230, 0, 0, 1, NULL, 'Instant'),
(6, 'jctest', '25d55ad283aa400af464c76d713c07ad', '1', 1443968318, 1446972094, 1443968468, 1443968318, 1, 0, 1, NULL, 'Instant'),
(7, 'stephenfung84@yahoo.com', '4675f7b1ddf3d169c160468e096a9367', '', 1444740837, 0, 1461598221, 0, 3, 0, 1, NULL, 'Instant'),
(8, '', '59af111021669d62bf9aa8df96fbbf82', '', 1444741003, 0, 1458454868, 0, 0, 0, 1, NULL, 'Instant'),
(9, 'ricky2', '6905b7f4e4815742530a02639e96c98d', '1', 1445517769, 1445670604, 1445670983, 1445517921, 0, 0, 1, NULL, 'Instant'),
(10, 'steve', '7cbfc703d3e5c49092e5373420bee42e', '77fcc8b98b3d866d6ece8935827f3ed0', 1449293716, 0, 0, 1449293716, 0, 0, 0, NULL, 'Instant'),
(11, 'stephen2', '7cbfc703d3e5c49092e5373420bee42e', '1', 1449293918, 1449294028, 1449294028, 1449293918, 0, 0, 1, NULL, 'Instant'),
(12, 'whospets@twitter', '5360e99d51911c6d07cdb556c39d9501', '', 1458377464, 0, 1458377499, 0, 0, 0, 1, NULL, 'Instant'),
(13, 'wongwankei', 'a35fe15aa72dcc3c90c2ae858785ffea', '78f200411d62a967652c0e65f3c58907', 1458411846, 0, 0, 1458411846, 0, 0, 0, NULL, 'Instant'),
(14, 'rickykei@yahoo.com.hk', 'a1cdcd512d48ac64526dba143df605b1', '', 1458415454, 0, 1458494924, 0, 0, 0, 1, NULL, 'Instant'),
(15, 'steve12345', 'e10adc3949ba59abbe56e057f20f883e', 'ac5427a75042ae4b9234052effca9e3c', 1458454327, 0, 0, 1458454327, 0, 0, 0, NULL, 'Instant'),
(16, 'sodijsd', 'e10adc3949ba59abbe56e057f20f883e', '334f29c9db09b7d6b2cb28ffb1a3bcdb', 1458640453, 0, 0, 1458640453, 0, 0, 0, NULL, 'Instant'),
(17, 'ken50488642@gmail.com', 'de2069f6289b4b9326e4c4a254f3dea5', '', 1459506993, 0, 1459587954, 0, 0, 0, 1, NULL, 'Instant'),
(20, 'ricky3', 'a35fe15aa72dcc3c90c2ae858785ffea', '1', 1459578229, 1459578313, 0, 1459578229, 0, 0, 1, NULL, 'Instant'),
(21, 'ricky4', 'a35fe15aa72dcc3c90c2ae858785ffea', '1', 1459578645, 1459578675, 0, 1459578645, 0, 0, 1, NULL, 'Instant'),
(22, 'ricky5', 'a35fe15aa72dcc3c90c2ae858785ffea', '1', 1459579506, 1459579534, 0, 1459579506, 0, 0, 1, NULL, 'Instant'),
(23, 'ricky6', 'a35fe15aa72dcc3c90c2ae858785ffea', '1', 1459579697, 1459579715, 0, 1459579697, 0, 0, 1, NULL, 'Instant'),
(24, 'Tiny', '9b1e1876d3503abab6dd16a33e90a8ad', '1', 1459666586, 1459666687, 1459666728, 1459666716, 0, 0, 1, NULL, 'Instant'),
(25, 'stephen12', '7cbfc703d3e5c49092e5373420bee42e', '1', 1459758042, 1459758084, 1459758090, 1459758042, 0, 0, 1, NULL, 'Instant'),
(26, 'deniserichardson@hotmail.com', '534b94053f7847438a37a101676aab46', '', 1460273655, 0, 1461221400, 1461218802, 0, 0, 1, NULL, 'Instant'),
(27, 'heiraymond', 'ed3b7fd48fa7f66845d7cb378ac0c42a', '1', 1460435309, 1461937143, 1461245049, 1460435309, 0, 0, 1, NULL, 'Instant'),
(28, 'tejessicamtsang', 'a4dba0517b01aafecb74a7fd38763ee2', '1', 1461930172, 1461938771, 1461938773, 1461930172, 0, 0, 1, NULL, 'Instant'),
(29, 'timmy1105', '63238f332ec8523ddfc017feeb3a081b', '9e9d684982d343ee649c0fae35180703', 1461937493, 0, 0, 1461937493, 0, 0, 0, NULL, 'Instant'),
(30, 'ka_lam', 'f3e8b29516545a898bf78f79198bf18c', '661232f863a8272ad8e49b72e2931d41', 1461937545, 0, 0, 1461937545, 0, 0, 0, NULL, 'Instant'),
(31, 'Yukito925', 'da15772f9dfd2e17427ecd3ffb0d2426', '1', 1461937638, 0, 0, 1461937638, 1, 0, 1, NULL, 'Instant'),
(32, 'Jocelyn', 'f84a66dd2101da040ac5f0f4702d7826', '1', 1461949393, 1461949486, 1461949499, 1461949392, 0, 0, 1, NULL, 'Instant');

-- --------------------------------------------------------

--
-- Table structure for table `usergroup`
--

CREATE TABLE IF NOT EXISTS `usergroup` (
`id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `participants` text,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_group_message`
--

CREATE TABLE IF NOT EXISTS `user_group_message` (
`id` int(11) unsigned NOT NULL,
  `author_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  `createtime` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action`
--
ALTER TABLE `action`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friendship`
--
ALTER TABLE `friendship`
 ADD PRIMARY KEY (`inviter_id`,`friend_id`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
 ADD PRIMARY KEY (`principal_id`,`subordinate_id`,`type`,`action`,`subaction`);

--
-- Indexes for table `privacysetting`
--
ALTER TABLE `privacysetting`
 ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile2016`
--
ALTER TABLE `profile2016`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_comment`
--
ALTER TABLE `profile_comment`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_visit`
--
ALTER TABLE `profile_visit`
 ADD PRIMARY KEY (`visitor_id`,`visited_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_address`
--
ALTER TABLE `shop_address`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_app_profile`
--
ALTER TABLE `shop_app_profile`
 ADD PRIMARY KEY (`code`);

--
-- Indexes for table `shop_category`
--
ALTER TABLE `shop_category`
 ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `shop_category2`
--
ALTER TABLE `shop_category2`
 ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `shop_chat`
--
ALTER TABLE `shop_chat`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_chat_image`
--
ALTER TABLE `shop_chat_image`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_Image_Message` (`message_id`);

--
-- Indexes for table `shop_chat_message`
--
ALTER TABLE `shop_chat_message`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_color`
--
ALTER TABLE `shop_color`
 ADD PRIMARY KEY (`color`);

--
-- Indexes for table `shop_customer`
--
ALTER TABLE `shop_customer`
 ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `shop_favorite`
--
ALTER TABLE `shop_favorite`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_favorite_user` (`user_id`), ADD KEY `fk_favorite_store` (`store_id`);

--
-- Indexes for table `shop_feature_ipn`
--
ALTER TABLE `shop_feature_ipn`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_feedback`
--
ALTER TABLE `shop_feedback`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_feedback_store` (`store_id`), ADD KEY `fk_feedback_user` (`user_id`);

--
-- Indexes for table `shop_image`
--
ALTER TABLE `shop_image`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_Image_Products` (`product_id`);

--
-- Indexes for table `shop_order`
--
ALTER TABLE `shop_order`
 ADD PRIMARY KEY (`order_id`), ADD KEY `fk_order_customer` (`customer_id`);

--
-- Indexes for table `shop_order_ipn`
--
ALTER TABLE `shop_order_ipn`
 ADD PRIMARY KEY (`tracking_id`);

--
-- Indexes for table `shop_order_position`
--
ALTER TABLE `shop_order_position`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_payment_method`
--
ALTER TABLE `shop_payment_method`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_products`
--
ALTER TABLE `shop_products`
 ADD PRIMARY KEY (`product_id`), ADD KEY `fk_products_category` (`category_id`);

--
-- Indexes for table `shop_product_specification`
--
ALTER TABLE `shop_product_specification`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_product_variation`
--
ALTER TABLE `shop_product_variation`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_shipping_method`
--
ALTER TABLE `shop_shipping_method`
 ADD PRIMARY KEY (`id`,`weight_range`);

--
-- Indexes for table `shop_size_guide`
--
ALTER TABLE `shop_size_guide`
 ADD PRIMARY KEY (`code`);

--
-- Indexes for table `shop_store`
--
ALTER TABLE `shop_store`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `shop_tax`
--
ALTER TABLE `shop_tax`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_wishlist`
--
ALTER TABLE `shop_wishlist`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_wishlist_product` (`product_id`), ADD KEY `fk_wishlist_user` (`user_id`);

--
-- Indexes for table `translation`
--
ALTER TABLE `translation`
 ADD PRIMARY KEY (`message`,`language`,`category`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`), ADD KEY `status` (`status`), ADD KEY `superuser` (`superuser`);

--
-- Indexes for table `usergroup`
--
ALTER TABLE `usergroup`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group_message`
--
ALTER TABLE `user_group_message`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
 ADD PRIMARY KEY (`user_id`,`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action`
--
ALTER TABLE `action`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `profile2016`
--
ALTER TABLE `profile2016`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `profile_comment`
--
ALTER TABLE `profile_comment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `shop_address`
--
ALTER TABLE `shop_address`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shop_category`
--
ALTER TABLE `shop_category`
MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=177;
--
-- AUTO_INCREMENT for table `shop_category2`
--
ALTER TABLE `shop_category2`
MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `shop_chat`
--
ALTER TABLE `shop_chat`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `shop_chat_image`
--
ALTER TABLE `shop_chat_image`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `shop_chat_message`
--
ALTER TABLE `shop_chat_message`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `shop_customer`
--
ALTER TABLE `shop_customer`
MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shop_favorite`
--
ALTER TABLE `shop_favorite`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shop_feedback`
--
ALTER TABLE `shop_feedback`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `shop_image`
--
ALTER TABLE `shop_image`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT for table `shop_order`
--
ALTER TABLE `shop_order`
MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shop_order_position`
--
ALTER TABLE `shop_order_position`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shop_payment_method`
--
ALTER TABLE `shop_payment_method`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `shop_products`
--
ALTER TABLE `shop_products`
MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `shop_product_specification`
--
ALTER TABLE `shop_product_specification`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `shop_product_variation`
--
ALTER TABLE `shop_product_variation`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shop_shipping_method`
--
ALTER TABLE `shop_shipping_method`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `shop_store`
--
ALTER TABLE `shop_store`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `shop_tax`
--
ALTER TABLE `shop_tax`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `shop_wishlist`
--
ALTER TABLE `shop_wishlist`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `usergroup`
--
ALTER TABLE `usergroup`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_group_message`
--
ALTER TABLE `user_group_message`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `shop_favorite`
--
ALTER TABLE `shop_favorite`
ADD CONSTRAINT `fk_favorite_store` FOREIGN KEY (`store_id`) REFERENCES `shop_store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_favorite_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shop_feedback`
--
ALTER TABLE `shop_feedback`
ADD CONSTRAINT `fk_feedback_store` FOREIGN KEY (`store_id`) REFERENCES `shop_store` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_feedback_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shop_image`
--
ALTER TABLE `shop_image`
ADD CONSTRAINT `fk_Image_Products` FOREIGN KEY (`product_id`) REFERENCES `shop_products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shop_order`
--
ALTER TABLE `shop_order`
ADD CONSTRAINT `fk_order_customer1` FOREIGN KEY (`customer_id`) REFERENCES `shop_customer` (`customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shop_products`
--
ALTER TABLE `shop_products`
ADD CONSTRAINT `fk_products_category` FOREIGN KEY (`category_id`) REFERENCES `shop_category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shop_wishlist`
--
ALTER TABLE `shop_wishlist`
ADD CONSTRAINT `fk_wishlist_product` FOREIGN KEY (`product_id`) REFERENCES `shop_products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_wishlist_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
