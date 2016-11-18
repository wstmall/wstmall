
SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_distribut_users`
-- ----------------------------
DROP TABLE IF EXISTS `wst_distribut_users`;
CREATE TABLE `wst_distribut_users` (
  `distributId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT '0',
  `buyerId` int(11) DEFAULT '0',
  `createTime` datetime DEFAULT NULL,
  PRIMARY KEY (`distributId`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_distribut_users
-- ----------------------------
