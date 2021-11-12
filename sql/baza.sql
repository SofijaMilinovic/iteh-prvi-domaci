/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.21-MariaDB : Database - iteh-prvi-domaci
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`iteh-prvi-domaci` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `iteh-prvi-domaci`;

/*Table structure for table `klijent` */

DROP TABLE IF EXISTS `klijent`;

CREATE TABLE `klijent` (
  `klijentId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ime` varchar(255) NOT NULL,
  `prezime` varchar(255) NOT NULL,
  `datumRodjenja` date NOT NULL,
  PRIMARY KEY (`klijentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `klijent` */

/*Table structure for table `psihoterapeut` */

DROP TABLE IF EXISTS `psihoterapeut`;

CREATE TABLE `psihoterapeut` (
  `psihoterapeutId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ime` varchar(255) NOT NULL,
  `prezime` varchar(255) NOT NULL,
  PRIMARY KEY (`psihoterapeutId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `psihoterapeut` */

/*Table structure for table `seansa` */

DROP TABLE IF EXISTS `seansa`;

CREATE TABLE `seansa` (
  `seansaId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `datum` date NOT NULL,
  `vreme` varchar(255) NOT NULL,
  `trajanjeMin` int(10) unsigned NOT NULL,
  `beleske` varchar(10000) NOT NULL,
  `klijentId` int(10) unsigned NOT NULL,
  `psihoterapeutId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`seansaId`),
  KEY `seansa_psihoterapeut_fk` (`psihoterapeutId`),
  KEY `seansa_klijent_fk` (`klijentId`),
  CONSTRAINT `seansa_klijent_fk` FOREIGN KEY (`klijentId`) REFERENCES `klijent` (`klijentId`),
  CONSTRAINT `seansa_psihoterapeut_fk` FOREIGN KEY (`psihoterapeutId`) REFERENCES `psihoterapeut` (`psihoterapeutId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `seansa` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
