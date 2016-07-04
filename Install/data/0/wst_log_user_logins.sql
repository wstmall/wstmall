SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_log_user_logins`
-- ----------------------------
DROP TABLE IF EXISTS `wst_log_user_logins`;
CREATE TABLE `wst_log_user_logins` (
  `loginId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `loginTime` datetime NOT NULL,
  `loginIp` varchar(16) NOT NULL,
  `loginSrc` tinyint(3) unsigned DEFAULT '0' COMMENT '0:商城  1:webapp  2:App',
  `loginRemark` varchar(30) DEFAULT NULL COMMENT '登录备注信息',
  PRIMARY KEY (`loginId`),
  KEY `loginTime` (`loginTime`),
  KEY `userId` (`userId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_log_user_logins
-- ----------------------------
