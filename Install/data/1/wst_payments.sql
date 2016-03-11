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
  PRIMARY KEY (`id`),
  KEY `payCode` (`payCode`,`enabled`,`isOnline`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_payments
-- ----------------------------
INSERT INTO `wst_payments` VALUES ('1', 'cod', '货到付款', '开通城市', '1', '', '1', '0'),
 ('2', 'alipay', '支付宝', '', '2', '', '0', '1'),
('3', 'Weixin', '微信支付', '微信支付', '0', '', '0', '1');