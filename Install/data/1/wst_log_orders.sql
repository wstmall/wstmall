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
 INSERT INTO `wst_log_orders` VALUES('1', '2', '下单成功', '9', '0', '2015-05-19 23:35:49'),
 ('2', '2', '商家已受理订单', '9', '0', '2015-05-19 23:40:20'),
 ('3', '2', '订单打包中', '9', '0', '2015-05-19 23:41:11'),
 ('4', '2', '商家已发货', '9', '0', '2015-05-19 23:41:49'),
 ('5', '2', '用户已收货', '9', '0', '2015-05-19 23:42:31'),
 ('6', '2', '用户已收货', '9', '0', '2015-05-19 23:42:39'),
 ('7', '2', '用户已收货', '9', '0', '2015-05-19 23:59:42'),
 ('8', '2', '用户已收货', '9', '0', '2015-05-19 23:59:50'),
 ('9', '2', '用户拒收', '9', '0', '2015-05-19 23:59:57'),
 ('10', '2', '商家确认拒收', '9', '0', '2015-05-20 00:09:38'),
 ('11', '3', '下单成功', '9', '0', '2015-05-24 15:59:46');
