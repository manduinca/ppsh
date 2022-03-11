-- To schema v2 from schema v1

USE `devel_sencico`;

DROP TABLE `w_one`;
DROP TABLE `zer0`;
DROP TABLE `zer1`;
DROP TABLE `zer2`;
DROP TABLE `zer3`;
DROP TABLE `zer4`;
DROP TABLE `zer5`;
DROP TABLE `zer6`;
DROP TABLE `zer7`;

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

DELETE FROM `polygon` WHERE type = 1;
DELETE FROM `point_polygon` WHERE type = 1;
