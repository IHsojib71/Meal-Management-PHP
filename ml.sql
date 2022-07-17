/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.4.22-MariaDB : Database - meal_management
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`meal_management` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `meal_management`;

/*Table structure for table `cost_tbl` */

DROP TABLE IF EXISTS `cost_tbl`;

CREATE TABLE `cost_tbl` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `costby_userid` bigint(20) DEFAULT NULL,
  `costby_name` varchar(255) DEFAULT NULL,
  `amount` int(10) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `entrytime` datetime DEFAULT NULL,
  `entryby` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `cost_tbl` */

/*Table structure for table `meal_tbl` */

DROP TABLE IF EXISTS `meal_tbl`;

CREATE TABLE `meal_tbl` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `breakfast` int(10) DEFAULT NULL,
  `lunch` int(10) DEFAULT NULL,
  `dinner` int(10) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `entrytime` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

/*Data for the table `meal_tbl` */

insert  into `meal_tbl`(`id`,`user_id`,`user_name`,`date`,`breakfast`,`lunch`,`dinner`,`remarks`,`entrytime`) values 
(14,12,'Ismail Hossain','2022-04-15',1,0,1,'asdf','15 Apr 2022'),
(15,13,'admin','2022-04-15',1,1,1,'sfsdf','15 Apr 2022'),
(16,12,'Ismail Hossain','2022-04-14',1,1,1,'dsfdsf','15 Apr 2022'),
(17,13,'admin','2022-04-16',1,1,1,'dfsdf','15 Apr 2022'),
(18,13,'admin','2022-04-16',1,1,1,'asdfasdfs','15 Apr 2022'),
(19,12,'Ismail Hossain','2022-04-16',1,0,1,'asdfsadf','15 Apr 2022'),
(20,12,'Ismail Hossain','2022-07-15',1,1,1,'dfdf','15 Apr 2022');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `entrytime` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id`,`fullname`,`username`,`password`,`mobile`,`entrytime`) values 
(12,'Ismail Hossain','sojib','123','01779666715','08-04-2022'),
(13,'admin','admin','admin','1234','08-04-2022');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
