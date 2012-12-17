/*
SQLyog Ultimate v9.02 
MySQL - 5.1.50-community : Database - prizewheel
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`prizewheel` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `prizewheel`;

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
  `advertiserid` int(10) unsigned NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text,
  `typeid` int(11) NOT NULL,
  `bannerimage` varchar(150) NOT NULL,
  `url` varchar(300) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `advertisements` */

insert  into `advertisements`(`id`,`advertiserid`,`name`,`description`,`typeid`,`bannerimage`,`url`,`enabled`) values (1,2,'Test','Test',1,'169021_158793174173150_153290324723435_348535_4336805_n.jpg','',1),(2,2,'Test','Test',1,'169021_158793174173150_153290324723435_348535_4336805_n.jpg','',1),(3,2,'Test','Test',1,'169021_158793174173150_153290324723435_348535_4336805_n.jpg','',1),(4,2,'Test','Test',1,'169021_158793174173150_153290324723435_348535_4336805_n.jpg','',1);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `advertisers` */

insert  into `advertisers`(`id`,`facebookuserid`,`firstname`,`lastname`,`address1`,`address2`,`city`,`state`,`country`,`postal`,`telephone`,`emailaddress`,`createdatetime`) values (2,'100000384651852','Michael','Davidson','701 SW 60th TER','','Oklahoma City','1','United States','73139','4053719894','realityenigma@hotmail.com','2012-12-13 14:27:29');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `affiliates` */

insert  into `affiliates`(`id`,`facebookuserid`,`firstname`,`lastname`,`address1`,`address2`,`city`,`state`,`country`,`postal`,`telephone`,`emailaddress`,`createdatetime`) values (1,'','Michael','Davidson','701 SW 60th TER','','Oklahoma City','1','USA','73139','4053719894','realityenigma@hotmail.com','2012-12-12 14:37:54'),(2,'','Janice','Davidson','701 SW 60th TER','','Oklahoma City','1','USA','73139','4054050136','preciouspresh@hotmail.com','2012-12-12 14:45:50'),(3,'','Marcus','Davidson','701 SW 60th TER','','Oklahoma City','1','USA','73139','4053884578','marcus@gmail.com','2012-12-12 14:49:07');

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

/*Table structure for table `prizewheels` */

DROP TABLE IF EXISTS `prizewheels`;

CREATE TABLE `prizewheels` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
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
  `smtpfromaddress` varchar(150) DEFAULT NULL,
  `smtpencryption` varchar(50) DEFAULT 'none',
  `smtpauthmethod` varchar(50) DEFAULT 'plain',
  `notificationemailsubject` varchar(300) DEFAULT NULL,
  `notificationemailbody` longtext,
  `ipaddressfilter` tinyint(1) NOT NULL DEFAULT '0',
  `phonefilter` tinyint(1) NOT NULL DEFAULT '0',
  `emailfilter` tinyint(1) NOT NULL DEFAULT '0',
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `createdatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `prizewheels` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
