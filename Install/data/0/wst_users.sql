SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_users`
-- ----------------------------
DROP TABLE IF EXISTS `wst_users`;
CREATE TABLE `wst_users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `loginName` varchar(20) NOT NULL,
  `loginSecret` int(11) NOT NULL,
  `loginPwd` varchar(50) NOT NULL,
  `userSex` tinyint(4) DEFAULT '0',
  `userType` tinyint(4) DEFAULT '0',
  `userName` varchar(20) DEFAULT NULL,
  `userQQ` varchar(20) DEFAULT NULL,
  `userPhone` char(11) DEFAULT NULL,
  `userEmail` varchar(50) DEFAULT NULL,
  `userScore` int(11) DEFAULT '0',
  `userPhoto` varchar(150) DEFAULT NULL,
  `userTotalScore` int(11) DEFAULT '0',
  `userStatus` tinyint(4) DEFAULT '1',
  `userFlag` tinyint(4) DEFAULT '1',
  `createTime` datetime DEFAULT NULL,
  `lastIP` varchar(16) DEFAULT NULL,
  `lastTime` datetime DEFAULT NULL,
  `userFrom` tinyint(4) DEFAULT '0',
  `openId` varchar(50) DEFAULT NULL,
  `wxOpenId` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`userId`),
  KEY `userStatus` (`userStatus`,`userFlag`),
  KEY `loginName` (`loginName`),
  KEY `userPhone` (`userPhone`),
  KEY `userEmail` (`userEmail`),
  KEY `userType` (`userType`,`userFlag`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_users
-- ----------------------------
