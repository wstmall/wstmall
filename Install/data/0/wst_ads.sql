SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `wst_ads`;
CREATE TABLE `wst_ads` (
  `adId` int(11) NOT NULL AUTO_INCREMENT,
  `adPositionId` int(11) DEFAULT NULL,
  `areaId1` int(11) NOT NULL,
  `areaId2` int(11) NOT NULL,
  `adType` tinyint(4) NOT NULL DEFAULT '0',
  `adFile` varchar(150) NOT NULL,
  `adName` varchar(100) NOT NULL,
  `adURL` varchar(150) NOT NULL,
  `adStartDate` date NOT NULL,
  `adEndDate` date NOT NULL,
  `adSort` int(11) NOT NULL DEFAULT '0',
  `adClickNum` int(11) DEFAULT '0',
  PRIMARY KEY (`adId`),
  KEY `adPositionId` (`adPositionId`,`areaId1`,`areaId2`,`adStartDate`,`adEndDate`),
  KEY `adPositionId_2` (`adPositionId`,`areaId1`,`areaId2`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
