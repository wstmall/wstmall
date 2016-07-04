SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_banks`
-- ----------------------------
DROP TABLE IF EXISTS `wst_banks`;
CREATE TABLE `wst_banks` (
  `bankId` int(11) NOT NULL AUTO_INCREMENT,
  `bankName` varchar(50) DEFAULT NULL,
  `bankFlag` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`bankId`),
  KEY `bankFlag` (`bankFlag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_banks
-- ----------------------------
