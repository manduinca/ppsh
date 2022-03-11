-- MySQL dump 10.13  Distrib 5.6.51, for Linux (x86_64)
--
-- Host: localhost    Database: devel_sencico
-- ------------------------------------------------------
-- Server version	5.6.51

CREATE TABLE `location` (
  `id` int(10) unsigned NOT NULL,
  `latitude` varchar(10) DEFAULT NULL,
  `longitude` varchar(10) DEFAULT NULL,
  `pol` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `point_polygon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `latitude` varchar(10) NOT NULL,
  `longitude` varchar(10) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `polygon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `points` varchar(2860) DEFAULT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `zer0` (
  `id` int(10) unsigned NOT NULL,
  `Periodo` varchar(5) DEFAULT NULL,
  `X` varchar(10) DEFAULT NULL,
  `Y` varchar(30) DEFAULT NULL,
  KEY `id` (`id`),
  CONSTRAINT `zer0_ibfk_1` FOREIGN KEY (`id`) REFERENCES `location` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `zer1` (
  `id` int(10) unsigned NOT NULL,
  `Periodo` varchar(5) DEFAULT NULL,
  `X` varchar(10) DEFAULT NULL,
  `Y` varchar(30) DEFAULT NULL,
  KEY `id` (`id`),
  CONSTRAINT `zer1_ibfk_1` FOREIGN KEY (`id`) REFERENCES `location` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `zer2` (
  `id` int(10) unsigned NOT NULL,
  `Periodo` varchar(5) DEFAULT NULL,
  `X` varchar(10) DEFAULT NULL,
  `Y` varchar(30) DEFAULT NULL,
  KEY `id` (`id`),
  CONSTRAINT `zer2_ibfk_1` FOREIGN KEY (`id`) REFERENCES `location` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `zer3` (
  `id` int(10) unsigned NOT NULL,
  `Periodo` varchar(5) DEFAULT NULL,
  `X` varchar(10) DEFAULT NULL,
  `Y` varchar(30) DEFAULT NULL,
  KEY `id` (`id`),
  CONSTRAINT `zer3_ibfk_1` FOREIGN KEY (`id`) REFERENCES `location` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `zer4` (
  `id` int(10) unsigned NOT NULL,
  `Periodo` varchar(5) DEFAULT NULL,
  `X` varchar(10) DEFAULT NULL,
  `Y` varchar(30) DEFAULT NULL,
  KEY `id` (`id`),
  CONSTRAINT `zer4_ibfk_1` FOREIGN KEY (`id`) REFERENCES `location` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `zer5` (
  `id` int(10) unsigned NOT NULL,
  `Periodo` varchar(5) DEFAULT NULL,
  `X` varchar(10) DEFAULT NULL,
  `Y` varchar(30) DEFAULT NULL,
  KEY `id` (`id`),
  CONSTRAINT `zer5_ibfk_1` FOREIGN KEY (`id`) REFERENCES `location` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `zer6` (
  `id` int(10) unsigned NOT NULL,
  `Periodo` varchar(5) DEFAULT NULL,
  `X` varchar(10) DEFAULT NULL,
  `Y` varchar(30) DEFAULT NULL,
  KEY `id` (`id`),
  CONSTRAINT `zer6_ibfk_1` FOREIGN KEY (`id`) REFERENCES `location` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `zer7` (
  `id` int(10) unsigned NOT NULL,
  `Periodo` varchar(5) DEFAULT NULL,
  `X` varchar(10) DEFAULT NULL,
  `Y` varchar(30) DEFAULT NULL,
  KEY `id` (`id`),
  CONSTRAINT `zer7_ibfk_1` FOREIGN KEY (`id`) REFERENCES `location` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
