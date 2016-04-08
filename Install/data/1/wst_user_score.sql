
DROP TABLE IF EXISTS `wst_user_score`;
CREATE TABLE `wst_user_score` (
  `scoreId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL DEFAULT '0',
  `score` int(11) NOT NULL DEFAULT '0',
  `dataSrc` int(11) NOT NULL DEFAULT '0',
  `dataId` int(11) NOT NULL DEFAULT '0',
  `dataRemarks` text,
  `scoreType` int(11) NOT NULL DEFAULT '0',
  `createTime` datetime DEFAULT NULL,
  PRIMARY KEY (`scoreId`),
  KEY `userId` (`userId`),
  KEY `userId_2` (`userId`,`dataSrc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

