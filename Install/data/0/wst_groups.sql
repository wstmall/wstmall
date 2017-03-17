
SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `wst_groups`;
CREATE TABLE `wst_groups` (
  `groupId` int(11) NOT NULL AUTO_INCREMENT,
  `shopId` int(11) NOT NULL DEFAULT '0',
  `groupName` varchar(200) NOT NULL,
  `startTime` datetime NOT NULL,
  `endTime` datetime DEFAULT NULL,
  `groupDes` text NOT NULL,
  `createTime` datetime NOT NULL,
  `dataFlag` tinyint(4) NOT NULL DEFAULT '1',
  `groupStatus` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`groupId`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

