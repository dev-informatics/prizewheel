/*
SQLyog Ultimate v9.20 
MySQL - 5.5.29 : Database - prizewheel
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`prizewheel` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `prizewheel`;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `advertisement_categories` */

insert  into `advertisement_categories`(`id`,`name`,`description`,`clickrate`,`impressionrate`,`enabled`) values (1,'Automobiles','Automobiles',1.5,0.75,1),(2,'Electronics','Electronics',1,0.6,1),(3,'Demo','Demo',1.55,0.75,1),(4,'Weight Loss','Weight Loss',1,0.02,1),(5,'Cell Phones','Cell Phones',0.75,0.02,1),(6,'Exercise','Exercise',0.55,0.02,1),(7,'Sex Pills','Sex Pills',1,0.03,1);

/*Table structure for table `advertisement_category_entries` */

DROP TABLE IF EXISTS `advertisement_category_entries`;

CREATE TABLE `advertisement_category_entries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `advertisementcategoryid` int(10) unsigned NOT NULL,
  `advertisementid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=latin1;

/*Data for the table `advertisement_category_entries` */

insert  into `advertisement_category_entries`(`id`,`advertisementcategoryid`,`advertisementid`) values (6,2,13),(12,1,16),(13,2,16),(25,1,18),(26,2,18),(33,1,14),(45,1,12),(46,2,12),(47,3,12),(63,1,20),(64,2,20),(65,3,20),(66,1,17),(67,2,17),(71,1,9),(72,2,9),(73,3,9),(74,2,15),(75,1,19),(76,2,19),(77,3,19);

/*Table structure for table `advertisement_clicks` */

DROP TABLE IF EXISTS `advertisement_clicks`;

CREATE TABLE `advertisement_clicks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `prizewheelid` int(10) unsigned NOT NULL,
  `facebookuserid` varchar(100) NOT NULL,
  `advertisementid` int(11) NOT NULL,
  `createdatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `advertisement_clicks` */

insert  into `advertisement_clicks`(`id`,`prizewheelid`,`facebookuserid`,`advertisementid`,`createdatetime`) values (1,2,'100000384651852',17,'2012-12-20 10:20:38'),(2,2,'100000384651852',16,'2012-12-20 10:21:14'),(3,2,'100000384651852',18,'2012-12-20 11:01:38'),(4,2,'100000384651852',13,'2012-12-20 11:05:21'),(5,3,'100000384651852',12,'2012-12-27 14:00:39'),(6,3,'100000384651852',14,'2012-12-31 11:57:36'),(7,4,'100004964763250',13,'2013-01-01 09:12:35'),(8,2,'100000384651852',19,'2013-01-02 15:45:25'),(9,6,'100004977903170',20,'2013-01-08 14:07:58'),(10,6,'100004977903170',14,'2013-01-08 14:13:35'),(11,6,'100004977903170',13,'2013-01-08 14:14:26'),(12,3,'100000384651852',9,'2013-01-10 10:07:21');

/*Table structure for table `advertisement_impressions` */

DROP TABLE IF EXISTS `advertisement_impressions`;

CREATE TABLE `advertisement_impressions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `prizewheelid` int(10) unsigned NOT NULL,
  `facebookuserid` varchar(100) NOT NULL,
  `advertisementid` int(11) NOT NULL,
  `createdatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*Data for the table `advertisement_impressions` */

insert  into `advertisement_impressions`(`id`,`prizewheelid`,`facebookuserid`,`advertisementid`,`createdatetime`) values (1,2,'100000384651852',17,'2012-12-20 10:20:25'),(2,2,'100000384651852',18,'2012-12-20 10:20:25'),(3,2,'100000384651852',13,'2012-12-20 10:20:25'),(4,2,'100000384651852',16,'2012-12-20 10:20:25'),(5,2,'100000384651852',15,'2012-12-20 10:21:31'),(6,2,'100000384651852',12,'2012-12-20 10:21:43'),(7,2,'100000384651852',14,'2012-12-26 16:38:07'),(8,3,'100000384651852',9,'2012-12-31 22:32:40'),(9,4,'100004964763250',12,'2013-01-01 09:11:16'),(10,4,'100004964763250',18,'2013-01-01 09:11:16'),(11,4,'100004964763250',16,'2013-01-01 09:11:16'),(12,4,'100004964763250',13,'2013-01-01 09:11:16'),(13,4,'100004964763250',17,'2013-01-01 09:11:29'),(14,4,'100004964763250',9,'2013-01-01 09:11:36'),(15,3,'100000384651852',19,'2013-01-02 11:01:32'),(16,3,'100000384651852',20,'2013-01-02 13:23:02'),(17,3,'100004964763250',20,'2013-01-02 14:45:52'),(18,6,'100004977903170',14,'2013-01-08 14:07:58'),(19,6,'100004977903170',19,'2013-01-08 14:08:05'),(20,6,'100004977903170',18,'2013-01-08 14:13:30'),(21,6,'100004977903170',13,'2013-01-08 14:13:30'),(22,6,'100004977903170',20,'2013-01-08 14:13:44'),(23,6,'100004977903170',17,'2013-01-08 14:14:26');

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `advertisements` */

insert  into `advertisements`(`id`,`advertisementplacementtypeid`,`advertiserid`,`name`,`description`,`typeid`,`bannerimage`,`sponserimage`,`url`,`bucket`,`enabled`,`createdatetime`) values (2,1,2,'Test','Test',1,'169021_158793174173150_153290324723435_348535_4336805_n.jpg','','','0.00',0,'0000-00-00 00:00:00'),(3,1,2,'Test','Test',1,'169021_158793174173150_153290324723435_348535_4336805_n.jpg','','','0.00',0,'0000-00-00 00:00:00'),(4,1,2,'Test','Test',1,'169021_158793174173150_153290324723435_348535_4336805_n.jpg','','','0.00',0,'2012-12-14 10:40:32'),(5,1,2,'fgdf','dgdfg',1,'81799881-106b-4964-aa2c-fd7dd2ed9fc0.jpg','','http://google.com/','0.00',0,'0000-00-00 00:00:00'),(6,2,2,'sdgfg','fdgdfg',1,'169021_158793174173150_153290324723435_348535_4336805_n.jpg','','http://google.com/','0.00',0,'0000-00-00 00:00:00'),(7,1,2,'dfgf','dgdfg',2,'amino2222caps.jpg','','http://news.com','25.00',1,'2012-12-14 10:21:17'),(8,1,2,'Bryan Test','Bryan Test',2,'81799881-106b-4964-aa2c-fd7dd2ed9fc0.jpg','','http://drudgereport.com','25.00',1,'2012-12-14 10:42:32'),(9,2,2,'Used Cars','Used Cars',2,'lambo-sm.png','atlas5_rc_big.jpg','http://auto.com','45.95',1,'2012-12-14 12:03:27'),(10,1,2,'ffdsf','sdfsdfsdfsdf',2,'b7ab5406ca3ec4ce618cf92ft9.jpg','','http://coolads.com','25.00',1,'2012-12-14 14:43:09'),(11,1,2,'New and Used Cars','New and Used Cars',1,'multi1.jpg','','http://newandusedcars.com','25.00',1,'2012-12-14 14:50:01'),(12,2,2,'Bob\'s Crap Cars Test','Bob\'s Crap Cars',1,'frontline.jpg','','http://bobs.biz','0.00',1,'2012-12-14 14:52:02'),(13,1,2,'This is a new one','This is a new one',1,'81799881-106b-4964-aa2c-fd7dd2ed9fc0.jpg','','http://drudgereport.com','22.60',1,'2012-12-17 11:58:20'),(14,2,2,'Type Test','Type Test',1,'lipodrene.png','','http://google.com','18.25',1,'2012-12-17 16:51:29'),(15,2,2,'Next Test','Next Test',1,'81799881-106b-4964-aa2c-fd7dd2ed9fc0.jpg','480x640_TREEESRED.jpg','http://google.com','23.20',1,'2012-12-17 16:55:29'),(16,1,2,'Number 15','Number 15 - 1',2,'8d63c76d-64ac-41ed-92da-d924a2998ee3.jpg','','http://number15.com','0.00',1,'2012-12-18 10:19:10'),(17,2,2,'Wheel','Wheel',1,'81799881-106b-4964-aa2c-fd7dd2ed9fc0.jpg','sleep.jpg','http://news.com','487.85',1,'2012-12-19 10:23:53'),(18,1,2,'New Ad','New Ad Testing again.',1,'proceedto_checkout.png','Sharing.jpg','http://bsnonline.net','431.10',1,'2012-12-19 13:58:18'),(19,1,3,'Test 2','Test',1,'headerlipodrene.gif','81799881-106b-4964-aa2c-fd7dd2ed9fc0.jpg','http://test.com','98.70',1,'2013-01-02 08:24:44'),(20,2,2,'Something','Something',1,'blastforcesample.jpg','lipodrene.png','http://news.com','-1.20',1,'2013-01-02 08:51:29');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `advertisers` */

insert  into `advertisers`(`id`,`facebookuserid`,`firstname`,`lastname`,`address1`,`address2`,`city`,`state`,`country`,`postal`,`telephone`,`emailaddress`,`createdatetime`,`enabled`) values (2,'100000384651852','Michael','Davidson','701 SW 60th TER','','Oklahoma City','OK','United States','73139','4053719894','realityenigma@hotmail.com','2012-12-26 16:00:45',1),(3,'100004964763250','Richard','Narayanansen','774 W 10th St','','Moore','OK','USA','73160','4057894561','richard@test.com','2013-01-01 09:15:55',1),(4,'100004969173305','James','Bushakstein','701 SW 60th TER','','Oklahoma City','OK','United States','73139','4053719894','realityenigma@hotmail.com','2013-01-08 16:00:32',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `affiliate_payout_entries` */

insert  into `affiliate_payout_entries`(`id`,`affiliateid`,`amount`,`payoutmethod`,`messages`,`claimedstatus`,`transactionid`,`uniqueid`,`createdatetime`) values (1,4,'0.30','paypal','Michael Davidson\'s Test Store','Unclaimed','1RC96853TR406870V','4|1357079494','2013-01-01 16:32:00'),(2,10,'0.05','paypal','Michael Davidson\'s Test Store','Unclaimed','4VP38964SD4654344','10|1357079494','2013-01-01 16:32:00');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `affiliates` */

insert  into `affiliates`(`id`,`facebookuserid`,`firstname`,`lastname`,`address1`,`address2`,`city`,`state`,`country`,`postal`,`telephone`,`emailaddress`,`createdatetime`,`enabled`) values (4,'100000384651852','Michael','Davidson','701 SW 60th TER','','Oklahoma City','OK','United States','73139','4053719894','janice_1351267256_per@devinformatics.com','2013-01-01 16:58:09',1),(9,'100000384651858','Janice','Davidson','701 SW 60th TER','','Oklahoma City','OK','United States','73139','4053719894','realityenigma@hotmail.com','2012-12-26 15:21:11',1),(10,'100004964763250','Richard','Narayanansen','774 W 10th St','','Moore','OK','USA','73160','4057894561','richard@test.com','2013-01-01 08:50:33',1),(11,'100004977903170','Dorothy','Baowitzmansenbergsteinskysonescu','77 W 105th Ave','','Oklahoma City','OK','USA','73159','4057861234','test@testing.com','2013-01-08 11:09:02',1),(12,'100004969173305','James','Bushakstein','dfsfdfs','sfdsd','sfdsdf','Oklahoma','USA','73139','4053719894','realityenigma@hotmail.com','2013-01-08 15:52:25',1);

/*Table structure for table `configuration_entries` */

DROP TABLE IF EXISTS `configuration_entries`;

CREATE TABLE `configuration_entries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `configuration_entries` */

insert  into `configuration_entries`(`id`,`name`,`value`) values (1,'affiliate payout rate','0.05'),(2,'paypal button code','<form action=\"https://www.sandbox.paypal.com/cgi-bin/webscr\" method=\"post\" id=\"paypal\">\r\n<input type=\"hidden\" name=\"cmd\" value=\"_s-xclick\">\r\n<input type=\"hidden\" name=\"hosted_button_id\" value=\"C46X84T6UQMZU\">\r\n<table>\r\n<tr><td><input type=\"hidden\" name=\"on0\" value=\"bucket-deposit\">bucket-deposit</td></tr><tr><td><select name=\"os0\">\r\n	<option value=\"$25.00 Bucket Deposit\">$25.00 Bucket Deposit $25.00 USD</option>\r\n	<option value=\"$50.00 Bucket Deposit\">$50.00 Bucket Deposit $50.00 USD</option>\r\n	<option value=\"$100.00 Bucket Deposit\">$100.00 Bucket Deposit $100.00 USD</option>\r\n	<option value=\"$250.00 Bucket Deposit\">$250.00 Bucket Deposit $250.00 USD</option>\r\n	<option value=\"$500.00 Bucket Deposit\">$500.00 Bucket Deposit $500.00 USD</option>\r\n</select> </td></tr>\r\n</table>\r\n<input type=\"hidden\" name=\"currency_code\" value=\"USD\">\r\n<input type=\"image\" src=\"https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif\" border=\"0\" name=\"submit\" alt=\"PayPal - The safer, easier way to pay online!\">\r\n<img alt=\"\" border=\"0\" src=\"https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif\" width=\"1\" height=\"1\">\r\n</form>'),(3,'paypal api username','mike_1351267371_biz_api1.devinformatics.com'),(4,'paypal api password','1351267390'),(5,'paypal api signature','AFcWxV21C7fd0v3bYYYRCpSSRl31A9hW-nWAAhoESXgYhfCQ-FsBDa-K'),(6,'paypal subscribe button','<form id=\"paypal-sub-form\" action=\"https://www.sandbox.paypal.com/cgi-bin/webscr\" method=\"post\">\r\n<input type=\"hidden\" name=\"cmd\" value=\"_s-xclick\">\r\n<input type=\"hidden\" name=\"hosted_button_id\" value=\"QJARCR6JEXV3N\">\r\n<input type=\"image\" src=\"https://www.sandbox.paypal.com/en_US/i/btn/btn_subscribeCC_LG.gif\" border=\"0\" name=\"submit\" alt=\"PayPal - The safer, easier way to pay online!\">\r\n<img alt=\"\" border=\"0\" src=\"https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif\" width=\"1\" height=\"1\">\r\n</form>'),(7,'paypal unsubscribe button','<A HREF=\"https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_subscr-find&alias=M98LXAW9KA5JY\">\r\n<IMG SRC=\"https://www.sandbox.paypal.com/en_US/i/btn/btn_unsubscribe_LG.gif\" BORDER=\"0\">\r\n</A>');

/*Table structure for table `prizewheel_category_entries` */

DROP TABLE IF EXISTS `prizewheel_category_entries`;

CREATE TABLE `prizewheel_category_entries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `prizewheelid` int(10) unsigned NOT NULL,
  `advertisementcategoryid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=latin1;

/*Data for the table `prizewheel_category_entries` */

insert  into `prizewheel_category_entries`(`id`,`prizewheelid`,`advertisementcategoryid`) values (1,1,1),(2,1,2),(57,2,1),(58,2,2),(78,5,1),(79,5,2),(80,5,3),(102,4,1),(103,4,2),(104,4,3),(119,6,1),(120,6,5),(121,6,3),(122,6,2),(123,6,6),(124,6,4),(146,7,1),(147,7,5),(148,7,3),(149,7,2),(150,7,6),(151,7,7),(152,7,4),(157,3,1),(158,3,2);

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
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

/*Data for the table `prizewheel_entries` */

insert  into `prizewheel_entries`(`id`,`prizewheelid`,`facebookuserid`,`firstname`,`lastname`,`emailaddress`,`telephone`,`ipaddress`,`playtime`,`prize`,`exported`) values (6,3,'100000384651852','Michael','Davidson','realityenigma@hotmail.com','4053719894','192.168.1.1','2013-01-03 10:00:34','Test',1),(7,3,'100000384651852','Michael','Davidson','realityenigma@hotmail.com','4053719894','192.168.1.1','2013-01-03 10:00:34','Test',1),(8,3,'100000384651852','Michael','Davidson','realityenigma@hotmail.com','4053719894','192.168.1.1','2013-01-07 15:37:57','Test',1),(9,3,'100000384651852','King','Kong','king.kong@aol.com','4053334545','192.168.1.1','2013-01-07 15:37:57','',1),(10,2,'100000384651852','Camel','Case','camel.case@aol.com','4053345678','192.168.1.1','2012-12-27 14:14:52','18',0),(11,3,'100000384651852','Michael','Davidson','michael.davidson@devinformatics.com','4053719895','192.168.1.1','2013-01-07 15:37:57','Test',1),(12,2,'100000384651852','Fred','Flintstone','fred@aol.com','4053341212','192.168.1.1','2012-12-27 14:20:20','18',0),(13,3,'100000384651852','Michael','Davidson','michael.davidson@aol.com','4057594475','192.168.15.50','2013-01-07 15:37:57','Test',1),(14,3,'100000384651852','King','Kong','king.kong@mgm.com','4561237891','192.168.15.50','2013-01-07 15:37:57','Test',1),(15,3,'100000384651852','Bill','O\'Reilly','bill@foxnews.com','5641234521','192.168.15.50','2013-01-07 15:37:57','Test',1),(16,2,'100000384651852','Sam','Smith','sam.smith@aol.com','4052213214','192.168.15.50','2012-12-30 22:28:16','13',0),(17,3,'100000384651852','Sam','Smith','samsmith@aol.com','4568945623','70.164.196.66','2013-01-07 15:37:57','Test',1),(18,3,'100000384651852','James','Smith','james.smith@aol.com','4058894174','70.164.196.66','2013-01-07 15:37:57','Test',1),(19,3,'100000384651852','Jeff','Jones','jeff.jones@hotmail.com','4515647891','70.164.196.66','2013-01-07 15:37:57','Test',1),(20,2,'100000384651852','Bob','Jones','bob.jones@aol.com','4057451245','70.164.196.66','2012-12-31 13:03:57','18',0),(21,3,'','King','John','king.john@aol.com','4058964123','70.164.196.66','2013-01-07 15:37:57','Test',1),(22,3,'','Paul','Smith','paul.smith@test.com','4053321245','70.164.196.66','2013-01-07 15:37:57','Test',1),(23,3,'','James','Gregory','james.gregory@news.com','4053214567','70.164.196.66','2013-01-07 15:37:57','',1),(24,3,'','Samuel','Jones','sam.jones@news.com','4057894561','70.164.196.66','2013-01-07 15:37:57','Test',1),(25,3,'','Sven','Svit','sven.svit@aol.com','4058974125','70.164.196.66','2013-01-07 15:37:57','Test',1),(26,3,'100000384651852','Snoozing','Again','snooze@aol.com','4058215689','70.164.196.66','2013-01-07 15:37:57','Test',1),(27,3,'100000384651852','Te4053451234st','User','test.user@hotmail.com','4051231289','192.168.15.205','2013-01-07 15:37:57','Test',1),(28,4,'100004964763250','Janice','Davidson','janice.davidson@devinformatics.info','4057894561','70.164.196.66','2013-01-01 09:12:33','13',0),(29,3,'100000384651852','James','Jones','james.jones@hotmail.com','4055671234','70.164.196.66','2013-01-07 15:37:57','Test',1),(30,3,'100004964763250','Michael','Davidson','m.davidson30@test.com','4058947896','70.164.196.66','2013-01-07 15:37:57','Test',1),(31,3,'100004964763250','Shelly','Jones','shelly.jones@aol.com','4058547894','70.164.196.66','2013-01-07 15:37:57','Test',1),(32,2,'100000384651852','Michael','Jones','m.jones@aol.com','4561234567','70.164.196.66','2013-01-02 15:10:15','18',0),(33,2,'100000384651852','sdfdsdf','sdfd','sfdsfdds@sdfsd.com','4531231234','70.164.196.66','2013-01-02 15:15:47','18',0),(34,2,'100000384651852','dfdhfdf','sdfddss','fdsfdsf@sfdfs.com','5673451212','70.164.196.66','2013-01-02 15:19:30','18',0),(35,2,'100000384651852','Bill','Bing','bill.bing@aol.com','4051238989','70.164.196.66','2013-01-02 15:45:23','19',0),(36,2,'100000384651852','News','Anchor','news.anchor@test.com','4561230909','70.164.196.66','2013-01-02 15:57:16','18',0),(37,3,'100000384651852','Michael','Colombus','michael.c@news.com','4058951241','70.164.196.66','2013-01-07 15:37:57','Test',1),(38,2,'100000384651852','James','Smith','james.smith@aol.com','4521234567','70.164.196.66','2013-01-02 16:33:20','19',0),(39,2,'100000384651852','File','Test','file.test@test.com','4052213214','70.164.196.66','2013-01-02 16:36:59','18',0),(40,3,'100000384651852','Kyle','Weather','kyle.weather@aol.com','4058978541','192.168.15.50','2013-01-07 15:37:57','Test',1),(41,3,'100000384651852','Fuck','Off','fuck.off@aol.com','4051234567','70.164.196.66','2013-01-07 15:37:57','Test',1),(42,3,'100000384651852','Michael','Davidson','michael.davidson@devinformatics.com','4058827894','70.164.196.66','2013-01-07 15:37:57','',1),(43,3,'100000384651852','Michael','Davidson','michael.davidson@devinformatics.com','4057594475','70.164.196.66','2013-01-07 15:37:57','Test',1),(44,3,'100000384651852','Michael','Davidson','michael.davidson@devinformatics.com','4057594475','70.164.196.66','2013-01-07 15:37:57','',1),(45,3,'100000384651852','Michael','Davidson','michael.davidson@devinformatics.com','4057544578','70.164.196.66','2013-01-07 15:37:57','Test',1),(46,3,'100000384651852','Michael','Davidson','michael.davidson@devinformatics.com','4057594475','70.164.196.66','2013-01-07 15:37:57','Test',1),(47,3,'100000384651852','Michael','Davidson','michael.davidson@devinformatics.com','4057594475','70.164.196.66','2013-01-07 15:37:57','Test',1),(48,3,'100000384651852','Michael','Davidson','michael.davidson@devinformatics.com','4057594475','70.164.196.66','2013-01-07 15:37:57','',1),(49,3,'100000384651852','Michaekl','Dsfdffg','michael.davidson@devinformatics.com','4057594475','70.164.196.66','2013-01-07 15:37:57','',1),(50,3,'100000384651852','Michael','Davidson','michael.davidson@devinformatics.com','4058547894','70.164.196.66','2013-01-07 15:37:57','Test',1),(51,3,'100000384651852','Michael','Davidson','michael.davidson@devinformatics.com','4057594475','70.164.196.66','2013-01-07 15:37:57','Test',1),(52,3,'100000384651852','Michael','Davidson','michael.davidson@devinformatics.com','4057897894','70.164.196.66','2013-01-07 15:37:57','',1),(53,3,'100000384651852','Michael','Davidson','michael.davidson@devinformatics.com','4057594475','70.164.196.66','2013-01-07 15:37:57','Test',1),(54,3,'100000384651852','Michael','Davidson','realityenigma@hotmail.com','457594475','70.164.196.66','2013-01-07 15:37:57','Test',1),(55,3,'100000384651852','Michael','Davidson','michael.davidson@devinformatics.com','4057594475','70.164.196.66','2013-01-07 15:37:57','Test',1),(56,6,'100004977903170','King','King','king.king@aol.com','4052341234','70.164.196.66','2013-01-08 14:14:23','13',0),(57,3,'100000384651852','Michael','Davidson','michael.davidson@devinformatics.com','4054551234','70.164.196.66','2013-01-08 15:41:01','Test',0);

/*Table structure for table `prizewheel_entry_category_entries` */

DROP TABLE IF EXISTS `prizewheel_entry_category_entries`;

CREATE TABLE `prizewheel_entry_category_entries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `prizewheelentryid` bigint(20) unsigned NOT NULL,
  `advertisementcategoryid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=latin1;

/*Data for the table `prizewheel_entry_category_entries` */

insert  into `prizewheel_entry_category_entries`(`id`,`prizewheelentryid`,`advertisementcategoryid`) values (1,1,3),(2,1,4),(3,2,3),(4,2,4),(5,3,3),(6,3,4),(7,4,3),(8,4,4),(9,5,57),(10,5,58),(11,6,61),(12,6,62),(13,7,61),(14,7,62),(15,8,61),(16,8,62),(17,9,63),(18,9,64),(19,10,57),(20,10,58),(21,11,63),(22,11,64),(23,12,57),(24,12,58),(25,13,63),(26,13,64),(27,14,69),(28,14,70),(29,15,71),(30,15,72),(31,16,57),(32,16,58),(33,17,71),(34,17,72),(35,18,71),(36,18,72),(37,19,71),(38,19,72),(39,20,57),(40,20,58),(41,21,71),(42,21,72),(43,22,71),(44,22,72),(45,23,71),(46,23,72),(47,24,71),(48,24,72),(49,25,71),(50,25,72),(51,26,73),(52,26,74),(53,27,73),(54,27,74),(55,28,11),(56,28,12),(57,28,75),(58,28,76),(59,28,77),(60,29,73),(61,29,74),(62,30,81),(63,30,82),(64,31,81),(65,31,82),(66,32,57),(67,32,58),(68,33,57),(69,33,58),(70,34,57),(71,34,58),(72,35,57),(73,35,58),(74,36,57),(75,36,58),(76,37,81),(77,37,82),(78,38,57),(79,38,58),(80,39,57),(81,39,58),(82,40,81),(83,40,82),(84,41,97),(85,41,98),(86,42,109),(87,42,110),(88,43,109),(89,43,110),(90,44,109),(91,44,110),(92,45,111),(93,45,112),(94,46,111),(95,46,112),(96,47,113),(97,47,114),(98,48,113),(99,48,114),(100,49,113),(101,49,114),(102,50,113),(103,50,114),(104,51,113),(105,51,114),(106,52,113),(107,52,114),(108,53,115),(109,53,116),(110,54,115),(111,54,116),(112,55,117),(113,55,118),(114,56,119),(115,56,120),(116,56,121),(117,56,122),(118,56,123),(119,56,124),(120,57,117),(121,57,118);

/*Table structure for table `prizewheel_impressions` */

DROP TABLE IF EXISTS `prizewheel_impressions`;

CREATE TABLE `prizewheel_impressions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `prizewheelid` int(10) unsigned NOT NULL,
  `facebookuserid` varchar(100) NOT NULL,
  `createdatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `prizewheel_impressions` */

insert  into `prizewheel_impressions`(`id`,`prizewheelid`,`facebookuserid`,`createdatetime`) values (1,3,'100000384651852','2012-12-31 00:20:51'),(2,4,'100004964763250','2013-01-01 09:11:09'),(3,3,'100004964763250','2013-01-02 14:45:45'),(4,2,'100000384651852','2013-01-02 15:09:48'),(5,6,'100004977903170','2013-01-08 14:13:28');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `prizewheels` */

insert  into `prizewheels`(`id`,`prizewheeltypeid`,`pageid`,`affiliateid`,`forcelike`,`forcelikeimage`,`firsttext`,`validemail`,`alreadyplayed`,`errorsubmit`,`errorprize`,`accesserror`,`accesslimit`,`textrules`,`prizeonename`,`prizeonecode`,`prizeonetext`,`prizeonetextsize`,`prizeoneimage`,`prizeoneurl`,`prizeoneweight`,`prizetwoname`,`prizetwocode`,`prizetwotext`,`prizetwotextsize`,`prizetwoimage`,`prizetwourl`,`prizetwoweight`,`prizethreename`,`prizethreecode`,`prizethreetext`,`prizethreetextsize`,`prizethreeimage`,`prizethreeurl`,`prizethreeweight`,`prizefourname`,`prizefourcode`,`prizefourtext`,`prizefourtextsize`,`prizefourimage`,`prizefoururl`,`prizefourweight`,`prizefivename`,`prizefivecode`,`prizefivetext`,`prizefivetextsize`,`prizefiveimage`,`prizefiveurl`,`prizefiveweight`,`prizesixname`,`prizesixcode`,`prizesixtext`,`prizesixtextsize`,`prizesiximage`,`prizesixurl`,`prizesixweight`,`prizesevenname`,`prizesevencode`,`prizeseventext`,`prizeseventextsize`,`prizesevenimage`,`prizesevenurl`,`prizesevenweight`,`prizeeightname`,`prizeeightcode`,`prizeeighttext`,`prizeeighttextsize`,`prizeeightimage`,`prizeeighturl`,`prizeeightweight`,`prizeninename`,`prizeninecode`,`prizeninetext`,`prizeninetextsize`,`prizenineimage`,`prizenineurl`,`prizenineweight`,`prizetenname`,`prizetencode`,`prizetentext`,`prizetentextsize`,`prizetenimage`,`prizetenurl`,`prizetenweight`,`prizeelevenname`,`prizeelevencode`,`prizeeleventext`,`prizeeleventextsize`,`prizeelevenimage`,`prizeelevenurl`,`prizeelevenweight`,`prizetwelvename`,`prizetwelvecode`,`prizetwelvetext`,`prizetwelvetextsize`,`prizetwelveimage`,`prizetwelveurl`,`prizetwelveweight`,`sponserimage`,`sponserlink`,`backimage`,`topimage`,`buttonimage`,`sendemailnotifications`,`notificationemailaddress`,`smtpserver`,`smtpusername`,`smtppassword`,`smtpport`,`smtpfromaddress`,`smtpencryption`,`smtpauthmethod`,`notificationemailsubject`,`notificationemailbody`,`ipaddressfilter`,`phonefilter`,`emailfilter`,`enabled`,`createdatetime`,`paidexpiration`) values (2,1,'158447550966525',4,0,'','Spin the wheel for your chance to win a prize today!','Please enter a valid E-Mail.','You have already played!','There has been a submission error!','There has been an error calculating the Prize!','There has been an Access error!','You have reached your Access Limit!','You must agree to the terms and conditions to play.','','','',10,'','',0,'','','',10,'','',0,'','','',10,'','',0,'','','',10,'','',0,'','','',10,'','',0,'','','',10,'','',0,'','','',10,'','',0,'','','',10,'','',0,'','','',10,'','',0,'','','',10,'','',0,'','','',10,'','',0,'','','',10,'','',0,'','','','','',0,'','','','',25,'','none','login','','',0,0,0,1,'2012-12-20 10:20:12','0000-00-00 00:00:00'),(3,2,'112641775564211',4,0,'8d63c76d-64ac-41ed-92da-d924a2998ee3.jpg','Spin the wheel for your chance to win a prize today!','Please enter a valid E-Mail.','You have already played!','There has been a submission error!','There has been an error calculating the Prize!','There has been an Access error!','You have reached your Access Limit!','You are only allowed to play once.','Test','Test','Test',10,'','http://obestrim.com',8,'Test','Test','Test',10,'','http://obestrim.com',8,'Test','Test','Test',10,'','http://obestrim.com',9,'Test','Test','Test',10,'','http://obestrim.com',8,'Test','Test','Test',10,'','http://obestrim.com',8,'Test','Test','Test',10,'','http://obestrim.com',9,'Test','Test','Test',10,'','http://obestrim.com',8,'Test','Test','Test',10,'','http://obestrim.com',8,'Test','Test','Test',10,'','http://obestrim.com',9,'Test','Test','Test',10,'','http://obestrim.com',8,'Test','Test','Test',10,'','http://obestrim.com',8,'Test','Test','Test',10,'','http://obestrim.com',9,'Black_And_White_Dragon_Drawing_320X480_iPhone_Mobile_Wallpaper.jpg','http://news.com','81799881-106b-4964-aa2c-fd7dd2ed9fc0.jpg','','proceedto_checkout.png',1,'realityenigma@hotmail.com','smtp.obestrim.com','bryanf@obestrim.com','ihr2109',587,'bryanf@obestrim.com','none','login','You have won','Congrats, You have won a prize.',0,0,0,1,'2013-01-07 13:44:35','2012-02-13 21:11:21'),(4,1,'425235017548467',10,0,'','Spin the wheel for your chance to win a prize today!','Please enter a valid E-Mail.','You have already played!','There has been a submission error!','There has been an error calculating the Prize!','There has been an Access error!','You have reached your Access Limit!','You must agree to the terms and conditions to play.','','','',10,'','',8,'Try Again','Try Again','Try Again',10,'','',8,'','','',10,'','',9,'Try Again','Try Again','Try Again',10,'','',8,'','','',10,'','',8,'Try Again','Try Again','Try Again',10,'','',9,'','','',10,'','',8,'Try Again','Try Again','Try Again',10,'','',8,'','','',10,'','',9,'Try Again','Try Again','Try Again',10,'','',8,'','','',10,'','',8,'Try Again','Try Again','Try Again',10,'','',9,'','','','','',0,'','','','',25,'','none','plain','Thank you for playing the Prize Wheel','Congratulations,<br/><br/>Here is your Prize Wheel spin results: @prize<br/>',0,0,0,1,'2013-01-01 09:07:30','0000-00-00 00:00:00'),(5,2,'359229357507880',10,0,'','Spin the wheel for your chance to win a prize today!','Please enter a valid E-Mail.','You have already played!','There has been a submission error!','There has been an error calculating the Prize!','There has been an Access error!','You have reached your Access Limit!','You must agree to the terms and conditions to play.','','','',10,'','',8,'Try Again','Try Again','Try Again',10,'','',8,'','','',10,'','',9,'Try Again','Try Again','Try Again',10,'','',8,'','','',10,'','',8,'Try Again','Try Again','Try Again',10,'','',9,'','','',10,'','',8,'Try Again','Try Again','Try Again',10,'','',8,'','','',10,'','',9,'Try Again','Try Again','Try Again',10,'','',8,'','','',10,'','',8,'Try Again','Try Again','Try Again',10,'','',9,'','','','','',0,'','','','',25,'','none','plain','Thank you for playing the Prize Wheel','Congratulations,<br/><br/>Here is your Prize Wheel spin results: @prize<br/>',0,0,0,1,'2013-01-01 09:07:56','0000-00-00 00:00:00'),(6,1,'266356913491719',11,0,'','Spin the wheel for your chance to win a prize today!','Please enter a valid E-Mail.','You have already played!','There has been a submission error!','There has been an error calculating the Prize!','There has been an Access error!','You have reached your Access Limit!','You must agree to the terms and conditions to play.','Prize One','Prize One Code','Prize One',10,'','http://facebook.com',8,'Try Again','Try Again','Try Again',10,'','http://facebook.com',8,'Prize Three','Prize Three Code','Prize Three',10,'','http://facebook.com',9,'Try Again','Try Again','Try Again',10,'','http://facebook.com',8,'Prize Five','Prize Five Code','Prize Five',10,'','http://facebook.com',8,'Try Again','Try Again','Try Again',10,'','http://facebook.com',9,'Prize Seven','Prize Seven Code','Prize Seven',10,'','http://facebook.com',8,'Try Again','Try Again','Try Again',10,'','http://facebook.com',8,'Prize Nine','Prize Nine Code','Prize Nine',10,'','http://facebook.com',9,'Try Again','Try Again','Try Again',10,'','http://facebook.com',8,'Prize Eleven','Prize Eleven Code','Prize Eleven',10,'','http://facebook.com',8,'Try Again','Try Again','Try Again',10,'','http://facebook.com',9,'','','','','',0,'','','','',25,'','none','plain','Thank you for playing the Prize Wheel','Congratulations,<br/><br/>Here is your Prize Wheel spin results: @prize<br/>',0,0,0,1,'2013-01-08 14:04:37','0000-00-00 00:00:00'),(7,2,'421957484540776',12,0,'','Spin the wheel for your chance to win a prize today!','Please enter a valid E-Mail.','You have already played!','There has been a submission error!','There has been an error calculating the Prize!','There has been an Access error!','You have reached your Access Limit!','You must agree to the terms and conditions to play.','Prize One','Prize One Code','Prize One',10,'','http://facebook.com',8,'Try Again','Try Again','Try Again',10,'','http://facebook.com',8,'Prize Three','Prize Three Code','Prize Three',10,'','http://facebook.com',9,'Try Again','Try Again','Try Again',10,'','http://facebook.com',8,'Prize Five','Prize Five Code','Prize Five',10,'','http://facebook.com',8,'Try Again','Try Again','Try Again',10,'','http://facebook.com',9,'Prize Seven','Prize Seven Code','Prize Seven',10,'','http://facebook.com',8,'Try Again','Try Again','Try Again',10,'','http://facebook.com',8,'Prize Nine','Prize Nine Code','Prize Nine',10,'','http://facebook.com',9,'Try Again','Try Again','Try Again',10,'','http://facebook.com',8,'Prize Eleven','Prize Eleven Code','Prize Eleven',10,'','http://facebook.com',8,'Try Again','Try Again','Try Again',10,'','http://facebook.com',9,'Construction_in_April_2012.jpg','','','','',0,'','','','',25,'','none','plain','Thank you for playing the Prize Wheel','Congratulations,Here is your Prize Wheel spin results: @prize',0,0,0,1,'2013-01-09 15:11:50','2013-02-13 16:15:22');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `subscription_transactions` */

insert  into `subscription_transactions`(`id`,`subscriptionid`,`prizewheelid`,`transactionstatusid`,`firstname`,`lastname`,`telephone`,`emailaddress`,`address1`,`address2`,`city`,`state`,`country`,`postal`,`cardfirstfour`,`cardlastfour`,`cardexpmonth`,`cardexpyear`,`processor`,`amount`,`paymentid`,`status`,`memo`,`ipaddress`,`createdatetime`) values (1,'I-PGCKY6A390KJ',7,1,'Janice','Davidson','408-392-5640','janice_1351267256_per@devinformatics.com','1 Main St',NULL,'San Jose','CA','US','95131',NULL,NULL,NULL,NULL,'paypal','5.95','5W44342434504754C','Completed','Ad-Free Prize Wheel','173.0.82.126','2013-01-09 15:11:50'),(2,'I-9EC0C7UAEHGG',7,1,'Janice','Davidson','408-392-5640','janice_1351267256_per@devinformatics.com','1 Main St',NULL,'San Jose','CA','US','95131',NULL,NULL,NULL,NULL,'paypal','5.95','4S840361148480811','Completed','Ad-Free Prize Wheel','173.0.82.126','2013-01-09 15:24:13'),(3,'I-645E5G1XMKW6',7,1,'Janice','Davidson','408-392-5640','janice_1351267256_per@devinformatics.com','1 Main St',NULL,'San Jose','CA','US','95131',NULL,NULL,NULL,NULL,'paypal','5.95','6P992161XP9666541','Completed','Ad-Free Prize Wheel','173.0.82.126','2013-01-09 16:15:22'),(4,'I-UKALMJBN3WJ5',3,1,'Janice','Davidson','408-392-5640','janice_1351267256_per@devinformatics.com','1 Main St',NULL,'San Jose','CA','US','95131',NULL,NULL,NULL,NULL,'paypal','5.95','3UG32664HK791250L','Completed','Ad-Free Prize Wheel','173.0.82.126','2013-01-09 21:11:21');

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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

/*Data for the table `transactions` */

insert  into `transactions`(`id`,`advertisementid`,`transactionstatusid`,`firstname`,`lastname`,`telephone`,`emailaddress`,`address1`,`address2`,`city`,`state`,`country`,`postal`,`cardfirstfour`,`cardlastfour`,`cardexpmonth`,`cardexpyear`,`processor`,`amount`,`paymentid`,`status`,`memo`,`ipaddress`,`createdatetime`) values (7,18,4,'Michael','Davidson',NULL,'realityenigma@hotmail.com','701 SW 60th TER',NULL,'Oklahoma City','OK','United States','73139',NULL,NULL,NULL,NULL,'paypal','25.00','5NL89636F63802210','Completed','BKL','192.168.1.1','2012-12-28 10:16:25'),(8,18,4,'Michael','Davidson',NULL,'realityenigma@hotmail.com','701 SW 60th TER',NULL,'Oklahoma City','OK','United States','73139',NULL,NULL,NULL,NULL,'paypal','25.00','71E34804FD793944P','Completed','BKL','192.168.1.1','2012-12-28 10:57:44'),(9,18,4,'Michael','Davidson',NULL,'realityenigma@hotmail.com','701 SW 60th TER',NULL,'Oklahoma City','OK','United States','73139',NULL,NULL,NULL,NULL,'paypal','50.00','9SW180102J515030F','Completed','BKL','192.168.1.1','2012-12-28 10:59:45'),(10,18,4,'Michael','Davidson',NULL,'realityenigma@hotmail.com','701 SW 60th TER',NULL,'Oklahoma City','OK','United States','73139',NULL,NULL,NULL,NULL,'paypal','25.00','91G77219V4360401W','Completed','BKL','192.168.1.1','2012-12-28 11:01:04'),(11,18,4,'Michael','Davidson',NULL,'realityenigma@hotmail.com','701 SW 60th TER',NULL,'Oklahoma City','OK','United States','73139',NULL,NULL,NULL,NULL,'paypal','25.00','1R767057RS5265126','Completed','BKL','192.168.1.1','2012-12-28 11:03:10'),(12,18,4,'Michael','Davidson',NULL,'realityenigma@hotmail.com','701 SW 60th TER',NULL,'Oklahoma City','OK','United States','73139',NULL,NULL,NULL,NULL,'paypal','25.00','281277453C426162E','Completed','BKL','192.168.1.1','2012-12-28 11:22:12'),(13,18,4,'Michael','Davidson',NULL,'realityenigma@hotmail.com','701 SW 60th TER',NULL,'Oklahoma City','OK','United States','73139',NULL,NULL,NULL,NULL,'paypal','25.00','77W47249A8907715H','Completed','BKL','192.168.1.1','2012-12-28 11:24:34'),(14,18,4,'Michael','Davidson',NULL,'realityenigma@hotmail.com','701 SW 60th TER',NULL,'Oklahoma City','OK','United States','73139',NULL,NULL,NULL,NULL,'paypal','25.00','43U16470VU3755623','Completed','BKL','192.168.1.1','2012-12-28 13:11:55'),(15,18,4,'Michael','Davidson',NULL,'realityenigma@hotmail.com','701 SW 60th TER',NULL,'Oklahoma City','OK','United States','73139',NULL,NULL,NULL,NULL,'paypal','25.00','8T782044AM765654G','Completed','BKL','192.168.1.1','2012-12-28 13:26:17'),(16,18,4,'Michael','Davidson',NULL,'realityenigma@hotmail.com','701 SW 60th TER',NULL,'Oklahoma City','OK','United States','73139',NULL,NULL,NULL,NULL,'paypal','25.00','9DC24432JY971534T','Completed','BKL','192.168.1.1','2012-12-28 13:32:26'),(17,18,1,'Janice','Davidson','408-392-5640','janice_1351267256_per@devinformatics.com','1 Main St',NULL,'San Jose','CA','US','95131',NULL,NULL,NULL,NULL,'paypal','25.00','0NN30323U1670682N','Completed','Bucket Load','173.0.82.126','2012-12-31 01:11:45'),(18,18,1,'Janice','Davidson','408-392-5640','janice_1351267256_per@devinformatics.com','1 Main St',NULL,'San Jose','CA','US','95131',NULL,NULL,NULL,NULL,'paypal','25.00','6UB043269B767681A','Completed','Bucket Load','173.0.82.126','2012-12-31 01:20:24'),(19,18,6,'Janice','Davidson','408-392-5640','janice_1351267256_per@devinformatics.com','1 Main St',NULL,'San Jose','CA','US','95131',NULL,NULL,NULL,NULL,'paypal','-25.00','21S7452401131901V','Refunded','Bucket Load','173.0.82.126','2012-12-31 01:21:47'),(20,18,6,'Janice','Davidson','408-392-5640','janice_1351267256_per@devinformatics.com','1 Main St',NULL,'San Jose','CA','US','95131',NULL,NULL,NULL,NULL,'paypal','-25.00','91517067JC940283P','Refunded','Bucket Load','173.0.82.126','2012-12-31 01:26:08'),(21,18,1,'Janice','Davidson','408-392-5640','janice_1351267256_per@devinformatics.com','1 Main St',NULL,'San Jose','CA','US','95131',NULL,NULL,NULL,NULL,'paypal','50.00','44M240935D163150H','Completed','Bucket Load','173.0.82.126','2012-12-31 08:31:31'),(22,20,1,'Janice','Davidson','408-392-5640','janice_1351267256_per@devinformatics.com','1 Main St',NULL,'San Jose','CA','US','95131',NULL,NULL,NULL,NULL,'paypal','25.00','5846735711409942L','Completed','Bucket Load','173.0.82.126','2013-01-02 12:42:42'),(23,20,1,'Janice','Davidson','408-392-5640','janice_1351267256_per@devinformatics.com','1 Main St',NULL,'San Jose','CA','US','95131',NULL,NULL,NULL,NULL,'paypal','25.00','26B71378U7116221H','Completed','Bucket Load','173.0.82.126','2013-01-02 12:44:02'),(24,20,1,'Janice','Davidson','408-392-5640','janice_1351267256_per@devinformatics.com','1 Main St',NULL,'San Jose','CA','US','95131',NULL,NULL,NULL,NULL,'paypal','25.00','71500622NH605700E','Completed','Bucket Load','173.0.82.126','2013-01-02 12:45:04'),(25,19,1,'Janice','Davidson','408-392-5640','janice_1351267256_per@devinformatics.com','1 Main St',NULL,'San Jose','CA','US','95131',NULL,NULL,NULL,NULL,'paypal','250.00','1NU23055P4825560A','Completed','Bucket Load','173.0.82.126','2013-01-02 13:19:17'),(26,19,1,'Janice','Davidson','408-392-5640','janice_1351267256_per@devinformatics.com','1 Main St',NULL,'San Jose','CA','US','95131',NULL,NULL,NULL,NULL,'paypal','25.00','993424756A221360S','Completed','Bucket Load','173.0.82.126','2013-01-02 14:57:51'),(27,9,1,'Janice','Davidson','408-392-5640','janice_1351267256_per@devinformatics.com','1 Main St',NULL,'San Jose','CA','US','95131',NULL,NULL,NULL,NULL,'paypal','50.00','6B442696DA6464847','Completed','Bucket Load','173.0.82.126','2013-01-03 00:17:49'),(28,11,1,'Janice','Davidson','408-392-5640','janice_1351267256_per@devinformatics.com','1 Main St',NULL,'San Jose','CA','US','95131',NULL,NULL,NULL,NULL,'paypal','25.00','12U00916H9789054D','Completed','Bucket Load','173.0.82.126','2013-01-03 00:19:32'),(29,15,1,'Janice','Davidson','408-392-5640','janice_1351267256_per@devinformatics.com','1 Main St',NULL,'San Jose','CA','US','95131',NULL,NULL,NULL,NULL,'paypal','25.00','8AS09625U2062691X','Completed','Bucket Load','173.0.82.126','2013-01-03 00:20:47'),(30,14,1,'Janice','Davidson','408-392-5640','janice_1351267256_per@devinformatics.com','1 Main St',NULL,'San Jose','CA','US','95131',NULL,NULL,NULL,NULL,'paypal','25.00','4JB39709SL361170A','Completed','Bucket Load','173.0.82.126','2013-01-03 00:21:22'),(31,7,1,'Janice','Davidson','408-392-5640','janice_1351267256_per@devinformatics.com','1 Main St',NULL,'San Jose','CA','US','95131',NULL,NULL,NULL,NULL,'paypal','25.00','7MS42929D7976853N','Completed','Bucket Load','173.0.82.126','2013-01-03 00:22:09'),(32,8,1,'Janice','Davidson','408-392-5640','janice_1351267256_per@devinformatics.com','1 Main St',NULL,'San Jose','CA','US','95131',NULL,NULL,NULL,NULL,'paypal','25.00','8GD46955B7685004Y','Completed','Bucket Load','173.0.82.126','2013-01-03 00:22:54'),(33,17,1,'Janice','Davidson','408-392-5640','janice_1351267256_per@devinformatics.com','1 Main St',NULL,'San Jose','CA','US','95131',NULL,NULL,NULL,NULL,'paypal','500.00','40Y53728W4832371M','Completed','Bucket Load','173.0.82.126','2013-01-03 00:23:43'),(34,19,1,'Janice','Davidson','408-392-5640','janice_1351267256_per@devinformatics.com','1 Main St',NULL,'San Jose','CA','US','95131',NULL,NULL,NULL,NULL,'paypal','100.00','25C47712A38940040','Completed','Bucket Load','173.0.82.126','2013-01-03 16:42:12'),(35,13,1,'Janice','Davidson','408-392-5640','janice_1351267256_per@devinformatics.com','1 Main St',NULL,'San Jose','CA','US','95131',NULL,NULL,NULL,NULL,'paypal','25.00','1L92011882272484H','Completed','Bucket Load','173.0.82.126','2013-01-04 14:38:31'),(36,10,1,'Janice','Davidson','408-392-5640','janice_1351267256_per@devinformatics.com','1 Main St',NULL,'San Jose','CA','US','95131',NULL,NULL,NULL,NULL,'paypal','25.00','4R49935827136225Y','Completed','Bucket Load','173.0.82.126','2013-01-08 15:44:30');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`) values (1,'admin','6926e8dee39cac6e84c885e22fe68aaa26886fa880e3c64d4938d2d661570584bMAiXbr74YlGslvvH5eLNTJ0aMgaIeUTpzaruj3ybVI=');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
