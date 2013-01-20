# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.29)
# Database: request
# Generation Time: 2013-01-19 17:59:31 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table Djs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Djs`;

CREATE TABLE `Djs` (
  `dj_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `dj_name` varchar(50) NOT NULL DEFAULT '',
  `dj_email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`dj_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

LOCK TABLES `Djs` WRITE;
/*!40000 ALTER TABLE `Djs` DISABLE KEYS */;

INSERT INTO `Djs` (`dj_id`, `dj_name`, `dj_email`)
VALUES
	(0,'DJ Ranman','djranman@gmail.com'),
	(1,'DJ Jazzy Jeff','jazzyjeff@gmail.com'),
	(2,'Skrillx','skrillx@gmail.com'),
	(3,'SleeperCell','sleepercell@gmail.com'),
	(4,'DeadMau5','dm5@gmail.com'),
	(5,'DJ Smashley','djsmash@gmail.com');

/*!40000 ALTER TABLE `Djs` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Queues
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Queues`;

CREATE TABLE `Queues` (
  `qu_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`qu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

LOCK TABLES `Queues` WRITE;
/*!40000 ALTER TABLE `Queues` DISABLE KEYS */;

INSERT INTO `Queues` (`qu_id`)
VALUES
	(0),
	(1),
	(2),
	(3),
	(4),
	(5);

/*!40000 ALTER TABLE `Queues` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table QueueToDj
# ------------------------------------------------------------

DROP TABLE IF EXISTS `QueueToDj`;

CREATE TABLE `QueueToDj` (
  `qtd_queueId` int(11) unsigned NOT NULL,
  `qtd_djId` int(11) unsigned NOT NULL,
  PRIMARY KEY (`qtd_queueId`,`qtd_djId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `QueueToDj` WRITE;
/*!40000 ALTER TABLE `QueueToDj` DISABLE KEYS */;

INSERT INTO `QueueToDj` (`qtd_queueId`, `qtd_djId`)
VALUES
	(0,0),
	(1,1),
	(2,2),
	(3,3),
	(4,4),
	(5,5);

/*!40000 ALTER TABLE `QueueToDj` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table QueueToVenue
# ------------------------------------------------------------

DROP TABLE IF EXISTS `QueueToVenue`;

CREATE TABLE `QueueToVenue` (
  `qtv_queueId` int(11) unsigned NOT NULL,
  `qtv_venueId` int(11) unsigned NOT NULL,
  PRIMARY KEY (`qtv_queueId`,`qtv_venueId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `QueueToVenue` WRITE;
/*!40000 ALTER TABLE `QueueToVenue` DISABLE KEYS */;

INSERT INTO `QueueToVenue` (`qtv_queueId`, `qtv_venueId`)
VALUES
	(0,0),
	(1,1),
	(2,2),
	(3,3),
	(4,4),
	(5,5);

/*!40000 ALTER TABLE `QueueToVenue` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Songs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Songs`;

CREATE TABLE `Songs` (
  `so_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `so_artist` varchar(50) DEFAULT NULL,
  `so_title` varchar(50) NOT NULL DEFAULT '',
  `so_album` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`so_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

LOCK TABLES `Songs` WRITE;
/*!40000 ALTER TABLE `Songs` DISABLE KEYS */;

INSERT INTO `Songs` (`so_id`, `so_artist`, `so_title`, `so_album`)
VALUES
	(0,'Janelle Monae','Many Moons','Metropolis: The Chase Suite'),
	(1,'Fun.','Some Nights','Some Nights'),
	(2,'Fun.','We Are Young','Some Nights'),
	(3,'MIKA','Love Today','Life in Cartoon Motion'),
	(4,'Jessie J','Domino','Who Are You');

/*!40000 ALTER TABLE `Songs` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table SongToQueue
# ------------------------------------------------------------

DROP TABLE IF EXISTS `SongToQueue`;

CREATE TABLE `SongToQueue` (
  `stq_songId` int(11) unsigned NOT NULL,
  `stq_queueId` int(11) unsigned NOT NULL,
  `stq_votes` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`stq_songId`,`stq_queueId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `SongToQueue` WRITE;
/*!40000 ALTER TABLE `SongToQueue` DISABLE KEYS */;

INSERT INTO `SongToQueue` (`stq_songId`, `stq_queueId`, `stq_votes`)
VALUES
	(0,0,1),
	(0,1,1),
	(2,0,1);

/*!40000 ALTER TABLE `SongToQueue` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Users`;

CREATE TABLE `Users` (
  `us_id` int(11) NOT NULL AUTO_INCREMENT,
  `us_username` varchar(50) NOT NULL,
  `us_password` varchar(50) NOT NULL,
  `us_email` varchar(50) NOT NULL,
  `us_join_date` datetime NOT NULL,
  PRIMARY KEY (`us_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;

INSERT INTO `Users` (`us_id`, `us_username`, `us_password`, `us_email`, `us_join_date`)
VALUES
	(1,'ericso','5f4dcc3b5aa765d61d8327deb882cf99','ericso@gmail.com','2013-01-13 00:09:43');

/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Venues
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Venues`;

CREATE TABLE `Venues` (
  `ve_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ve_name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`ve_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

LOCK TABLES `Venues` WRITE;
/*!40000 ALTER TABLE `Venues` DISABLE KEYS */;

INSERT INTO `Venues` (`ve_id`, `ve_name`)
VALUES
	(0,'The Boom Boom Room'),
	(1,'The Mallard'),
	(2,'Elbow Room'),
	(3,'The Apollo'),
	(4,'DNA Lounge'),
	(5,'Sens');

/*!40000 ALTER TABLE `Venues` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
