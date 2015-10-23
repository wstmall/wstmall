SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_user_ranks`
-- ----------------------------
DROP TABLE IF EXISTS `wst_user_ranks`;
CREATE TABLE `wst_user_ranks` (
  `rankId` int(11) NOT NULL AUTO_INCREMENT,
  `rankName` varchar(20) NOT NULL,
  `startScore` int(11) NOT NULL DEFAULT '0',
  `endScore` int(11) NOT NULL DEFAULT '0',
  `rebate` int(11) DEFAULT '100',
  `createTime` datetime NOT NULL,
  PRIMARY KEY (`rankId`),
  KEY `startScore` (`startScore`,`endScore`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_user_ranks
-- ----------------------------
