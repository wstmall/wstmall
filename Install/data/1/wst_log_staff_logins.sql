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
) ENGINE=MyISAM AUTO_INCREMENT=180 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_log_staff_logins
-- ----------------------------
INSERT INTO `wst_log_staff_logins` VALUES ('178', '1', '2015-06-02 22:50:57', '127.0.0.1');
INSERT INTO `wst_log_staff_logins` VALUES ('179', '1', '2015-06-04 22:37:16', '127.0.0.1');
