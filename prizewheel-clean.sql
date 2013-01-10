/*
SQLyog Ultimate v9.20 
MySQL - 5.1.50-community : Database - prizewheel_mvc
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`prizewheel_mvc` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `prizewheel_mvc`;

/*Table structure for table `advertisement_categories` */

DROP TABLE IF EXISTS `advertisement_categories`;

CREATE TABLE `advertisement_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `description` text,
  `clickrate` float NOT NULL DEFAULT '0',
  `impressionrate` float NOT NULL DEFAULT '0',
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `advertisement_categories` */

/*Table structure for table `advertisement_category_entries` */

DROP TABLE IF EXISTS `advertisement_category_entries`;

CREATE TABLE `advertisement_category_entries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `advertisementcategoryid` int(10) unsigned NOT NULL,
  `advertisementid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `advertisement_category_entries` */

/*Table structure for table `advertisement_clicks` */

DROP TABLE IF EXISTS `advertisement_clicks`;

CREATE TABLE `advertisement_clicks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `prizewheelid` int(10) unsigned NOT NULL,
  `facebookuserid` varchar(100) NOT NULL,
  `advertisementid` int(11) NOT NULL,
  `createdatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `advertisement_clicks` */

/*Table structure for table `advertisement_impressions` */

DROP TABLE IF EXISTS `advertisement_impressions`;

CREATE TABLE `advertisement_impressions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `prizewheelid` int(10) unsigned NOT NULL,
  `facebookuserid` varchar(100) NOT NULL,
  `advertisementid` int(11) NOT NULL,
  `createdatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `advertisement_impressions` */

/*Table structure for table `advertisement_placement_types` */

DROP TABLE IF EXISTS `advertisement_placement_types`;

CREATE TABLE `advertisement_placement_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `advertisement_placement_types` */

insert  into `advertisement_placement_types`(`id`,`name`,`description`) values (1,'Prize Wheel','Prize Wheel'),(2,'Sponser','Sponser');

/*Table structure for table `advertisement_types` */

DROP TABLE IF EXISTS `advertisement_types`;

CREATE TABLE `advertisement_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `advertisement_types` */

insert  into `advertisement_types`(`id`,`name`,`description`) values (1,'Impression','Impression'),(2,'Click','Click');

/*Table structure for table `advertisements` */

DROP TABLE IF EXISTS `advertisements`;

CREATE TABLE `advertisements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `advertisementplacementtypeid` int(11) NOT NULL DEFAULT '1',
  `advertiserid` int(10) unsigned NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text,
  `typeid` int(11) NOT NULL,
  `bannerimage` varchar(150) NOT NULL,
  `sponserimage` varchar(150) NOT NULL,
  `url` varchar(300) NOT NULL,
  `bucket` decimal(15,2) NOT NULL DEFAULT '0.00',
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `createdatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `advertisements` */

/*Table structure for table `advertisers` */

DROP TABLE IF EXISTS `advertisers`;

CREATE TABLE `advertisers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `facebookuserid` varchar(255) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `address1` varchar(150) NOT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(150) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(200) NOT NULL,
  `postal` varchar(50) DEFAULT NULL,
  `telephone` varchar(100) NOT NULL,
  `emailaddress` varchar(255) NOT NULL,
  `createdatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `advertisers` */

/*Table structure for table `affiliate_payout_entries` */

DROP TABLE IF EXISTS `affiliate_payout_entries`;

CREATE TABLE `affiliate_payout_entries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `affiliateid` int(10) unsigned NOT NULL,
  `amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `payoutmethod` varchar(150) NOT NULL,
  `messages` text,
  `claimedstatus` varchar(150) NOT NULL,
  `transactionid` varchar(150) NOT NULL,
  `uniqueid` varchar(255) NOT NULL,
  `createdatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `affiliate_payout_entries` */

/*Table structure for table `affiliates` */

DROP TABLE IF EXISTS `affiliates`;

CREATE TABLE `affiliates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `facebookuserid` varchar(255) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `address1` varchar(150) NOT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(150) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(200) NOT NULL,
  `postal` varchar(50) DEFAULT NULL,
  `telephone` varchar(100) NOT NULL,
  `emailaddress` varchar(255) NOT NULL,
  `createdatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `affiliates` */

/*Table structure for table `configuration_entries` */

DROP TABLE IF EXISTS `configuration_entries`;

CREATE TABLE `configuration_entries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `configuration_entries` */

insert  into `configuration_entries`(`id`,`name`,`value`) values (1,'affiliate payout rate','0.05'),(2,'paypal button code','<form action=\"https://www.sandbox.paypal.com/cgi-bin/webscr\" method=\"post\" id=\"paypal\">\r\n<input type=\"hidden\" name=\"cmd\" value=\"_s-xclick\">\r\n<input type=\"hidden\" name=\"hosted_button_id\" value=\"C46X84T6UQMZU\">\r\n<table>\r\n<tr><td><input type=\"hidden\" name=\"on0\" value=\"bucket-deposit\">bucket-deposit</td></tr><tr><td><select name=\"os0\">\r\n	<option value=\"$25.00 Bucket Deposit\">$25.00 Bucket Deposit $25.00 USD</option>\r\n	<option value=\"$50.00 Bucket Deposit\">$50.00 Bucket Deposit $50.00 USD</option>\r\n	<option value=\"$100.00 Bucket Deposit\">$100.00 Bucket Deposit $100.00 USD</option>\r\n	<option value=\"$250.00 Bucket Deposit\">$250.00 Bucket Deposit $250.00 USD</option>\r\n	<option value=\"$500.00 Bucket Deposit\">$500.00 Bucket Deposit $500.00 USD</option>\r\n</select> </td></tr>\r\n</table>\r\n<input type=\"hidden\" name=\"currency_code\" value=\"USD\">\r\n<input type=\"image\" src=\"https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif\" border=\"0\" name=\"submit\" alt=\"PayPal - The safer, easier way to pay online!\">\r\n<img alt=\"\" border=\"0\" src=\"https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif\" width=\"1\" height=\"1\">\r\n</form>'),(3,'paypal api username','mike_1351267371_biz_api1.devinformatics.com'),(4,'paypal api password','1351267390'),(5,'paypal api signature','AFcWxV21C7fd0v3bYYYRCpSSRl31A9hW-nWAAhoESXgYhfCQ-FsBDa-K'),(6,'paypal subscribe button',NULL),(7,'paypal unsubscribe button',NULL);

/*Table structure for table `prizewheel_category_entries` */

DROP TABLE IF EXISTS `prizewheel_category_entries`;

CREATE TABLE `prizewheel_category_entries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `prizewheelid` int(10) unsigned NOT NULL,
  `advertisementcategoryid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `prizewheel_category_entries` */

/*Table structure for table `prizewheel_entries` */

DROP TABLE IF EXISTS `prizewheel_entries`;

CREATE TABLE `prizewheel_entries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `prizewheelid` int(10) unsigned NOT NULL,
  `facebookuserid` varchar(100) NOT NULL,
  `firstname` varchar(150) NOT NULL,
  `lastname` varchar(150) NOT NULL,
  `emailaddress` varchar(300) NOT NULL,
  `telephone` varchar(150) NOT NULL,
  `ipaddress` varchar(100) NOT NULL,
  `playtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `prize` varchar(50) NOT NULL,
  `exported` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `prizewheel_entries` */

/*Table structure for table `prizewheel_entry_category_entries` */

DROP TABLE IF EXISTS `prizewheel_entry_category_entries`;

CREATE TABLE `prizewheel_entry_category_entries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `prizewheelentryid` bigint(20) unsigned NOT NULL,
  `advertisementcategoryid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `prizewheel_entry_category_entries` */

/*Table structure for table `prizewheel_impressions` */

DROP TABLE IF EXISTS `prizewheel_impressions`;

CREATE TABLE `prizewheel_impressions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `prizewheelid` int(10) unsigned NOT NULL,
  `facebookuserid` varchar(100) NOT NULL,
  `createdatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `prizewheel_impressions` */

/*Table structure for table `prizewheel_types` */

DROP TABLE IF EXISTS `prizewheel_types`;

CREATE TABLE `prizewheel_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `prizewheel_types` */

insert  into `prizewheel_types`(`id`,`name`,`description`) values (1,'Ad-Driven','Ad-Driven'),(2,'Personalized','Personalized');

/*Table structure for table `prizewheels` */

DROP TABLE IF EXISTS `prizewheels`;

CREATE TABLE `prizewheels` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `prizewheeltypeid` int(11) NOT NULL DEFAULT '0',
  `pageid` varchar(100) NOT NULL,
  `affiliateid` int(10) unsigned NOT NULL,
  `forcelike` tinyint(1) NOT NULL DEFAULT '0',
  `forcelikeimage` varchar(255) DEFAULT NULL,
  `firsttext` varchar(500) DEFAULT NULL,
  `validemail` varchar(500) DEFAULT NULL,
  `alreadyplayed` varchar(500) DEFAULT NULL,
  `errorsubmit` varchar(500) DEFAULT NULL,
  `errorprize` varchar(500) DEFAULT NULL,
  `accesserror` varchar(500) DEFAULT NULL,
  `accesslimit` varchar(500) DEFAULT NULL,
  `textrules` varchar(500) DEFAULT NULL,
  `prizeonename` varchar(50) NOT NULL,
  `prizeonecode` varchar(50) NOT NULL,
  `prizeonetext` varchar(50) NOT NULL,
  `prizeonetextsize` int(11) NOT NULL DEFAULT '10',
  `prizeoneimage` varchar(300) DEFAULT NULL,
  `prizeoneurl` varchar(500) NOT NULL,
  `prizeoneweight` int(11) NOT NULL DEFAULT '0',
  `prizetwoname` varchar(50) NOT NULL,
  `prizetwocode` varchar(50) NOT NULL,
  `prizetwotext` varchar(50) NOT NULL,
  `prizetwotextsize` int(11) NOT NULL DEFAULT '10',
  `prizetwoimage` varchar(300) DEFAULT NULL,
  `prizetwourl` varchar(500) NOT NULL,
  `prizetwoweight` int(11) NOT NULL DEFAULT '0',
  `prizethreename` varchar(50) NOT NULL,
  `prizethreecode` varchar(50) NOT NULL,
  `prizethreetext` varchar(50) NOT NULL,
  `prizethreetextsize` int(11) NOT NULL DEFAULT '10',
  `prizethreeimage` varchar(300) DEFAULT NULL,
  `prizethreeurl` varchar(500) NOT NULL,
  `prizethreeweight` int(11) NOT NULL DEFAULT '0',
  `prizefourname` varchar(50) NOT NULL,
  `prizefourcode` varchar(50) NOT NULL,
  `prizefourtext` varchar(50) NOT NULL,
  `prizefourtextsize` int(10) NOT NULL,
  `prizefourimage` varchar(300) DEFAULT NULL,
  `prizefoururl` varchar(500) NOT NULL,
  `prizefourweight` int(11) NOT NULL DEFAULT '0',
  `prizefivename` varchar(50) NOT NULL,
  `prizefivecode` varchar(50) NOT NULL,
  `prizefivetext` varchar(50) NOT NULL,
  `prizefivetextsize` int(11) NOT NULL DEFAULT '10',
  `prizefiveimage` varchar(300) DEFAULT NULL,
  `prizefiveurl` varchar(500) NOT NULL,
  `prizefiveweight` int(11) NOT NULL DEFAULT '0',
  `prizesixname` varchar(50) NOT NULL,
  `prizesixcode` varchar(50) NOT NULL,
  `prizesixtext` varchar(50) NOT NULL,
  `prizesixtextsize` int(11) NOT NULL DEFAULT '10',
  `prizesiximage` varchar(300) DEFAULT NULL,
  `prizesixurl` varchar(500) NOT NULL,
  `prizesixweight` int(11) NOT NULL DEFAULT '0',
  `prizesevenname` varchar(50) NOT NULL,
  `prizesevencode` varchar(50) NOT NULL,
  `prizeseventext` varchar(50) NOT NULL,
  `prizeseventextsize` int(11) NOT NULL DEFAULT '10',
  `prizesevenimage` varchar(300) DEFAULT NULL,
  `prizesevenurl` varchar(500) NOT NULL,
  `prizesevenweight` int(11) NOT NULL DEFAULT '0',
  `prizeeightname` varchar(50) NOT NULL,
  `prizeeightcode` varchar(50) NOT NULL,
  `prizeeighttext` varchar(50) NOT NULL,
  `prizeeighttextsize` int(11) NOT NULL DEFAULT '10',
  `prizeeightimage` varchar(300) DEFAULT NULL,
  `prizeeighturl` varchar(500) NOT NULL,
  `prizeeightweight` int(11) NOT NULL,
  `prizeninename` varchar(50) NOT NULL,
  `prizeninecode` varchar(50) NOT NULL,
  `prizeninetext` varchar(50) NOT NULL,
  `prizeninetextsize` int(11) NOT NULL DEFAULT '10',
  `prizenineimage` varchar(300) DEFAULT NULL,
  `prizenineurl` varchar(500) NOT NULL,
  `prizenineweight` int(11) NOT NULL DEFAULT '0',
  `prizetenname` varchar(50) NOT NULL,
  `prizetencode` varchar(50) NOT NULL,
  `prizetentext` varchar(50) NOT NULL,
  `prizetentextsize` int(11) NOT NULL DEFAULT '10',
  `prizetenimage` varchar(300) DEFAULT NULL,
  `prizetenurl` varchar(500) NOT NULL,
  `prizetenweight` int(11) NOT NULL DEFAULT '0',
  `prizeelevenname` varchar(50) NOT NULL,
  `prizeelevencode` varchar(50) NOT NULL,
  `prizeeleventext` varchar(50) NOT NULL,
  `prizeeleventextsize` int(11) NOT NULL DEFAULT '10',
  `prizeelevenimage` varchar(300) DEFAULT NULL,
  `prizeelevenurl` varchar(500) NOT NULL,
  `prizeelevenweight` int(11) NOT NULL DEFAULT '0',
  `prizetwelvename` varchar(50) NOT NULL,
  `prizetwelvecode` varchar(50) NOT NULL,
  `prizetwelvetext` varchar(50) NOT NULL,
  `prizetwelvetextsize` int(11) NOT NULL DEFAULT '10',
  `prizetwelveimage` varchar(300) DEFAULT NULL,
  `prizetwelveurl` varchar(500) NOT NULL,
  `prizetwelveweight` int(11) NOT NULL DEFAULT '0',
  `sponserimage` varchar(300) DEFAULT NULL,
  `sponserlink` varchar(500) DEFAULT NULL,
  `backimage` varchar(300) DEFAULT NULL,
  `topimage` varchar(300) DEFAULT NULL,
  `buttonimage` varchar(300) DEFAULT NULL,
  `sendemailnotifications` tinyint(1) NOT NULL DEFAULT '0',
  `notificationemailaddress` varchar(300) DEFAULT NULL,
  `smtpserver` varchar(100) DEFAULT NULL,
  `smtpusername` varchar(150) DEFAULT NULL,
  `smtppassword` varchar(50) DEFAULT NULL,
  `smtpport` int(11) DEFAULT '25',
  `smtpfromaddress` varchar(300) DEFAULT NULL,
  `smtpencryption` varchar(50) DEFAULT 'none',
  `smtpauthmethod` varchar(50) DEFAULT 'plain',
  `notificationemailsubject` varchar(300) DEFAULT NULL,
  `notificationemailbody` longtext,
  `ipaddressfilter` tinyint(1) NOT NULL DEFAULT '0',
  `phonefilter` tinyint(1) NOT NULL DEFAULT '0',
  `emailfilter` tinyint(1) NOT NULL DEFAULT '0',
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `createdatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paidexpiration` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `prizewheels` */

/*Table structure for table `subscription_transactions` */

DROP TABLE IF EXISTS `subscription_transactions`;

CREATE TABLE `subscription_transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subscriptionid` varchar(255) NOT NULL,
  `prizewheelid` bigint(20) unsigned NOT NULL,
  `transactionstatusid` int(11) NOT NULL DEFAULT '4',
  `firstname` varchar(150) DEFAULT NULL,
  `lastname` varchar(150) DEFAULT NULL,
  `telephone` varchar(100) DEFAULT NULL,
  `emailaddress` varchar(300) DEFAULT NULL,
  `address1` varchar(150) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(150) DEFAULT NULL,
  `state` varchar(150) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  `postal` varchar(100) DEFAULT NULL,
  `cardfirstfour` varchar(4) DEFAULT NULL,
  `cardlastfour` varchar(4) DEFAULT NULL,
  `cardexpmonth` varchar(2) DEFAULT NULL,
  `cardexpyear` varchar(4) DEFAULT NULL,
  `processor` varchar(150) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `paymentid` varchar(150) NOT NULL,
  `status` varchar(150) NOT NULL,
  `memo` text,
  `ipaddress` varchar(100) NOT NULL,
  `createdatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `subscription_transactions` */

/*Table structure for table `transactions` */

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `advertisementid` bigint(20) unsigned NOT NULL,
  `transactionstatusid` int(11) NOT NULL DEFAULT '4',
  `firstname` varchar(150) DEFAULT NULL,
  `lastname` varchar(150) DEFAULT NULL,
  `telephone` varchar(100) DEFAULT NULL,
  `emailaddress` varchar(300) DEFAULT NULL,
  `address1` varchar(150) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `city` varchar(150) DEFAULT NULL,
  `state` varchar(150) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  `postal` varchar(100) DEFAULT NULL,
  `cardfirstfour` varchar(4) DEFAULT NULL,
  `cardlastfour` varchar(4) DEFAULT NULL,
  `cardexpmonth` varchar(2) DEFAULT NULL,
  `cardexpyear` varchar(4) DEFAULT NULL,
  `processor` varchar(150) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `paymentid` varchar(150) NOT NULL,
  `status` varchar(150) NOT NULL,
  `memo` text,
  `ipaddress` varchar(100) NOT NULL,
  `createdatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transactions` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`) values (1,'admin','81c4e7bc2868dc33329184258ed7a8d94995b4c361a9553424b443f87aa32d71BHU5hZBZLyKWbnq2UIGTadGOI3TwLUhcKTRLStlBNgI=');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
