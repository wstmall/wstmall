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
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_banks
-- ----------------------------
INSERT INTO `wst_banks` VALUES ('17', '中国工商银行', '1'),
 ('18', '中国农业银行', '1'),
 ('19', '中国人民银行', '1'),
 ('20', '招商银行', '1'),
 ('21', '中兴银行', '1'),
 ('22', '交通银行', '1'),
 ('23', '深圳发展银行', '1'),
 ('24', '中国光大银行', '1');
