SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_log_operates`
-- ----------------------------
DROP TABLE IF EXISTS `wst_log_operates`;
CREATE TABLE `wst_log_operates` (
  `operateId` int(11) NOT NULL AUTO_INCREMENT,
  `staffId` int(11) NOT NULL,
  `operateTime` datetime NOT NULL,
  `module` varchar(20) NOT NULL,
  `operateURI` varchar(150) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`operateId`),
  KEY `operateTime` (`operateTime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_log_operates
-- ----------------------------
