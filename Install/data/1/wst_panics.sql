
SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `wst_panics`;
CREATE TABLE `wst_panics` (
  `panicId` int(11) NOT NULL AUTO_INCREMENT,
  `shopId` int(11) NOT NULL DEFAULT '0',
  `panicName` varchar(200) NOT NULL,
  `startTime` datetime NOT NULL,
  `endTime` datetime NOT NULL,
  `panicDes` text,
  `createTime` datetime NOT NULL,
  `dataFlag` tinyint(4) NOT NULL DEFAULT '1',
  `panicStatus` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`panicId`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
