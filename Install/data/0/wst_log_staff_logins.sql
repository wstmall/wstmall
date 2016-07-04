SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_log_staff_logins`
-- ----------------------------
DROP TABLE IF EXISTS `wst_log_staff_logins`;
CREATE TABLE `wst_log_staff_logins` (
  `loginId` int(11) NOT NULL AUTO_INCREMENT,
  `staffId` int(11) NOT NULL,
  `loginTime` datetime NOT NULL,
  `loginIp` varchar(16) NOT NULL,
  PRIMARY KEY (`loginId`),
  KEY `loginTime` (`loginTime`),
  KEY `staffId` (`staffId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_log_staff_logins
-- ----------------------------
