-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 04 maj 2016 kl 22:08
-- Serverversion: 5.5.46-0ubuntu0.14.04.2
-- PHP-version: 5.5.9-1ubuntu4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `running_shoes`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `By` varchar(200) DEFAULT NULL,
  `blog_label` varchar(200) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `blog_content` text,
  `blog_image` text,
  `blog_title` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `By` (`By`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumpning av Data i tabell `blog`
--

INSERT INTO `blog` (`ID`, `By`, `blog_label`, `Date`, `blog_content`, `blog_image`, `blog_title`) VALUES
(1, 'Pontus', 'Shoes', '2016-03-03', 'IPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsum', 'images/laravel-5-test.jpg', 'Date some shoes'),
(2, 'Pontus2', 'Shoes2', '2016-03-07', 'IPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsum', 'images/laravel-5-test.jpg', 'Date some shoes'),
(3, 'Pontus3', 'Shoes3', '2016-03-07', 'IPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsumIPSUM lorem ipsum', 'images/laravel-5-test.jpg', 'Date some shoes');

-- --------------------------------------------------------

--
-- Tabellstruktur `brands`
--

CREATE TABLE IF NOT EXISTS `brands` (
  `Brand_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `banner_link` text,
  `link` text,
  `Brand_title` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Brand_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Dumpning av Data i tabell `brands`
--

INSERT INTO `brands` (`Brand_id`, `banner_link`, `link`, `Brand_title`, `created_at`, `updated_at`) VALUES
(41, '/images/sample_banner.jpg', 'Addidas', 'Addidas', '2016-01-22 11:58:59', '2016-01-22 11:58:59'),
(42, '/images/sample_banner.jpg', 'ALDO', 'ALDO', '2016-01-22 11:58:59', '2016-01-22 11:58:59'),
(43, '/images/sample_banner.jpg', 'ASOS', 'ASOS', '2016-01-22 11:58:59', '2016-01-22 11:58:59'),
(44, '/images/sample_banner.jpg', 'Boohoo', 'Boohoo', '2016-01-22 11:58:59', '2016-01-22 11:58:59');

-- --------------------------------------------------------

--
-- Tabellstruktur `cats`
--

CREATE TABLE IF NOT EXISTS `cats` (
  `Cat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `link` text,
  `cat_title` varchar(200) DEFAULT NULL,
  `banner_link` text,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Dumpning av Data i tabell `cats`
--

INSERT INTO `cats` (`Cat_id`, `link`, `cat_title`, `banner_link`, `created_at`, `updated_at`) VALUES
(41, 'Runningshoes', 'Runningshoes', '/images/sample_banner.jpg', '2016-01-22 11:58:59', '2016-01-22 11:58:59'),
(42, 'Walkingshoes', 'Walkingshoes', '/images/sample_banner.jpg', '2016-01-22 11:58:59', '2016-01-22 11:58:59'),
(43, 'Flat-Boots', 'Flat-Boots', '/images/sample_banner.jpg', '2016-01-22 11:58:59', '2016-01-22 11:58:59'),
(44, 'Flat-shoes', 'Flat-shoes', '/images/sample_banner.jpg', '2016-01-22 11:58:59', '2016-01-22 11:58:59');

-- --------------------------------------------------------

--
-- Tabellstruktur `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `comments` text NOT NULL,
  `rate` int(11) DEFAULT NULL,
  `comments_products_id` int(10) unsigned DEFAULT NULL,
  `comments_blogg_id` int(11) DEFAULT NULL,
  `pages` varchar(200) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_products_id` (`comments_products_id`),
  KEY `comments_blogg_id` (`comments_blogg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=150 ;

--
-- Dumpning av Data i tabell `comments`
--

INSERT INTO `comments` (`id`, `name`, `comments`, `rate`, `comments_products_id`, `comments_blogg_id`, `pages`, `date`) VALUES
(142, 'Test', 'Tetsttsts s t', NULL, NULL, 3, 'blogg3', '2016-05-02'),
(143, 'Test', 'Tetsttsts s t', NULL, NULL, 3, 'blogg3', '2016-05-02'),
(144, 'This Is Great', 'HJKHSAJHSDKJHAS DKJAH SKJAHSD', 3, 43, NULL, 'products43', '2016-05-04'),
(145, 'Pontus', 'aölskdöalsdk alöskdöalksd aölsdkaö', 5, 43, NULL, 'products43', '2016-05-04'),
(146, 'asdadssasdadsasda', 'asdasdadadssad', 1, 43, NULL, 'products43', '2016-05-04'),
(147, 'Pontus', 'lkajsdla lasdjlald', 0, NULL, 2, 'blogg2', '2016-05-04'),
(148, 'sadasdasdadad', 'asdadadsasd', 5, 46, NULL, 'products46', '2016-05-04'),
(149, 'Pontus', 'öasmdalsd aa ö kaö', 3, 45, NULL, 'products45', '2016-05-04');

-- --------------------------------------------------------

--
-- Tabellstruktur `forum_cat`
--

CREATE TABLE IF NOT EXISTS `forum_cat` (
  `Forum_cat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Forum_cat_name` varchar(200) DEFAULT NULL,
  `forum_qty` int(10) unsigned NOT NULL,
  `Forum_cat_desc` text,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Forum_cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Dumpning av Data i tabell `forum_cat`
--

INSERT INTO `forum_cat` (`Forum_cat_id`, `Forum_cat_name`, `forum_qty`, `Forum_cat_desc`, `created_at`, `updated_at`) VALUES
(41, 'Shoes', 3, 'Any Good shoes', '2016-01-22 11:58:59', '2016-01-22 11:58:59'),
(42, 'Running', 0, 'The consept of running', '2016-01-22 11:58:59', '2016-01-22 11:58:59'),
(43, 'Webbsite', 1, 'What can be better?\r\n', '2016-01-22 11:58:59', '2016-01-22 11:58:59');

-- --------------------------------------------------------

--
-- Tabellstruktur `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `menu_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(200) DEFAULT NULL,
  `menu_href` text,
  `info` text,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Dumpning av Data i tabell `menus`
--

INSERT INTO `menus` (`menu_id`, `menu_name`, `menu_href`, `info`, `created_at`, `updated_at`) VALUES
(43, 'Home', '', NULL, '2016-01-22 11:58:59', '2016-01-22 11:58:59'),
(44, 'All Products', 'Products&products_id', NULL, '2016-01-22 11:58:59', '2016-01-22 11:58:59'),
(45, 'Blogg', 'Blogg&ID', '<h2>Our Blogg</h2>', '2016-01-22 11:58:59', '2016-01-22 11:58:59'),
(46, 'Forum', 'Forum', NULL, '2016-01-22 11:58:59', '2016-01-22 11:58:59'),
(47, 'About us', 'about-us', 'Ipsu lorem taxida Sopin Ipsum BLaOPsum hye paos ipsum lorem albina sorema astaba boppaaee ipsum Ipsu lorem taxida Sopin Ipsum BLaOPsum hye paos ipsum lorem albina sorema astaba boppaaee ipsum Ipsu lorem taxida Sopin Ipsum BLaOPsum hye paos ipsum lorem albina sorema astaba boppaaee ipsum Ipsu lorem taxida Sopin Ipsum BLaOPsum hye paos ipsum lorem albina sorema astaba boppaaee ipsum  ', '2016-01-22 11:58:59', '2016-01-22 11:58:59'),
(48, 'Contact us', 'contact-us', NULL, '2016-01-22 11:58:59', '2016-01-22 11:58:59');

-- --------------------------------------------------------

--
-- Tabellstruktur `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_100000_create_password_resets_table', 1),
('2015_12_14_224721_create_slides_table', 1),
('2015_12_16_133517_create_users_table', 1),
('2016_01_14_181324_create_brands_table', 1),
('2016_01_14_181433_create_cats_table', 1),
('2016_01_14_181547_create_forum_cat_table', 1),
('2016_01_14_181634_create_menus_table', 1),
('2016_01_14_181719_create_postsubject_table', 1),
('2016_01_14_181857_create_products_table', 1),
('2016_01_14_181916_create_reply_table', 1),
('2016_01_14_182126_create_shoppingcart_table', 1),
('2016_01_14_182152_create_subjects_table', 1),
('2016_01_14_182224_create_submenu_table', 1),
('2016_01_14_182312_create_toplinks_table', 1),
('2016_01_20_200824_wishlist_table', 2);

-- --------------------------------------------------------

--
-- Tabellstruktur `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellstruktur `postsubject`
--

CREATE TABLE IF NOT EXISTS `postsubject` (
  `post_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_name` varchar(200) DEFAULT NULL,
  `post_content` text,
  `cat_page` varchar(100) DEFAULT NULL,
  `post_date` date DEFAULT NULL,
  `post_by` varchar(255) DEFAULT NULL,
  `post_subject_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`post_id`),
  KEY `postsubject_post_subject_id_index` (`post_subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumpning av Data i tabell `postsubject`
--

INSERT INTO `postsubject` (`post_id`, `post_name`, `post_content`, `cat_page`, `post_date`, `post_by`, `post_subject_id`, `created_at`, `updated_at`) VALUES
(21, 'Awesine', 'This IS Nice!! :)', '41', '2016-05-02', 'pontus', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'Pontus', 'Thsi IS greta', '43', '2016-05-04', 'Pontus', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'Pontus', 'Pontus aosdla ', '41', '2016-05-04', 'Pontus', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'Pontusasd', 'sasdasdasdasda', '41', '2016-05-04', 'Pontus', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tabellstruktur `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `products_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `products_name` varchar(200) DEFAULT NULL,
  `Products_price` int(11) DEFAULT NULL,
  `product_image` text,
  `product_title` varchar(200) DEFAULT NULL,
  `product_desc` text,
  `product_cat` int(10) unsigned DEFAULT NULL,
  `product_brand` int(10) DEFAULT NULL,
  `categories_title` varchar(100) DEFAULT NULL,
  `products_antal` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `order_page` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`products_id`),
  KEY `products_product_cat_foreign` (`product_cat`),
  KEY `order_page` (`order_page`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Dumpning av Data i tabell `products`
--

INSERT INTO `products` (`products_id`, `products_name`, `Products_price`, `product_image`, `product_title`, `product_desc`, `product_cat`, `product_brand`, `categories_title`, `products_antal`, `created_at`, `updated_at`, `order_page`) VALUES
(34, 'Test', 500, '/images/demo-prod.png', 'This IS A testing product', '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."', 41, 41, 'Boohoo', 50, '2016-01-22 11:58:59', '2016-05-04 19:48:47', NULL),
(35, 'Test2', 500, '/images/demo-prod.png', 'This Is A Testing product', '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."', 41, 41, 'Boohoo', 49, '2016-01-22 11:58:59', '2016-05-04 21:57:57', NULL),
(36, 'Test3', 500, '/images/demo-prod.png', 'This is A testing product', '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."', 41, 42, 'Boohoo', 49, '2016-01-22 11:58:59', '2016-05-04 19:36:34', NULL),
(37, 'Test4', 500, '/images/demo-prod.png', 'This Is A testing product', '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."', 41, 50, 'ASOS', 20, '2016-01-22 11:58:59', '2016-01-22 11:58:59', NULL),
(38, 'Test5', 500, '/images/demo-prod.png', 'This Is A testing product', '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."', 41, 50, 'ASOS', 39, '2016-01-22 11:58:59', '2016-05-04 19:33:27', NULL),
(39, 'Test6', 500, '/images/demo-prod.png', 'This IS A testing product', '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."', 41, 41, 'ASOS', 50, '2016-01-22 11:58:59', '2016-01-22 11:58:59', NULL),
(40, 'Test7', 500, '/images/demo-prod.png', 'This IS A Testing product', '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."', 41, 42, 'ASOS', 49, '2016-01-22 11:58:59', '2016-05-04 19:34:32', NULL),
(41, 'Test8', 500, '/images/demo-prod.png', 'This Is A testing product', '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."', 41, 44, 'Addidas', 0, '2016-01-22 11:58:59', '2016-01-22 11:58:59', NULL),
(42, 'Test9', 500, '/images/demo-prod.png', 'This Is A Testing Product', '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."', 41, 43, 'Addidas', 50, '2016-01-22 11:58:59', '2016-05-04 19:48:58', NULL),
(43, 'Test41,0', 500, '/images/demo-prod.png', 'This IS A testing product', '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."', 41, 44, 'Flat-shoes', 50, '2016-01-22 11:58:59', '2016-05-04 19:56:40', NULL),
(44, 'Testing 45', 500, '/images/demo-prod.png', 'This Is A testing product', 'This Is A Testing Products only so dont care if you see it', 41, NULL, 'Runningshoes', 51, '2016-01-22 11:58:59', '2016-05-04 21:53:44', NULL),
(45, 'Shoes 55', 500, '/images/demo-prod.png', 'This is for shoes title', '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."', 41, 41, 'Flat-Boots', 51, '2016-04-06 22:00:00', '2016-05-04 22:06:26', 'shoes'),
(46, 'First Assecories', 250, '/images/demo-prod.png', 'First Assecories', '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."', 44, 43, 'ALDO', 48, '2016-04-11 22:00:00', '2016-05-04 21:58:04', 'Accessories');

-- --------------------------------------------------------

--
-- Tabellstruktur `reply`
--

CREATE TABLE IF NOT EXISTS `reply` (
  `reply_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reply_text` text,
  `reply_date` date DEFAULT NULL,
  `reply_topic` varchar(200) DEFAULT NULL,
  `reply_by` varchar(200) DEFAULT NULL,
  `reply_name` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`reply_id`),
  UNIQUE KEY `reply_name` (`reply_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumpning av Data i tabell `reply`
--

INSERT INTO `reply` (`reply_id`, `reply_text`, `reply_date`, `reply_topic`, `reply_by`, `reply_name`, `created_at`, `updated_at`) VALUES
(3, 'ölskdöaskaök', '2016-05-04', 'Awesine', 'Pontus', 'Pontus', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'sadadsadsadsasd', '2016-05-04', 'Awesine', 'Pontus', 'asdasdadssdsda', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tabellstruktur `shoppingcart`
--

CREATE TABLE IF NOT EXISTS `shoppingcart` (
  `shoppingcart_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shoppingcart_prod_name` varchar(255) DEFAULT NULL,
  `shoppingcart_prod_price` int(11) DEFAULT NULL,
  `full_prise_prod` int(11) NOT NULL,
  `shoppingcart_prod_title` varchar(200) DEFAULT NULL,
  `shoppingcart_prod_label` text,
  `shoppingcart_prod_img` text,
  `cart_pro_qty` int(10) unsigned NOT NULL,
  `cart_user_id` int(10) unsigned NOT NULL,
  `prod_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`shoppingcart_id`),
  KEY `shoppingcart_prod_id_foreign` (`prod_id`),
  KEY `shoppingcart_cart_user_id_foreign` (`cart_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `slides`
--

CREATE TABLE IF NOT EXISTS `slides` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumpning av Data i tabell `slides`
--

INSERT INTO `slides` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(7, 'Test', '/images/test-slideshow.jpg', '2016-01-22 11:58:59', '2016-01-22 11:58:59'),
(8, 'Test2', '/images/test-slide2.jpg', '2016-01-22 11:58:59', '2016-01-22 11:58:59'),
(9, 'Test3', '/images/test-slideshow.jpg', '2016-01-22 11:58:59', '2016-01-22 11:58:59');

-- --------------------------------------------------------

--
-- Tabellstruktur `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `subjects_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subjects_name` varchar(200) DEFAULT NULL,
  `subject_post_content` text,
  `subjects_date` date DEFAULT NULL,
  `subjects_username` varchar(200) DEFAULT NULL,
  `sub_cat_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`subjects_id`),
  UNIQUE KEY `subjects_name` (`subjects_name`),
  KEY `subjects_sub_cat_id_foreign` (`sub_cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Dumpning av Data i tabell `subjects`
--

INSERT INTO `subjects` (`subjects_id`, `subjects_name`, `subject_post_content`, `subjects_date`, `subjects_username`, `sub_cat_id`, `created_at`, `updated_at`) VALUES
(26, 'Awesine', 'This IS Nice!! :)', '2016-05-02', 'pontus', 41, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'Pontusasd', 'sasdasdasdasda', '2016-05-04', 'Pontus', 41, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tabellstruktur `submenu`
--

CREATE TABLE IF NOT EXISTS `submenu` (
  `submenu_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `submenu_link` text,
  `submenu_name` varchar(200) DEFAULT NULL,
  `banner_link` text,
  `submenu_menu_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`submenu_id`),
  KEY `submenus_submenu_menu_id_foreign` (`submenu_menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumpning av Data i tabell `submenu`
--

INSERT INTO `submenu` (`submenu_id`, `submenu_link`, `submenu_name`, `banner_link`, `submenu_menu_id`, `created_at`, `updated_at`) VALUES
(9, 'Shoes&products_id', 'Shoes', 'images/sample_banner.jpg', 44, '2016-01-22 11:58:59', '2016-01-22 11:58:59'),
(10, 'Accessories&products_id', 'Accessories', 'images/sample_banner.jpg', 44, '2016-01-22 11:58:59', '2016-01-22 11:58:59'),
(11, 'Forum/create/Subjects', 'Create forum', 'images/sample_banner.jpg', 46, '2016-01-22 11:58:59', '2016-01-22 11:58:59'),
(12, 'Forum/Aktive/Aktuella-Subjects', 'aktive topics', 'images/sample_banner.jpg', 46, '2016-01-22 11:58:59', '2016-01-22 11:58:59');

-- --------------------------------------------------------

--
-- Tabellstruktur `toplinks`
--

CREATE TABLE IF NOT EXISTS `toplinks` (
  `topLink_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `link` text,
  `name` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`topLink_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumpning av Data i tabell `toplinks`
--

INSERT INTO `toplinks` (`topLink_id`, `link`, `name`, `created_at`, `updated_at`) VALUES
(6, 'Account', 'Account', '2016-01-22 11:58:59', '2016-01-22 11:58:59'),
(7, 'Shoppingcart', 'Shoppingcart', '2016-01-22 11:58:59', '2016-01-22 11:58:59'),
(8, 'Log-in', 'Login', '2016-01-22 11:58:59', '2016-01-22 11:58:59');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `image` text,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `username`, `image`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(21, 'Pon', '/images/demo-icon.jpg', 'PON@pon.se', '$2y$10$93ywVjZL9kC/G.F7IQt.EesfiUeFEdfDNBV5TRMTKBSTcL3VeNtpC', NULL, '2016-04-14 04:37:32', '2016-04-14 04:37:32'),
(22, 'Pontus', '/images/demo-icon.jpg', 'pontusp66@hotmail.com', '$2y$10$KZva10MF2K.FcJKLnWCX.OVJer0WtBv/DsHkV8g64cXr3rxdOf8Z2', NULL, '2016-04-14 05:25:31', '2016-04-14 05:25:31'),
(23, 'KristofferPettersson', NULL, 'KristofferPettersson@KristofferPettersson.se', '$2y$10$VbNiNrdBeknlzI4sb4qSI.tTTOuedyDrvxb1.qhAy//agtUTCkLgC', NULL, '2016-05-04 21:13:03', '2016-05-04 21:13:03');

-- --------------------------------------------------------

--
-- Tabellstruktur `wishlist`
--

CREATE TABLE IF NOT EXISTS `wishlist` (
  `wishlist_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wishlist_prod_name` varchar(255) DEFAULT NULL,
  `wishlist_prod_price` int(11) DEFAULT NULL,
  `wishlistfullprise_prod` int(11) NOT NULL,
  `wishlist_prod_title` varchar(200) DEFAULT NULL,
  `wishlist_prod_label` text,
  `wishlist_prod_img` text,
  `wishlist_pro_qty` int(10) unsigned NOT NULL,
  `wishlist_user_id` int(10) unsigned NOT NULL,
  `wishlist_prod_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`wishlist_id`),
  KEY `wishlist_wishlist_prod_id_foreign` (`wishlist_prod_id`),
  KEY `wishlist_wishlist_user_id_foreign` (`wishlist_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`comments_products_id`) REFERENCES `products` (`products_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`comments_blogg_id`) REFERENCES `blog` (`ID`);

--
-- Restriktioner för tabell `postsubject`
--
ALTER TABLE `postsubject`
  ADD CONSTRAINT `postsubject_ibfk_1` FOREIGN KEY (`post_subject_id`) REFERENCES `subjects` (`subjects_id`);

--
-- Restriktioner för tabell `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_product_cat_foreign` FOREIGN KEY (`product_cat`) REFERENCES `cats` (`Cat_id`);

--
-- Restriktioner för tabell `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD CONSTRAINT `shoppingcart_cart_user_id_foreign` FOREIGN KEY (`cart_user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `shoppingcart_prod_id_foreign` FOREIGN KEY (`prod_id`) REFERENCES `products` (`products_id`);

--
-- Restriktioner för tabell `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_sub_cat_id_foreign` FOREIGN KEY (`sub_cat_id`) REFERENCES `forum_cat` (`Forum_cat_id`);

--
-- Restriktioner för tabell `submenu`
--
ALTER TABLE `submenu`
  ADD CONSTRAINT `submenus_submenu_menu_id_foreign` FOREIGN KEY (`submenu_menu_id`) REFERENCES `menus` (`menu_id`);

--
-- Restriktioner för tabell `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_wishlist_prod_id_foreign` FOREIGN KEY (`wishlist_prod_id`) REFERENCES `products` (`products_id`),
  ADD CONSTRAINT `wishlist_wishlist_user_id_foreign` FOREIGN KEY (`wishlist_user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
