/*
SQLyog Community v13.1.6 (64 bit) !
MySQL - 8.0.23 : Database - iteh-prvi-domaci !
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`iteh-prvi-domaci` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `iteh-prvi-domaci`;

/*Table structure for table `klijent` */

DROP TABLE IF EXISTS `klijent`;

CREATE TABLE `klijent` (
  `jmbg` varchar(13) NOT NULL,
  `ime` varchar(255) NOT NULL,
  `prezime` varchar(255) NOT NULL,
  `datumRodjenja` date NOT NULL,
  PRIMARY KEY (`jmbg`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `klijent` */

insert  into `klijent`(`jmbg`,`ime`,`prezime`,`datumRodjenja`) values 
('1111111111111','Pera','Peric','2021-12-06'),
('2222222222222','Mika','Mikic','2021-12-08');

/*Table structure for table `psihoterapeut` */

DROP TABLE IF EXISTS `psihoterapeut`;

CREATE TABLE `psihoterapeut` (
  `psihoterapeutId` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ime` varchar(255) NOT NULL,
  `prezime` varchar(255) NOT NULL,
  PRIMARY KEY (`psihoterapeutId`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

/*Data for the table `psihoterapeut` */

insert  into `psihoterapeut`(`psihoterapeutId`,`username`,`password`,`ime`,`prezime`) values 
(20,'pera@gmail.com','Pera123','Pera','Peric'),
(21,'sofija@gmail.com','Sofija123','Sofija','Milinovic');

/*Table structure for table `seansa` */

DROP TABLE IF EXISTS `seansa`;

CREATE TABLE `seansa` (
  `seansaId` int unsigned NOT NULL AUTO_INCREMENT,
  `datum` date NOT NULL,
  `vreme` varchar(255) NOT NULL,
  `trajanjeMin` int unsigned NOT NULL,
  `beleske` varchar(10000) NOT NULL,
  `psihoterapeutId` int unsigned NOT NULL,
  `klijentJmbg` varchar(13) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`seansaId`),
  KEY `seansa_psihoterapeut_fk` (`psihoterapeutId`),
  KEY `seansa_klijent` (`klijentJmbg`),
  CONSTRAINT `seansa_klijent` FOREIGN KEY (`klijentJmbg`) REFERENCES `klijent` (`jmbg`),
  CONSTRAINT `seansa_psihoterapeut_fk` FOREIGN KEY (`psihoterapeutId`) REFERENCES `psihoterapeut` (`psihoterapeutId`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

/*Data for the table `seansa` */

insert  into `seansa`(`seansaId`,`datum`,`vreme`,`trajanjeMin`,`beleske`,`psihoterapeutId`,`klijentJmbg`) values 
(14,'2021-12-17','15:45',40,'Pozrtvovan',20,'1111111111111'),
(16,'2021-12-19','20:30',30,'Teska depresija',21,'2222222222222'),
(17,'2021-12-19','15:20',50,'Sreca sreca radost',21,'1111111111111'),
(18,'2021-12-08','12:30',60,'Sve je bilo ok',20,'2222222222222');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
