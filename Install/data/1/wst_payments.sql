SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_payments`
-- ----------------------------
DROP TABLE IF EXISTS `wst_payments`;
CREATE TABLE `wst_payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payCode` varchar(255) DEFAULT NULL,
  `payName` varchar(255) DEFAULT NULL,
  `payDesc` text,
  `payOrder` int(11) DEFAULT '0',
  `payConfig` text,
  `enabled` tinyint(4) DEFAULT '0',
  `isOnline` tinyint(4) DEFAULT '0',
  `payFor` varchar(20) DEFAULT '1,2,3,4',
  PRIMARY KEY (`id`),
  KEY `payCode` (`payCode`,`enabled`,`isOnline`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_payments
-- ----------------------------
INSERT INTO `wst_payments` VALUES ('1', 'cod', '货到付款', '开通城市', '1', '\"\"', '1', '0', '1,2,3,4');
INSERT INTO `wst_payments` VALUES ('2', 'alipay', '支付宝(及时到帐)', '支付宝(及时到帐)', '2', '', '0', '1', '1,2,4');
INSERT INTO `wst_payments` VALUES ('3', 'weixin', '微信支付', '微信支付', '0', '', '0', '1', '1,3');
INSERT INTO `wst_payments` VALUES ('4', 'app_weixin', '微信支付', 'App微信支付', '0', '', '0', '0', '4');
