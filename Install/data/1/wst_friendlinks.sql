SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_friendlinks`
-- ----------------------------
DROP TABLE IF EXISTS `wst_friendlinks`;
CREATE TABLE `wst_friendlinks` (
  `friendlinkId` int(11) NOT NULL AUTO_INCREMENT,
  `friendlinkIco` varchar(150) DEFAULT NULL,
  `friendlinkName` varchar(50) DEFAULT NULL,
  `friendlinkUrl` varchar(150) DEFAULT NULL,
  `friendlinkSort` int(11) DEFAULT '0',
  PRIMARY KEY (`friendlinkId`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_friendlinks
-- ----------------------------
INSERT INTO `wst_friendlinks` VALUES ('1', 'Apps/Home/View/default/images/logo.png', 'WSTMall', 'http://www.wstmall.com', '0');
