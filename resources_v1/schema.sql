-- MySQL dump 10.13  Distrib 5.6.51, for Linux (x86_64)
--
-- Host: localhost    Database: devel_sencico
-- ------------------------------------------------------
-- Server version	5.6.51

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(10) unsigned NOT NULL,
  `latitude` varchar(10) DEFAULT NULL,
  `longitude` varchar(10) DEFAULT NULL,
  `pol` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `point_polygon`
--

CREATE TABLE `point_polygon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `latitude` varchar(10) NOT NULL,
  `longitude` varchar(10) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `polygon`
--

CREATE TABLE `polygon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `points` varchar(2860) DEFAULT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `w_one`
--

CREATE TABLE `w_one` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Y_y` varchar(5) NOT NULL,
  `Y_z` varchar(5) NOT NULL,
  `Y_mc` varchar(5) NOT NULL,
  `Y_ab` varchar(5) NOT NULL,
  `Y_bc` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `zer0`
--

CREATE TABLE `zer0` (
  `id` int(10) unsigned NOT NULL,
  `Periodo` varchar(5) DEFAULT NULL,
  `X` varchar(10) DEFAULT NULL,
  `Y_y` varchar(30) DEFAULT NULL,
  `Y_z` varchar(30) DEFAULT NULL,
  `Y_mc` varchar(30) DEFAULT NULL,
  `Y_ab` varchar(30) DEFAULT NULL,
  `Y_bc` varchar(30) DEFAULT NULL,
  KEY `id` (`id`),
  CONSTRAINT `zer0_ibfk_1` FOREIGN KEY (`id`) REFERENCES `location` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `zer1`
--

CREATE TABLE `zer1` (
  `id` int(10) unsigned NOT NULL,
  `Periodo` varchar(5) DEFAULT NULL,
  `X` varchar(10) DEFAULT NULL,
  `Y_y` varchar(30) DEFAULT NULL,
  `Y_z` varchar(30) DEFAULT NULL,
  `Y_mc` varchar(30) DEFAULT NULL,
  `Y_ab` varchar(30) DEFAULT NULL,
  `Y_bc` varchar(30) DEFAULT NULL,
  KEY `id` (`id`),
  CONSTRAINT `zer1_ibfk_1` FOREIGN KEY (`id`) REFERENCES `location` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `zer2`
--

CREATE TABLE `zer2` (
  `id` int(10) unsigned NOT NULL,
  `Periodo` varchar(5) DEFAULT NULL,
  `X` varchar(10) DEFAULT NULL,
  `Y_y` varchar(30) DEFAULT NULL,
  `Y_z` varchar(30) DEFAULT NULL,
  `Y_mc` varchar(30) DEFAULT NULL,
  `Y_ab` varchar(30) DEFAULT NULL,
  `Y_bc` varchar(30) DEFAULT NULL,
  KEY `id` (`id`),
  CONSTRAINT `zer2_ibfk_1` FOREIGN KEY (`id`) REFERENCES `location` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `zer3`
--

CREATE TABLE `zer3` (
  `id` int(10) unsigned NOT NULL,
  `Periodo` varchar(5) DEFAULT NULL,
  `X` varchar(10) DEFAULT NULL,
  `Y_y` varchar(30) DEFAULT NULL,
  `Y_z` varchar(30) DEFAULT NULL,
  `Y_mc` varchar(30) DEFAULT NULL,
  `Y_ab` varchar(30) DEFAULT NULL,
  `Y_bc` varchar(30) DEFAULT NULL,
  KEY `id` (`id`),
  CONSTRAINT `zer3_ibfk_1` FOREIGN KEY (`id`) REFERENCES `location` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `zer4`
--

CREATE TABLE `zer4` (
  `id` int(10) unsigned NOT NULL,
  `Periodo` varchar(5) DEFAULT NULL,
  `X` varchar(10) DEFAULT NULL,
  `Y_y` varchar(30) DEFAULT NULL,
  `Y_z` varchar(30) DEFAULT NULL,
  `Y_mc` varchar(30) DEFAULT NULL,
  `Y_ab` varchar(30) DEFAULT NULL,
  `Y_bc` varchar(30) DEFAULT NULL,
  KEY `id` (`id`),
  CONSTRAINT `zer4_ibfk_1` FOREIGN KEY (`id`) REFERENCES `location` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `zer5`
--

CREATE TABLE `zer5` (
  `id` int(10) unsigned NOT NULL,
  `Periodo` varchar(5) DEFAULT NULL,
  `X` varchar(10) DEFAULT NULL,
  `Y_y` varchar(30) DEFAULT NULL,
  `Y_z` varchar(30) DEFAULT NULL,
  `Y_mc` varchar(30) DEFAULT NULL,
  `Y_ab` varchar(30) DEFAULT NULL,
  `Y_bc` varchar(30) DEFAULT NULL,
  KEY `id` (`id`),
  CONSTRAINT `zer5_ibfk_1` FOREIGN KEY (`id`) REFERENCES `location` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `zer6`
--

CREATE TABLE `zer6` (
  `id` int(10) unsigned NOT NULL,
  `Periodo` varchar(5) DEFAULT NULL,
  `X` varchar(10) DEFAULT NULL,
  `Y_y` varchar(30) DEFAULT NULL,
  `Y_z` varchar(30) DEFAULT NULL,
  `Y_mc` varchar(30) DEFAULT NULL,
  `Y_ab` varchar(30) DEFAULT NULL,
  `Y_bc` varchar(30) DEFAULT NULL,
  KEY `id` (`id`),
  CONSTRAINT `zer6_ibfk_1` FOREIGN KEY (`id`) REFERENCES `location` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `zer7`
--

CREATE TABLE `zer7` (
  `id` int(10) unsigned NOT NULL,
  `Periodo` varchar(5) DEFAULT NULL,
  `X` varchar(10) DEFAULT NULL,
  `Y_y` varchar(30) DEFAULT NULL,
  `Y_z` varchar(30) DEFAULT NULL,
  `Y_mc` varchar(30) DEFAULT NULL,
  `Y_ab` varchar(30) DEFAULT NULL,
  `Y_bc` varchar(30) DEFAULT NULL,
  KEY `id` (`id`),
  CONSTRAINT `zer7_ibfk_1` FOREIGN KEY (`id`) REFERENCES `location` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
