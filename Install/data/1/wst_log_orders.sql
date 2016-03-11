SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `wst_log_orders`
-- ----------------------------
DROP TABLE IF EXISTS `wst_log_orders`;
CREATE TABLE `wst_log_orders` (
  `logId` int(11) NOT NULL AUTO_INCREMENT,
  `orderId` int(11) NOT NULL,
  `logContent` varchar(255) NOT NULL,
  `logUserId` int(11) NOT NULL,
  `logType` tinyint(4) NOT NULL DEFAULT '0',
  `logTime` datetime NOT NULL,
  PRIMARY KEY (`logId`),
  KEY `orderId` (`orderId`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of wst_log_orders
-- ----------------------------
INSERT INTO `wst_log_orders` VALUES ('12', '4', '下单成功', '9', '0', '2016-03-07 21:27:08')，
('13', '4', '商家已受理订单', '9', '0', '2016-03-07 21:27:41')，
('14', '4', '订单打包中', '9', '0', '2016-03-07 21:27:54')，
('15', '4', '商家已发货', '9', '0', '2016-03-07 21:28:08')，
('16', '4', '用户已收货', '9', '0', '2016-03-07 21:28:40');
