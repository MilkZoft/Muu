-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 19-11-2011 a las 20:23:32
-- Versión del servidor: 5.1.44
-- Versión de PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `mini_muucms`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_applications`
--

DROP TABLE IF EXISTS `muu_applications`;
CREATE TABLE IF NOT EXISTS `muu_applications` (
  `ID_Application` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(45) NOT NULL,
  `Slug` varchar(45) NOT NULL,
  `CPanel` tinyint(1) NOT NULL DEFAULT '1',
  `Adding` tinyint(1) NOT NULL,
  `BeDefault` tinyint(1) NOT NULL DEFAULT '1',
  `Comments` tinyint(1) NOT NULL DEFAULT '0',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Application`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Volcar la base de datos para la tabla `muu_applications`
--

INSERT INTO `muu_applications` (`ID_Application`, `Title`, `Slug`, `CPanel`, `Adding`, `BeDefault`, `Comments`, `Situation`) VALUES
(1, 'Ads', 'ads', 1, 1, 0, 0, 'Inactive'),
(2, 'Applications', 'applications', 1, 1, 0, 0, 'Inactive'),
(3, 'Blog', 'blog', 1, 1, 1, 1, 'Active'),
(4, 'Categories', 'categories', 1, 1, 0, 0, 'Inactive'),
(5, 'Comments', 'comments', 1, 0, 0, 1, 'Inactive'),
(6, 'Configuration', 'configuration', 1, 0, 0, 0, 'Active'),
(7, 'Feedback', 'feedback', 1, 0, 0, 0, 'Active'),
(8, 'Forums', 'forums', 1, 1, 1, 0, 'Inactive'),
(9, 'Gallery', 'gallery', 1, 1, 1, 1, 'Inactive'),
(10, 'Links', 'links', 1, 1, 1, 0, 'Active'),
(11, 'Messages', 'messages', 1, 1, 0, 0, 'Inactive'),
(12, 'Pages', 'pages', 1, 1, 1, 0, 'Active'),
(13, 'Polls', 'polls', 1, 1, 0, 0, 'Inactive'),
(14, 'Support', 'support', 1, 1, 0, 0, 'Inactive'),
(15, 'Tags', 'tags', 1, 1, 0, 0, 'Inactive'),
(16, 'URL', 'url', 1, 1, 0, 0, 'Inactive'),
(17, 'Users', 'users', 1, 1, 0, 0, 'Active'),
(18, 'Videos', 'videos', 1, 1, 1, 0, 'Inactive'),
(19, 'Works', 'works', 1, 1, 1, 0, 'Inactive'),
(20, 'Hotels', 'hotels', 1, 1, 1, 0, 'Inactive');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_blog`
--

DROP TABLE IF EXISTS `muu_blog`;
CREATE TABLE IF NOT EXISTS `muu_blog` (
  `ID_Post` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_URL` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(250) NOT NULL,
  `Slug` varchar(250) NOT NULL,
  `Content` text NOT NULL,
  `Author` varchar(50) NOT NULL,
  `Start_Date` int(11) NOT NULL DEFAULT '0',
  `Text_Date` varchar(40) NOT NULL,
  `Year` varchar(4) NOT NULL,
  `Month` varchar(2) NOT NULL,
  `Day` varchar(2) NOT NULL,
  `Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Image_Small` varchar(250) DEFAULT NULL,
  `Image_Medium` varchar(250) NOT NULL,
  `Comments` mediumint(8) NOT NULL DEFAULT '0',
  `Enable_Comments` tinyint(1) NOT NULL DEFAULT '0',
  `Language` varchar(20) NOT NULL DEFAULT 'Spanish',
  `Pwd` varchar(40) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Post`),
  KEY `ID_User` (`ID_User`),
  KEY `ID_URL` (`ID_URL`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `muu_categories`;
CREATE TABLE IF NOT EXISTS `muu_categories` (
  `ID_Category` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Parent` tinyint(4) DEFAULT '0',
  `Title` varchar(90) DEFAULT NULL,
  `Slug` varchar(90) DEFAULT NULL,
  `Language` varchar(10) DEFAULT NULL,
  `Situation` varchar(15) DEFAULT 'Active',
  PRIMARY KEY (`ID_Category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Estructura de tabla para la tabla `muu_comments`
--

DROP TABLE IF EXISTS `muu_comments`;
CREATE TABLE IF NOT EXISTS `muu_comments` (
  `ID_Comment` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Comment` text NOT NULL,
  `Start_Date` int(11) NOT NULL,
  `Text_Date` varchar(40) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Website` varchar(80) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Comment`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_comments`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_configuration`
--

DROP TABLE IF EXISTS `muu_configuration`;
CREATE TABLE IF NOT EXISTS `muu_configuration` (
  `ID_Configuration` tinyint(1) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Slogan_English` varchar(100) NOT NULL,
  `Slogan_Spanish` varchar(100) NOT NULL,
  `Slogan_French` varchar(100) NOT NULL,
  `Slogan_Portuguese` varchar(100) NOT NULL,
  `URL` varchar(60) NOT NULL,
  `Lang` varchar(2) NOT NULL DEFAULT 'en',
  `Language` varchar(25) NOT NULL DEFAULT 'English',
  `Theme` varchar(25) NOT NULL DEFAULT 'ZanPHP',
  `Gallery` varchar(30) NOT NULL DEFAULT 'Basic',
  `Validation` varchar(15) NOT NULL DEFAULT 'Super Admin',
  `Application` varchar(30) NOT NULL DEFAULT 'Blog',
  `Message` text NOT NULL,
  `Activation` varchar(10) NOT NULL DEFAULT 'Nobody',
  `Email_Recieve` varchar(50) NOT NULL,
  `Email_Send` varchar(50) NOT NULL DEFAULT '@domain.com',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Configuration`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `muu_configuration`
--

INSERT INTO `muu_configuration` (`ID_Configuration`, `Name`, `Slogan_English`, `Slogan_Spanish`, `Slogan_French`, `Slogan_Portuguese`, `URL`, `Lang`, `Language`, `Theme`, `Gallery`, `Validation`, `Application`, `Message`, `Activation`, `Email_Recieve`, `Email_Send`, `Situation`) VALUES
(1, 'ZanPHP v.2.4.4', 'Framework', 'Framework', 'Framework', 'Framework', 'http://127.0.0.1/MuuCMS', 'es', 'Spanish', 'zanphp', '1', 'Inactive', 'blog', '<p>Regresamos pronto</p>', 'Admin', 'carlos@milkzoft.com', 'webmaster@milkzoft.com', 'Active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_feedback`
--

DROP TABLE IF EXISTS `muu_feedback`;
CREATE TABLE IF NOT EXISTS `muu_feedback` (
  `ID_Feedback` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(60) NOT NULL,
  `Company` varchar(50) NOT NULL,
  `Phone` varchar(16) NOT NULL,
  `City` varchar(50) NOT NULL,
  `Subject` varchar(200) NOT NULL,
  `Message` text NOT NULL,
  `Start_Date` int(11) NOT NULL,
  `Text_Date` varchar(60) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Inactive',
  PRIMARY KEY (`ID_Feedback`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_feedback`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_links`
--

DROP TABLE IF EXISTS `muu_links`;
CREATE TABLE IF NOT EXISTS `muu_links` (
  `ID_Link` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(50) NOT NULL,
  `URL` varchar(100) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Follow` tinyint(1) NOT NULL DEFAULT '1',
  `Position` varchar(10) NOT NULL DEFAULT 'Web Friend',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Link`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Estructura de tabla para la tabla `muu_logs`
--

DROP TABLE IF EXISTS `muu_logs`;
CREATE TABLE IF NOT EXISTS `muu_logs` (
  `ID_Log` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Record` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Table_Name` varchar(50) NOT NULL,
  `Activity` varchar(100) NOT NULL,
  `Query` text NOT NULL,
  `Start_Date` datetime NOT NULL,
  PRIMARY KEY (`ID_Log`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_logs`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_mural`
--

DROP TABLE IF EXISTS `muu_mural`;
CREATE TABLE IF NOT EXISTS `muu_mural` (
  `ID_Mural` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Post` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Title` varchar(200) NOT NULL,
  `URL` varchar(250) NOT NULL,
  `Image` varchar(250) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Mural`),
  KEY `ID_Post` (`ID_Post`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_mural`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_pages`
--

DROP TABLE IF EXISTS `muu_pages`;
CREATE TABLE IF NOT EXISTS `muu_pages` (
  `ID_Page` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Translation` mediumint(8) NOT NULL DEFAULT '0',
  `Title` varchar(100) NOT NULL,
  `Slug` varchar(100) NOT NULL,
  `Content` text NOT NULL,
  `Views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Language` varchar(20) NOT NULL,
  `Principal` tinyint(1) NOT NULL DEFAULT '0',
  `Start_Date` int(11) NOT NULL,
  `Text_Date` varchar(40) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Page`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Estructura de tabla para la tabla `muu_privileges`
--

DROP TABLE IF EXISTS `muu_privileges`;
CREATE TABLE IF NOT EXISTS `muu_privileges` (
  `ID_Privilege` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Privilege` varchar(25) NOT NULL DEFAULT 'Member',
  PRIMARY KEY (`ID_Privilege`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `muu_privileges`
--

INSERT INTO `muu_privileges` (`ID_Privilege`, `Privilege`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'Moderator'),
(4, 'Member');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_re_categories_applications`
--

DROP TABLE IF EXISTS `muu_re_categories_applications`;
CREATE TABLE IF NOT EXISTS `muu_re_categories_applications` (
  `ID_Category2Application` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Application` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Category` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Category2Application`),
  KEY `ID_Application` (`ID_Application`),
  KEY `ID_Category` (`ID_Category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Estructura de tabla para la tabla `muu_re_categories_records`
--

DROP TABLE IF EXISTS `muu_re_categories_records`;
CREATE TABLE IF NOT EXISTS `muu_re_categories_records` (
  `ID_Category2Application` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Record` mediumint(8) unsigned NOT NULL DEFAULT '0',
  KEY `ID_Category2Application` (`ID_Category2Application`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `muu_re_comments_applications`
--

DROP TABLE IF EXISTS `muu_re_comments_applications`;
CREATE TABLE IF NOT EXISTS `muu_re_comments_applications` (
  `ID_Comment2Application` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Application` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Comment` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Comment2Application`),
  KEY `ID_Application` (`ID_Application`),
  KEY `ID_Comment` (`ID_Comment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_re_comments_applications`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_re_comments_records`
--

DROP TABLE IF EXISTS `muu_re_comments_records`;
CREATE TABLE IF NOT EXISTS `muu_re_comments_records` (
  `ID_Comment2Application` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Record` mediumint(8) unsigned NOT NULL DEFAULT '0',
  KEY `ID_Comment2Application` (`ID_Comment2Application`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `muu_re_comments_records`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_re_permissions_privileges`
--

DROP TABLE IF EXISTS `muu_re_permissions_privileges`;
CREATE TABLE IF NOT EXISTS `muu_re_permissions_privileges` (
  `ID_Privilege` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_Application` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Adding` tinyint(1) NOT NULL DEFAULT '0',
  `Deleting` tinyint(1) NOT NULL DEFAULT '0',
  `Editing` tinyint(1) NOT NULL DEFAULT '0',
  `Viewing` tinyint(1) NOT NULL DEFAULT '0',
  KEY `ID_Privilege` (`ID_Privilege`),
  KEY `ID_Application` (`ID_Application`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `muu_re_permissions_privileges`
--

INSERT INTO `muu_re_permissions_privileges` (`ID_Privilege`, `ID_Application`, `Adding`, `Deleting`, `Editing`, `Viewing`) VALUES
(1, 1, 1, 1, 1, 1),
(1, 2, 1, 1, 1, 1),
(1, 3, 1, 1, 1, 1),
(1, 4, 1, 1, 1, 1),
(1, 5, 1, 1, 1, 1),
(1, 6, 1, 1, 1, 1),
(1, 7, 1, 1, 1, 1),
(1, 8, 1, 1, 1, 1),
(1, 9, 1, 1, 1, 1),
(1, 10, 1, 1, 1, 1),
(1, 11, 1, 1, 1, 1),
(1, 12, 1, 1, 1, 1),
(1, 13, 1, 1, 1, 1),
(1, 14, 1, 1, 1, 1),
(1, 15, 1, 1, 1, 1),
(1, 16, 1, 1, 1, 1),
(1, 17, 1, 1, 1, 1),
(1, 18, 1, 1, 1, 1),
(1, 19, 1, 1, 1, 1),
(1, 20, 1, 1, 1, 1),
(2, 1, 1, 1, 1, 1),
(2, 2, 0, 0, 0, 0),
(2, 3, 1, 1, 1, 1),
(2, 4, 1, 1, 1, 1),
(2, 5, 0, 0, 0, 0),
(2, 6, 0, 0, 0, 0),
(2, 7, 0, 0, 0, 1),
(2, 8, 1, 1, 1, 1),
(2, 9, 1, 1, 1, 1),
(2, 10, 1, 1, 1, 1),
(2, 11, 1, 0, 1, 1),
(2, 12, 1, 1, 1, 1),
(2, 13, 1, 0, 0, 0),
(2, 14, 1, 1, 1, 1),
(2, 15, 1, 1, 1, 1),
(2, 16, 1, 1, 1, 1),
(2, 17, 1, 1, 1, 1),
(2, 18, 1, 1, 1, 1),
(2, 19, 1, 1, 1, 1),
(2, 20, 1, 1, 1, 1),
(3, 1, 0, 0, 0, 0),
(3, 2, 0, 0, 0, 0),
(3, 3, 1, 0, 0, 1),
(3, 4, 1, 0, 0, 0),
(3, 5, 0, 0, 0, 0),
(3, 6, 0, 0, 0, 0),
(3, 7, 0, 0, 0, 0),
(3, 8, 1, 0, 0, 1),
(3, 9, 0, 0, 0, 0),
(3, 10, 0, 0, 0, 0),
(3, 11, 1, 0, 0, 1),
(3, 12, 0, 0, 0, 0),
(3, 13, 0, 0, 0, 0),
(3, 14, 0, 0, 0, 0),
(3, 15, 1, 0, 0, 1),
(3, 16, 1, 0, 0, 1),
(3, 17, 0, 0, 0, 0),
(3, 18, 1, 0, 0, 1),
(3, 19, 0, 0, 0, 0),
(3, 20, 0, 0, 0, 0),
(4, 1, 0, 0, 0, 0),
(4, 2, 0, 0, 0, 0),
(4, 3, 0, 0, 0, 0),
(4, 4, 0, 0, 0, 0),
(4, 5, 0, 0, 0, 0),
(4, 6, 0, 0, 0, 0),
(4, 7, 0, 0, 0, 0),
(4, 8, 0, 0, 0, 0),
(4, 9, 0, 0, 0, 0),
(4, 10, 0, 0, 0, 0),
(4, 11, 0, 0, 0, 0),
(4, 12, 0, 0, 0, 0),
(4, 13, 0, 0, 0, 0),
(4, 14, 0, 0, 0, 0),
(4, 15, 0, 0, 0, 0),
(4, 16, 0, 0, 0, 0),
(4, 17, 0, 0, 0, 0),
(4, 18, 0, 0, 0, 0),
(4, 19, 0, 0, 0, 0),
(4, 19, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_re_privileges_users`
--

DROP TABLE IF EXISTS `muu_re_privileges_users`;
CREATE TABLE IF NOT EXISTS `muu_re_privileges_users` (
  `ID_Privilege` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  KEY `ID_Privilege` (`ID_Privilege`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `muu_re_privileges_users`
--

INSERT INTO `muu_re_privileges_users` (`ID_Privilege`, `ID_User`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_re_tags_applications`
--

DROP TABLE IF EXISTS `muu_re_tags_applications`;
CREATE TABLE IF NOT EXISTS `muu_re_tags_applications` (
  `ID_Tag2Application` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_Application` mediumint(8) unsigned NOT NULL,
  `ID_Tag` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`ID_Tag2Application`),
  KEY `ID_Application` (`ID_Application`),
  KEY `ID_Tag` (`ID_Tag`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_re_tags_records`
--

DROP TABLE IF EXISTS `muu_re_tags_records`;
CREATE TABLE IF NOT EXISTS `muu_re_tags_records` (
  `ID_Tag2Application` mediumint(8) unsigned NOT NULL,
  `ID_Record` mediumint(8) unsigned NOT NULL,
  KEY `ID_Tag2Application` (`ID_Tag2Application`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_tags`
--

DROP TABLE IF EXISTS `muu_tags`;
CREATE TABLE IF NOT EXISTS `muu_tags` (
  `ID_Tag` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) NOT NULL,
  `Slug` varchar(255) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Acitve',
  PRIMARY KEY (`ID_Tag`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Estructura de tabla para la tabla `muu_tokens`
--

DROP TABLE IF EXISTS `muu_tokens`;
CREATE TABLE IF NOT EXISTS `muu_tokens` (
  `ID_Token` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Token` varchar(40) NOT NULL,
  `Action` varchar(50) NOT NULL,
  `Start_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `End_Date` int(11) unsigned NOT NULL DEFAULT '0',
  `Situation` varchar(10) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_Token`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_tokens`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_url`
--

DROP TABLE IF EXISTS `muu_url`;
CREATE TABLE IF NOT EXISTS `muu_url` (
  `ID_URL` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `URL` varchar(255) NOT NULL,
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_URL`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Estructura de tabla para la tabla `muu_users`
--

DROP TABLE IF EXISTS `muu_users`;
CREATE TABLE IF NOT EXISTS `muu_users` (
  `ID_User` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `Username` varchar(30) NOT NULL,
  `Pwd` varchar(40) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `Website` varchar(100) NOT NULL,
  `Avatar` varchar(200) NOT NULL,
  `Rank` varchar(30) NOT NULL DEFAULT 'Member',
  `Sign` text NOT NULL,
  `Messages` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Recieve_Messages` tinyint(1) NOT NULL DEFAULT '1',
  `Topics` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Replies` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Visits` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Comments` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Subscribed` tinyint(1) NOT NULL DEFAULT '0',
  `Start_Date` int(11) NOT NULL,
  `Code` varchar(10) NOT NULL,
  `God` tinyint(1) NOT NULL DEFAULT '0',
  `Privilege` varchar(50) NOT NULL DEFAULT 'Member',
  `Type` varchar(30) NOT NULL DEFAULT 'Normal',
  `Situation` varchar(15) NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`ID_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_users`
--

INSERT INTO `muu_users` (`ID_User`, `Username`, `Pwd`, `Email`, `Website`, `Avatar`, `Rank`, `Sign`, `Messages`, `Recieve_Messages`, `Topics`, `Replies`, `Visits`, `Comments`, `Subscribed`, `Start_Date`, `Code`, `God`, `Privilege`, `Type`, `Situation`) VALUES
(1, 'admin', 'b9223847e1566884893656e84798ff39cea2b8c4', 'carlos@milkzoft.com', 'www.facebook.com', '', 'Administrator', '', 0, 0, 0, 0, 0, 0, 0, 1304740493, '3628FB9CC0', 1, 'Super Admin', 'Normal', 'Active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_users_information`
--

DROP TABLE IF EXISTS `muu_users_information`;
CREATE TABLE IF NOT EXISTS `muu_users_information` (
  `ID_User_Information` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ID_User` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `Name` varchar(60) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Company` varchar(50) NOT NULL,
  `Gender` varchar(20) NOT NULL,
  `Birthday` varchar(20) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `District` varchar(50) NOT NULL,
  `Town` varchar(50) NOT NULL,
  `Facebook` varchar(100) NOT NULL,
  `Twitter` varchar(100) NOT NULL,
  `Linkedin` varchar(150) NOT NULL,
  `Google` varchar(150) NOT NULL,
  PRIMARY KEY (`ID_User_Information`),
  KEY `ID_User` (`ID_User`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `muu_users_information`
--

INSERT INTO `muu_users_information` (`ID_User_Information`, `ID_User`, `Name`, `Phone`, `Company`, `Gender`, `Birthday`, `Country`, `District`, `Town`, `Facebook`, `Twitter`, `Linkedin`, `Google`) VALUES
(1, 1, 'admin', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_users_online`
--

DROP TABLE IF EXISTS `muu_users_online`;
CREATE TABLE IF NOT EXISTS `muu_users_online` (
  `User` varchar(20) NOT NULL DEFAULT '',
  `Start_Date` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`User`),
  KEY `Date_Start` (`Start_Date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `muu_users_online`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `muu_users_online_anonymous`
--

DROP TABLE IF EXISTS `muu_users_online_anonymous`;
CREATE TABLE IF NOT EXISTS `muu_users_online_anonymous` (
  `IP` varchar(20) NOT NULL DEFAULT '',
  `Start_Date` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`IP`),
  KEY `Date_Start` (`Start_Date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `muu_users_online_anonymous`
--


--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `muu_blog`
--
ALTER TABLE `muu_blog`
  ADD CONSTRAINT `muu_blog_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `muu_blog_ibfk_2` FOREIGN KEY (`ID_URL`) REFERENCES `muu_url` (`ID_URL`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_links`
--
ALTER TABLE `muu_links`
  ADD CONSTRAINT `muu_links_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_logs`
--
ALTER TABLE `muu_logs`
  ADD CONSTRAINT `muu_logs_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_pages`
--
ALTER TABLE `muu_pages`
  ADD CONSTRAINT `muu_pages_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_re_categories_records`
--
ALTER TABLE `muu_re_categories_records`
  ADD CONSTRAINT `muu_re_categories_records_ibfk_1` FOREIGN KEY (`ID_Category2Application`) REFERENCES `muu_re_categories_applications` (`ID_Category2Application`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_re_comments_records`
--
ALTER TABLE `muu_re_comments_records`
  ADD CONSTRAINT `muu_re_comments_records_ibfk_1` FOREIGN KEY (`ID_Comment2Application`) REFERENCES `muu_re_comments_applications` (`ID_Comment2Application`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_re_permissions_privileges`
--
ALTER TABLE `muu_re_permissions_privileges`
  ADD CONSTRAINT `muu_re_permissions_privileges_ibfk_1` FOREIGN KEY (`ID_Privilege`) REFERENCES `muu_privileges` (`ID_Privilege`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `muu_re_permissions_privileges_ibfk_2` FOREIGN KEY (`ID_Application`) REFERENCES `muu_applications` (`ID_Application`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_re_privileges_users`
--
ALTER TABLE `muu_re_privileges_users`
  ADD CONSTRAINT `muu_re_privileges_users_ibfk_1` FOREIGN KEY (`ID_Privilege`) REFERENCES `muu_privileges` (`ID_Privilege`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `muu_re_privileges_users_ibfk_2` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_re_tags_applications`
--
ALTER TABLE `muu_re_tags_applications`
  ADD CONSTRAINT `muu_re_tags_applications_ibfk_2` FOREIGN KEY (`ID_Tag`) REFERENCES `muu_tags` (`ID_Tag`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_re_tags_records`
--
ALTER TABLE `muu_re_tags_records`
  ADD CONSTRAINT `muu_re_tags_records_ibfk_1` FOREIGN KEY (`ID_Tag2Application`) REFERENCES `muu_re_tags_applications` (`ID_Tag2Application`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_tokens`
--
ALTER TABLE `muu_tokens`
  ADD CONSTRAINT `muu_tokens_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `muu_users_information`
--
ALTER TABLE `muu_users_information`
  ADD CONSTRAINT `muu_users_information_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `muu_users` (`ID_User`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `getCategories`$$
CREATE PROCEDURE `getCategories`()
BEGIN

    SELECT muu_re_categories_applications.ID_Category, ID_Application, ID_Parent, Title, Slug, Language, Situation FROM muu_re_categories_applications 

    INNER JOIN muu_categories 

            ON muu_categories.ID_Category = muu_re_categories_applications.ID_Category;

END$$

DROP PROCEDURE IF EXISTS `getCategoriesByApplication`$$
CREATE PROCEDURE `getCategoriesByApplication`(_Application VARCHAR(150), _Language VARCHAR(15))
BEGIN

  DECLARE _ID_Application MEDIUMINT(8);  

  IF(EXISTS(SELECT ID_Application FROM muu_applications WHERE Slug = _Application)) THEN

    SET _ID_Application = (SELECT ID_Application FROM muu_applications WHERE Slug = _Application);

    SELECT muu_re_categories_applications.ID_Category, Title, Slug, Language, Situation 

    FROM muu_re_categories_applications     

    INNER JOIN muu_categories ON muu_categories.ID_Category = muu_re_categories_applications.ID_Category

    WHERE muu_re_categories_applications.ID_Application = _ID_Application AND muu_categories.Language = _Language ORDER BY ID_Category DESC;

  END IF;

END$$

DROP PROCEDURE IF EXISTS `getCategoriesByRecord`$$
CREATE PROCEDURE `getCategoriesByRecord`(_ID_Application mediumint(8), _ID_Record mediumint(8))
BEGIN

    SELECT * FROM muu_categories WHERE muu_categories.ID_Category IN (

        SELECT muu_re_categories_applications.ID_Category FROM muu_re_categories_applications 

        WHERE muu_re_categories_applications.ID_Application = _ID_Application AND muu_re_categories_applications.ID_Category2Application IN (

            SELECT muu_re_categories_records.ID_Category2Application FROM muu_re_categories_records WHERE ID_Record = _ID_Record

        )

    );

END$$

DROP PROCEDURE IF EXISTS `getComments`$$
CREATE PROCEDURE `getComments`(_ID_Application mediumint(8), _ID_Record mediumint(8))
BEGIN

    IF (_ID_Record = 0) THEN

        SELECT * FROM muu_comments WHERE muu_comments.ID_Comment IN (

            SELECT muu_re_comments_applications.ID_Comment FROM muu_re_comments_applications 

            WHERE muu_re_comments_applications.ID_Application = _ID_Application 

        ) AND Situation = 'Inactive';

    ELSE    

        SELECT * FROM muu_comments WHERE muu_comments.ID_Comment IN (

            SELECT muu_re_comments_applications.ID_Comment FROM muu_re_comments_applications 

            WHERE muu_re_comments_applications.ID_Application = _ID_Application AND muu_re_comments_applications.ID_Comment2Application IN (

                SELECT muu_re_comments_records.ID_Comment2Application FROM muu_re_comments_records WHERE ID_Record = _ID_Record

            )

        );    

    END IF;

END$$

DROP PROCEDURE IF EXISTS `getFeedbackNotifications`$$
CREATE PROCEDURE `getFeedbackNotifications`()
BEGIN

    SELECT * FROM muu_feedback WHERE Situation != 'Read';

END$$

DROP PROCEDURE IF EXISTS `getLink`$$
CREATE PROCEDURE `getLink`(_ID_Link MEDIUMINT(8))
BEGIN

  DECLARE _ID_Category2Application MEDIUMINT(8);

  DECLARE _ID_Application MEDIUMINT(8);

  DECLARE _ID_Category MEDIUMINT(8);

  SET _ID_Application = (SELECT ID_Application FROM muu_applications WHERE Slug = 'links');

  SELECT muu_links.*,  muu_categories.ID_Category FROM muu_links

  LEFT JOIN 

  muu_categories ON muu_categories.ID_Category = 

  (SELECT ID_Category FROM muu_re_categories_applications WHERE ID_Category2Application = 

  (SELECT ID_Category2Application FROM muu_re_categories_records WHERE ID_Record = _ID_Link) AND ID_Application = _ID_Application)

  WHERE ID_Link = _ID_Link;

END$$

DROP PROCEDURE IF EXISTS `getTags`$$
CREATE PROCEDURE `getTags`(_ID_Application mediumint(8), _ID_Record mediumint(8))
BEGIN

    SELECT * FROM muu_tags WHERE muu_tags.ID_Tag IN (

        SELECT muu_re_tags_applications.ID_Tag FROM muu_re_tags_applications 

        WHERE muu_re_tags_applications.ID_Application = _ID_Application AND muu_re_tags_applications.ID_Tag2Application IN (

            SELECT muu_re_tags_records.ID_Tag2Application FROM muu_re_tags_records WHERE ID_Record = _ID_Record

        )

    );

END$$

DROP PROCEDURE IF EXISTS `getTagsByRecord`$$
CREATE PROCEDURE `getTagsByRecord`(_ID_Application mediumint(8), _ID_Record mediumint(8))
BEGIN
    SELECT * FROM muu_tags WHERE muu_tags.ID_Tag IN (
        SELECT muu_re_tags_applications.ID_Tag FROM muu_re_tags_applications 
        WHERE muu_re_tags_applications.ID_Application = _ID_Application AND muu_re_tags_applications.ID_Tag2Application IN (
            SELECT muu_re_tags_records.ID_Tag2Application FROM muu_re_tags_records WHERE ID_Record = _ID_Record
        )
    );
END$$

DROP PROCEDURE IF EXISTS `getUser`$$
CREATE PROCEDURE `getUser`(_ID_User mediumint(8))
BEGIN

  SELECT muu_users.*, muu_re_privileges_users.ID_Privilege FROM muu_users, muu_re_privileges_users WHERE muu_users.ID_User = _ID_User and muu_re_privileges_users.ID_User = _ID_User;

END$$

DROP PROCEDURE IF EXISTS `setCategory`$$
CREATE PROCEDURE `setCategory`(

_Title VARCHAR(90),

_Slug VARCHAR(90),

_Language VARCHAR(10),

_Situation VARCHAR(15)

)
BEGIN

  IF(NOT EXISTS(SELECT ID_Category FROM muu_categories WHERE Title = _Title AND Language = _Language)) THEN

    INSERT INTO muu_categories (Title, Slug, Language, Situation) VALUES (_Title, _Slug, _Language, _Situation);

    SELECT LAST_INSERT_ID() as ID_Category;

  ELSE

    SELECT ID_Category FROM muu_categories WHERE Title = _Title;

  END IF;

END$$

DROP PROCEDURE IF EXISTS `setUser`$$
CREATE PROCEDURE `setUser`(

_Username VARCHAR(30),

_Pwd VARCHAR(40),

_Email VARCHAR(45),

_Start_Date INT(11),

_Code VARCHAR(10),

_Situation VARCHAR(15),

_ID_Privilege MEDIUMINT(8)

)
BEGIN

  DECLARE _Last_ID MEDIUMINT(8);



  IF(EXISTS(SELECT ID_User FROM muu_users WHERE Email = _Email)) THEN

    SELECT TRUE as Email_Exists;

  ELSEIF(EXISTS(SELECT ID_User FROM muu_users WHERE Username = _Username)) THEN

    SELECT TRUE as Username_Exists;

  ELSE

    INSERT INTO muu_users (Username, Pwd, Email, Start_Date, Code, Situation) VALUES (_Username, _Pwd, _Email, _Start_Date, _Code, _Situation);

    SET _LAST_ID = LAST_INSERT_ID();

    INSERT INTO muu_re_privileges_users (ID_Privilege, ID_User) VALUES (_ID_Privilege, _LAST_ID);

    INSERT INTO muu_users_information (ID_User) VALUES (_LAST_ID);

    SELECT _LAST_ID as ID_User;

  END IF;

END$$

DELIMITER ;